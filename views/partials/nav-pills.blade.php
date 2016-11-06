
<div class="container">
    <ul class="nav nav-pills nav-justified">
        <li role="presentation" class="{{ Pilaster\Epistolary\set_active('lists') }}"><a href="{{ route('epistolary::lists.index') }}">Lists</a></li>
        <li role="presentation" class="{{ Pilaster\Epistolary\set_active('campaigns') }}"><a href="{{ route('epistolary::campaigns.index') }}">Campaigns</a></li>
        <li role="presentation" class="{{ Pilaster\Epistolary\set_active('subscribers') }}"><a href="{{ route('epistolary::subscribers.index') }}">Subscribers</a></li>
        {{--<li role="presentation" class="{{ Pilaster\Epistolary\set_active('templates') }}"><a href="{{ route('epistolary::templates.index') }}">Templates</a></li>--}}
    </ul>
</div>
