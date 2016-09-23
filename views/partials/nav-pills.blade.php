
<div class="container">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation" class="{{ set_active('lists') }}"><a href="{{ route('newsletters::lists.index') }}">Lists</a></li>
        <li role="presentation" class="{{ set_active('campaigns') }}"><a href="{{ route('newsletters::campaigns.index') }}">Campaigns</a></li>
        <li role="presentation" class="{{ set_active('subscribers') }}"><a href="{{ route('newsletters::subscribers.index') }}">Subscribers</a></li>
        {{--<li role="presentation" class="{{ set_active('templates') }}"><a href="{{ route('newsletters::templates.index') }}">Templates</a></li>--}}
    </ul>
</div>
