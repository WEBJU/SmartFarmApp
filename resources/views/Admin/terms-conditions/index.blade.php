@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | Terms Conditions
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <section id="basic-form-layouts">
            <div class="row">
                <div class="col-sm-12">
                    <div class="content-header">Terms Conditions</div>
                </div>
            </div>

            <div class="row justify-content-md-center">
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
                                <form class="form" method="post" action="{{ route('admin.terms-conditions.update') }}">
                                @csrf
                                    <div class="form-body">
                                        <input type="hidden" name="id" class="form-control" value="{{$data->id}}">
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>
                                                    Terms Conditions
                                                </label>
                                                <textarea class="form-control" name="terms_conditions" id="terms_conditions" rows="5" placeholder="{{ trans('placeholder.terms_conditions') }}">{{$data->terms_conditions}}</textarea>
                                                @if ($errors->has('terms_conditions'))
                                                    <span class="text-danger">{{ $errors->first('terms_conditions') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-actions right">
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
@endsection