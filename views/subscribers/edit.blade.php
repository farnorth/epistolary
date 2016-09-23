@extends('newsletters::layout')

@section('content')
  <h1>{{ $subscriber->email }}</h1>

  <form action="{{ route('newsletters::subscribers.update', [$subscriber->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('newsletters::subscribers.form')

  </form>
@endsection
