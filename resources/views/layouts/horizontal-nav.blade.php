
<!-- Top Bar Start -->
<div class="topbar">  
    <!-- LOGO -->
    <div class="brand" style="position: absolute">
        <a href="index" class="logo" style="display: flex">
            <span style="padding: 6px">
                <img src="{{URL::asset('assets/images/court-of-arms.png')}}" alt="logo-small" class="logo-sm">
            </span>
            <!-- <span>
                <img src="{{URL::asset('assets/images/court-of-arms.png')}}" alt="logo-small" class="logo-sm logo-light">
                <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span> -->
        </a>
    </div>
    <!--end logo-->  
    <!-- Navbar -->
    <nav class="navbar-custom" >    
        <ul class="list-unstyled topbar-nav float-end mb-0"> 
                                 

            <!-- <li class="notification-list">
                <a class="nav-link arrow-none nav-icon offcanvas-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#Appearance" role="button" aria-controls="Rightbar">
                    <i class="ti ti-settings ti-spin"></i>
                </a>
            </li>                        -->
            
           


            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <div class="d-flex align-items-center">
                    <img src="{{URL::asset('assets/images/users/default_profile.png')}}" alt="profile-user" class="rounded-circle me-2 thumb-sm" />
                        <div>
                            <small class="d-none d-md-block font-11">{{ $user_role }}</small>
                            <span class="d-none d-md-block fw-semibold font-12">{{ $log_user->email }}</span>
                            <span class="d-none d-md-block fw-semibold font-12">{{ $log_user->name }} <i class="mdi mdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="/profile/view"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Settings</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li><!--end topbar-profile-->
            <li class="menu-item">
                <!-- Mobile menu toggle-->
                <a class="navbar-toggle nav-link" id="mobileToggle"  onclick="toggleMenu()" onclick="toggleMenu()">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a><!-- End mobile menu toggle-->
            </li> <!--end menu item--> 
        </ul><!--end topbar-nav-->

        <div class="navbar-custom-menu">
            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                <li class="nav-item ">
                        <a class="nav-link " href="/dashboard" id="navbar_auth" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="padding: 6px">
                <img src="{{URL::asset('assets/images/court-of-arms.png')}}" alt="logo-small" class="logo-sm">
            </span>
                        </a>
                        
                    </li><!--end nav-item-->    
                    <li class="nav-item dropdown parent-menu-item">
                        <a class="nav-link " href="/dashboard" id="navbarDashboards"  aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span><i class="ti ti-smart-home menu-icon"></i>Dashboard</span>
                        </a>
                        <!--  -->
                    </li><!--end nav-item-->
                    @can('view-parliaments')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarApps" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-apps menu-icon"></i>Parliament Data</span>
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarApps"> 
                        @can('create-parliament')
                            <li>
                                <a class="dropdown-item" href="/parliaments">Parliament Types</a>
                            </li><!--end /li-->
                            @endcan
                            <li>
                                <a class="dropdown-item" href="/parties">Political Parties</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="/members">MPs</a>
                            </li><!--end /li-->
                            
                                           
                        </ul><!--end submenu-->
                    </li><!--end nav-item--> 
                    @endcan
                    
                    @can('view-districts')
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUI_Kit" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-planet menu-icon"></i>Constituencies</span>
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarApps"> 
                       
                                <li >
                                    <a class="dropdown-item" href="/districts">Districts</a>
                                </li><!--end nav-item-->

                                <!-- <li>
                                <a class="dropdown-item" href="/constituencies">View Constituencies</a>
                            </li>end nav-item -->
                            
                        </ul><!--end submenu-->
                    </li><!--end nav-item-->
                    @endcan

                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-file-diff menu-icon"></i>What we do</span>
                        </a>
                            <ul class="dropdown-menu  animate slideIn" aria-labelledby="navbarPages">
                            <li>
                                <a class="dropdown-item" href="/posts">Posts</a>
                            </li><!--end /li-->
                            @can('create-post')
                            <li>
                                <a class="dropdown-item" href="/posts">Posts</a>
                            </li><!--end /li-->
                            @endcan
                            @can('view-professional-bodies')
                            <li>
                                <a class="dropdown-item" href="/professional-bodies">CBO Data</a>
                            </li><!--end /li-->
                            @endcan
                            @can('view-hobbies')
                            <li">
                                    <a class="dropdown-item" href="/hobbies">Team</a>
                            </li>
                            @endcan
                            </ul><!--end nav-->
                    </li><!--end nav-item-->
                  

                   
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbar_auth" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-shield-lock menu-icon"></i>Authorization</span>
                        </a>
                        <ul class="dropdown-menu  animate slideIn" aria-labelledby="navbar_auth">
                        @can('create-user')
                        <li>
                                <a class="dropdown-item" href="/users">Manage Users</a>
                            </li><!--end /li-->
                            @endcan
                            @can('role-create')
                            <li>
                                <a class="dropdown-item" href="/roles">Manage Roles</a>
                            </li><!--end /li-->
                            @endcan 
                        </ul><!--end submenu-->
                    </li><!--end nav-item-->     
                              
                </ul>
                <ul>
                  
                <ul><!-- End navigation menu -->
            </div> <!-- end navigation -->
        </div>
        <!-- Navbar -->
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->


