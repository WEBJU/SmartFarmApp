@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.top_banner') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.edit_banner') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.banner.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="brand_id" id="brand_id" value="{{$data->id}}" class="form-control">
                                        <input type="hidden" name="old_img" id="old_img" value="{{$data->icon}}" class="form-control">
                                        <div class="form-group">
                                            <label for="type" class="col-form-label">{{ trans('labels.type') }}:</label>
                                            <select name="type" class="form-control" id="type">
                                                <option value="">{{ trans('placeholder.select_type') }}</option>
                                                <option value="category" {{$data->type == "category"  ? 'selected' : ''}}>{{ trans('labels.category') }}</option>
                                                <option value="product" {{$data->type == "product"  ? 'selected' : ''}}>{{ trans('labels.product') }}</option>
                                            </select>
                                        </div>

                                        <div class="category gravity" @if($data->type != "category") style="display: none;" @endif>
                                            <div class="form-group">
                                                <label for="cat_id" class="col-form-label">{{ trans('labels.category') }}:</label>
                                                <select name="cat_id" class="form-control"id="cat_id">
                                                    <option value="">{{ trans('placeholder.select_category') }}</option>
                                                    @foreach ($category as $category)
                                                    <option value="{{$category->id}}" {{($data->cat_id == $category->id) ? 'selected' : '' }}>{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="product gravity" @if($data->type != "product") style="display: none;" @endif>
                                            <div class="form-group">
                                                <label for="product_id" class="col-form-label">{{ trans('labels.product') }}:</label>
                                                <select name="product_id" class="form-control" id="product_id">
                                                    <option value="">{{ trans('placeholder.select_product') }}</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{$product->id}}" {{($data->product_id == $product->id) ? 'selected' : '' }}>{{$product->product_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="image">{{ trans('labels.image') }} (800X450)</label>
                                            <input type="file" id="image" class="form-control" name="image" >
                                            @if ($errors->has('image'))
                                                <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                        </div>
                                        <img src='{!! asset("storage/app/public/images/banner/".$data->image) !!}' class='media-object round-media height-50'>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.brand') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> {{ trans('labels.update') }}
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
<script type="text/javascript">

    $(document).ready(function(){
        $('#type').on('change', function() {
          if ( this.value == 'category')
          {
            $(".category").show();
            $(".product").hide();
          }

          if ( this.value == 'product')
          {
            $(".product").show();
            $(".category").hide();
          }
        });
    });
</script>

@endsection