@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.vendors') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="configuration">
            <div class="row">
                    <div class="col-md-12">
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="alert alert-danger">
                            {{ Session::get('danger') }}
                            @php
                                Session::forget('danger');
                            @endphp
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="px-3">
                                    <form class="form form-horizontal striped-rows form-bordered" method="post" action="{{ route('admin.vendors.update') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">
                                            <h4 class="form-section"><i class="ft-user"></i> Basic Info</h4>
                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="name">Store Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="name" class="form-control" placeholder="Store Name" name="name" id="name" value="{{$data->name}}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="email">E-mail</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="email" class="form-control" placeholder="E-mail" name="email" id="email" value="{{$data->email}}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-3 label-control" for="mobile">Mobile number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="mobile" class="form-control" placeholder="Mobile number" name="mobile" id="mobile" value="{{$data->mobile}}">
                                                    @if ($errors->has('mobile'))
                                                        <span class="text-danger">{{ $errors->first('mobile') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row last">
                                                <label class="col-md-3 label-control" for="store_address">Store address</label>
                                                <div class="col-md-9">
                                                    <textarea class="form-control" name="store_address" id="store_address" placeholder="Store address">{{$data->store_address}}</textarea>
                                                    @if ($errors->has('store_address'))
                                                        <span class="text-danger">{{ $errors->first('store_address') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control">Store logo</label>
                                                <div class="col-md-9">
                                                    <label id="profile_pic" class="file center-block">
                                                        <input type="file" name="profile_pic" id="profile_pic">
                                                    </label>
                                                    <br>
                                                    @if ($errors->has('profile_pic'))
                                                        <span class="text-danger">{{ $errors->first('profile_pic') }}</span>
                                                    @endif
                                                    <br>
                                                    <img src='{!! asset("/storage/app/public/images/profile/".$data->profile_pic) !!}' class='media-object round-media height-50'>
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="ft-file-text"></i> Payment Setting</h4>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="bank_name">Bank Name</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="bank_name" class="form-control" placeholder="Bank Name" name="bank_name" value="{{@$bankdata->bank_name}}">
                                                    @if ($errors->has('bank_name'))
                                                        <span class="text-danger">{{ $errors->first('bank_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="account_type">Bank Account type</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="account_type" class="form-control" placeholder="Bank Account type" name="account_type" value="{{@$bankdata->account_type}}">
                                                    @if ($errors->has('account_type'))
                                                        <span class="text-danger">{{ $errors->first('account_type') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="account_number">Bank Account Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="account_number" class="form-control" placeholder="Bank Account Number" name="account_number" value="{{@$bankdata->account_number}}">
                                                    @if ($errors->has('account_number'))
                                                        <span class="text-danger">{{ $errors->first('account_number') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="routing_number">Bank Routing Number</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="routing_number" class="form-control" placeholder="Bank Routing Number" name="routing_number" value="{{@$bankdata->routing_number}}">
                                                    @if ($errors->has('routing_number'))
                                                        <span class="text-danger">{{ $errors->first('routing_number') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <h4 style="display: none" class="form-section"><i class="fa fa-globe"></i> Social Media Link (Optional)</h4>

                                            <div style="display: none" class="form-group row">
                                                <label class="col-md-3 label-control" for="facebook">Facebook</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="facebook" class="form-control" placeholder="Facebook link (Insert link with https)" name="facebook" value="{{$data->facebook}}">
                                                </div>
                                            </div>

                                            <div style="display: none" class="form-group row">
                                                <label class="col-md-3 label-control" for="instagram">Instagram</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="instagram" class="form-control" placeholder="Instagram link (Insert link with https)" name="instagram" value="{{$data->instagram}}">
                                                </div>
                                            </div>

                                            <div style="display: none" class="form-group row">
                                                <label class="col-md-3 label-control" for="twitter">Twitter</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="twitter" class="form-control" placeholder="Twitter link (Insert link with https)" name="twitter" value="{{$data->twitter}}">
                                                </div>
                                            </div>

                                            <div style="display: none" class="form-group row">
                                                <label class="col-md-3 label-control" for="google">Google</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="google" class="form-control" placeholder="Google link (Insert link with https)" name="google" value="{{$data->google}}">
                                                </div>
                                            </div>

                                            <div style="display: none" class="form-group row">
                                                <label class="col-md-3 label-control" for="youtube">Youtube</label>
                                                <div class="col-md-9">
                                                    <input type="text" id="youtube" class="form-control" placeholder="Youtube (Insert link with https)" name="youtube" value="{{$data->youtube}}">
                                                </div>
                                            </div>

                                            <h4 class="form-section"><i class="fa fa-image"></i>Banner Settings (Optional)</h4>

                                            <div class="form-group row">
                                                <label class="col-md-3 label-control" for="store_banner">Banners (1500x450)</label>
                                                <div class="col-md-9">
                                                    <input type="file" id="store_banner" class="form-control" name="store_banner" value="{{$data->store_banner}}">
                                                    <div class="row">
                                                    @foreach($getbanners as $banner)
                                                        <div class="col-2 pr-0">
                                                            <div class="card px-1">
                                                                <div class="text-center py-3">
                                                                    <img src='{!! asset("/storage/app/public/images/banner/".$banner->image) !!}' class='media-object round-media height-50'>
                                                                </div>
                                                                <span class="tags float-left">
                                                                    <span class="badge bg-danger white" onclick="do_delete('{{$banner->id}}','{{route('admin.vendors.delete')}}','{{ trans('labels.delete_image') }}','{{ trans('labels.delete') }}')">Delete</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="form-actions text-right">
                                            <button type="submit" class="btn btn-raised btn-primary">
                                                <i class="fa fa-check-square-o"></i> Update
                                            </button>
                                        </div>
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
                            location.reload();    
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
</script>
@endsection