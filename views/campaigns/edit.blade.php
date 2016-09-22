@extends('newsletters::layout')

@section('content')
  <h1>{{ $campaign->name }}</h1>

  <form action="{{ route('newsletters::campaigns.update', [$campaign->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('newsletters::campaigns.form')

  </form>
@endsection
