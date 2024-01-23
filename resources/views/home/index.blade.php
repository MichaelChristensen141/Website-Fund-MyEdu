@extends('layouts.front.app')

@section('content')
    <!-- Banner Section Three-->

    @if (Auth::check() && Auth::user()->hasRole('user') && is_null(Auth::user()->Status))
        <br>
        <div class="container">
            <div class="marquee marquee_hoverpause marquee--borders" style="--duration: 15s;   transform: skewY(-0deg);">
                <div class="marquee__group">
                    <p class="h4" aria-hidden="true">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sebelum
                        Anda dapat melihat semua informasi dari {{ config('web.title') }}, harap
                        mengisi
                        semua informasi yang diperlukan terlebih dahulu. Informasi yang belum diisi dapat mengakibatkan
                        keterbatasan
                        akses terhadap fitur dan data yang relevan</p>
                </div>


            </div>
        </div>
    @endif

    <section class="banner-section-three">
        <div class="auto-container">
            <div class="row">
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="title-box wow fadeInUp">
                            <h3>Temukan Potensimu dengan <br>Beasiswa</h3>
                            <div class="text">Temukan Peluang Tanpa Batas melalui Beasiswa</div>
                        </div> <!-- Pencarian Beasiswa Form -->
                        <div class="job-search-form-two wow fadeInUp" data-wow-delay="500ms">
                            <form method="get" action="/beasiswa">
                                <div class="row">
                                    <div class="form-group col-lg-5 col-md-12 col-sm-12">
                                        <label class="title">Beasiswa</label>
                                        <span class="icon flaticon-search-1"></span>
                                        <input type="text" name="keywords" placeholder="Nama beasiswa">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-4 col-md-12 col-sm-12 location">
                                        <label class="title">Insitusi</label>
                                        <span class="icon flaticon-map-locator"></span>
                                        <input type="text" name="insitusi" placeholder="Cari Insitusi">
                                    </div>
                                    <!-- Form Group -->
                                    <div class="form-group col-lg-3 col-md-12 col-sm-12 btn-box">
                                        <button type="submit" class="theme-btn btn-style-one"><span class="btn-title">Cari
                                                Beasiswa</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- Pencarian Beasiswa Form -->

                        <!-- Pencarian Populer -->
                        <div class="popular-searches wow fadeInUp" data-wow-delay="1000ms">
                            <span class="title">Pencarian Populer : </span>
                            <a href="#">Desainer</a>,
                            <a href="#">Pengembang</a>,
                            <a href="#">Web</a>,
                            <a href="#">iOS</a>,
                            <a href="#">PHP</a>,
                            <a href="#">Senior</a>,
                            <a href="#">Insinyur</a>,
                        </div>
                        <!-- End Pencarian Populer -->
                    </div>
                </div>

                <div class="image-column col-lg-5 col-md-12">
                    <div class="image-box">
                        <figure class="main-image wow fadeInRight" data-wow-delay="1500ms"><img
                                src="/images/resource/banner-img-3.png" alt=""></figure>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Banner Section Three-->



    <!-- Job Section -->
    <section class="job-section">
        <div class="auto-container">
            <div class="sec-title text-center">
                <h2>Beasiswa Terbaru</h2>
                <div class="text">Ketahui nilai diri Anda dan temukan beasiswa yang sesuai dengan kehidupan Anda</div>
            </div>

            <div class="row wow fadeInUp">
                @foreach ($beasiswa as $item)
                    <div class="job-block-three col-lg-4 col-md-6 col-sm-12">
                        <div class="inner-box" style="height:290px">
                            <div class="content">
                                <span class="company-logo">
                                    @if ($item->TipeBeasiswa === 'Non-Kampus')
                                        @if (empty($item->perusahaan->Gambar))
                                            <img src="{{ url('/images/telkom.jpeg') }}" width="70" height="70"
                                                class="img-thumbnail">
                                        @else
                                            <img src="{{ Storage::url($item->perusahaan->Gambar) }}" width="70"
                                                height="70" class="img-thumbnail">
                                        @endif
                                    @elseif($item->TipeBeasiswa === 'Kampus')
                                        @if (empty($item->kampus->Gambar))
                                            <img src="{{ url('/images/telkom.jpeg') }}" width="70" height="70"
                                                class="img-thumbnail">
                                        @else
                                            <img src="{{ Storage::url($item->kampus->Gambar) }}" width="70"
                                                height="70" class="img-thumbnail">
                                        @endif
                                    @endif
                                </span>
                                @php
                                    $encryptedId = Crypt::encrypt($item->BeasiswaID); // Mengenkripsi ID menggunakan metode encrypt()
                                @endphp
                                <h4><a href="{{ route('index.beasiswa.item', ['id' => $encryptedId]) }}">
                                        <p class="text-truncate">{{ $item->NamaBeasiswa }}</p>
                                    </a></h4>
                                <ul class="job-info">
                                    <li class="text-truncate">
                                        <span class="icon flaticon-briefcase"></span>
                                        @if ($item->jenjang->isNotEmpty())
                                            @foreach ($item->jenjang as $key => $jenjang)
                                                {{ $jenjang->NamaJenjang }},
                                            @endforeach
                                        @endif

                                    </li>
                                    <li><span class="icon flaticon-map-locator"></span>
                                        @if ($item->TipeBeasiswa === 'Kampus')
                                            {{ $item->kampus->NamaKampus }}, {{ $item->kampus->Alamat }}
                                        @else
                                            {{ $item->perusahaan->NamaPerusahaan }}. {{ $item->perusahaan->Alamat }}
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            <ul class="job-other-info">
                                @if ($item->jurusan->isNotEmpty())
                                    @foreach ($item->jurusan as $key => $jurusan)
                                        @php
                                            $class = ['required', 'privacy', 'time'][array_rand(['required', 'privacy', 'time'])];
                                        @endphp
                                        <li class="{{ $class }}">{{ $jurusan->NamaJurusan }}</li>
                                    @endforeach
                                @endif





                            </ul>
                            <button class="bookmark-btn"><span class="fas fa-check-circle text-primary"></span></button>
                        </div>
                    </div>
                @endforeach



            </div>

            <div class="btn-box">
                <a href="{{ route('index.beasiswa') }}" class="theme-btn btn-style-one bg-blue"><span
                        class="btn-title">Muat
                        Lebih Banyak</span></a>
            </div>
        </div>
    </section>
    <!-- End Job Section -->
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.6.0/jquery.marquee.min.js"
        integrity="sha512-JHJv/L48s1Hod24iSI0u9bcF/JlUi+YaxliKdbasnw/U1Lp9xxWkaZ3O5OuQPMkVwOVXeFkF4n4176ouA6Py3A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('css')
    @if (Auth::check() && Auth::user()->hasRole('user') && is_null(Auth::user()->Status))
        <style>
            body {
                --space: 0rem;


            }

            .marquee {
                --duration: 60s;
                --gap: var(--space);

                display: flex;
                overflow: hidden;
                user-select: none;
                gap: var(--gap);

            }

            .marquee__group {
                flex-shrink: 0;
                display: flex;
                align-items: center;
                justify-content: space-around;
                gap: var(--gap);
                min-width: 100%;
                animation: scroll var(--duration) linear infinite;
            }

            @media (prefers-reduced-motion: reduce) {
                .marquee__group {
                    animation-play-state: paused;
                }
            }

            .marquee__group img {
                max-width: clamp(10rem, 1rem + 28vmin, 20rem);
                aspect-ratio: 1;
                object-fit: cover;
                border-radius: 1rem;
            }

            .marquee__group p {
                background-image: linear-gradient(75deg,
                        hsl(240deg 70% 49%) 0%,
                        hsl(253deg 70% 49%) 11%,
                        hsl(267deg 70% 49%) 22%,
                        hsl(280deg 71% 48%) 33%,
                        hsl(293deg 71% 48%) 44%,
                        hsl(307deg 71% 48%) 56%,
                        hsl(320deg 71% 48%) 67%,
                        hsl(333deg 72% 48%) 78%,
                        hsl(347deg 72% 48%) 89%,
                        hsl(0deg 73% 47%) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
            }

            .marquee--borders {
                border-block: 3px solid rgb(224, 12, 12);
                padding-block: 0.75rem;
            }

            .marquee--reverse .marquee__group {
                animation-direction: reverse;
                animation-delay: calc(var(--duration) / -2);
            }

            @keyframes scroll {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(calc(-100% - var(--gap)));
                }
            }
        </style>
    @endif
@endsection
