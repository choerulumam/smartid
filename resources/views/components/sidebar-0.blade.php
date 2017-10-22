<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"></div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="designation">Administrator</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="{{  Route::currentRouteNamed('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-tags"></i><span>Attendance</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Lectures</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Students</a></li>
                </ul>
            </li>
            <li class="treeview {{ Route::currentRouteNamed('admin.manage.dosen') || Route::currentRouteNamed('admin.manage.mahasiswa')  ? 'active' : '' }}"><a href="#"><i class="fa fa-user-circle"></i><span>Management</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ Route::currentRouteNamed('admin.manage.dosen') ? 'active' : '' }}"><a href="{{ route('admin.manage.dosen') }}"><i class="fa fa-circle-o"></i> Lectures Data</a></li>
                    <li class="{{ Route::currentRouteNamed('admin.manage.mahasiswa') ? 'active' : '' }}"><a href="{{ route('admin.manage.mahasiswa') }}"><i class="fa fa-circle-o"></i> Students Data</a></li>
                </ul>
            </li>
            <li class="{{ Route::currentRouteNamed('admin.classroom') ? 'active' : '' }}"><a href="{{ route('admin.classroom') }}"><i class="fa fa-group"></i><span>Classroom</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-university"></i><span>Course</span><i class="fa fa-angle-right"></i></a>
                <ul class="treeview-menu">
                    <li class=""><a href="#"><i class="fa fa-circle-o"></i> Lectures Course</a></li>
                    <li class=""><a href="#"><i class="fa fa-circle-o"></i> Students Course</a></li>
                </ul>
            </li>
            <li><a href="#"><i class="fa fa-calendar"></i><span>Schedules</span></a></li>
            <li><a href="#"><i class="fa fa-upload"></i><span>Import Data</span></a></li>
            <li><a href="#"><i class="fa fa-download"></i><span>Export Data</span></a></li>
        </ul>
    </section>
</aside>