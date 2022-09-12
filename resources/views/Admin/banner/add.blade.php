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
                    <div class="content-header">{{ trans('labels.add_banner') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.banner.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                      <div class="form-group">
                                          <label for="type" class="col-form-label">{{ trans('labels.type') }}:</label>
                                          <select name="type" class="form-control"id="type">
                                              <option value="">{{ trans('placeholder.select_type') }}</option>
                                              <option value="category">{{ trans('labels.category') }}</option>
                                              <option value="product">{{ trans('labels.product') }}</option>                                
                                          </select>
                                      </div>

                                      <div class="category gravity">
                                          <div class="form-group">
                                              <label for="cat_id" class="col-form-label">{{ trans('labels.category') }}:</label>
                                              <select name="cat_id" class="form-control selectpicker"id="cat_id">
                                                  <option value="">{{ trans('placeholder.select_category') }}</option>
                                                  @foreach ($data as $category)
                                                  <option value="{{$category->id}}">{{$category->category_name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>


                                      <div class="product gravity">
                                          <div class="form-group">
                                              <label for="product_id" class="col-form-label">{{ trans('labels.product') }}:</label>
                                              <select name="product_id" class="form-control selectpicker" id="product_id">
                                                  <option value="">{{ trans('placeholder.select_product') }}</option>
                                                  @foreach ($products as $product)
                                                  <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                      </div>

                                      <div class="form-group">
                                          <label for="image">{{ trans('labels.image') }}:</label>
                                          <input type="file" id="image" class="form-control" name="image" >
                                          @if ($errors->has('image'))
                                              <span class="text-danger">{{ $errors->first('image') }}</span>
                                          @endif
                                      </div>
                                      <div class="gallery"></div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.banner') }}" class="btn btn-raised btn-warning mr-1">
                                            <i class="ft-x"></i> {{ trans('labels.cancel') }}:
                                        </a>
                                        <button type="submit" class="btn btn-raised btn-primary">
                                            <i class="fa fa-check-square-o"></i> {{ trans('labels.save') }}:
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