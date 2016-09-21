@extends('newsletters::layout')

@section('content')
  <h1>{{ $list->name }}</h1>
  <h2>List</h2>

  <h3>Campaigns</h3>
  <table class="table table-striped">
    @foreach ($list->campaigns as $campaign)
      <tr>
        <td><a href="{{ route('newsletters::campaigns.show', [$list->slug, $campaign->id]) }}">{{ $campaign->name }}</a></td>
      </tr>
    @endforeach
  </table>
@endsection
