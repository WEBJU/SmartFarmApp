@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.innersubcategory') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_innersubcategory') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <div class="card-body">
                            @if(Session::has('danger'))
                            <div class="alert alert-danger">
                                {{ Session::get('danger') }}
                                @php
                                    Session::forget('danger');
                                @endphp
                            </div>
                            @endif
                            <div class="px-3">
                                <form class="form" method="post" action="{{ route('admin.innersubcategory.store') }}">
                                @csrf
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label for="cat_id">{{ trans('labels.category') }}</label>
                                            <select class="form-control" name="cat_id" id="cat_id">
                                                <option value="">{{ trans('placeholder.select_category') }}</option>
                                                @foreach ($data as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('cat_id'))
                                                <span class="text-danger">{{ $errors->first('cat_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="subcat_id">{{ trans('labels.subcategory') }}</label>
                                            <select class="form-control" name="subcat_id" id="subcat_id">
                                                <option value="">{{ trans('placeholder.select_subcategory') }}</option>
                                            </select>
                                            @if ($errors->has('subcat_id'))
                                                <span class="text-danger">{{ $errors->first('subcat_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="innersubcategory_name">{{ trans('labels.innersubcategory_name') }}</label>
                                            <input type="text" id="innersubcategory_name" class="form-control" name="innersubcategory_name" placeholder="{{ trans('placeholder.innersubcategory') }}">
                                            @if ($errors->has('innersubcategory_name'))
                                                <span class="text-danger">{{ $errors->first('innersubcategory_name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.innersubcategory') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}
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
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        $("#cat_id").change(function () {
            var cat_id = $("#cat_id").val();
            jQuery.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'POST',
                url:"{{ route('admin.innersubcategory.subcat') }}",
                data:{      
                'cat_id':cat_id
                },
                dataType: "json",
                success: function(response) {
                    let html ='';
                    html = '<option value="">{{ trans('placeholder.select_subcategory') }}</option>';
                    for(i in response){              
                        html+='<option value="'+response[i].id+'">'+response[i].subcategory_name+'</option>'
                    }
                    $('#subcat_id').html(html);
                },              
            });
        });
    });
</script>