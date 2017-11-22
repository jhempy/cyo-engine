@extends('layouts.app-panel')

@section('content')

<p><strong>Adventure:</strong> {{ $adventure->title }} <a class="small-side-link" href="/adventures">(change)</a></p>

<p class="headline">Create a Page</p>

<form id="create" v-cloak method="post" action="{{ url('/pages') }}">

  {{ csrf_field() }}

  <div class="form-group">
    <label for="pageName">Page Name</label>
    <input 
      type="text" 
      class="form-control" 
      id="pageName" 
      name="pageName" 
      placeholder="There and Back Again">
  </div>
  <div class="form-group">
    <label for="pageText">Page Text</label>
    <textarea 
      class="form-control" 
      rows="3" 
      id="pageText" 
      name="pageText"
      placeholder="In a hole in the ground there lived a hobbit. Not a nasty, dirty, wet hole, filled with the ends of worms and an oozy smell, nor yet a dry, bare, sandy hole with nothing in it to sit down on or to eat: it was a hobbit-hole, and that means comfort.">
    </textarea>
  </div>

  {{--<decisions></decisions>--}}

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Create</button>
  </div>

</form>

@endsection