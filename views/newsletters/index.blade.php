@extends('layout')

@section('content')
  <h1>Newsletters</h1>

  <table class="table table-striped">
    @foreach ($newsletters as $newsletter)
      <tr>
        <td><a href="{{ route('newsletters.show', [$newsletter->slug]) }}">{{ $newsletter->name }}</a></td>
      </tr>
    @endforeach
  </table>

@endsection
