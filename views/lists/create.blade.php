@extends('epistolary::layout')

@section('newsletter-content')
  <h1>Create a new list</h1>

  <form action="{{ route('epistolary::lists.store') }}" method="POST">
    {{ csrf_field() }}

    @include('epistolary::lists.form')

    <!-- SUBMIT OR CANCEL -->
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-lg">Add List</button>
      <a href="{{ route('epistolary::lists.index') }}" class="btn btn-default">Cancel</a>
    </div>

  </form>
@endsection
