
<!-- NAME -->
<div class="form-group">
    <label class="control-label" for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="List Name" value="{{ old('name', $list->name) }}" required>
</div>

<!-- SENDER EMAIL -->
<div class="form-group">
    <label class="control-label" for="from_email">Sender From Email</label>
    <input type="email" class="form-control" name="from_email" id="from_email" placeholder="Sender Email Address" value="{{ old('from_email', $list->from_email) }}">
</div>

<!-- SENDER NAME -->
<div class="form-group">
    <label class="control-label" for="from_name">Sender From Name</label>
    <input type="text" class="form-control" name="from_name" id="from_name" placeholder="Sender Name" value="{{ old('from_name', $list->from_name) }}">
</div>

<!-- DESCRIPTION -->
<div class="form-group">
    <label class="control-label" for="description">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Description (optional)" rows="4">{{ old('description', $list->description) }}</textarea>
</div>

<!-- REQUIRES OPT-IN -->
<div class="form-group">
    <label class="control-label" for="requires_opt_in">Requires Opt-in?</label>
    <div>
        <label class="radio-inline">
            <input type="radio" name="requires_opt_in" id="requires_opt_in1" value="1" {{ old('requires_opt_in', $list->requires_opt_in ?: true) ? 'checked' : '' }} required> Yes
        </label>
        <label class="radio-inline">
            <input type="radio" name="requires_opt_in" id="requires_opt_in2" value="0" required> No
        </label>
    </div>
</div>
