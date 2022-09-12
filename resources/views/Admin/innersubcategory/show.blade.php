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
                    <div class="content-header">{{ trans('labels.edit_innersubcategory') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.innersubcategory.update') }}">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="inner_cat_id" id="inner_cat_id" value="{{$data->id}}" class="form-control">

                                        <div class="form-group">
                                            <label for="cat_id">{{ trans('labels.category') }}</label>
                                            <select class="form-control" name="cat_id" id="cat_id">
                                                <option value="">{{ trans('placeholder.select_category') }}</option>
                                                @foreach ($category as $category)
                                                <option value='{{$category->id}}' 
                                                  {{($data->cat_id == $category->id) ? 'selected' : '' }}>
                                                  {{$category->category_name}}</option>
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
                                                @foreach ($subcategory as $subcategory)
                                                <option value='{{$subcategory->id}}' 
                                                  {{($data->subcat_id == $subcategory->id) ? 'selected' : '' }}>
                                                  {{$subcategory->subcategory_name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('subcat_id'))
                                                <span class="text-danger">{{ $errors->first('subcat_id') }}</span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="innersubcategory_name">{{ trans('labels.innersubcategory_name') }}</label>
                                            <input type="text" id="innersubcategory_name" class="form-control" name="innersubcategory_name" value="{{$data->innersubcategory_name}}" placeholder="{{ trans('placeholder.innersubcategory') }}">
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