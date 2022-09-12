@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.Privacy_Policy') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.Privacy_Policy') }}</h4>
                        </div>
                        
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                            	<form name="privacy" id="privacy">
                            	    @csrf
                            	    <textarea class="form-control" id="ckeditor" name="termscondition">{{$getprivacypolicy->description}}</textarea>
                                    <button type="submit" name="update" class="btn mb-1 btn-primary mt-5">{{ trans('labels.update') }}</button>
                            	</form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection
@section('scripttop')
@endsection
@section('script')
<script type="text/javascript">
$(document).ready(function() {

    $('#privacy').on('submit', function(event){
        event.preventDefault();
        // var form_data = new FormData(this);
        var privacy = CKEDITOR.instances['ckeditor'].getData();
        $.ajax({
            $('#preloader').show();
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ route('admin.privacy.update') }}",
            method:'POST',
            data:{'privacy':privacy},
            dataType: "json",
            success: function(result) {
                $('#preloader').hide();
                var msg = '';
                if(result == 2)
                {
                    toastr.error("Error!","Fail..");
                }
                else
                {
                    toastr.success("Success!"," privacy Content has been updated..");
                }
            },error:function(data){
                $('#preloader').hide();
                $('.error-1').text('');
                for(var key in data.responseJSON.errors){
                    $('#'+key+"-error").text(data.responseJSON.errors[key]);
                }
            }
        });
    });
});

</script>
@endsection