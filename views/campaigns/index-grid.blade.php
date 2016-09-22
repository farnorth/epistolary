
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
            <a href="{{ route('newsletters::campaigns.show', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @else
            <a href="{{ route('newsletters::campaigns.edit', [$campaign->id]) }}">{{ $campaign->name }}</a>
            @endif
        </td>
        <td>{{ $campaign->mailingList->name }}</td>
        <td>{{ $campaign->scheduled_for ? $campaign->scheduled_for->format("Y-m-d H:i:s") : 'No' }}</td>
        <td class="text-center">
            @if ($campaign->is_sent)
            <i class="fa fa-check"></i>
            @else
            <i class="fa fa-times"></i>
            @endif
        </td>
    </tr>
    @endforeach
</table>
@else
<h5><em>Add your first campaign now!</em></h5>
@endif
