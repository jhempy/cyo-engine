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
        $page = new \App\Page;
        $pages = $adventure->pages()->orderBy('name')->get();
        return view('page.create', compact('adventure', 'page', 'pages'));
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

        // Is this a final page?
        if ($request->input('isTheEnd')) {
            $page->is_the_end = true;
            $page->save();
        }
        else {
            $page->is_the_end = false;
            $page->save();

            // Save new choices
            $choices = json_decode($request->input('choices'), true);
            foreach ($choices as $choice) {
                $new = new \App\Choice;
                $new->page_id = $page->id;
                if ($choice['next_page_id'] === 'NEW') {
                    $new_page = new \App\Page;
                    $new_page->name = 'New Page';
                    $new_page->page_text = 'It was a dark and stormy night....';
                    $new_page->adventure_id = $adventure_id;
                    $new_page->save();
                    $choice['next_page_id'] = $new_page->id;
                }
                $new->next_page_id = $choice['next_page_id'];
                $new->wording = $choice['wording'];
                $new->save();
            }

        }

        return redirect('/pages/' . $page->id . '/edit');

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

        return redirect('/pages/' . $page->id . '/edit');

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
