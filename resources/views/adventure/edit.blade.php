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
  <div class="form-group">
    <label>Is this adventure public?</label>
    &nbsp;
    <label class="radio-inline">
      <input type="radio" name="isPublic" value="1" {{ $adventure->is_public ? 'checked' : '' }}> Yes
    </label>
    <label class="radio-inline">
      <input type="radio" name="isPublic" value="0" {{ !$adventure->is_public ? 'checked' : '' }}> No
    </label>
  </div>

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>

  <br />

  <hr />

  <h4><strong>Pages</strong></h4>
  <p><a href="/pages/create">Create a New Page</a></p>
  <table class="table">
      <thead>
          <tr>
              <th>First?</th>
              <th>End?</th>
              <th>Page Name</th>
          </tr>
      </thead>
      <tbody>


  @foreach ($adventure->pages as $page)
  <tr>
    <td>
      @if ($page->id == $adventure->first_page_id)
        <i class="fa fa-play page-icon" aria-hidden="true"></i>
      @else
        <i class="fa page-icon" aria-hidden="true"></i>
      @endif
  </td>
  <td>
      @if ($page->is_the_end)
        <i class="fa fa-stop page-icon" aria-hidden="true"></i>
      @else
        <i class="fa page-icon" aria-hidden="true"></i>
      @endif
  </td>
  <td>
      <a href="/pages/{{ $page->id }}/edit">{{ $page->name }}</a>
  </td>
  @endforeach
</tbody>
</table>

</form>

@endsection
