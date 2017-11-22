@extends('layouts.app-panel')

@section('content')

<p class="headline">Edit Adventure</p>

<form id="edit" v-cloak method="post" action="/adventures/{{ $adventure->id }}">

  {{ method_field('PATCH') }}
  {{ csrf_field() }}

  <div class="form-group">
    <label for="adventureTitle">Adventure Title</label>
    <input 
      type="text" 
      class="form-control" 
      id="adventureTitle" 
      name="adventureTitle" 
      value="{{ $adventure->title }}">
  </div>
  <div class="form-group">
    <label for="adventureDescription">Adventure Decription</label>
    <textarea 
      class="form-control" 
      rows="3" 
      id="adventureDescription" 
      name="adventureDescription">{{ $adventure->description }}</textarea>
  </div>
  <div class="form-group">
    <label for="adventureTitle">Publish Date</label>
    <input 
      type="date" 
      class="form-control" 
      id="publishDate" 
      name="publishDate" 
      value="{{ $adventure->publish_date }}">
  </div>


  <p><strong>Pages</strong> <a class="small-side-link" href="/pages/create">(Create)</a></p>
  <ul class="list-unstyled">
  @foreach ($adventure->pages as $page)
    <li>
      @if ($page->id == $adventure->first_page_id)
        <i class="fa fa-play page-icon" aria-hidden="true"></i>
      @else
        <i class="fa page-icon" aria-hidden="true"></i>
      @endif
      @if ($page->is_the_end)
        <i class="fa fa-stop page-icon" aria-hidden="true"></i>
      @else
        <i class="fa page-icon" aria-hidden="true"></i>
      @endif
      <a href="/pages/{{ $page->id }}/edit">{{ $page->name }}</a></li>
  @endforeach
  </ul>

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>

</form>

@endsection