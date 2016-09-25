@extends('epistolary::layout')

@section('content')
  <h1>Create a new campaign</h1>

  <form action="{{ route('epistolary::campaigns.store') }}" method="POST">
    {{ csrf_field() }}

    @include('epistolary::campaigns.form')

  </form>
@endsection
