<div class="w3-ch-sideBar w3-bar-block w3-card-2 w3-animate-right"  style="display:none;right:0;" id="rightMenu">
	<div class="rightMenu-scroll">
		<h4 class="cart_heading">Your cart</h4>
		<button onclick="closeRightMenu()" class="w3-bar-item w3-button w3-large"><i class="ti-close"></i></button>
		@if (@Auth::user()->id != "")
			<div class="right-ch-sideBar" id="side-scroll">	
				@if(count(Helper::getcart(Auth::user()->id)) == 0)
					<div class="col-lg-12 col-md-12 text-center">
						<img src="https://image.flaticon.com/icons/png/128/1209/1209205.png">
						@if(Auth::user())
							<h2 class="error_title mt-4">Your cart is empty!</h2>
							<p><span class="text-primary">Woops!</span> There is nothing in your bag. Let's add some items.</p>
							<a href="{{URL::to('/')}}" class="btn btn-primary">Shop now</a>
						@else
							<h2 class="error_title mt-4">PLEASE LOG IN</h2>
							<p>Login to view items in your cart.</p>
							<a href="{{URL::to('/signin')}}" class="btn btn-primary">Login</a>
						@endif
					</div>

				@else 	
					<div class="cart_select_items">
						<!-- Single Item -->
						@foreach (Helper::getcart(Auth::user()->id) as $cartitems)
						<div class="product cart_selected_single">
							<div class="cart_selected_single_thumb">
								<a href="#"><img src="{{$cartitems->image_url}}" class="img-fluid" alt="" /></a>
							</div>
							<div class="cart_selected_single_caption">
								<h4 class="product_title">{{$cartitems->product_name}}</h4>
								@if ($cartitems->attribute != "")
									<span class="numberof_item mt-2">{{$cartitems->attribute}} : {{$cartitems->variation}}</span>
								@endif
								<span class="numberof_item mt-2">{{Helper::CurrencyFormatter($cartitems->price)}} x {{$cartitems->qty}}</span>
								<span class="numberof_item mt-2 text-right"><b></b></span>
								<div class="cart_price">
									<h6><a href="javascript::void()" onclick="DeleteItem('{{$cartitems->id}}','1')" class="text-danger"><i class="fa fa-trash" aria-hidden="true"></i></a><span>{{Helper::CurrencyFormatter($cartitems->qty * $cartitems->price)}}</span></h6>
								</div>
							</div>
						</div>

						<?php
						$data[] = array(
						    "sub_total" => $cartitems->qty * $cartitems->price
						);
						$sub_total = array_sum(array_column(@$data, 'sub_total'));
						?>
						@endforeach

					</div>
					
					<div class="cart_subtotal">
						<h6>Subtotal<span class="theme-cl">{{Helper::CurrencyFormatter($sub_total)}}</span></h6>
					</div>
					
					<div class="cart_action">
						<ul>
							<li><a href="{{URL::to('/cart')}}" class="btn btn-go-cart btn-theme">View/Edit Cart</a></li>
						</ul>
					</div>
				@endif
				
			</div>
		@else
			<div class="right-ch-sideBar" id="side-scroll">
										
				<div class="cart_action">
					<ul>
						<li><a href="{{URL::to('/signin')}}" class="btn btn-go-cart btn-theme">Login</a></li>
					</ul>
				</div>
				
			</div>
		@endif
	</div>
</div>