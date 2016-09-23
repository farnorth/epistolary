
<nav class="navbar navbar-inverse">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('newsletters::dashboard') }}">Newsletters</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ set_active('lists') }}"><a href="{{ route('newsletters::lists.index') }}">Lists</a></li>
                <li class="{{ set_active('campaigns') }}"><a href="{{ route('newsletters::campaigns.index') }}">Campaigns</a></li>
                <li class="{{ set_active('subscribers') }}"><a href="{{ route('newsletters::subscribers.index') }}">Subscribers</a></li>
                {{--<li class="{{ set_active('templates') }}"><a href="{{ route('newsletters::templates.index') }}">Templates</a></li>--}}
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
