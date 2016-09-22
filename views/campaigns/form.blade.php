
<div class="campaign-form">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
        <li role="presentation"><a href="#template" aria-controls="template" role="tab" data-toggle="tab">Template</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
        <!-- DETAILS TAB -->
        <div role="tabpanel" class="tab-pane active" id="settings">
            <br>
            @include('newsletters::campaigns.form-tab-settings')
        </div>
        <!-- TEMPLATE TAB -->
        <div role="tabpanel" class="tab-pane" id="template">
            <br>
            @include('newsletters::campaigns.form-tab-template')
        </div>
    </div>

</div>
<!-- SUBMIT OR CANCEL -->
<div class="form-group">
    <button type="submit" class="btn btn-primary">Save Campaign</button>
    <button type="submit" class="btn btn-success">Schedule Campaign</button>
    <button type="submit" class="btn btn-warning">Send Campaign Now</button>
    <a href="{{ route('newsletters::campaigns.index') }}" class="btn btn-default">Cancel</a>
</div>
