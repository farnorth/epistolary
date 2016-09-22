@extends('newsletters::layout')

@section('content')
  <h1>Create a new campaign</h1>

  <form action="{{ route('newsletters::campaigns.store') }}" method="POST">
    {{ csrf_field() }}

    @include('newsletters::campaigns.form')

  </form>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css" integrity="sha256-e47xOkXs1JXFbjjpoRr1/LhVcqSzRmGmPqsrUQeVs+g=" crossorigin="anonymous" />
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

    function addFileName(name){
      $('.campaign-form').append('<input type="hidden" name="attached_files[]" value="'+name+'">')
    }

    Dropzone.autoDiscover = false;

    $(document).ready(function(){
      $("#dropzone-attachments").dropzone({
        url: "{{ route('newsletters.api::attachments.store') }}",
        sending: function(file, xhr, formData) {
          var file_name = getFilename();
          if (file_name) formData.append("file_name", file_name);
        },
        success: function(file, response) {
          addFileName(response);
        }
      });
    });
  </script>
@endpush
