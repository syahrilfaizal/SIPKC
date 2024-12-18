<div class="nav-header bg-white shadow-xs border-0">
    <div class="nav-top">
        <a href="default.html">
            <i class="feather-zap text-success display1-size me-2 ms-0"></i>
            <span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">Complaint.</span>
        </a>
        <a href="#" class="mob-menu ms-auto me-2 chat-active-btn">
            <i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight"></i>
        </a>
        <a href="default.html" class="mob-menu me-2">
            <i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight"></i>
        </a>
        <a href="#" class="me-2 menu-search-icon mob-menu">
            <i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight"></i>
        </a>
        <button class="nav-menu me-0 ms-2"></button>

    </div>

    <form action="#" class="float-left header-search">
        <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input type="text" placeholder="Start typing to search.."
                class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl theme-dark-bg"
                style="width: 630px;">
        </div>
    </form>

    <a href="default.html" class="p-2 text-center ms-3 menu-icon center-menu-icon"><i
            class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current "></i></a>
    <a href="#" class="p-2 text-center ms-auto menu-icon" id="dropdownMenu3" data-bs-toggle="dropdown"
        aria-expanded="false"><span class="dot-count bg-warning"></span><i
            class="feather-bell font-xl text-current"></i></a>
    <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg" aria-labelledby="dropdownMenu3">

        <h4 class="fw-700 font-xss mb-4">Notification</h4>
        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
            <img src="images/user-8.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Hendrix Stamp <span
                    class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 3 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">There are many variations of pass..</h6>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
            <img src="images/user-4.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Goria Coast <span
                    class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 2 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
        </div>

        <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
            <img src="images/user-7.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Surfiya Zakir <span
                    class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 1 min</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
        </div>
        <div class="card bg-transparent-card w-100 border-0 ps-5">
            <img src="images/user-6.png" alt="user" class="w40 position-absolute left-0">
            <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">Victor Exrixon <span
                    class="text-grey-400 font-xsssss fw-600 float-right mt-1"> 30 sec</span></h5>
            <h6 class="text-grey-500 fw-500 font-xssss lh-4">Mobile Apps UI Designer is require..</h6>
        </div>
    </div>
    <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
        <i class="feather-settings animation-spin d-inline-block font-xl text-current"></i>
        <div class="dropdown-menu-settings switchcolor-wrap">
            @if (Auth::guest())
                <a href="{{ route('loginpage') }}" class="p-2 text-center ms-3 menu-icon d-flex align-items-center">
                    <i class="feather-log-in font-sm text-current"></i>
                    <span class="ms-2">Login</span>
                </a>
            @else
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="p-2 text-center ms-3 menu-icon d-flex align-items-center" style="background: none; border: none; cursor: pointer;">
                    <i class="feather-log-in font-sm text-current"></i>
                    <span class="ms-2">Logout</span>
                </button>
            </form>
            
            @endif
        </div>
        
    </div>


    <a href="default.html" class="p-0 ms-3 menu-icon"><img src="images/profile-4.png" alt="user"
            class="w40 mt--1"></a>

</div>
