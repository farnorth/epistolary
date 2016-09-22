@extends('newsletters::layout')

@section('content')
  <h1>List: {{ $list->name }}</h1>

  <h3>Campaigns</h3>

  @if ($list->campaigns->count())
    <table class="table table-striped">
      @foreach ($list->campaigns as $campaign)
        <tr>
          <td><a href="{{ route('newsletters::campaigns.show', [$campaign->id]) }}">{{ $campaign->name }}</a></td>
        </tr>
      @endforeach
    </table>
  @else
    <h5><em>Create your first <strong>{{ $list->name }}</strong> campaign now!</em></h5>
  @endif

  <a class="btn btn-primary" href="{{ route('newsletters::campaigns.create') }}?list={{ $list->slug }}">Add a campaign</a>

@endsection
