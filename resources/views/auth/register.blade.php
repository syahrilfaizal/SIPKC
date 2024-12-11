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
        margin: 0;
        overflow: hidden;
    }

    .vh-100 {
        height: 100vh;
    }

    .bg-image-cover {
        background-size: cover;
        background-position: center;
    }
</style>

<div class="row">
    <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
        style="background-image: url(images/login-bg-2.jpg);"></div>
    <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
        <div class="card shadow-none border-0 ms-auto me-auto login-card">
            <div class="card-body rounded-0 text-left">
                <h2 class="fw-700 display1-size display2-md-size mb-4">Create <br>your account</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group icon-input mb-3">
                        <i class="font-sm ti-user text-grey-500 pe-0"></i>
                        <input name="name" type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                            placeholder="Your Name">
                    </div>
                    <div id="email" class="form-group icon-input mb-3">
                        <i class="font-sm ti-email text-grey-500 pe-0"></i>
                        <input name="email" type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"
                            placeholder="Your Email Address">
                    </div>

                    <div class="form-group icon-input mb-3">
                        <input id="password" name="password" type="password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                            placeholder="Password">
                        <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                    </div>
                    <div class="form-group icon-input mb-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" class="style2-input ps-5 form-control text-grey-900 font-xss ls-3"
                            placeholder="Confirm Password">
                        <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                    </div>
                    
                    <div class="col-sm-12 p-0 text-left">
                        <div class="form-group mb-1">
                            <button type="submit" class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Register</button>
                        </div>
                        <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">Already have account <a href="{{ route('login') }}" class="fw-700 ms-1">Login</a></h6>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        // Function to check if passwords match
        function checkPasswordMatch() {
            if (password.value !== passwordConfirmation.value) {
                passwordConfirmation.setCustomValidity("Passwords do not match.");
            } else {
                passwordConfirmation.setCustomValidity(""); // Clear error
            }
        }

        // Add event listeners for input changes
        password.addEventListener('input', checkPasswordMatch);
        passwordConfirmation.addEventListener('input', checkPasswordMatch);
    });
</script>
