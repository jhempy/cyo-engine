<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adventures = \App\Adventure::where('publish_date', '!=', null)->get();
        foreach ($adventures as $adventure) {
            $adventure->author_name = $adventure->author->name;
            $adventure->url = "/read/" . $adventure->id;
            $adventure->pubdate = $adventure->pretty_published();
        }

        return view('read.index', compact('adventures'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $go = false;

        // You can see this adventure if either...
        // ...you own it, or
        if ($adventure && !\Auth::guest() && \Auth::user()->id == $adventure->user_id) {
            $go = true;
        }
        // ...it is public and published
        elseif ($adventure && $adventure->is_public && $adventure->publish_date) {
            $go = true;
        }

        if ($go) {
            $page = \App\Page::find($adventure->first_page_id);
            return view('adventure.show', compact('adventure', 'page'));
        }
        else {
            return view('errors.nope');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
