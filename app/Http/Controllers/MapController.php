<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $adventure = \App\Adventure::findOrFail($id);

        if ($adventure->user_id == \Auth::user()->id) {

            $nodes = "graph TB\n";
            foreach ($adventure->pages()->orderBy('id')->get() as $page) {
                $nodes .= "\tPage" . $page->id . '[' . $page->name . "]\n";
                $nodes .= "\tclass Page" . $page->id;
                if ($page->is_the_end) {
                    $nodes .= " mapEnd\n";
                }
                else {
                    if ($adventure->first_page_id == $page->id) {
                        $nodes .= " mapStart\n";
                    }
                    else {
                        $nodes .= " mapChoice\n";
                    }
                }
                $nodes .= "\tclick Page" . $page->id . ' "/pages/' . $page->id . "/edit\"\n";
                foreach ($page->choices()->orderBy('wording')->get() as $choice) {
                    $nodes .= "\tPage" . $page->id . '-->|' . $choice->wording . '|Page' . $choice->next_page_id . "\n";
                }
            }
            $adventure->mermaid = $nodes;

            return view('map.show', compact('adventure'));

        }
        else {
            return view('home');
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
