@if (session('error'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Oops!</strong> {!! session('error') !!}
</div>
@endif

@if (session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Success!</strong> {!! session('success') !!}
</div>
@endif

@if (session('info'))
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    {!! session('info') !!}
</div>
@endif

<!-- Form Validation errors -->
@if (count($errors) > 0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif