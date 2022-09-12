<nav class="navbar navbar-expand-lg navbar-light bg-faded header-navbar">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" class="navbar-toggle d-lg-none float-left">
          <span class="sr-only">{{ trans('labels.toggle_navigation') }}</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <span class="d-lg-none navbar-right navbar-collapse-toggle">
          <a aria-controls="navbarSupportedContent" href="javascript:;" class="open-navbar-container black">
            <i class="ft-more-vertical"></i>
          </a>
        </span>

        <form method="POST" action="{{route('admin.withdrawal')}}" class="navbar-form navbar-right">
          @csrf
          <div class="position-relative has-icon-right">
            <button class="btn btn-success btn-raised" type="button">
              Earnings <span class="badge badge-light">Ksh.{{Helper::getwalletbalance(Auth::user()->id)}}</span>
            </button>
            @if(Auth::user()->roles->first()->name == "admin")
              @if(Helper::MinBalanceForWithdraw(Auth::user()->id) == 1)
              <input type="hidden" name="balance" value="{{Auth::user()->wallet}}">
              <button class="btn btn-info btn-raised" type="submit">
                Send withdrawal request
              </button>
              @endif
            @endif
          </div>
        </form>
      </div>
      <div class="navbar-container">
        <div id="navbarSupportedContent" class="collapse navbar-collapse">
          @if(Auth::user()->roles->first()->name == "admin")
            @if(Helper::CheckInfo(Auth::user()->id) == 1)
              <div id="top-message" class="container">
                <div class="alert alert-danger">
                  Complete your store <a href="{{route('admin.vendor-profile')}}">Click here</a>
                </div>
              </div>
            @endif
          @endif
          <ul class="navbar-nav">
            <li class="dropdown nav-item"><a id="dropdownBasic3" href="#" data-toggle="dropdown" class="nav-link position-relative dropdown-toggle">{{ Auth::user()->name }}
                <p class="d-none">{{ trans('labels.user_settings') }}</p></a>
                <div ngbdropdownmenu="" aria-labelledby="dropdownBasic3" class="dropdown-menu text-left dropdown-menu-right">
                  <a href="javascript:void(0);" data-toggle="modal" data-target="#ChangePasswordModal" class="dropdown-item"><i class="fa fa-key mr-2"></i><span>{{ trans('labels.change_password') }}</span></a>
                  <a href="{{route('admin.logout')}}" class="dropdown-item"><i class="ft-power mr-2"></i><span>{{ trans('labels.logout') }}</span></a>
                </div>
            </li>

          </ul>
        </div>
      </div>
    </div>
</nav>