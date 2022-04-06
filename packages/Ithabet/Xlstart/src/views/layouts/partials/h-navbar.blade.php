<!-- BEGIN: Header-->
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-secondary navbar-brand-center">
    <div class="navbar-header d-xl-block d-none">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item"><a class="navbar-brand" href="{{ url('/') }}">
                    <div class="brand-logo"><img class="logo" src="{{ asset('xlstart-assets/') }}//app-assets/images/logo/logo-light.png"></div>
                    <h2 class="brand-text mb-0">OUTFOCUS</h2></a></li>
        </ul>
    </div>
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu mr-auto"><a class="nav-link nav-menu-main menu-toggle" href="javascript:void(0);"><i class="bx bx-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        <li class="nav-item d-none d-lg-block">
                            <a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title=""
                               data-original-title="{{ __('New Project') }}"><i class="ficon bx bx-plus"></i></a></li>

                    </ul>

                </div>
                <ul class="nav navbar-nav float-left d-flex align-items-center">

                    <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>

                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="javascript:void(0);" data-toggle="dropdown">
                            <div class="user-nav d-lg-flex d-none">
                                <span class="user-name"> <i class="bx bx-user mr-50"></i> {{ auth()->user()->name }}</span>
                            </div></a>
                        <div class="dropdown-menu dropdown-menu-right pb-0">
                            <!--Basic Modal -->
                            <a class="dropdown-item" data-toggle="modal" data-target="#change_password" href="#"><i
                                    class="bx bx-lock mr-50"></i>{{__('Edit Password')}}</a>
                            <div class="dropdown-divider mb-0"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                                <i class="bx bx-power-off mr-50"></i>{{__('Logout')}}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="change_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel1">{{ __('Change Password') }}</h3>
                    <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.update') }}" method="post">
                            @csrf

                        <label>{{ __('New Password') }}</label>
                            <input name="password" type="password" class="form-control">

                            <button type="submit" class="btn btn-primary float-right mt-2">{{ __('save') }}</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</nav>
<!-- END: Header-->
