@extends('layouts.admin')
@section('title')
    {{Helper::webinfo()->site_title}} | Users
@endsection
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="row match-height">
            <div class="col-xl-4 col-lg-12">
                <div class="card" style="height: 553px;">
                    <div class="card-header">
                        <h4 class="card-title mb-0">User Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="card-block">
                            <div class="media mb-3">
                                <img alt="96x96" class="media-object d-flex mr-3 align-self-center bg-primary height-50 rounded-circle" src="{{$userInfo->profile_pic}}">
                                <div class="media-body">
                                    <h4 class="font-medium-1 mt-2 mb-0">{{$userInfo->name}}</h4>
                                </div>
                            </div>
                            <li class="list-group-item">
                                <span class="badge bg-primary float-right">{{$totalwallpaper}}</span> Total Wallpapers
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-success float-right">{{$totallikes}}</span> Total Likes
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-warning float-right">{{$totalview}}</span> Total Views
                            </li>
                            <li class="list-group-item">
                                <span class="badge bg-warning float-right">{{$totalvideos}}</span> Total Videos
                            </li>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-lg-12">
                <div class="card-body">
                  <div class="card-block my-gallery" itemscope="" itemtype="http://schema.org/ImageGallery">
                    <div class="row">
                        @foreach ($wallpaperdata as $wallpaper)
                            @if ($wallpaper['istype'] == "Wallpaper")
                            <figure class="col-md-3 col-sm-6 col-12" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                <a itemprop="contentUrl" data-size="480x360">
                                <img class="img-thumbnail img-fluid" src="{{$wallpaper->wallpaper_image}}" itemprop="thumbnail" alt="Image description">
                                </a>
                            </figure>
                            @else
                            <figure class="col-md-3 col-sm-6 col-12" itemprop="associatedMedia" itemscope="" itemtype="http://schema.org/ImageObject">
                                <a itemprop="contentUrl" data-size="480x360">
                                <video class="img-thumbnail img-fluid" width="320" height="240" controls>
                                  <source src="{{$wallpaper->video_url}}" type="video/mp4">
                                </video>
                                </a>
                            </figure>
                            @endif
                        @endforeach
                    </div>
                    {!! $wallpaperdata->links() !!}
                  </div>
                  <!--/ Image grid -->
                </div>
            </div>
        </div>
    </div>


@endsection
@section('scripttop')

    <script src="{{ asset('public/Adminassets/vendors/js/datatable/datatables.min.js')}}" type="text/javascript"></script>
@endsection
@section('script')
<script src="{{asset('public/Adminassets/js/data-tables/datatable-basic.js')}}" type="text/javascript"></script>
<script src="{{asset('public/Adminassets/js/sweetalert2.min.js')}}"></script>
@endsection