<nav class="navigation scroll-bar">
    <div class="container ps-0 pe-0">
        <div class="nav-content">
            <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2">
                <div class="nav-caption fw-600 font-xssss text-grey-500">Navigations</div>
                <ul class="mb-1 top-content">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    <li>
                        <a href="{{ route('reports.index') }}" class="nav-content-bttn open-font">
                            <i class="feather-home btn-round-md bg-blue-gradiant me-3"></i>
                            <span>Feeds</span>
                        </a>
                    </li>
                    <li>
                        @if (Auth::check())
                            <a href="{{ route('form') }}" class="nav-content-bttn open-font">
                                <i class="feather-edit btn-round-md bg-red-gradiant me-3"></i>
                                <span>Post Pengaduan</span>
                            </a>
                        @else
                            <a href="{{ route('loginpage')}}" class="nav-content-bttn open-font" >
                                <i class="feather-edit btn-round-md bg-red-gradiant me-3"></i>
                                <span>Post Pengaduan</span>
                            </a>
                        @endif
                    </li>

                    <li>
                        @if (Auth::check())
                            <a href="{{ route('pantau') }}" class="nav-content-bttn open-font">
                                <i class="feather-eye btn-round-md bg-gold-gradiant me-3"></i>
                                <span>Pantau Laporan</span>
                            </a>
                        @else
                            <a href="{{ route('login')}}" class="nav-content-bttn open-font" >
                                <i class="feather-eye btn-round-md bg-gold-gradiant me-3"></i>
                                <span>Pantau Laporan</span>
                            </a>
                        @endif
                    </li>

                </ul>
            </div>


            <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1">
                <div class="nav-caption fw-600 font-xssss text-grey-500"><span></span> Account</div>
                <ul class="mb-1">
                    <li class="logo d-none d-xl-block d-lg-block"></li>
                    <li><a href="default.html" class="nav-content-bttn open-font h-auto pt-2 pb-2"><i
                                class="font-sm feather-settings me-3 text-grey-500"></i><span>Settings</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

