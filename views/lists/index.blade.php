@extends('epistolary::layout')

@section('newsletter-content')
  <h1>Lists</h1>

  @if ($lists->count())
  <table class="table table-striped">
    <tr>
      <th>List Name</th>
      <th>Subscribers</th>
      <th>Campaigns</th>
    </tr>
    @foreach ($lists as $list)
      <tr>
        <td><a href="{{ route('epistolary::lists.show', [$list->slug]) }}">{{ $list->name }}</a></td>
        <td>{{ $list->subscriptions()->count() }}</td>
        <td>{{ $list->campaigns()->count() }}</td>
      </tr>
    @endforeach
  </table>
  @else
    <h5><em>Add a list now!</em></h5>
  @endif

  <a class="btn btn-primary" href="{{ route('epistolary::lists.create') }}">Add a new list</a>

@endsection
