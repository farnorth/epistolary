@extends('newsletters::layout')

@section('content')
  <h1>Create a new list</h1>

  <form action="{{ route('newsletters::lists.store') }}" method="POST">
    {{ csrf_field() }}

    <!-- NAME -->
    <div class="form-group">
      <label class="control-label" for="name">Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="List Name" required>
    </div>

    <!-- DESCRIPTION -->
    <div class="form-group">
      <label class="control-label" for="description">Description</label>
      <textarea class="form-control" name="description" id="description" placeholder="Description (optional)" rows="4"></textarea>
    </div>

    <!-- REQUIRES OPT-IN -->
    <div class="form-group">
      <label class="control-label" for="requires_opt_in">Requires Opt-in?</label>
      <div>
        <label class="radio-inline">
          <input type="radio" name="requires_opt_in" id="requires_opt_in1" value="1" checked required> Yes
        </label>
        <label class="radio-inline">
          <input type="radio" name="requires_opt_in" id="requires_opt_in2" value="0" required> No
        </label>
      </div>
    </div>

    <!-- SUBMIT OR CANCEL -->
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-lg">Add List</button>
      <a href="{{ route('newsletters::lists.index') }}" class="btn btn-default">Cancel</a>
    </div>

  </form>
@endsection
