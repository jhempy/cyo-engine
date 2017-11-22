@extends('layouts.app-panel')

@section('content')

<p class="headline">Create an Adventure</p>

<form id="create" v-cloak method="post" action="{{ url('/adventures') }}">

  {{ csrf_field() }}

  <div class="form-group">
    <label for="adventureTitle">Adventure Title</label>
    <input 
      type="text" 
      class="form-control" 
      id="adventureTitle" 
      name="adventureTitle" 
      placeholder="The Hobbit, or There and Back Again">
  </div>
  <div class="form-group">
    <label for="adventureDescription">Adventure Decription</label>
    <textarea 
      class="form-control" 
      rows="3" 
      id="adventureDescription" 
      name="adventureDescription" 
      placeholder="The Hobbit is set in a time between the Dawn of Faerie and the Dominion of Men, and follows the quest of home-loving hobbit Bilbo Baggins to win a share of the treasure guarded by Smaug the dragon. Bilbo's journey takes him from light-hearted, rural surroundings into more sinister territory.">
    </textarea>
  </div>
  <div class="form-group">
    <label for="firstPageName">First Page Name</label>
    <input 
      type="text" 
      class="form-control" 
      id="firstPageName" 
      name="firstPageName" 
      placeholder="There and Back Again">
  </div>
  <div class="form-group">
    <label for="firstPageText">First Page Text</label>
    <textarea 
      class="form-control" 
      rows="3" 
      id="firstPageText" 
      name="firstPageText"
      placeholder="In a hole in the ground there lived a hobbit. Not a nasty, dirty, wet hole, filled with the ends of worms and an oozy smell, nor yet a dry, bare, sandy hole with nothing in it to sit down on or to eat: it was a hobbit-hole, and that means comfort.">
    </textarea>
  </div>

  {{--<decisions></decisions>--}}

  <div class="pull-right">
    <button type="submit" class="btn btn-primary">Create</button>
  </div>

</form>

@endsection