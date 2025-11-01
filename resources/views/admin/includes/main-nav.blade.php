 <div class="vertical-menu">
    <div class="navbar-brand-box">
        <a href="{{url('admin/dashboard')}}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{config('i.favicon')}}" alt="" class="admin-logo-sm">
            </span>
            <span class="logo-lg">
                <img src="{{config('i.logo')}}" alt=""  class="admin-logo-lg">
            </span>
        </a>
        <a href="{{url('admin/dashboard')}}" class="logo logo-light">
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
                    <a href="{{url('admin/dashboard')}}" class="">
                        <i class="bx bxs-dashboard"></i>
                        <span>{{pxLang('admin.main-nav','dashboard')}}</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-user"></i>
                        <span>{{pxLang('admin.main-nav','employee.menu')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('admin/employee/draft')}}">{{pxLang('admin.main-nav','employee.menu.draft')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/employee/active/active-employee/list')}}">{{pxLang('admin.main-nav','employee.menu.active')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fa fa-user-clock" style="font-size: 13px;"></i>
                        <span>{{pxLang('admin.main-nav','attendance.menu')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('admin/attendance/reconciliation/employee-recon/list')}}" >{{pxLang('admin.main-nav','attendance.menu.recon')}}</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);"  class="has-arrow waves-effect">{{pxLang('admin.main-nav','attendance.menu.attendance_report')}}</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{url('admin/attendance/report/employee/month-wise')}}">{{pxLang('admin.main-nav','attendance.menu.attendance_report_monthly')}}</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-data"></i>
                        <span>{{pxLang('admin.main-nav','data-library.menu')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('admin/data-library/department')}}">{{pxLang('admin.main-nav','data-library.menu.department')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/data-library/designation')}}">{{pxLang('admin.main-nav','data-library.menu.designation')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/data-library/leave')}}">{{pxLang('admin.main-nav','data-library.menu.leave')}}</a>
                        </li>
                        <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect" >{{pxLang('admin.main-nav','data-library.menu.salary-setup')}}</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="{{url('admin/data-library/salary/heads')}}">{{pxLang('admin.main-nav','data-library.menu.salary-setup.heads')}}</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/data-library/salary/group')}}">{{pxLang('admin.main-nav','data-library.menu.salary-setup.groups')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('admin/data-library/board')}}">{{pxLang('admin.main-nav','data-library.menu.board')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/data-library/dgree')}}">{{pxLang('admin.main-nav','data-library.menu.dgree')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/data-library/banks')}}">{{pxLang('admin.main-nav','data-library.menu.bank')}}</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bxs-cog"></i>
                        <span>{{pxLang('admin.main-nav','system.core')}}</span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{url('admin/system/user/user-role')}}">{{pxLang('admin.main-nav','system.core.user_role')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/system/user')}}">{{pxLang('admin.main-nav','system.core.user')}}</a>
                        </li>
                        <li>
                            <a href="{{url('admin/system/user/user-policy')}}">{{pxLang('admin.main-nav','system.core.user_policy')}}</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
