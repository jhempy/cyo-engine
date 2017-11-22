@extends('layouts.app-panel')

@section('title')

    All Adventures

@endsection

@section('content')

    <p class="headline">Adventures</p>

    <read-list :adventures='{!! json_encode($adventures) !!}'></read-list>

@endsection
