<nav id="pcoded-navbar" class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo b-brand">   
            <div class="menu-logo-small">
                <img src="{{ asset('assets/admin/images/logo_img.png') }}" alt="Small Logo Here">
            </div>         
            <div class="menu-logo">
                <img src="{{ asset('assets/admin/images/logo_img.png') }}" alt="Logo Here">
            </div>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)"><span></span></a>
        </div>

        <div class="navbar-content scroll-div">
            @auth
                <ul class="nav pcoded-inner-navbar">            
                    <li data-username="admin_dashboard" class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                      <a href="{{ route('admin.home') }}" class="nav-link">
                          <span class="pcoded-micon">
                              <i class="feather icon-home"></i>
                          </span>
                          <span class="pcoded-mtext">Dashboard</span>
                      </a>
                    </li>
                    @can('user_management_access')
                        <li data-username="user_management_access" class="nav-item pcoded-hasmenu {{ request()->is('admin/users*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/roles*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/permissions*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-users-between-lines"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.userManagement.title') }}</span>
                            </a>
                            
                            <ul class="pcoded-submenu">            
                                @can('user_access')
                                    <li data-username="users" class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-users"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.user.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('role_access')
                                    <li data-username="role" class="nav-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.role.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('permission_access')
                                    <li data-username="permission" class="nav-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.permission.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                        <li data-username="country" class="nav-item {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.countries.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-flag"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.country.title') }}</span>
                            </a>
                        </li>

                        <li data-username="category" class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.category.title') }}</span>
                            </a>
                        </li>

                        <li data-username="subCategory" class="nav-item {{ request()->is('admin/sub-categories') || request()->is('admin/sub-categories/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.sub-categories.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.sub_category.title') }}</span>
                            </a>
                        </li>

                        <li data-username="verificationMode" class="nav-item {{ request()->is('admin/verification-modes') || request()->is('admin/verification-modes/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.verification-modes.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.verification_mode.title') }}</span>
                            </a>
                        </li>

                        <li data-username="providerType" class="nav-item {{ request()->is('admin/provider-types') || request()->is('admin/provider-types/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.provider-types.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.provider_type.title') }}</span>
                            </a>
                        </li>

                        <li data-username="verificationProvider" class="nav-item {{ request()->is('admin/verification-providers') || request()->is('admin/verification-providers/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.verification-providers.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.verification_provider.title') }}</span>
                            </a>
                        </li>

                        <li data-username="servicePartner" class="nav-item {{ request()->is('admin/service-partners') || request()->is('admin/service-partners/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.service-partners.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-file-text"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.service_partner.title') }}</span>
                            </a>
                        </li>

                        <li data-username="evidenceType" class="nav-item {{ request()->is('admin/evidence-types') || request()->is('admin/evidence-types/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.evidence-types.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-file-text"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.evidence_type.title') }}</span>
                            </a>
                        </li>
                        
                        <li data-username="services" class="nav-item {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.services.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-file-text"></i> 
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.services.title') }}</span>
                            </a>
                        </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
