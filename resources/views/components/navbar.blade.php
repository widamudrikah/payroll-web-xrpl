<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Payroll <span class="text-warning">Bendahara</span></a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @auth
                    @if(Auth::user()->role === 'bendahara')
                        <!-- navbar bendahara -->
                        <li class="nav-item"><a href="{{ route('manage.employee.index') }}" class="nav-link">Kelola Kryawan</a></li>
                        <li class="nav-item"><a href="{{ route('manage.attendance.index') }}" class="nav-link">Rekap Absensi</a></li>
                        <li class="nav-item"><a href="{{ route('manage.payroll.index') }}" class="nav-link">Kelola Gaji</a></li>
                    @elseif(Auth::user()->role === 'karyawan')
                        <!-- navbar karyana -->
                        <li class="nav-item"><a href="{{ route('employee.dashboard') }}" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="{{ route('attendance.index') }}" class="nav-link">Absensi</a></li>
                        <li class="nav-item"><a href="{{ route('salary.index') }}" class="nav-link">Gajiku</a></li>
                    @endif
                @endauth
            </ul>
        </div>

        <div class="ms-auto d-flex align-items-center">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Login</a>
            @else
                <span class="text-white me-3">{{ Auth::user()->name }}</span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-light btn-sm">Logout</button>
                </form>
            @endguest

        </div>
    </div>
</nav>