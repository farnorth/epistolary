@extends('epistolary::layout')

@section('newsletter-content')
  <h2>{{ $campaign->name }}</h2>

  <div class="campaign-stats">
    <p><b>Delivered:</b> {{ $campaign->sent_at->format("D, M j, Y g:i a") }}</p>
    <p><b>Mailing List:</b> {{ $campaign->mailingList->name }}</p>
    <p><b>Sent To:</b> {{ number_format($campaign->sent_count) }} {{ ngettext('subscriber', 'subscribers', $campaign->sent_count) }}</p>
    <p><b>Subject:</b> {{ $campaign->subject }}</p>
    <p><b>Description:</b> {{ $campaign->description }}</p>
  </div>

  <div class="newsletter-actions">
    <form action="{{ route('epistolary::campaigns.store') }}" method="POST">
      @include('epistolary::campaigns.form-duplicate-inputs')
      <button type="submit" class="btn btn-primary"><i class="fa fa-clone"></i> Duplicate Campaign</button>
    </form>
  </div>
@endsection
