@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.category') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_category') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="category_name">{{ trans('labels.category_name') }}</label>
                                            <input type="text" id="category_name" class="form-control" name="category_name" placeholder="{{ trans('placeholder.category') }}">
                                            @if ($errors->has('category_name'))
                                                <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="icon">{{ trans('labels.image') }}</label>
                                            <input type="file" id="icon" class="form-control" name="icon" >
                                            @if ($errors->has('icon'))
                                                <span class="text-danger">{{ $errors->first('icon') }}</span>
                                            @endif
                                        </div>
                                        <div class="gallery"></div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.category') }}" class="btn btn-raised btn-warning mr-1">
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