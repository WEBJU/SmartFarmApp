@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.notification') }}
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
                            <h4 class="card-title">{{ trans('labels.notification') }}</h4>
                            <button type="button" class="btn btn-raised btn-primary btn-min-width mr-1 mb-1 float-right" data-toggle="modal" data-target="#addmodal" style="margin-top: -30px;">
                                {{ trans('labels.add_notification') }}
                            </button>
                        </div>
                        
                        <div class="card-body collapse show">
                            <div class="card-block card-dashboard" id="table-display">
                                    @include('Admin.notification.notificationtable')
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection
@section('scripttop')

        <!-- Send model -->
        <div class="modal fade text-left" id="addmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <label class="modal-title text-text-bold-600" id="myModalLabel33">{{ trans('labels.send_notification') }}</label>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="notification_form" enctype="multipart/form-data">
                    @csrf
                      <div class="modal-body">
                        <label>{{ trans('labels.title') }} </label>
                        <div class="form-group">
                          <input type="text" placeholder="{{ trans('labels.title') }}" name="title" id="title" class="form-control">
                          <span class="error" id="title-error"></span>
                        </div>
                        <label>{{ trans('labels.message') }} </label>
                        <div class="form-group">
                            <textarea class="form-control" name="message" id="message" placeholder="{{ trans('labels.message') }}"></textarea>
                          <span class="error" id="message-error"></span>
                        </div> 
                    </div>
                    <div class="modal-footer">
                    <input type="reset" class="btn btn-raised btn-warning" data-dismiss="modal" value="{{ trans('labels.close') }}">
                    <button type="submit" class="btn btn-raised btn-primary submit">{{ trans('labels.send') }}</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

@endsection
@section('script')
<script type="text/javascript">
    $('.table').dataTable({
      aaSorting: [[0, 'DESC']]
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $('#notification_form').on('submit', function(event){
            event.preventDefault();
            var form_data = new FormData(this);
            $('#preloader').show();
            $.ajax({
                url:"{{ route('admin.notification.store') }}",
                method:"POST",
                data:form_data,
                cache: false,
                contentType: false,
                processData: false,
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
                        toastr.success("Success!"," Notification has been added..");
                        NotificationTable();
                        $(".modal").modal("hide");
                        $("#notification_form")[0].reset();
                    }
                },error:function(data){
                    $('#preloader').hide();
                    $('.error').text('');
                    for(var key in data.responseJSON.errors){
                        $('#'+key+"-error").text(data.responseJSON.errors[key]);
                    }
                }
            })
        });
    }); 

    function resend(id,page_name,name,titles)
    {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to "+name+"!",
            type: 'error',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, '+titles+' it!'
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
                            Swal.fire({type: 'success',title: titles,text: name+" Successfully",showConfirmButton: false,timer: 1500});    
                        }
                        else
                        {
                            Swal.fire({type: 'error',title: 'Cancelled',text: " Not "+name,showConfirmButton: false,timer: 1500});
                        }    
                    },error:function(data){
                        $('#preloader').hide();
                        console.log("AJAX error in request: " + JSON.stringify(data, null, 2));
                    }
                });
            }
            else
            {
                Swal.fire({type: 'error',title: 'Cancelled',text: " Not " + name,showConfirmButton: false,timer: 1500});

            }
        });

    }
    
    function NotificationTable() {
        $('#preloader').show();
        $.ajax({
            url:"{{ route('admin.notification.list') }}",
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
</script>
@endsection