<!-- sidebar-->
<aside class="aside-container">
    <!-- START Sidebar (left)-->
    <div class="aside-inner">
        <nav class="sidebar" data-sidebar-anyclick-close="">
            <!-- START sidebar nav-->
            <ul class="sidebar-nav">
                <!-- START user info-->
                <li class="has-user-block">
                    <div class="collapse" id="user-block">
                        <div class="item user-block">
                            <!-- User picture-->
                            <div class="user-block-picture">
                                <div class="user-block-status">
                                    <img class="img-thumbnail rounded-circle" src="{{ auth()->user()->display_photo }}" alt="Avatar" width="60" height="60" />
                                    <div class="circle bg-success circle-lg"></div>
                                </div>
                            </div>
                            <!-- Name and Job-->
                            <div class="user-block-info"><span class="user-block-name">Hello, {{ auth()->user()->fullname }}</span><span class="user-block-role">{{ auth()->user()->role }}</span></div>
                        </div>
                    </div>
                </li>
                <!-- END user info-->
                <!-- Iterates over all sidebar items-->
                <li class="nav-heading"><span data-localize="sidebar.heading.HEADER">Main Navigation</span></li>
                <li class=" ">
                    <a href="{{ url('home') }}" title="Dashboard">
                        <em class="icon-speedometer"></em><span data-localize="sidebar.nav.DASHBOARD">Dashboard</span>
                    </a>
                </li>
                <li class=" ">
                    <a href="#layout" title="Layouts" data-toggle="collapse"><em class="icon-layers"></em><span>Proposals</span></a>
                    <ul class="sidebar-nav sidebar-subnav collapse" id="layout">
                        <li class="sidebar-subnav-header">Proposals</li>
                        <li class=" ">
                            <a href="{{ url('client/proposals') }}" title="Proposals"><span>List of Proposals</span></a>
                        </li>
                        <li class=" ">
                            <a href="{{ url('client/proposals/create') }}" title="Proposals"><span>Submit a Proposal</span></a>
                        </li>
                        <li class=" ">
                            <a href="{{ url('client/tasks') }}" title="Tasks"><span>Assigned Tasks</span></a>
                        </li>
                    </ul>
                </li>
                @if (auth()->user()->role == 'Admin')
                <li class=" ">
                    <a href="{{ url('client/users') }}" title="Users">
                        <em class="icon-people"></em><span data-localize="sidebar.nav.USER">User Lists</span>
                    </a>
                </li>
                @endif
                <li class=" ">
                    <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <em class="icon-grid"></em><span data-localize="sidebar.nav.Logout">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
            <!-- END sidebar nav-->
        </nav>
    </div>
    <!-- END Sidebar (left)-->
</aside>