
<!-- schedule -->
<div class="form-group">
    <div class="checkbox">
        <label id="scheduled-checkbox">
            <input type="checkbox" name="is_scheduled" id="is_scheduled" value="1" {{ old('is_scheduled', $campaign->is_scheduled) ? 'checked' : '' }}>
            Schedule this campaign?
        </label>
    </div>
</div>

<!-- schedule -->
<div style="overflow:hidden;{{ old('is_scheduled', $campaign->is_scheduled) ? '' : 'display:none;'}}" id="schedule-controls">
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <div id="schedule-datetime-picker"></div>
                <input type="hidden" name="scheduled_for" id="scheduled_for" value="{{ old('scheduled_for', $campaign->scheduled_for) }}">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(function () {
        var $isScheduled = $('#scheduled-checkbox').find('input');
        var $scheduled_for = $('#scheduled_for');
        var defaultTime = moment.utc({{$default_time}}, 'X').add(1, 'days');
        // Set the scheduled_for default
        if ($isScheduled.is(':checked') && !$scheduled_for.val()) {
            $scheduled_for.val(defaultTime.toISOString());
        }
        // DateTimePicker
        $('#schedule-datetime-picker').datetimepicker({
            inline: true,
            sideBySide: true,
            minDate: moment().add(1, 'hours'),
            defaultDate: defaultTime
        }).on('dp.change', function(e){
            $scheduled_for.val(e.date.toISOString());
            console.log($scheduled_for.val());
        });
        // Checkbox change listener
        $isScheduled.change(function(event){
            var $controls = $('#schedule-controls');
            var $submit = $('#save-campaign');
            if ($(this).is(':checked')) {
                $controls.slideDown();
                if (!$scheduled_for.val()) {
                    $scheduled_for.val(defaultTime.toISOString());
                }
                $submit.text('Save & Schedule');
            } else {
                $controls.slideUp();
                $scheduled_for.val('');
                $submit.text('Save');
            }
        });
    });
</script>
@endpush
