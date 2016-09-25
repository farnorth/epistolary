
{{ csrf_field() }}

<input type="hidden" name="name" id="name" value="{{ $campaign->name }}">
<input type="hidden" name="list_id" id="list_id" value="{{ $campaign->list_id }}">
<input type="hidden" name="subject" id="subject" value="{{ $campaign->subject }}">
<input type="hidden" name="description" id="description" value="{{ $campaign->description }}">
