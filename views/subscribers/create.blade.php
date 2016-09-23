@extends('newsletters::layout')

@section('content')
  <h1>Add a new subscriber</h1>

  <form action="{{ route('newsletters::subscribers.store') }}" method="POST">
    {{ csrf_field() }}

    @include('newsletters::subscribers.form')

  </form>
@endsection
