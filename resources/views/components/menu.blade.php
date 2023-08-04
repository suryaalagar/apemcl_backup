    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <!-- <li class=" navigation-header"><span>User Management</span><i class=" feather icon-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
          </li> -->
                {{-- <li class=" nav-item"><a href="index-2.html"><i class="feather icon-home"></i><span class="menu-title"
                            data-i18n="Dashboard">Dashboard</span><span
                            class="badge badge badge-primary badge-pill float-right mr-2">3</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="dashboard-ecommerce.html" data-i18n="">eCommerce</a>
                        </li>
                        <li class="active"><a class="menu-item" href="dashboard-analytics.html"
                                data-i18n="Analytics">Analytics</a>
                        </li>
                        <li><a class="menu-item" href="dashboard-fitness.html" data-i18n="Fitness">Fitness</a>
                        </li>
                        <li><a class="menu-item" href="dashboard-crm.html" data-i18n="CRM">CRM</a>
                        </li>
                    </ul>
                </li> --}}


                <li class=" nav-item"><a href="{{ route('dashboard') }}" target="_blank"><i
                            class="feather icon-home"></i><span class="menu-title"
                            data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li class=" nav-item"><a href="index-2.html"><i class="feather icon-folder"></i><span class="menu-title"
                            data-i18n="Dashboard">Reports</span><span
                            class="badge badge badge-primary badge-pill float-right mr-2">3</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('tripplanreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title" data-i18n="Trip_plan">Trip
                                    Plan</span></a>
                        </li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('idlereport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title"
                                    data-i18n="idle_report">Idle</span></a>
                        </li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('parkingreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title"
                                    data-i18n="parking_report">Stoppage</span></a>
                        </li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('routedeviationreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title"
                                    data-i18n="routedeviation_report">Route Deviation</span></a>
                        </li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('keyonkeyoffreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title"
                                    data-i18n="keyonkeyoff_report">Key on Key off</span></a>
                        </li>
                    </ul>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('playbackhistoryreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title"
                                    data-i18n="keyonkeyoff_report">Playback History</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="index-2.html"><i class="feather icon-map"></i><span class="menu-title"
                            data-i18n="Dashboard">Planned Trips</span></a>
                    <ul class="menu-content">
                        <li class=" nav-item"><a href="{{ route('tripplanreport.index') }}" target="_blank"><i
                                    class="feather icon-car"></i><span class="menu-title" data-i18n="Trip_plan">Trips</span></a>
                        </li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="{{ route('setting.index') }}" target="_blank"><i
                            class="feather icon-settings"></i><span class="menu-title"
                            data-i18n="Setting">Settings</span></a>
                </li>


            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->
