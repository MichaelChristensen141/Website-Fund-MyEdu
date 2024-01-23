 <!-- Header Span -->
 <span class="header-span"></span>

 <!-- Main Header-->
 <header class="main-header">

     <!-- Main box -->
     <div class="main-box">
         <!--Nav Outer -->
         <div class="nav-outer">
             <div class="logo-box">
                 <div class="logo"><a href="{{ route('index') }}">
                         <img src="/images/logo.png" alt="" title="" style="width:154px"></a>
                 </div>
             </div>

             <nav class="nav main-menu">
                 <ul class="navigation" id="navbar">
                     <li class="{{ request()->route()->getName() === 'index'? 'current dropdown': 'dropdown' }}">
                         <a href="{{ route('index') }}">Beranda</a>

                     </li>
                     <li
                         class="{{ request()->route()->getName() === 'index.beasiswa'? 'current dropdown': 'dropdown' }}">
                         <a href="{{ route('index.beasiswa') }}">Beasiswa</a>
                     </li>

                     <li
                         class="{{ request()->route()->getName() === 'index.rekomendasi_beasiswa'? 'current dropdown': 'dropdown' }}">
                         <a href="{{ route('index.rekomendasi_beasiswa') }}">Rekomendasi Beasiswa</a>
                     </li>

                     <li class="{{ request()->route()->getName() === 'index.about'? 'current dropdown': 'dropdown' }}">
                         <a href="{{ route('index.about') }}">Tentang Kami</a>
                     </li>

                 </ul>
             </nav>
             <!-- Main Menu End-->
         </div>

         <div class="outer-box">


             @if (Auth::check())
                 <!-- Dashboard Option -->
                 <div class="dropdown dashboard-option">
                     <a class="dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">

                         @if (!empty(Auth::user()->Gambar))
                             <img src="{{ Storage::url(Auth::user()->Gambar) }}" alt="avatar" class="thumb">
                         @else
                             <img src="https://ui-avatars.com/api/?name={{ Auth::user()->NamaDepan }}+{{ Auth::user()->NamaBelakang }}"
                                 alt="avatar" class="thumb">
                         @endif
                         <span class="name">{{ Auth::user()->NamaDepan }}</span>
                     </a>
                     <ul class="dropdown-menu">

                         <li>
                             @if (auth()->user()->hasRole('admin'))
                                 <!-- Konten untuk admin -->
                                 <a href="{{ route('dashboard') }}"><i class="la fas fa-toolbox"></i></i>Dashboard
                                     Admin</a>
                             @endif


                         <li><a href="{{ route('profile.edit') }}"><i class="la la-user-alt"></i>View Profile</a>
                         </li>
                         <li>
                             <!-- Authentication -->
                             <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                 @csrf
                                 <a href="{{ route('logout') }}"
                                     onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
                                     <i class="la fas fa-sign-out-alt fa-xs"></i> Log Out
                                 </a>
                             </form>
                         </li>

                     </ul>
                 </div>
             @else
                 <div class="btn-box">
                     <a href="{{ route('login') }}" class="theme-btn btn-style-three">Login</a>
                     <a href="{{ route('register') }}" class="theme-btn btn-style-one">Register</a>
                 </div>
             @endif

         </div>

     </div>

     <!-- Mobile Header -->
     <div class="mobile-header">
         <div class="logo"><a href="index-2.html"><img src="/images/logo.png" alt="" title=""></a>
         </div>

         <!--Nav Box-->
         <div class="nav-outer clearfix">

             <div class="outer-box">
                 <!-- Login/Register -->
                 @if (!Auth::check())
                     <div class="login-box">
                         <a href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i></a>
                     </div>
                 @else
                     @if (!empty(Auth::user()->Gambar))
                         <a href="{{ route('profile.edit') }}" style="width:30px;border-radius: 100px;"><img
                                 src="{{ Storage::url(Auth::user()->Gambar) }}" alt="avatar" class="thumb"></a>
                     @else
                         <a href="{{ route('profile.edit') }}" style="width:30px;border-radius: 100px;"><img
                                 src="https://ui-avatars.com/api/?name={{ Auth::user()->NamaDepan }}+{{ Auth::user()->NamaBelakang }}"
                                 alt="avatar" class="thumb"></a>
                     @endif

                     <!-- Login/Register -->
                     <button id="toggle-user-sidebar"><i class="fas fa-bars"></i></button>
                 @endif


             </div>
         </div>
     </div>

     <!-- Mobile Nav -->
     <div id="nav-mobile"></div>
 </header>
 <!--End Main Header -->
