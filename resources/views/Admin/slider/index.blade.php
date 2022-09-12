@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.sliders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <div class="card">                       
                        <div class="card-header">
                            <h4 class="card-title">{{ trans('labels.sliders') }}</h4>
                            <a href="{{route('admin.slider.add')}}" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1 float-right" style="margin-top: -30px;">
                                {{ trans('labels.add_slider') }}
                            </a>
                        </div>
                        
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                    @include('Admin.slider.slidertable')
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function SliderTable() {
        $('#preloader').show();
        $.ajax({
            url:"{{ route('admin.slider.list') }}",
            method:'get',
            success:function(data){
                $('#preloader').hide();
                $('#table-display').html(data);
                $(".zero-configuration").DataTable({
                  aaSorting: [[0, 'DESC']]
                })
            }
        });
    }

    function do_delete(id,page_name,name,titles)
    {
        Swal.fire({
            title: '{{ trans('labels.are_you_sure') }}',
            text: "{{ trans('labels.delete_text') }} "+name+"!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('labels.yes') }}',
            cancelButtonText: '{{ trans('labels.no') }}'
        }).then((t) => {
            if(t.value==true){  
                $('#preloader').show();
                $.ajax({
                     headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: page_name,
                    type: "POST",
                    data : {'id':id},

                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            $('#del-'+id).remove();
                            Swal.fire({type: 'success',title: '{{ trans('labels.success') }}',showConfirmButton: false,timer: 1500});    
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});
                        }    
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});

            }
        });

    }
    
    //Change Status
    $('body').on('click','.changeStatus',function() {
        let status=$(this).attr('data-status');
        let id=$(this).attr('data-id');
        Swal.fire({
            title: '{{ trans('labels.are_you_sure') }}',
            text: "{{ trans('labels.change_status') }}",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{ trans('labels.yes') }}',
            cancelButtonText: '{{ trans('labels.no') }}'
        }).then((t) => {
            if(t.value==true){
                $('#preloader').show();
                $.ajax({
                    headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{route("admin.slider.changeStatus")}}',
                    type: "POST",
                    data : {'id':id,'status':status},
                    success:function(data)
                    { 
                        $('#preloader').hide();
                        if(data == 1000)
                        {
                            Swal.fire({type: 'success',title: "{{ trans('labels.success') }}",showConfirmButton: false,timer: 1500});    
                            if(status=='1'){
                                $('#tdstatus'+id).html('<span class="btn btn-raised btn-outline-success round btn-min-width mr-1 mb-1 changeStatus" data-status="2"  data-id="'+id+'">{{ trans('labels.active') }}</span>');
                            }else{
                                $('#tdstatus'+id).html('<span class="btn btn-raised btn-outline-danger round btn-min-width mr-1 mb-1 changeStatus" data-status="1"  data-id="'+id+'">{{ trans('labels.deactive') }}</span>');
                            }
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}', showConfirmButton: false,timer: 1500});
                        }
                            
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: '{{ trans('labels.cancelled') }}',showConfirmButton: false,timer: 1500});

            }
        });
    });
</script>
@endsection