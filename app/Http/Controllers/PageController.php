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
        $decisions = [];
        return view('page.create', compact('adventure', 'decisions'));
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
        $page->adventure_id = $adventure_id;
        $page->save();

        // Add the decisions to the page
        $choices = $request->input('decision.*');
        for ($i=0; $i<count($choices); $i++) {
            $choice = new \App\Choice;
            $choice->page_id = $page->id;
            $choice->wording = $choices[$i];
            $choice->save();
        }

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
        return "View a page (no edit)";
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
        $decisions = [];


        // TODO: what data structure should I use for decisions?


        return view('page.edit', compact('adventure', 'page', 'decisions'));
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

        // Is this a final page?
        if ($request->input('isTheEnd')) {
            $page->is_the_end = true;
//            $page->choices()->delete();
        }
        else {
            $page->is_the_end = false;
        }

        // Save choices
//        $choices = $request->input('decision.*');
//        for ($i=0; $i<count($choices); $i++) {
//            $choice = new \App\Choice;
//            $choice->page_id = $page->id;
//            $choice->wording = $choices[$i];
//            $choice->save();
//        }

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
