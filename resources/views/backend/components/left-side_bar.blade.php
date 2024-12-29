<div class="left-side-menu">

    <div class="slimscroll-menu">

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul class="metismenu" id="side-menu">

                <li class="menu-title">Navigation</li>

                <!--<li>
                    <a href="javascript: void(0);">
                        <i class="la la-dashboard"></i>
                        <span class="badge badge-info badge-pill float-right">2</span>
                        <span> Dashboards </span>
                    </a>
                    <ul class="nav-second-level" aria-expanded="false">
                        <li>
                            <a href="index.html">Dashboard 1</a>
                        </li>
                        <li>
                            <a href="dashboard-2.html">Dashboard 2</a>
                        </li>
                    </ul>
                </li>-->
                @foreach(__('module') as $module)
                    <li>
                        <a href="javascript: void(0);">
                            <i class="{{ $module['icon'] }}"></i>
                            <span> {{ $module['name'] }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level">
                            @foreach($module['subModule'] as $sub)
                                <li>
                                    <a href="{{ route($sub['route']) }}">{{ $sub['name'] }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
