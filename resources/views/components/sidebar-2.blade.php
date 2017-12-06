@php
if(file_exists(public_path('images/mahasiswa/' . Auth::user()->images))){
    $userimage = asset('images/mahasiswa/'. Auth::user()->images );
}else{
    $userimage = asset('images/user.png');
};
@endphp

<aside class="main-sidebar hidden-print">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="{{ $userimage }}" alt="User Image"></div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <p class="designation">Mahasiswa</p>
            </div>
        </div>
        <ul class="sidebar-menu">
            <li class="active"><a href="{{ route('mahasiswa.dashboard') }}"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-tags"></i><span>Attendance</span></a></li>
            <li><a href="#"><i class="fa fa-university"></i><span>Course</span></a></li>
            <li><a href="#"><i class="fa fa-calendar"></i><span>Schedules</span></a></li>
        </ul>
    </section>
</aside>