@extends('newsletters::layout')

@section('content')
  <h1>List: {{ $list->name }}</h1>

  <h3>Campaigns</h3>
  @if ($list->campaigns->count())
    @include('newsletters::campaigns.index-grid', ['campaigns' => $list->campaigns])
  @else
    <h5><em>Create your first <strong>{{ $list->name }}</strong> campaign now!</em></h5>
  @endif

  <a class="btn btn-primary" href="{{ route('newsletters::campaigns.create') }}?list={{ $list->slug }}">Add a campaign</a>

@endsection
