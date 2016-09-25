@extends('epistolary::layout')

@section('newsletter-content')
  <h1>{{ $list->name }} <small><a href="{{ route('epistolary::lists.edit', [$list->id]) }}"><i class="fa fa-edit"></i></a></small></h1>

  <!-- info -->
  <div class="row">
    <div class="col-md-12">
      <p>{{ $list->description }}</p>
    </div>
  </div>
  <br>

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
  <br>

  <!-- info -->
  <div class="row">
    <div class="col-md-12">
      <p><b>From Name:</b> {{ $list->from_name ?: config('mail.from.name') ?: 'n/a' }}</p>
      <p><b>From Email:</b> {{ $list->from_email ?: config('mail.from.address') ?: 'n/a' }}</p>
      <p><b>Requires opt in:</b> {{ $list->requires_opt_in ? 'Yes' : 'No' }}</p>
    </div>
  </div>
  <br>

@endsection
