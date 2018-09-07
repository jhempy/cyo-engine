<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
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
        return "List of pages";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $adventure = \App\Adventure::find(session('adventure_id'));
        $pages = $adventure->pages()->orderBy('name')->get();
        return view('page.create', compact('adventure', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Which adventure?
        $adventure_id = session('adventure_id');

        // Create the page
        $page = new \App\Page;
        $page->name = $request->input('pageName');
        $page->page_text = $request->input('pageText');
        if ($request->input('decisionPrompt') != '') {
            $page->decision_prompt = $request->input('decisionPrompt');
        }
        $page->adventure_id = $adventure_id;
        $page->save();

        return redirect('/adventures/' . $adventure_id . '/edit');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = \App\Page::with('choices')->where('id', $id)->first();
        return $page;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $adventure = \App\Adventure::find(session('adventure_id'));
        $page = \App\Page::find($id);
        $pages = $adventure->pages()->orderBy('name')->get();

        return view('page.edit', compact('adventure', 'page', 'pages'));
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
        // Fetch the page
        $page = \App\Page::find($id);
        $page->name = $request->input('pageName');
        $page->page_text = $request->input('pageText');
        if ($request->input('decisionPrompt') != '') {
            $page->decision_prompt = $request->input('decisionPrompt');
        }

        // Change adventure first page
        if ($request->input('isFirstPage')) {
            $page->adventure->first_page_id = $id;
            $page->adventure->save();
        }
        else {
            if ($page->adventure->first_page_id == $id) {
                $page->adventure->first_page_id = null;
                $page->adventure->save();
            }

        }

        // Remove old choices
        $page->choices()->delete();

        // Is this a final page?
        if ($request->input('isTheEnd')) {
            $page->is_the_end = true;
        }
        else {
            $page->is_the_end = false;

            // Save new choices
            $choices = json_decode($request->input('choices'), true);
            foreach ($choices as $choice) {
                $new = new \App\Choice;
                $new->page_id = $page->id;
                $new->next_page_id = $choice['next_page_id'];
                $new->wording = $choice['wording'];
                $new->save();
            }

        }

        // Save page
        $page->save();

        return redirect('/adventures/' . $page->adventure_id . '/edit');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "Delete a page";
    }

}
