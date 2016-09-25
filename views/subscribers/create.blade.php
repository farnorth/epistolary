@extends('epistolary::layout')

@section('content')
  <h1>Add a new subscriber</h1>

  <form action="{{ route('epistolary::subscribers.store') }}" method="POST">
    {{ csrf_field() }}

    @include('epistolary::subscribers.form')

  </form>
@endsection
