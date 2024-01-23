<!DOCTYPE html>
<html lang="id">


<head>
    <meta charset="utf-8">
    <title>Login - {{config('web.title')}}</title>

    <!-- Stylesheets -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon">
    <link rel="icon" href="images/favicon.png" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="js/respond.js"></script><![endif]-->
</head>

<body>

    <div class="page-wrapper">

        <!-- Preloader -->
        <div class="preloader"></div>

        <!-- Main Header-->
        <header class="main-header">
            <div class="container-fluid">
                <!-- Main box -->
                <div class="main-box">
                    <!--Nav Outer -->
                    <div class="outer-box">
                        <div class="logo-box">
                            <div class="logo"><a href="{{ route('index') }}"><img src="images/logo1.png" style="width:150px"
                                        alt="" title=""></a></div>
                        </div>
                    </div>

                    <div class="outer-box">
                        <!-- Login/Register -->
                        <div class="btn-box">
                            <a href="{{ route('register') }}" class="theme-btn btn-style-three">Register</a>
                            <a href="{{ route('index') }}" class="theme-btn btn-style-one"><span
                                    class="btn-title">Lihat Beasiswa</span></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Header -->
            <div class="mobile-header">
                <div class="logo"><a href="index-2.html"><img src="images/logo.png" alt="" title=""></a>
                </div>
            </div>

            <!-- Mobile Nav -->
            <div id="nav-mobile"></div>
        </header>
        <!--End Main Header -->

        <!-- Info Section -->
        <div class="login-section">
            <div class="image-layer" style="background-image: url(images/background/12.jpg);"></div>
            <div class="outer-box">
                <!-- Login Form -->
                <div class="login-form default-form">
                    <div class="form-inner">
                        <h3>Login to Fund MyEdu</h3>
                        <!--Login Form-->
                        <form method="POST" action="{{ route('login') }}">
                         @csrf
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="email" :value="old('email')" required autofocus
                                    autocomplete="username">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input id="password-field" type="password" type="password" name="password" required
                                    autocomplete="current-password">
                            </div>

                            <div class="form-group">
                                <div class="field-outer">
                                    <div class="input-group checkboxes square">
                                        <input type="checkbox" name="remember-me" id="remember_me" name="remember">
                                        <label for="remember" class="remember"><span class="custom-checkbox"></span>
                                            Remember me</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <button class="theme-btn btn-style-one" type="submit" name="log-in">Log In</button>
                            </div>
                        </form>


                    </div>
                </div>
                <!--End Login Form -->
            </div>
        </div>
        <!-- End Info Section -->


    </div><!-- End Page Wrapper -->


    <script src="js/jquery.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/chosen.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.fancybox.js"></script>
    <script src="js/jquery.modal.min.js"></script>
    <script src="js/mmenu.polyfills.js"></script>
    <script src="js/mmenu.js"></script>
    <script src="js/appear.js"></script>
    <script src="js/ScrollMagic.min.js"></script>
    <script src="js/rellax.min.js"></script>
    <script src="js/owl.js"></script>
    <script src="js/wow.js"></script>
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire(
                    'Daftar Gagal',
                    '{{ $error }}',
                    'warning'
                )
            </script>
        @endforeach
    @endif
</body>



</html>
