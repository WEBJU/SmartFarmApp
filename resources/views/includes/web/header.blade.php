<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header">

    <div class="header_topbar light">
        <div class="container">
            <div class="row">
            
                <div class="col-lg-6 col-md-6 col-sm-6 col-4">
                    <ul class="tp-list nbr ml-2">
                        <li class="dropdown dropdown-currency hidden-xs hidden-sm">
                            <select class="tp-list nbr ml-2 changeLang">
                                <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>LTR</option>
                                <option value="ar" {{ session()->get('locale') == 'ar' ? 'selected' : '' }}>RTL</option>
                            </select>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-8">
                    @if (@Auth::user()->id != "")
                    <div class="topbar_menu">
                        <ul @if (session()->get('locale') == 'en' OR session()->get('locale') == '') style="float: right;" @endif>
                            <li class="hide-m"><a href="{{URL::to('order-history')}}"><i class="ti-bag"></i>My Account</a></li>
                            <li><a href="{{URL::to('wishlist')}}"><i class="ti-heart"></i>Wishlist</a></li>
                            <li><a href="{{URL::to('logout')}}"><i class="ti-key"></i>Logout</a></li>
                        </ul>
                    </div>
                    @else
                    <div class="topbar_menu">
                        <ul @if (session()->get('locale') == 'en' OR session()->get('locale') == '') style="float: right;" @endif>
                            <li><a href="{{URL::to('signin')}}"><i class="ti-user"></i>Login</a></li>
                            <li><a href="{{URL::to('vendor-signup')}}"><i class="ti-users"></i>Become a vendor ?</a></li>
                        </ul>
                    </div>
                    @endif                   
                </div>
            
            </div>
        </div>
    </div>
    
    <!-- Main header -->
    <div class="main_header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-2 col-md-2 col-sm-3 col-4 mt-2">
                    <a class="nav-brand" href="{{URL::to('/')}}">
                        <img src="{{Helper::webinfo()->image}}" class="logo" alt="" />
                    </a>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                    <!-- Show on Mobile & iPad -->
                    <div class="blocks shop_cart d-xl-none d-lg-none">
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                <a class="cart_box" data-toggle="collapse" href="#mySearch" role="button" aria-expanded="false" aria-controls="mySearch"><i class="ti-search"></i></a>
                            </div>
                        </div>
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                @if (@Auth::user()->id != "")

                                    @if (!request()->is('cart'))

                                        <a href="#" onclick="openRightMenu()" id="openRightMenu" class="cart_box">

                                    @else

                                        <a href="#" class="cart_box">

                                    @endif

                                        <span class="qut_counter">{{Storage::disk('local')->get("cart")}}</span><i class="ti-shopping-cart"></i>

                                    </a>

                                @else

                                    <a href="#"  onclick="openRightMenu()" id="openRightMenu" class="cart_box"><span class="qut_counter">0</span><i class="ti-shopping-cart"></i></a>

                                @endif
                            </div>
                            <div class="ss_cart_content">
                                <strong>My Cart</strong>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Show on Desktop -->
                    <div class="blocks shop_cart d-none d-xl-block d-lg-block" @if (session()->get('locale') == 'en' OR session()->get('locale') == '') style="float: right;" @endif>
                        <div class="single_shop_cart">
                            <div class="ss_cart_left">
                                @if (@Auth::user()->id != "")

                                    @if (!request()->is('cart'))

                                        <a href="#" onclick="openRightMenu()" id="openRightMenu" class="cart_box">

                                    @else

                                        <a href="#" class="cart_box">

                                    @endif

                                        <span class="qut_counter">{{Storage::disk('local')->get("cart")}}</span><i class="ti-shopping-cart"></i>

                                    </a>

                                @else

                                    <a href="#"  onclick="openRightMenu()" id="openRightMenu" class="cart_box"><span class="qut_counter">0</span><i class="ti-shopping-cart"></i></a>

                                @endif
                            </div>
                            <div class="ss_cart_content">
                                <strong>My Cart</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="blocks search_blocks d-none d-xl-block d-lg-block ml-5">
                        <form method="get" action="{{URL::to('/search')}}">
                            <div class="input-group">
                                <input type="text" name="item" class="form-control" id="search-box" placeholder="Search entire store here..." style="border-radius: 0px !important;" autocomplete="off">
                                <div class="input-group-append">
                                    <button class="btn search_btn" type="submit" style="border-radius: 0px !important;"><i class="ti-search"></i></button>
                                </div>
                                <div id="countryList" class="item-list"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="collapse" id="mySearch">
            <div class="blocks search_blocks">
                <form method="get" action="{{URL::to('/search')}}">
                    <div class="input-group">
                        <input type="text" name="item" class="form-control" id="mobile-search-box" placeholder="Search entire store here..." style="border-radius: 0px !important;" autocomplete="off">
                        <div class="input-group-append">
                            <button class="btn search_btn" type="submit" style="border-radius: 0px !important;"><i class="ti-search"></i></button>
                        </div>
                        <div id="ProductSuggestions" class="item-list"></div>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
    
    <div class="header_nav">
        <div class="container"> 
            <div class="row align-item-center">
                <div class="col-lg-3 col-md-4 col-sm-8 col-10">
                    <!-- For Desktop -->
                    <div class="shopby_categories d-none d-xl-block d-lg-block">

                        <a class="shop_category" data-toggle="collapse" href="#myCategories" role="button" aria-expanded="false" aria-controls="myCategories"><i class="ti-menu"></i>Shop by categories</a>

                        <div class="collapse" id="myCategories">

                            <div id="cats_menu">

                                <ul>

                                    <?php $count = 0; ?>

                                    @foreach (Helper::getCategory() as $category)

                                    <?php if($count == 6) break; ?>

                                        <li class="active has-sub"><a href="{{URL::to('categories/products/'.$category->slug)}}"><span>{{$category->category_name}}</span></a>
                                            <ul>
                                                @foreach (Helper::getSubcategory() as $sub)
                                                @if($sub->cat_id==$category->id)
                                                 <li class="has-sub"><a href="{{URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)}}"><span>{{$sub->subcategory_name}}</span></a>
                                                    <ul>
                                                        @foreach (Helper::InnerSubcategory() as $inner)
                                                        @if($inner->subcat_id==$sub->id)
                                                        <li><a href="{{URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)}}"><span>{{$inner->innersubcategory_name}}</span></a></li>
                                                        @endif
                                                        @endforeach
                                                    </ul>
                                                 </li>
                                                @endif
                                                @endforeach
                                            </ul>
                                       </li>

                                    <?php $count++; ?>

                                    @endforeach

                                    <li><a href="{{URL::to('/categories')}}"><span>View All <i class="fa fa-arrow-right" aria-hidden="true"></i></span></a></li>

                                </ul>

                            </div>

                        </div>

                    </div>

                    <!-- Left Collapse navigation -->
                    <div class="w3-ch-sideBar-left w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="leftMenu">
                        <div class="rightMenu-scroll">
                            <div class="flixel">
                                <h4 class="cart_heading">Navigation</h4>
                                <button onclick="closeLeftMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
                            </div>
                            
                            <div class="right-ch-sideBar">
                                
                                <div class="side_navigation_collapse">
                                    <div class="d-navigation">
                                        <ul id="side-menu">
                                            <?php $count = 0; ?>

                                            @foreach (Helper::getCategory() as $category)

                                            <?php if($count == 6) break; ?>
                                            <li class="dropdown">
                                                <a href="{{URL::to('categories/products/'.$category->slug)}}">{{$category->category_name}}<span class="ti-angle-left"></span></a>
                                                <ul class="nav nav-second-level">
                                                    @foreach (Helper::getSubcategory() as $sub)
                                                    @if($sub->cat_id==$category->id)
                                                        <li class="dropdown"><a href="{{URL::to('subcategories/products/'.$category->slug.'/'.$sub->slug)}}">- {{$sub->subcategory_name}} <span class="ti-angle-left"></span></a>
                                                            <ul class="nav nav-third-level">
                                                            @foreach (Helper::InnerSubcategory() as $inner)
                                                            @if($inner->subcat_id==$sub->id)
                                                                <li><a href="{{URL::to('innersubcategories/products/'.$category->slug.'/'.$sub->slug.'/'.$inner->slug)}}">-- {{$inner->innersubcategory_name}}</a></li>
                                                            @endif
                                                            @endforeach
                                                            </ul>
                                                        </li>
                                                    @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <?php $count++; ?>

                                            @endforeach

                                            <li><a href="{{URL::to('/categories')}}"><span>View All <i class="fa fa-arrow-right" aria-hidden="true"></i></span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!-- Left Collapse navigation -->
                    
                    <!-- For Mobile -->
                    <div class="shopby_categories d-xl-none d-lg-none">
                        <a class="shop_category" href="#" onclick="openLeftMenu()"><i class="ti-menu"></i>Shop By categories</a>
                    </div>
                    
                </div>
                
                <div class="col-lg-9 col-md-8 col-sm-4 col-2">
                    <nav id="navigation" class="navigation navigation-landscape">
                        <div class="nav-header">
                            <div class="nav-toggle"></div>
                        </div>
                        <div class="nav-menus-wrapper" @if (session()->get('locale') == 'en' OR session()->get('locale') == '') style="transition-property: none;float: right;" @endif>
                            <ul class="nav-menu">
                                
                                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{URL::to('/')}}">Home</a></li>

                                <li class="{{ request()->is('categories') ? 'active' : '' }}"><a href="{{URL::to('/categories')}}">All Category</a></li>

                                <li class="{{ request()->is('new-products') ? 'active' : '' }}"><a href="{{URL::to('/new-products')}}">New Products</a></li>
                                
                                <li class="{{ request()->is('featured-products') ? 'active' : '' }}"><a href="{{URL::to('/featured-products')}}">Featured Products</a></li>

                                <li class="{{ request()->is('hot-products') ? 'active' : '' }}"><a href="{{URL::to('/hot-products')}}">Hot Products</a></li>
                                
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->