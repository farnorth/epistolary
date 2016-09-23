
<div class="campaign-form">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        {{--<li role="presentation"><a href="#template" aria-controls="template" role="tab" data-toggle="tab">Template</a></li>--}}
        <li role="presentation"><a href="#schedule" aria-controls="schedule" role="tab" data-toggle="tab">Schedule</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- DETAILS TAB -->
        <div role="tabpanel" class="tab-pane active" id="settings">
            <br>
            @include('newsletters::campaigns.form-tab-settings')
        </div>
        <!-- TEMPLATE TAB -->
        {{--
        <div role="tabpanel" class="tab-pane" id="template">
            <br>
            @include('newsletters::campaigns.form-tab-template')
        </div>
        --}}
        <div role="tabpanel" class="tab-pane" id="schedule">
            <br>
            @include('newsletters::campaigns.form-tab-schedule')
        </div>
    </div>

</div>
<!-- SUBMIT OR CANCEL -->
<div class="form-group">
    <button type="submit" id="save-campaign" class="btn btn-primary">
        {{ $campaign->is_scheduled && !empty($campaign->scheduled_for) ? 'Save & Schedule' : 'Save' }}
    </button>
    {{--<input type="submit" name="schedule_now" value="Schedule" class="btn btn-success confirm-schedule">--}}
    <input type="submit" name="send_now" value="Send Now" class="btn btn-warning confirm-send">
    <a href="{{ route('newsletters::campaigns.index') }}" class="btn btn-default">Cancel</a>
</div>

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.confirm-schedule').click(function(event){
                return confirm("Are you sure you want to schedule this?");
            });
            $('.confirm-send').click(function(event){
                return confirm("Are you sure you want to send it now? There is no going back once you do.");
            });
        });
    </script>
@endpush