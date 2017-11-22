@extends('layouts.app-panel')

@section('title')

    All Adventures

@endsection

@section('content')

    <p class="headline">Adventures</p>

    @if (count($adventures) > 0)
        @foreach ($adventures as $a)
            <p><strong><a href="/read/{{ $a->id }}">{{ $a->title }}</a></strong></p>
            <p style="padding-left: 20px;">{{ $a->description }}</p>
        @endforeach
    @else
        <p>There are no published stories to read. Sorry!</p>
    @endif

@endsection
