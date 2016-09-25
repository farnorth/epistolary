
@push('styles')
<style>
    .paging-links ul { float: right; }
</style>
@endpush

{{--
<div class="row">
    <div class="col-md-4 col-md-offset-8">
        <select name="filterBy" class="form-control" title="Filter by List">
            <option value>Filter by Mailing List</option>
            @foreach (Pilaster\Epistolary\MailingList::get(['name', 'id']) as $list)
                <option value="{{ $list->id }}">{{ $list->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<br>
--}}

@if ($campaigns->count())
<table class="table table-striped">
    <tr>
        <th></th>
        <th>Campaign Name</th>
        <th>Mailing List</th>
        <th>Scheduled</th>
        <th>Sent</th>
        <th></th>
    </tr>
    @foreach ($campaigns as $campaign)
    <tr>
        <td class="campaign-status-icon-cell text-center">
            @if ($campaign->is_sent)
            <i class="fa fa-check-circle-o text-success" title="Sent"></i>
            @elseif ($campaign->is_scheduled)
            <i class="fa fa-clock-o text-warning" title="Scheduled"></i>
            @else
            <i class="fa fa-edit text-default" title="Open for editing"></i>
            @endif
        </td>
        <td>
            @if ($campaign->is_sent)
            <a href="{{ route('epistolary::campaigns.show', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @else
            <a href="{{ route('epistolary::campaigns.edit', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @endif
        </td>
        <td>{{ $campaign->mailingList->name }}</td>
        <td>{{ $campaign->scheduled_for ? $campaign->scheduled_for->format("D, M j, Y g:i a") : '-' }}</td>
        <td>{{ $campaign->is_sent ? $campaign->sent_at->format("D, M j, Y g:i a") : '-' }}</td>
        <td class="campaign-action-cell text-center">
            @if ($campaign->is_sent)
                <form action="{{ route('epistolary::campaigns.store') }}" method="POST">
                    @include('epistolary::campaigns.form-duplicate-inputs')
                    <button type="submit" class="btn btn-default btn-xs" title="Duplicate"><i class="fa fa-clone"></i></button>
                </form>
            @else
                <form action="{{ route('epistolary::campaigns.destroy', [$campaign->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-default btn-xs confirm-delete" title="Delete"><i class="fa fa-trash text-danger"></i></button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>

<div class="paging-links clearfix">
    {{ $campaigns->links() }}
</div>

@else
<h5><em>Add your first campaign now!</em></h5>
@endif
