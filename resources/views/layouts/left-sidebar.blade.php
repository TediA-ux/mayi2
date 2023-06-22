<div class="left-sidebar">
    <!-- LOGO -->
    <div class="brand">
        <a href="/dashboard" class="logo">
            <span>
                <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="logo-small" class="logo-sm">
            </span>
            <span>
            </span>
        </a>
    </div>
    <div class="sidebar-user-pro media border-end">
        <div class="position-relative mx-auto">
            <img src="{{URL::asset('assets/images/users/default_profile.png')}}" alt="user" class="rounded-circle thumb-md">
            <span class="online-icon position-absolute end-0"><i class="mdi mdi-record text-success"></i></span>
        </div>
        <div class="media-body ms-2 user-detail align-self-center">
            <h5 class="font-14 m-0 fw-bold">{{  $log_user->firstname  }} {{  $log_user->lastname  }} </h5>
            <p class="opacity-50 mb-0">{{ $log_user->email }}</p>
        </div>
    </div>

    <!-- Tab panes -->

    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <div class="menu-body navbar-vertical">
            <div class="collapse navbar-collapse tab-content" id="sidebarCollapse">
                <!-- Navigation -->
                <ul class="navbar-nav tab-pane active" id="Main" role="tabpanel">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard" >
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Dashboard</span>
                        </a>

                    </li><!--end nav-item-->


                    @can('edit-company')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarCompanies" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCompanies">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Company Data</span>
                        </a>
                        <div class="collapse " id="sidebarCompanies">
                            <ul class="nav flex-column">
                                @can('create-company')
                               <li class="nav-item">
                                    <a class="nav-link" href="/companies">Companies</a>
                                </li><!--end nav-item-->
                                @endcan


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan
                    @can('view-transactions')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAuthoriser" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuthoriser">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Transactions</span>
                        </a>
                        <div class="collapse " id="sidebarAuthoriser">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/transactions">All Transactions</a>
                                </li><!--end nav-item-->

                                @can('view-all-transactions-topups')
                                   <li class="nav-item">
                                        <a class="nav-link" href="/transactions/view/topups">All TopUps</a>
                                    </li><!--end nav-item-->
                                @endcan

                                @can('view-all-transactions-givings')
                                   <li class="nav-item">
                                    <a class="nav-link" href="/transactions/view/givings">All Givings</a>
                                </li><!--end nav-item-->
                                @endcan

                                @can('view-all-transactions-schedules')
                                <li class="nav-item">
                                    <a class="nav-link" href="/transactions/view/schedules">All Schedule Givings</a>
                                </li><!--end nav-item-->
                                @endcan

                                {{-- @can('view-own-transactions')
                                <li class="nav-item">
                                    <a class="nav-link" href="view/my/transactions">My Transactions</a>
                                </li><!--end nav-item-->
                                @endcan --}}

                                @can('view-own-topups')
                                   <li class="nav-item">
                                        <a class="nav-link" href="view/my/topups">My TopUps</a>
                                    </li><!--end nav-item-->
                                @endcan

                                @can('view-own-givings')
                                   <li class="nav-item">
                                    <a class="nav-link" href="view/my/givings">My Givings</a>
                                </li><!--end nav-item-->
                                @endcan

                                @can('view-own-schedules')
                                <li class="nav-item">
                                    <a class="nav-link" href="view/my/schedules">My Schedules</a>
                                </li><!--end nav-item-->
                                @endcan


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->

                    @endcan

                    @can('view-sections')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarSections" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarSections">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Sections</span>
                        </a>
                        <div class="collapse " id="sidebarSections">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/sections">View All</a>
                                </li><!--end nav-item-->


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan

                    @can('view-groups')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarGroups" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarGroups">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Groups</span>
                        </a>
                        <div class="collapse " id="sidebarGroups">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/groups">View All</a>
                                </li><!--end nav-item-->


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan


                    @can('create-user')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuthentication">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Users</span>
                        </a>
                        <div class="collapse " id="sidebarAuthentication">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/users">List</a>
                                </li><!--end nav-item-->
                                <li class="nav-item">
                                    <a class="nav-link" href="/messages">Broadcast Messages</a>
                                </li><!--end nav-item-->


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan
                    
                    @can('create-message')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAuthentication">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Broadcast Messages</span>
                        </a>
                        <div class="collapse " id="sidebarAuthentication">
                            <ul class="nav flex-column">
                             
                                <li class="nav-item">
                                    <a class="nav-link" href="/messages">Broadcast Messages</a>
                                </li><!--end nav-item-->


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan

                    @can('report-create')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarReport" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarReport">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Reports</span>
                        </a>
                        <div class="collapse " id="sidebarReport">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/transactions/reports/topups">Top Up Reports</a>
                               </li><!--end nav-item-->
                               <li class="nav-item">
                                <a class="nav-link" href="/transactions/reports/givings">Givings Reports</a>
                               </li><!--end nav-item-->
                               <li class="nav-item">
                                <a class="nav-link" href="/transactions/reports/bills">Bills Reports</a>
                               </li><!--end nav-item-->
                               <li class="nav-item">
                                    <a class="nav-link" href="/report/users">User Reports</a>
                               </li><!--end nav-item-->
                               <li class="nav-item">
                                <a class="nav-link" href="/transactions/reports/schedules">Schedule Givings Reports</a>
                           </li><!--end nav-item-->
                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan
                    @can('role-create')
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarRoles">
                            <i class="ti ti-shield-lock menu-icon"></i>
                            <span>Manage Roles</span>
                        </a>
                        <div class="collapse " id="sidebarRoles">
                            <ul class="nav flex-column">
                               <li class="nav-item">
                                    <a class="nav-link" href="/roles">Roles</a>
                                </li><!--end nav-item-->


                            </ul><!--end nav-->
                        </div><!--end sidebarAuthentication-->
                    </li><!--end nav-item-->
                    @endcan


                </ul>

            </div><!--end sidebarCollapse-->
        </div>
    </div>
</div>
<!-- end left-sidenav-->
