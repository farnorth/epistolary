@extends('epistolary::layout')

@section('newsletter-content')
  <h1>{{ $list->name }}</h1>

  <form action="{{ route('epistolary::lists.update', [$list->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('epistolary::lists.form')

    <!-- SUBMIT OR CANCEL -->
    <div class="form-group">
      <button type="submit" class="btn btn-success btn-lg">Save</button>
      <a href="{{ route('epistolary::lists.index') }}" class="btn btn-default">Cancel</a>
    </div>

  </form>
@endsection
