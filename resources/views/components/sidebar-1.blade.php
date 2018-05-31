@php
// if(file_exists(public_path('images/dosen/' . Auth::user()->images))){
//     $userimage = asset('images/dosen/'. Auth::user()->images );
// }else{
//     $userimage = asset('images/user.png');
// };
$userimage = asset('images/user.png');
@endphp

<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="{{ $userimage }}" alt="User Image"></div>
            <div class="pull-left info">
                <p>{{ Auth::user()->kode_dosen }}</p>
                <p class="designation">Dosen</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Route::currentRouteNamed('dosen.dashboard') ? 'active' : '' }}"><a href="{{ route('dosen.dashboard')}}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-tags"></i><span>Attendance</span></a></li>
            <li class="{{ Route::currentRouteNamed('dosen.course') ? 'active' : '' }}"><a href="{{ route('dosen.course') }}"><i class="fa fa-university"></i><span>Course</span></a></li>
            <li><a href="#"><i class="fa fa-user"></i><span>Profile</span></a></li>
            <li><a href="#"><i class="fa fa-calendar"></i><span>Schedules</span></a></li>
        </ul>
    </section>
</aside>