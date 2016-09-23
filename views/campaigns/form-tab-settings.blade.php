
<!-- name -->
<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label class="control-label" for="name">Name</label>
    <input type="text" class="form-control" name="name" id="name" placeholder="Campaign Name" value="{{ old('name', $campaign->name) }}">
</div>

<!-- mailing list -->
<div class="form-group {{ $errors->has('list_id') ? 'has-error' : ''}}">
    <label class="control-label" for="list_id">Mailing List</label>
    <select name="list_id" id="list_id" class="form-control">
        <option disabled selected>Choose a mailing list</option>
        @foreach ($lists as $list)
            <option value="{{ $list->id }}" {{ ($list->id == $campaign->list_id) ? 'selected' : '' }}>{{ $list->name }}</option>
        @endforeach
    </select>
</div>

<!-- description -->
<div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
    <label class="control-label" for="description">Description</label>
    <textarea class="form-control" name="description" id="description" placeholder="Description (optional)" rows="4">{{ old('description', $campaign->description) }}</textarea>
</div>

<!-- existing attachments -->
@if (count($campaign->attachments))
    <div class="form-group">
        <label class="control-label">Attachments</label>
        @foreach ($campaign->attachments as $attachment)
            <div>
                {{ $attachment }}
                <a href="#remove-attachment" class="remove-attachment btn btn-default btn-xs" data-attachment="{{$attachment}}">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>
        @endforeach
    </div>
@endif

<!-- attachments -->
<div class="form-group">
    <label class="control-label">Upload Attachments</label>
    <div id="dropzone-attachments" class="dropzone"></div>
</div>

<div class="attachments">
    @if (count($campaign->attachments))
    @foreach ($campaign->attachments as $i => $attachment)
        <input type="hidden" name="attachments[]" id="attachment-{{$i}}" value="{{ $attachment }}">
    @endforeach
    @endif
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g=" crossorigin="anonymous" />
    <style>
        .deleted-attachment { text-decoration: line-through; font-style: italic; color: #999; }
    </style>
@endpush

@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js" integrity="sha256-p2l8VeL3iL1J0NxcXbEVtoyYSC+VbEbre5KHbzq1fq8=" crossorigin="anonymous"></script>
    <script>
        var lists = {!! $lists->toJson() !!}

        function getFilename(){
            list = lists.filter(function(l) { return l.id == $("#list_id").val(); });
            if (list.length > 0) return list[0].slug;
            return null;
        };

        function addAttachment(name){
            $('.attachments').append('<input type="hidden" name="attached_files[]" value="'+name+'">')
        }

        function removeAttachment(name, list_item){
            console.log(list_item);
            list_item.wrapInner('<span class="deleted-attachment"></span>').find('a').remove();
            $('.attachments').find("input[value='"+name+"']").remove();
        }

        Dropzone.autoDiscover = false;

        $(document).ready(function(){
            $("#dropzone-attachments").dropzone({
                url: "{{ route('newsletters.api::attachments.store') }}",
                sending: function(file, xhr, formData){
                    var file_name = getFilename();
                    if (file_name) formData.append("file_name", file_name);
                },
                success: function(file, response) {
                    addAttachment(response);
                }
            });
            $('.remove-attachment').click(function(event){
                event.preventDefault();
                var $this = $(this);
                removeAttachment($this.data('attachment'), $this.parent());
            });
        });
    </script>
@endpush
