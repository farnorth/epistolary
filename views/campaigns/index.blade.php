@extends('newsletters::layout')

@section('content')
  <h1>Campaigns</h1>

  @if ($campaigns->count())
    @include('newsletters::campaigns.index-grid')
  @else
    <h5><em>Add your first campaign now!</em></h5>
  @endif

  <a href="{{ route('newsletters::campaigns.create') }}" class="btn btn-primary">Add New Campaign</a>

@endsection