<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    {{-- Title --}}
    <title>
        @isset($title)
            {{ $title . ' - ' . config('web.title') }}
        @else
            {{ config('web.title') }}
        @endisset
    </title>

    <!-- Stylesheets -->
    <link href="{{ url('/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ url('/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ url('/css/preloader.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ url('/images/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/images/favicon.png') }}" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!--[if lt IE 9]><script src="/https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    @yield('css')
    <!--[if lt IE 9]><script src="/js/respond.js"></script><![endif]-->
</head>

<body data-anm=".anm">

    <div class="page-wrapper">

        {{-- <!-- Preloader -->
        <div class="preloader"></div> --}}

        @include('layouts.front.navbar')

        @yield('content')


        @include('layouts.front.footer')



    </div><!-- End Page Wrapper -->


    <script src="{{ url('/js/jquery.js') }}"></script>
    <script src="{{ url('/js/popper.min.js') }}"></script>
    <script src="{{ url('/js/chosen.min.js') }}"></script>
    <script src="{{ url('/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/js/jquery.fancybox.js') }}"></script>
    <script src="{{ url('/js/jquery.modal.min.js') }}"></script>
    <script src="{{ url('/js/mmenu.polyfills.js') }}"></script>
    <script src="{{ url('/js/mmenu.js') }}"></script>
    <script src="{{ url('/js/appear.js') }}"></script>
    <script src="{{ url('/js/anm.min.js') }}"></script>
    <script src="{{ url('/js/ScrollMagic.min.js') }}"></script>
    <script src="{{ url('/js/rellax.min.js') }}"></script>
    <script src="{{ url('/js/owl.js') }}"></script>
    <script src="{{ url('/js/wow.js') }}"></script>
    <script src="{{ url('/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('js')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                Swal.fire(
                    'Ubah Gagal',
                    '{{ $error }}',
                    'warning'
                )
            </script>
        @endforeach
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Berhasil',
                '{{ session('success') }}',
                'success'
            )
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire(
                'Ubah Gagal',
                '{{ session('error') }}',
                'warning'
            )
        </script>
    @endif

    @if (session('restricted'))
    <script>
        Swal.fire({
            title: 'Akses Dibatasi',
            text: '{{ session('restricted') }}',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Oke',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Edit Profil',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ route('profile.edit') }}';
            }
        });
    </script>
@endif





</body>



</html>
