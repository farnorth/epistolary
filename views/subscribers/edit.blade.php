@extends('epistolary::layout')

@section('content')
  <h1>{{ $subscriber->email }}</h1>

  <form action="{{ route('epistolary::subscribers.update', [$subscriber->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('epistolary::subscribers.form')

  </form>
@endsection
