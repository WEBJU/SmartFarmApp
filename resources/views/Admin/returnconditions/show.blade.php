@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | {{ trans('labels.returnconditions') }}
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">{{ trans('labels.edit_returnconditions') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.returnconditions.update') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="return_id" id="return_id" value="{{$data->id}}" class="form-control">
                                        <div class="form-group">
                                            <label for="return_conditions">{{ trans('labels.returnconditions') }}</label>
                                            <input type="text" id="return_conditions" class="form-control" name="return_conditions" placeholder="{{ trans('placeholder.return_conditions') }}" value="{{$data->return_conditions}}">
                                            @if ($errors->has('return_conditions'))
                                                <span class="text-danger">{{ $errors->first('return_conditions') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-actions center">
                                        <a href="{{ route('admin.returnconditions') }}" class="btn btn-raised btn-warning mr-1">
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

@endsection