@extends('layouts.app-panel')

@section('content')

    <h3 class="text-center">{{ $adventure->title }}</h3>

    <first-page page_text='{{ $page->page_text }}' page_prompt='{{ $page->decision_prompt }}' :choices='{{ $page->choices()->get()->toJson() }}'></first-page>

@endsection
