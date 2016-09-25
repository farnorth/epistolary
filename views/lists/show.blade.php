@extends('epistolary::layout')

@section('newsletter-content')
  <h1>{{ $list->name }}</h1>

  <div class="row">
    <!-- Campaigns -->
    <div class="col-md-2 text-center">
      <h4><a href="{{ route('epistolary::campaigns.index') }}">Campaigns</a></h4>
      <h4>{{ $list->campaigns()->count() }}</h4>
      <a class="btn btn-primary btn-sm" href="{{ route('epistolary::campaigns.create') }}?list_id={{ $list->id }}">Add a campaign</a>
    </div>
    <!-- Subscribers -->
    <div class="col-md-2 text-center">
      <h4><a href="{{ route('epistolary::campaigns.index') }}">Subscribers</a></h4>
      <h4>{{ $list->subscriptions()->count() }}</h4>
      <a class="btn btn-primary btn-sm" href="{{ route('epistolary::subscribers.create') }}?list_id={{ $list->id }}">Add a subscriber</a>
    </div>
  </div>

@endsection
