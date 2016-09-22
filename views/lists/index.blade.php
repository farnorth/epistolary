@extends('newsletters::layout')

@section('content')
  <h1>Lists</h1>

  @if ($lists->count())
  <table class="table table-striped">
    @foreach ($lists as $list)
      <tr>
        <td><a href="{{ route('newsletters::lists.show', [$list->slug]) }}">{{ $list->name }}</a></td>
      </tr>
    @endforeach
  </table>
  @else
    <h5><em>Add a list now!</em></h5>
  @endif

  <a class="btn btn-primary" href="{{ route('newsletters::lists.create') }}">Add a new list</a>

@endsection
