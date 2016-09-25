@extends('epistolary::layout')

@section('newsletter-content')
  <h1>Lists</h1>

  @if ($lists->count())
  <table class="table table-striped">
    <tr>
      <th>List Name</th>
      <th>Subscribers</th>
      <th>Campaigns</th>
      <th></th>
    </tr>
    @foreach ($lists as $list)
      <tr>
        <td><a href="{{ route('epistolary::lists.show', [$list->slug]) }}">{{ $list->name }}</a></td>
        <td>{{ $list->subscriptions()->count() }}</td>
        <td>{{ $list->campaigns()->count() }}</td>
        <td class="list-action-cell text-center">
          <a href="{{ route('epistolary::lists.edit', [$list->id]) }}" class="btn btn-default btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
        </td>
      </tr>
    @endforeach
  </table>
  @else
    <h5><em>Add a list now!</em></h5>
  @endif

  <a class="btn btn-primary" href="{{ route('epistolary::lists.create') }}">Add a new list</a>

@endsection
