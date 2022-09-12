@extends('layouts.admin')
@section('title')
    @if(@$data) Edit @else Create @endif Price Master
@endsection
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('storage/app/public/Adminassets/vendors/css/toastr.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="basic-elements">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">@if(@$data) Edit @else Create @endif User Profile</h4>
                        </div>
                        <div class="card-body">
                            <div class="px-3">
                              <form class="form" action="@if(@$data){{route('admin.priceplane.update')}}@else{{route('admin.priceplane.store')}}@endif" method="post">
                                 @csrf
                                  <div class="form-body">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="name">Name*</label>
                                                <input type="text" class="form-control" id="name" name="name" type="text" value="@if(@$data){{$data->name}}@else{{old('name')}}@endif" placeholder="Name">
                                                @if(@$data)
                                                  <input type="hidden" name="id" name="id" value="{{$data->id}}">
                                                @endif
                                                @error('name')
                                                    <span class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                            <fieldset class="form-group">
                                                <label for="year_price">Email*</label>
                                                <input type="text" class="form-control" id="year_price" name="year_price" value="@if(@$data){{$data->price_year}}@else{{old('year_price')}}@endif" placeholder="Year price" onkeypress='return (event.charCode >= 45 && event.charCode <= 57) && event.charCode !== 47'>
                                                @error('year_price')
                                                    <span class="invalid-feedback error" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </fieldset>
                                        </div>


                                </div>
                                <div class="form-actions">
                                  <div class="text-right">
                                    <a href="{{route('admin.priceplane')}}" class="btn btn-raised btn-warning">Close</a>
                                    <button class="btn btn-raised btn-primary" type="submit" name="action">@if(@$data) Update @else Save @endif</button>
                                  </div>
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
    <script src="{{ asset('storage/app/public/Adminassets/vendors/js/toastr.min.js')}}" type="text/javascript"></script>
@endsection
@section('script')

@endsection