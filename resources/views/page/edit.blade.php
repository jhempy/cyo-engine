@extends('layouts.app-panel')

@section('content')

  <p><strong>Adventure:</strong> <a href='/adventures/{{ $adventure->id }}/edit'>{{ $adventure->title }}</a> <a class="small-side-link" href="/adventures">(change)</a></p>

<p class="headline">Edit Page</p>

<form id="edit" v-cloak method="post" action="{{ url('/pages/' . $page->id) }}">

  {{ method_field('PATCH') }}
  {{ csrf_field() }}

  <div class="form-group">
    <label for="pageName">Page Name</label>
    <input 
      type="text" 
      class="form-control" 
      id="pageName" 
      name="pageName" 
      value="{{ $page->name }}">
  </div>
  <div class="form-group">
    <label for="pageText">Page Text</label>
    <textarea 
      class="form-control" 
      rows="3" 
      id="pageText" 
      name="pageText">{{ $page->page_text }}</textarea>
  </div>

  <div class="form-group">
    <label>Is this the first page of the adventure?</label>
    &nbsp;
    <label class="radio-inline">
      <input type="radio" name="isFirstPage" value="1" {{ $adventure->first_page_id === $page->id ? 'checked' : '' }}> Yes
    </label>
    <label class="radio-inline">
      <input type="radio" name="isFirstPage" value="0" {{ $adventure->first_page_id === $page->id ? '' : 'checked' }}> No
    </label>
  </div>

  <div class="form-group">
    <label>Is this page an ending?</label>
    &nbsp;
    <label class="radio-inline">
      <input type="radio" name="isTheEnd" value="1" {{ $page->is_the_end === true ? 'checked' : '' }}> Yes
    </label>
    <label class="radio-inline">
      <input type="radio" name="isTheEnd" value="0" {{ $page->is_the_end === true ? '' : 'checked' }}> No
    </label>
  </div>

  {{--<decisions></decisions>--}}

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>

</form>

@endsection