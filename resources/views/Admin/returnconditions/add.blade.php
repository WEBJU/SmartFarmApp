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
                    <div class="content-header">{{ trans('labels.add_returnconditions') }}</div>
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
                                <form class="form" method="post" action="{{ route('admin.returnconditions.store') }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-body">

                                        <div class="form-group">
                                            <label for="return_conditions">{{ trans('labels.returnconditions') }}</label>
                                            <input type="text" id="return_conditions" class="form-control" name="return_conditions" placeholder="{{ trans('placeholder.return_conditions') }}">
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
@endsection
@section('script')
<script type="text/javascript">
    function showType(select){
       if(select.value==0){
        document.getElementById('show_percentage').style.display = "block";
        document.getElementById('show_amount').style.display = "none";
       } else{
        document.getElementById('show_percentage').style.display = "none";
        document.getElementById('show_amount').style.display = "block";
       }
    };

    function showQuantity(select){
       if(select.value==1){
        document.getElementById('show_times').style.display = "block";
       } else{
        document.getElementById('show_times').style.display = "none";
       }
    };
</script>
@endsection