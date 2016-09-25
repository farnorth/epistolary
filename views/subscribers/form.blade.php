
<!-- email -->
<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
    <label class="control-label" for="email">Email Address</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="{{ old('email', $subscriber->email) }}" required>
</div>

<!-- first_name -->
<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
    <label class="control-label" for="first_name">First Name</label>
    <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="{{ old('first_name', $subscriber->first_name) }}">
</div>

<!-- last_name -->
<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
    <label class="control-label" for="last_name">Last Name</label>
    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="{{ old('last_name', $subscriber->last_name) }}">
</div>

<!-- subscriptions -->
<div class="form-group {{ $errors->has('list_id') ? 'has-error' : ''}}">
    <label class="control-label" for="list_id">Mailing List(s)</label>
    <select name="list_id[]" id="list_id" class="form-control" multiple>
        @foreach ($lists as $list)
            <option value="{{ $list->id }}" {{ $subscriber->subscriptions->hasWhere('list_id', $list->id) ? 'selected' : '' }}>{{ $list->name }}</option>
        @endforeach
    </select>
</div>

<!-- opted_in -->
<div class="form-group {{ $errors->has('opted_in') ? 'has-error' : ''}}">
    <div class="checkbox">
        <label>
            <input type="checkbox" name="opted_in" id="opted_in" value="1" {{ old('opted_in', $subscriber->subscriptions->count()) ? 'checked' : '' }}>
            Do you have this person's permission to add them to a mailing list?
        </label>
    </div>
</div>

<!-- SUBMIT OR CANCEL -->
<div class="form-group">
    <button type="submit" id="save-subscriber" class="btn btn-primary">Save</button>
    <a href="{{ route('epistolary::subscribers.index') }}" class="btn btn-default">Cancel</a>
</div>
