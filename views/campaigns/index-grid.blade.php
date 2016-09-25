
@push('styles')
<style>
    .paging-links ul { float: right; }
</style>
@endpush

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

@if ($campaigns->count())
<table class="table table-striped">
    <tr>
        <th>Campaign Name</th>
        <th>Mailing List</th>
        <th>Scheduled</th>
        <th class="text-center">Sent</th>
    </tr>
    @foreach ($campaigns as $campaign)
    <tr>
        <td>
            @if ($campaign->is_sent)
            <a href="{{ route('epistolary::campaigns.show', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @else
            <a href="{{ route('epistolary::campaigns.edit', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @endif
        </td>
        <td>{{ $campaign->mailingList->name }}</td>
        <td>{{ $campaign->scheduled_for ? $campaign->scheduled_for->format("Y-m-d H:i:s") : 'No' }}</td>
        <td class="text-center">
            @if ($campaign->is_sent)
            <i class="fa fa-check text-success"></i>
            @else
            <i class="fa fa-times"></i>
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
