@extends('epistolary::layout')

@section('newsletter-content')
    <h1>Subscribers</h1>

    @if ($subscribers->count())

        @push('styles')
        <style>
            .paging-links ul { float: right; }
        </style>
        @endpush

        <table class="table table-striped">
            <tr>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th class="text-center">Subscriptions</th>
                <th></th>
            </tr>
            @foreach ($subscribers as $subscriber)
                <tr>
                    <td>
                        <a href="{{ route('epistolary::subscribers.edit', [$subscriber->id]) }}">
                            {{ $subscriber->email }}
                        </a>
                    </td>
                    <td>{{ $subscriber->first_name }}</td>
                    <td>{{ $subscriber->last_name }}</td>
                    <td class="text-center">{{ $subscriber->subscriptions()->count() }}</td>
                    <td class="susbcriber-action-cell text-center">
                        <form action="{{ route('epistolary::subscribers.destroy', [$subscriber->id]) }}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-default btn-xs confirm-delete" title="Delete"><i class="fa fa-trash text-default"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="paging-links clearfix">
            {{ $subscribers->links() }}
        </div>

    @else
        <h5><em>Add your first subscriber now!</em></h5>
    @endif

    <a href="{{ route('epistolary::subscribers.create') }}" class="btn btn-primary">Add New Subscriber</a>

@endsection