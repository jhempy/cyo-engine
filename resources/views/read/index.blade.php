@extends('layouts.app-panel')

@section('title')

    All Adventures

@endsection

@section('content')

    <read-list :adventures='{!! json_encode($adventures) !!}'></read-list>

@endsection
