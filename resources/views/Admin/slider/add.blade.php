@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.sliders') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.add_slider') }}</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
                <div class="col-md-12">
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
                                <form class="form" method="post" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                      <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="image">{{ trans('labels.image') }} (1920X820)</label>
                                                <input type="file" id="image" class="form-control" name="image" >
                                                @if ($errors->has('image'))
                                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                                @endif
                                            </fieldset>
                                            <div class="gallery"></div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="link">{{ trans('labels.link') }}</label>
                                                <input type="text" class="form-control" id="link" name="link" placeholder="{{ trans('placeholder.link') }}" value="{{old('link')}}">
                                                @if ($errors->has('link'))
                                                    <span class="text-danger">{{ $errors->first('link') }}</span>
                                                @endif
                                            </fieldset>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.slider') }}" class="btn btn-raised btn-warning mr-1">
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