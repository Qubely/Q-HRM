 <div class="vertical-menu">
    <div class="navbar-brand-box">
        <a href="{{url('employee/dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{config('i.favicon')}}" alt="" class="admin-logo-sm">
            </span>
            <span class="logo-lg">
                <img src="{{config('i.logo')}}" alt=""  class="admin-logo-lg">
            </span>
        </a>
        <a href="{{url('employee/dashboard')}}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{config('i.favicon')}}" alt=""  class="admin-logo-sm">
            </span>
            <span class="logo-lg">
                <img src="{{config('i.logo')}}" alt=""  class="admin-logo-lg">
            </span>
        </a>
    </div>
    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>
    <div data-simplebar="" class="sidebar-menu-scroll">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="">
                    <a href="{{url('employee/dashboard')}}" class="">
                        <i class="bx bxs-dashboard"></i>
                        <span>{{pxLang('employee.main-nav','dashboard')}}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-cog"></i>
                        <span>{{pxLang('employee.main-nav','attendance.menu')}}</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{url('employee/attendance/entry/store')}}">{{pxLang('employee.main-nav','attendance.menu.my_attendance')}}</a>
                        </li>
                        <li>
                            <a href="{{url('employee/attendance/reconciliation/recon-history/list')}}">{{pxLang('employee.main-nav','attendance.menu.reconciliation')}}</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect">{{pxLang('employee.main-nav','attendance.menu.report')}}</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li>
                                    <a href="{{url('employee/attendance/report/monthly/details')}}">{{pxLang('employee.main-nav','attendance.menu.report.monthly')}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
