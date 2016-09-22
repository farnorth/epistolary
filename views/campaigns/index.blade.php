@extends('newsletters::layout')

@section('content')
  <h1>Campaigns</h1>

  @if ($campaigns->count())
    <table class="table table-striped">
        <tr>
            <th>Campaign Name</th>
            <th>Mailing List</th>
        </tr>
        @foreach ($campaigns as $campaign)
          <tr>
            <td>{{ $campaign->name }}</td>
            <td>{{ $campaign->mailingList->name }}</td>
          </tr>
        @endforeach
    </table>
  @else
    <h5><em>Add your first campaign now!</em></h5>
  @endif

  <a href="{{ route('newsletters::campaigns.create') }}" class="btn btn-primary">Add New Campaign</a>

@endsection