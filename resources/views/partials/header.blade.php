<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light">
        <div class="m-header">
            <img src="{{ asset('assets/admin/images/logo_img.png') }}" alt="Logo Here">
            <a class="mobile-menu" id="mobile-collapse1" href="javascript:void(0)"><span></span></a>
            
            <a href="{{ route('admin.home') }}" class="b-brand">
                   {{-- <div class="b-bg">
                       <i class="feather icon-trending-up"></i>
                   </div> --}}
                   <div class="">
                       <img src="{{ asset('assets/admin/images/fav.png') }}" />
                   </div>
                   <span class="b-title">Admin Dashboard</span>
               </a>
        </div>
        <a class="mobile-menu" id="mobile-header" href="javascript:void(0)">
            <i class="feather icon-more-horizontal"></i>
        </a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto header-right-icon">
                <li><a href="javascript:void(0)" class="full-screen" onclick="javascript:toggleFullScreen()"><i class="feather icon-maximize"></i></a></li>
                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon feather icon-settings"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ asset('assets/admin/images/user/user.png') }}" class="img-radius" alt="User-Profile-Image">
                                <span>{{ auth()->user()->profile->full_name ?? auth()->user()->name }}</span>
                                <p>{{ auth()->user()->email }}</p>

                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn bg-transparent dud-logout" title="Logout"><i class="fa fa-sign-out"></i></button>
                                </form>
                            </div>
                            <ul class="pro-body">
                                <li><a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="fa fa-user"></i> Profile</a></li>                                
                                <li><a href="{{ route('admin.changePasswordForm') }}" class="dropdown-item"><i class="fa fa-key"></i> Change Password</a></li>                                
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn bg-transparent dropdown-item" title="Logout"><i class="fa fa-sign-out"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
</header>