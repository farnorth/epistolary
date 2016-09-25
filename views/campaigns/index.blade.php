@extends('epistolary::layout')

@section('newsletter-content')
  <h1>Campaigns</h1>

  @if ($campaigns->count())
    @include('epistolary::campaigns.index-grid')
  @else
    <h5><em>Add your first campaign now!</em></h5>
  @endif

  <a href="{{ route('epistolary::campaigns.create') }}" class="btn btn-primary">Add New Campaign</a>

@endsection