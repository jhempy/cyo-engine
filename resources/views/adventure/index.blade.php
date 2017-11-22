@extends('layouts.app-panel')

@section('title')

  All Adventures

@endsection

@section('content')

  <p class="pull-right create-icon"><a href="{{ url('/adventures/create') }}">(Create)</a></p>

  <p class="headline pull-left">My Adventures</p>

  <table class="table">
    <thead>
      <tr>
        <th>Options</th>
        <th>Title</th>
        <th>Description</th>
        <th>Last Update</th>
      </tr>
    </thead>
    <tbody>

    @if (count($adventures) > 0)
      @foreach ($adventures as $a)
        <tr>
          <td>
            <a href="/read/{{ $a->id }}"><i class="option-spacing fa fa-book" aria-hidden="true"></i></a>
            <a href="/adventures/{{ $a->id }}/edit"><i class="option-spacing fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a href="#" v-on:click="deleteAdventure({{ $a->id }})"><i class="option-spacing fa fa-trash-o" aria-hidden="true"></i></a>
          </td>
          <td>{{ $a->title }}</td>
          <td>{{ $a->description }}</td>
          <td>{{ $a->pretty_updated() }}</td>
        </tr>
      @endforeach
    @else
      <tr><td colspan="4" align="center"><br />No adventures - <a href="/adventures/create">write one!</td></tr>
    @endif

    </tbody>
  </table>

  <form class="hidden" id="deleteAdventureForm" method="post" action="#">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
  </form>

@endsection
