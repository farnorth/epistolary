@extends('newsletters::layout')

@section('content')
  <h1>Create a new campaign</h1>

  <form action="{{ route('newsletters::campaigns.store') }}" method="POST">
    {{ csrf_field() }}

    @include('newsletters::campaigns.form')

  </form>
@endsection
