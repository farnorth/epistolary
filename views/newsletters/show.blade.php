@extends('newsletters::layout')

@section('content')
  <h1>{{ $newsletter->name }}</h1>
  <h2>Newsletter</h2>

  <h3>Campaigns</h3>
  <table class="table table-striped">
    @foreach ($newsletter->campaigns as $campaign)
      <tr>
        <td><a href="{{ route('newsletters::campaigns.show', [$newsletter->slug, $campaign->id]) }}">{{ $campaign->name }}</a></td>
      </tr>
    @endforeach
  </table>
@endsection
