<div class="col-lg-4 col-md-3">
	<nav class="dashboard-nav mb-10 mb-md-0">
	  <div class="list-group list-group-sm list-group-strong list-group-flush-x">
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('order-history') ? 'active' : '' }}" href="{{URL::to('order-history')}}">
		  Orders
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('wishlist') ? 'active' : '' }}" href="{{URL::to('wishlist')}}">
		  Wishlist
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('notifications') ? 'active' : '' }}" href="{{URL::to('notifications')}}">
		  All Notifications
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('account') ? 'active' : '' }}" href="{{URL::to('account')}}">
		  Account Settings
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('my-address') ? 'active' : '' }}" href="{{URL::to('my-address')}}">
		  My address
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle {{ request()->is('my-wallet') ? 'active' : '' }}" href="{{URL::to('my-wallet')}}">
		  My Wallet
		</a>
		<a class="list-group-item list-group-item-action dropright-toggle" href="{{URL::to('logout')}}">
		  Logout
		</a>
	  </div>
	</nav>
</div>