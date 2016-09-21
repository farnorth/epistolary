@extends('newsletters::layout')

@section('content')
  <h1>Lists</h1>

  <table class="table table-striped">
    @foreach ($lists as $list)
      <tr>
        <td><a href="{{ route('newsletters::lists.show', [$list->slug]) }}">{{ $list->name }}</a></td>
      </tr>
    @endforeach
  </table>

@endsection
