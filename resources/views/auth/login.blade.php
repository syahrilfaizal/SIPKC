<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
<link rel="stylesheet" href="{{ asset('css/feather.css') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/emoji.css') }}">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css">
<link rel="stylesheet" href="{{ asset('css/lightbox.css') }}">


<style>
    html,
    body {
        height: 100%;
        /* Pastikan html dan body memiliki tinggi penuh */
        margin: 0;
        overflow: hidden;
        /* Hilangkan scrollbar */
    }

    .vh-100 {
        height: 100vh;
        /* Pastikan elemen dengan class ini mengambil tinggi penuh layar */
    }

    .bg-image-cover {
        background-size: cover;
        /* Pastikan gambar mengisi area tanpa distorsi */
        background-position: center;
        /* Pusatkan gambar */
    }
</style>


<div class="row">
    <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
        style="background-image: url(images/login-bg.jpg);"></div>
    <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
        <div class="card shadow-none border-0 ms-auto me-auto login-card">
            <div class="card-body rounded-0 text-left">
                <h2 class="fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group icon-input mb-3">
                        <i class="font-sm ti-email text-grey-500 pe-0"></i>
                        <input name="email" type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                            placeholder="Your Email Address">
                    </div>
                    <div class="form-group icon-input mb-1">
                        <input name="password" type="Password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                            placeholder="Password">
                        <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                    </div>
                    {{-- <div class="form-check text-left mb-3">
                        <input type="checkbox" class="form-check-input mt-2" id="exampleCheck5">
                        <label class="form-check-label font-xsss text-grey-500" for="exampleCheck5">Remember me</label>
                        <a href="forgot.html" class="fw-600 font-xsss text-grey-700 mt-1 float-right">Forgot your
                            Password?</a>
                    </div> --}}
                

                <div class="col-sm-12 p-0 text-left">
                <div class="form-group mb-1">
                            <button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Login</button>
                        </div>
                    <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Dont have account <a
                            href="{{ route('register') }}" class="fw-700 ms-1">Register</a></h6>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script src="js/plugin.js"></script>
<script src="js/scripts.js"></script>
