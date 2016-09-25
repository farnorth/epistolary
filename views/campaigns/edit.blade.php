@extends('epistolary::layout')

@section('newsletter-content')
  <h1>{{ $campaign->name }}</h1>

  <form action="{{ route('epistolary::campaigns.update', [$campaign->id]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    @include('epistolary::campaigns.form')

  </form>
@endsection
