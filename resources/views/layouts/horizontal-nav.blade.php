
<!-- Top Bar Start -->
<div class="topbar">  
    <!-- LOGO -->
    <div class="brand">
        <a href="index" class="logo">
            <span>
                <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>
            <span>
                <img src="{{URL::asset('assets/images/logo.png')}}" alt="logo-large" class="logo-lg logo-light">
                <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="logo-large" class="logo-lg logo-dark">
            </span>
        </a>
    </div>
    <!--end logo-->  
    <!-- Navbar -->
    <nav class="navbar-custom">    
        <ul class="list-unstyled topbar-nav float-end mb-0"> 
            <li class="dropdown hide-phone">
                <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-search"></i>
                </a>                
                <div class="dropdown-menu dropdown-menu-end dropdown-lg p-0">
                    <!-- Top Search Bar -->
                    <div class="app-search-topbar">
                        <form action="#" method="get">
                            <input type="search" name="search" class="from-control top-search mb-0" placeholder="Type text...">
                            <button type="submit"><i class="ti ti-search"></i></button>
                        </form>
                    </div>
                </div>
            </li>                      

            <li class="notification-list">
                <a class="nav-link arrow-none nav-icon offcanvas-btn" href="#" data-bs-toggle="offcanvas" data-bs-target="#Appearance" role="button" aria-controls="Rightbar">
                    <i class="ti ti-settings ti-spin"></i>
                </a>
            </li>                       
            
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-mail"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">
                
                    <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Emails <span class="badge bg-soft-primary badge-pill">3</span>
                    </h6> 
                    <div class="notification-menu" data-simplebar>
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="{{URL::asset('assets/images/users/user-1.jpg')}}" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">10 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="{{URL::asset('assets/images/users/user-4.jpg')}}" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">40 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="{{URL::asset('assets/images/users/user-2.jpg')}}" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">1 hr ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="{{URL::asset('assets/images/users/user-5.jpg')}}" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 hrs ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <img src="{{URL::asset('assets/images/users/user-3.jpg')}}" alt="" class="thumb-sm rounded-circle">
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <i class="ti ti-bell"></i>
                    <span class="alert-badge"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-lg pt-0">
                
                    <h6 class="dropdown-item-text font-15 m-0 py-3 border-bottom d-flex justify-content-between align-items-center">
                        Notifications <span class="badge bg-soft-primary badge-pill">2</span>
                    </h6> 
                    <div class="notification-menu" data-simplebar>
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-chart-arcs"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing and industry.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">10 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-device-computer-camera"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Meeting with designers</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">40 min ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">                                                    
                                    <i class="ti ti-diamond"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">UX 3 Task complete.</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">1 hr ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-drone"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Your order is placed</h6>
                                    <small class="text-muted mb-0">It is a long established fact that a reader.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                        <!-- item-->
                        <a href="#" class="dropdown-item py-3">
                            <small class="float-end text-muted ps-2">2 hrs ago</small>
                            <div class="media">
                                <div class="avatar-md bg-soft-primary">
                                    <i class="ti ti-users"></i>
                                </div>
                                <div class="media-body align-self-center ms-2 text-truncate">
                                    <h6 class="my-0 fw-normal text-dark">Payment Successfull</h6>
                                    <small class="text-muted mb-0">Dummy text of the printing.</small>
                                </div><!--end media-body-->
                            </div><!--end media-->
                        </a><!--end-item-->
                    </div>
                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                        View all <i class="fi-arrow-right"></i>
                    </a>
                </div>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle nav-user" data-bs-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <img src="{{URL::asset('assets/images/users/user-4.jpg')}}" alt="profile-user" class="rounded-circle me-0 me-md-2 thumb-sm" />
                        <div class="user-name">
                            <small class="d-none d-lg-block font-11">Admin</small>
                            <span class="d-none d-lg-block fw-semibold font-12">Maria Gibson <i
                                    class="mdi mdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#"><i class="ti ti-user font-16 me-1 align-text-bottom"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ti ti-settings font-16 me-1 align-text-bottom"></i> Settings</a>
                    <div class="dropdown-divider mb-0"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="ti ti-power font-16 me-1 align-text-bottom"></i> Logout</a>
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
                    <li class="nav-item dropdown parent-menu-item">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="navbarDashboards" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <span><i class="ti ti-smart-home menu-icon"></i>Dashboards</span>
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarDashboards"> 
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="analyticsDashboards" aria-labelledby="navbarDashboards">
                                    Analytics
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a href="index" class="dropdown-item " aria-labelledby="analyticsDashboards">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="analytics-customers" class="dropdown-item " aria-labelledby="analyticsDashboards">Customers</a>
                                    </li>
                                    <li>
                                        <a href="analytics-reports" class="dropdown-item " aria-labelledby="analyticsDashboards">Reports</a>
                                    </li>
                                </ul>
                            </li> 
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="cryptoDashboards" aria-labelledby="navbarDashboards">
                                    Crypto
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="crypto-index" aria-labelledby="cryptoDashboards">Dashboard</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="crypto-exchange" aria-labelledby="cryptoDashboards">Exchange</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="crypto-wallet" aria-labelledby="cryptoDashboards">Wallet</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="crypto-news" aria-labelledby="cryptoDashboards">Crypto News</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="crypto-ico" aria-labelledby="cryptoDashboards">ICO List</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="crypto-settings" aria-labelledby="cryptoDashboards">Settings</a>
                                    </li><!--end /li-->
                                </ul>
                            </li> 
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="projectsDashboards" aria-labelledby="navbarDashboards">
                                    Projects
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a href="horizontal-index" class="dropdown-item " aria-labelledby="projectsDashboards">Dashboard</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="projects-clients" aria-labelledby="projectsDashboards">Clients</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-team" aria-labelledby="projectsDashboards">Team</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-project" aria-labelledby="projectsDashboards">Project</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-task" aria-labelledby="projectsDashboards">Task</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-kanban-board" aria-labelledby="projectsDashboards">Kanban Board</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-chat" aria-labelledby="projectsDashboards">Chat</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-users" aria-labelledby="projectsDashboards">Users</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="projects-create" aria-labelledby="projectsDashboards">Project Create</a>
                                    </li><!--end /li--> 
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="ecommerceDashboards" aria-labelledby="navbarDashboards">
                                    Ecommerce
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a href="ecommerce-index" class="dropdown-item "  aria-labelledby="ecommerceDashboards">Dashboard</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="ecommerce-products" aria-labelledby="ecommerceDashboards">Products</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ecommerce-product-list" aria-labelledby="ecommerceDashboards">Product List</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ecommerce-product-detail" aria-labelledby="ecommerceDashboards">Product Detail</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ecommerce-cart" aria-labelledby="ecommerceDashboards">Cart</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ecommerce-checkout" aria-labelledby="ecommerceDashboards">Checkout</a>
                                    </li><!--end /li-->
                                </ul>
                            </li>
                        </ul>
                    </li><!--end nav-item-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarApps" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-apps menu-icon"></i>Apps</span>
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarApps"> 
                            
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="EmailsApps" aria-labelledby="navbarApps">
                                    Emails
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a href="apps-email-inbox" class="dropdown-item" aria-labelledby="EmailsApps">Inbox</a>
                                    </li>
                                    <li>
                                        <a href="apps-email-read" class="dropdown-item" aria-labelledby="EmailsApps">Read Email</a>
                                    </li>
                                </ul>
                            </li>                       
                            <li>
                                <a href="apps-chat" class="dropdown-item" aria-labelledby="navbarApps">
                                    Chat
                                </a>
                            </li>
                            <li>
                                <a href="apps-contact-list" class="dropdown-item" aria-labelledby="navbarApps">
                                    Contact List
                                </a>
                            </li>
                            <li>
                                <a href="apps-calendar" class="dropdown-item" aria-labelledby="navbarApps">
                                    Calendar
                                </a>
                            </li>
                            <li>
                                <a href="apps-invoice" class="dropdown-item" aria-labelledby="navbarApps">
                                    Invoice
                                </a>
                            </li>                    
                        </ul><!--end submenu-->
                    </li><!--end nav-item--> 
                    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarUI_Kit" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-planet menu-icon"></i>UI Kit</span>
                        </a>
                        <ul class="dropdown-menu animate slideIn" aria-labelledby="navbarUI_Kit">                                    
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="UiKit" aria-labelledby="navbarUI_Kit"></a>
                                    UI Elements
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="ui-alerts" aria-labelledby="UiKit">Alerts</a>
                                    </li><!--end /li--> 
                                    <li>
                                        <a class="dropdown-item" href="ui-avatar" aria-labelledby="UiKit">Avatar</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-buttons" aria-labelledby="UiKit">Buttons</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-badges" aria-labelledby="UiKit">Badges</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-cards" aria-labelledby="UiKit">Cards</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-carousels" aria-labelledby="UiKit">Carousels</a>
                                    </li><!--end /li-->                                
                                    <li>
                                        <a class="dropdown-item" href="ui-dropdowns" aria-labelledby="UiKit">Dropdowns</a>
                                    </li><!--end /li-->                                   
                                    <li>
                                        <a class="dropdown-item" href="ui-grids" aria-labelledby="UiKit">Grids</a>
                                    </li><!--end /li-->                                
                                    <li>
                                        <a class="dropdown-item" href="ui-images" aria-labelledby="UiKit">Images</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-list" aria-labelledby="UiKit">List</a>
                                    </li><!--end /li-->                                   
                                    <li>
                                        <a class="dropdown-item" href="ui-modals" aria-labelledby="UiKit">Modals</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-navs" aria-labelledby="UiKit">Navs</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-navbar" aria-labelledby="UiKit">Navbar</a>
                                    </li><!--end /li--> 
                                    <li>
                                        <a class="dropdown-item" href="ui-paginations" aria-labelledby="UiKit">Paginations</a>
                                    </li><!--end /li-->   
                                    <li>
                                        <a class="dropdown-item" href="ui-popover-tooltips" aria-labelledby="UiKit">Popover & Tooltips</a>
                                    </li><!--end /li-->                                
                                    <li>
                                        <a class="dropdown-item" href="ui-progress" aria-labelledby="UiKit">Progress</a>
                                    </li><!--end /li-->                                
                                    <li>
                                        <a class="dropdown-item" href="ui-spinners" aria-labelledby="UiKit">Spinners</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-tabs-accordions" aria-labelledby="UiKit">Tabs & Accordions</a>
                                    </li><!--end /li-->                               
                                    <li>
                                        <a class="dropdown-item" href="ui-typography" aria-labelledby="UiKit">Typography</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="ui-videos" aria-labelledby="UiKit">Videos</a>
                                    </li><!--end /li-->                                                     
                                </ul>                                      
                            </li><!--end nav-item-->
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="AdvancedUi" aria-labelledby="navbarUI_Kit">
                                    Advanced UI
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="advanced-animation" aria-labelledby="AdvancedUi">Animation</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-clipboard" aria-labelledby="AdvancedUi">Clip Board</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-dragula" aria-labelledby="AdvancedUi">Dragula</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-files" aria-labelledby="AdvancedUi">File Manager</a>
                                    </li><!--end /li--> 
                                    <li>
                                        <a class="dropdown-item" href="advanced-highlight" aria-labelledby="AdvancedUi">Highlight</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-rangeslider" aria-labelledby="AdvancedUi">Range Slider</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-ratings" aria-labelledby="AdvancedUi">Ratings</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-ribbons" aria-labelledby="AdvancedUi">Ribbons</a>
                                    </li><!--end /li-->                                  
                                    <li>
                                        <a class="dropdown-item" href="advanced-sweetalerts" aria-labelledby="AdvancedUi">Sweet Alerts</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="advanced-toasts" aria-labelledby="AdvancedUi">Toasts</a>
                                    </li><!--end /li-->
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#"  id="UiForms" aria-labelledby="navbarUI_Kit">
                                    Forms
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="forms-elements" aria-labelledby="UiForms">Basic Elements</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-advanced" aria-labelledby="UiForms">Advance Elements</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-validation" aria-labelledby="UiForms">Validation</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-wizard" aria-labelledby="UiForms">Wizard</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-editors" aria-labelledby="UiForms">Editors</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-uploads" aria-labelledby="UiForms">File Upload</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="forms-img-crop" aria-labelledby="UiForms">Image Crop</a>
                                    </li><!--end /li--> 
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="UiCharts" aria-labelledby="navbarUI_Kit">
                                    Charts
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="charts-apex" aria-labelledby="UiCharts">Apex</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="charts-justgage" aria-labelledby="UiCharts">JustGage</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="charts-chartjs" aria-labelledby="UiCharts">Chartjs</a>
                                    </li><!--end /li--> 
                                    <li>
                                        <a class="dropdown-item" href="charts-toast-ui" aria-labelledby="UiCharts">Toast</a>
                                    </li><!--end /li-->
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="UiTables" aria-labelledby="navbarUI_Kit">
                                    Tables
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="tables-basic" aria-labelledby="UiTables">Basic</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="tables-datatable" aria-labelledby="UiTables">Datatables</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="tables-editable" aria-labelledby="UiTables">Editable</a>
                                    </li><!--end /li-->
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="UiIcons" aria-labelledby="navbarUI_Kit">
                                    Icons
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="icons-materialdesign" aria-labelledby="UiIcons">Material Design</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="icons-fontawesome" aria-labelledby="UiIcons">Font awesome</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="icons-tabler" aria-labelledby="UiIcons">Tabler</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="icons-feather" aria-labelledby="UiIcons">Feather</a>
                                    </li><!--end /li-->
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="UiMaps" aria-labelledby="navbarUI_Kit">
                                    Maps
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="maps-google" aria-labelledby="UiMaps">Google Maps</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="maps-leaflet" aria-labelledby="UiMaps">Leaflet Maps</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="maps-vector" aria-labelledby="UiMaps">Vector Maps</a>
                                    </li><!--end /li-->  
                                </ul>
                            </li>
                            <li class="dropdown-submenu dropend">
                                <a class="dropdown-item  dropdown-toggle" data-bs-toggle="dropdown" href="#" id="Ui_Email" aria-labelledby="navbarUI_Kit">
                                    Email Templates
                                </a>
                                <ul class="dropdown-menu animate slideIn">
                                    <li>
                                        <a class="dropdown-item" href="email-templates-alert" aria-labelledby="Ui_Email">Alert Email</a>
                                    </li><!--end /li-->
                                    <li>
                                        <a class="dropdown-item" href="email-templates-basic" aria-labelledby="Ui_Email">Basic Action Email</a>
                                    </li><!--end /li-->                                    
                                    <li>
                                        <a class="dropdown-item" href="email-templates-billing" aria-labelledby="Ui_Email">Billing Email</a>
                                    </li><!--end /li-->
                                </ul>
                            </li><!--end nav-item-->                     
                        </ul><!--end submenu-->
                    </li><!--end nav-item-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarPages" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-file-diff menu-icon"></i>Pages</span>
                        </a>
                        <ul class="dropdown-menu  animate slideIn" aria-labelledby="navbarPages">
                            <li>
                                <a class="dropdown-item" href="pages-profile" aria-labelledby="navbarPages">Profile</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-tour" aria-labelledby="navbarPages">Tour</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-timeline" aria-labelledby="navbarPages">Timeline</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-treeview" aria-labelledby="navbarPages">Treeview</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="horizontal-starter" aria-labelledby="navbarPages">Starter Page</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-pricing" aria-labelledby="navbarPages">Pricing</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-blogs" aria-labelledby="navbarPages">Blogs</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-faq" aria-labelledby="navbarPages">FAQs</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="pages-gallery" aria-labelledby="navbarPages">Gallery</a>
                            </li><!--end /li-->                                            
                        </ul>
                    </li><!--end nav-item-->

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbar_auth" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><i class="ti ti-shield-lock menu-icon"></i>Authentication</span>
                        </a>
                        <ul class="dropdown-menu  animate slideIn" aria-labelledby="navbar_auth">
                            <li>
                                <a class="dropdown-item" href="auth-login">Log in</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="auth-register">Register</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="auth-recover-pw">Re-Password</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="auth-lock-screen">Lock Screen</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="auth-404">Error 404</a>
                            </li><!--end /li-->
                            <li>
                                <a class="dropdown-item" href="auth-500">Error 500</a>
                            </li><!--end /li-->
                        </ul><!--end submenu-->
                    </li><!--end nav-item-->                    
                </ul><!-- End navigation menu -->
            </div> <!-- end navigation -->
        </div>
        <!-- Navbar -->
    </nav>
    <!-- end navbar-->
</div>
<!-- Top Bar End -->


