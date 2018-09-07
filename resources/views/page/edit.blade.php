@extends('layouts.app-panel')

@section('content')

<p class="headline">Edit a Page from <em><a href="/adventures/{{ $adventure->id }}/edit">{{ $adventure->title }}</a></em></p>

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

  <div class="form-group">
    <label for="decisionPrompt">Decision Prompt</label>
    <input
      type="text"
      class="form-control"
      id="decisionPrompt"
      name="decisionPrompt"
      value="{{ $page->decision_prompt }}">
  </div>

  <choices :choices='{{ $page->choices()->get()->toJson() }}' :pages='{{ $pages->toJson() }}'></choices>

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Update</button>
  </div>

</form>

@endsection

@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#pageText').summernote({
          toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']]
          ]
        });
    });
</script>
@stop
