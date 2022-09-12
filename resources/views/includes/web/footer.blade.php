<!-- ============================ Call To Action ================================== -->
<section class="theme-bg call_action_wrap-wrap">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        
        <div class="call_action_wrap">
          <div class="call_action_wrap-head">
            <h3>Subscribe to Our Newsletter</h3>
            <span>Subscribe our newsletter for coupon, offer and exciting promotional discount.</span>
          </div>
          <div class="newsletter_box">
            <form method="post" action="{{URL::to('/subscribe')}}">
              @csrf
              <div class="input-group">
                <input type="text" class="form-control" name="subscribe" placeholder="Enter email to Subscribe ...">
                <div class="input-group-append">
                  <button class="btn search_btn" type="submit"><i class="fas fa-arrow-alt-circle-right"></i></button>
                </div>
              </div>
              @if ($errors->has('subscribe'))
                  <span class="text-danger">{{ $errors->first('subscribe') }}</span>
              @endif
            </form>
          </div>
        </div>
        
      </div>
    </div>
  </div>
</section>
<!-- ============================ Call To Action End ================================== -->
<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
  <div class="before-footer">
    <div class="container">
      <div class="row">
    
        <div class="col-lg-4 col-md-4">
          <div class="single_facts">
            <div class="facts_icon">
              <i class="ti-shopping-cart"></i>
            </div>
            <div class="facts_caption">
              <h4>Free Home Delivery</h4>
              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut</p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4">
          <div class="single_facts">
            <div class="facts_icon">
              <i class="ti-money"></i>
            </div>
            <div class="facts_caption">
              <h4>Money Back Guarantee</h4>
              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut</p>
            </div>
          </div>
        </div>
        
        <div class="col-lg-4 col-md-4">
          <div class="single_facts last">
            <div class="facts_icon">
              <i class="ti-headphone-alt"></i>
            </div>
            <div class="facts_caption">
              <h4>24x7 Online Support</h4>
              <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut</p>
            </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="footer-middle">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-3 col-md-4">
          <div class="footer_widget">
            <h4 class="extream">Contact us</h4>
            
            <div class="address_infos">
              <ul>
                <li><i class="ti-home theme-cl"></i>{{Helper::webinfo()->address}}</li>
                <li><i class="ti-headphone-alt theme-cl"></i>{{Helper::webinfo()->contact}}</li>
                <li><i class="ti-email theme-cl"></i>{{Helper::webinfo()->email}}</li>
              </ul>
            </div>
            
          </div>
        </div>
            
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title">Categories</h4>
            <ul class="footer-menu">
              <?php $count = 0; ?>
              @foreach (Helper::getCategory() as $category)
                <?php if($count == 4) break; ?>
                <li><a href="{{URL::to('categories/products/'.$category->slug)}}">{{$category->category_name}}</a></li>
                <?php $count++; ?>
              @endforeach
            </ul>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title">Latest News</h4>
            <ul class="footer-menu">
              <li><a href="{{URL::to('offers')}}">Offers & Deals</a></li>
              <li><a href="#">My Account</a></li>
              <li><a href="{{URL::to('order-history')}}">My Orders</a></li>
              <li><a href="{{URL::to('wishlist')}}">Favorites</a></li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-3 col-md-2">
          <div class="footer_widget">
            <h4 class="widget_title">Customer Support</h4>
            <ul class="footer-menu">
              <li><a href="{{URL::to('about-us')}}">About Us</a></li>
              <li><a href="{{URL::to('terms-conditions')}}">Terms & Conditions</a></li>
              <li><a href="{{URL::to('privacy-policy')}}">Privacy</a></li>
              <li><a href="{{URL::to('help')}}">Help</a></li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </div>
  
  <div class="footer-bottom">
    <div class="container">
      <div class="row align-items-center">
        
        <div class="col-lg-6 col-md-8">
          <p class="mb-0">{{Helper::webinfo()->copyright}}</p>
        </div>
        
        <div class="col-lg-6 col-md-6 text-right">
          <ul class="footer_social_links">
            @if(Helper::webinfo()->facebook != "")
            <li><a href="{{Helper::webinfo()->facebook}}" target="_blank"><i class="ti-facebook"></i></a></li>
            @endif
            @if(Helper::webinfo()->twitter != "")
            <li><a href="{{Helper::webinfo()->twitter}}" target="_blank"><i class="ti-twitter"></i></a></li>
            @endif
            @if(Helper::webinfo()->instagram != "")
            <li><a href="{{Helper::webinfo()->instagram}}" target="_blank"><i class="ti-instagram"></i></a></li>
            @endif
            @if(Helper::webinfo()->linkedin != "")
            <li><a href="{{Helper::webinfo()->linkedin}}" target="_blank"><i class="ti-linkedin"></i></a></li>
            @endif
          </ul>
        </div>
        
      </div>
    </div>
  </div>
</footer>
<!-- ============================ Footer End ================================== -->

      <!-- cart -->
      <div id="cart-display">
        @include('includes.web.cart')
      </div>
      <!-- cart -->

      <!-- Product View -->
      <div class="modal fade" id="viewproduct-over" tabindex="-1" role="dialog" aria-labelledby="add-payment" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" id="view-product">
            <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
            <div class="modal-body">
              <div class="row align-items-center">
          
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="sp-wrap gallerys">
                </div>
              </div>
              
              <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="woo_pr_detail">
                  
                  <div class="woo_cats_wrps">
                    <a href="#" class="woo_pr_cats" id="category_name"></a>
                    <span class="woo_pr_trending">Trending</span>
                  </div>
                  <h2 class="woo_pr_title" id="product_name"></h2>
                  
                  <div class="woo_pr_reviews">
                    <div class="woo_pr_rating">
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star filled"></i>
                      <i class="fa fa-star"></i>
                      <span class="woo_ave_rat">4.8</span>
                    </div>
                    <div class="woo_pr_total_reviews">
                      <a href="#">(124 Reviews)</a>
                    </div>
                  </div>
                  
                  <div class="woo_pr_price">
                    <div class="woo_pr_offer_price">
                      <h3 id="discounted_price"></h3> <span id="product_price" class="org_price"></span>
                    </div>
                  </div>
                  
                  <div class="woo_pr_short_desc">
                    <p id="description"></p>
                  </div>
                  
                  <div class="woo_pr_color flex_inline_center mb-3">
                    <div class="woo_pr_varient">
                      
                    </div>
                    <div class="woo_colors_list pl-3">
                      <span id="variation"></span>
                      {{ $errors->login->first('variation') }}
                    </div>
                  </div>
                  
                  <div class="woo_btn_action">
                    <div class="col-12 col-lg-auto">
                      <button type="submit" class="btn btn-block btn-dark mb-2">Add to Cart <i class="ti-shopping-cart-full ml-2"></i></button>
                    </div>
                    <div class="col-12 col-lg-auto">
                      <button class="btn btn-gray btn-block mb-2" data-toggle="button">Wishlist <i class="ti-heart ml-2"></i></button>
                    </div>
                  </div>
                  
                </div>
              </div>
              
            </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Modal -->

    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

    