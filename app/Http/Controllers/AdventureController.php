<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class AdventureController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adventures = \App\Adventure::where('user_id', \Auth::user()->id)->orderBy('updated_at', 'desc')->get();
        return view('adventure.index', compact('adventures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adventure.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);

        // Create the adventure
        $adventure = new \App\Adventure;
        $adventure->user_id = \Auth::user()->id;
        $adventure->title = $request->input('adventureTitle');
        $adventure->description = $request->input('adventureDescription');
        $adventure->save();

        // Create the first page
        $page = new \App\Page;
        $page->adventure_id = $adventure->id;
        $page->name = $request->input('firstPageName');
        $page->page_text = $request->input('firstPageText');
        $page->save();

        // Add the first page id to the adventure
        $adventure->first_page_id = $page->id;
        $adventure->save();

        // Add the decisions to the page
        $choices = $request->input('decision.*');
        for ($i=0; $i<count($choices); $i++) {
            $choice = new \App\Choice;
            $choice->page_id = $page->id;
            $choice->wording = $choices[$i];
            $choice->save();
        }

        return redirect('/adventures');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $adventure = \App\Adventure::find($id);
        return $adventure;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Remember the current adventure
        session(['adventure_id' => $id]);

        // Return the edit page
        $adventure = \App\Adventure::find($id);
        return view('adventure.edit', compact('adventure'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $adventure = \App\Adventure::find($id);
        $adventure->title = $request->input('adventureTitle');
        $adventure->description = $request->input('adventureDescription');
        $adventure->publish_date = $request->input('publishDate');
        $adventure->is_public = $request->input('isPublic');
        $adventure->save();
        return redirect('/adventures');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adventure = \App\Adventure::find($id);

        // First, wipe out the first_page_id so that the first page can
        // be deleted later.
        $first_page = \App\Page::find($adventure->first_page_id);
        $adventure->first_page_id = null;
        $adventure->save();

        // Delete choices
        foreach ($first_page->choices as $choice) {
            $choice->delete();
        }
        foreach ($adventure->pages as $page) {
            foreach ($page->choices as $choice) {
                $choice->delete();
            }
        }

        // Delete pages
        $first_page->delete();
        foreach ($adventure->pages as $page) {
            $page->delete();
        }

        // Delete the adventure
        $adventure->delete();

        return redirect('/adventures');
    }
}
