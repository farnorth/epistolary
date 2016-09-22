
<!-- mailing list -->
<div class="form-group">
    <label class="control-label" for="list_id">Mailing List</label>
    <select name="list_id" id="list_id" class="form-control" required>
        <option disabled selected>Choose a mailing list</option>
        @foreach ($lists as $list)
            <option value="{{ $list->id }}" {{ ($list->id == $for_list) ? 'selected' : '' }}>{{ $list->name }}</option>
        @endforeach
    </select>
</div>

<!-- name -->
<div class="form-group">
    <label class="control-label" for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Campaign Name" required>
</div>

<!-- description -->
<div class="form-group">
    <label class="control-label" for="description">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Description (optional)" rows="4"></textarea>
</div>

<!-- attachments -->
<div class="form-group">
    <label class="control-label">Upload Attachments</label>
    <div id="dropzone-attachments" class="dropzone"></div>
</div>

<!-- schedule -->
<div class="form-group">
    <label for="send_at" class="control-label">Schedule the campaign to send</label>
    <input type="date" name="send_at" id="send_at" class="form-control">
</div>
