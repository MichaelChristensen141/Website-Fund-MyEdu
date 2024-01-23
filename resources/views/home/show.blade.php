@extends('layouts.front.app')

@section('content')
    <!-- Candidate Detail Section -->
    <section class="candidate-detail-section">
        <!-- Upper Box -->
        <div class="upper-box">
            <div class="auto-container">
                <!-- Candidate block Five -->
                <div class="candidate-block-five">
                    <div class="inner-box">
                        <div class="content">
                            <figure class="image">
                                @if ($beasiswa->TipeBeasiswa === 'Non-Kampus')
                                    @if (empty($beasiswa->perusahaan->Gambar))
                                        <img src="{{ url('/images/telkom.jpeg') }}" alt="">
                                    @else
                                        <img src="{{ Storage::url($beasiswa->perusahaan->Gambar) }}">
                                    @endif
                                @elseif($beasiswa->TipeBeasiswa === 'Kampus')
                                    @if (empty($beasiswa->kampus->Gambar))
                                        <img src="{{ url('/images/telkom.jpeg') }}" alt="">
                                    @else
                                        <img src="{{ Storage::url($beasiswa->kampus->Gambar) }}">
                                    @endif
                                @endif

                            </figure>
                            <h4 class="name">
                                
                                <a href="#">{{ $beasiswa->NamaBeasiswa }}</a>
                            </h4>
                            <ul class="candidate-info">
                               
                                @if ($beasiswa->TipeBeasiswa === 'Non-Kampus')
                                    <li class="text-success">
                                        <i class="icon fa-solid fa-graduation-cap"></i>
                                        {{ $beasiswa->perusahaan->NamaPerusahaan }}
                                    </li>
                                    <li><span class="icon flaticon-map-locator"></span>{{ $beasiswa->perusahaan->Alamat }}
                                    </li>
                                @elseif($beasiswa->TipeBeasiswa === 'Kampus')
                                    <li class="text-success">
                                        <i class="icon fa-solid fa-graduation-cap"></i>
                                        {{ $beasiswa->kampus->NamaKampus }}
                                    </li>
                                    <li><span class="icon flaticon-map-locator"></span>{{ $beasiswa->kampus->Alamat }}</li>
                                @endif

                            </ul>
                            <ul class="candidate-info">

                                <li><i class="icon fa-regular fa-address-card"></i></span>{{ $beasiswa->Kontak }}</li>
                                <li>
                                    <i class="icon fa-solid fa-calendar-days"></i>
                                    {{ $formattedDate = date('d F Y', strtotime($beasiswa->TanggalPendaftaran)) }}
                                    -
                                    {{ $formattedDate = date('d F Y', strtotime($beasiswa->TanggalPenutupan)) }}
                                </li>
                            </ul>
                            <ul class="post-tags">
                                @if ($beasiswa->jenjang->isNotEmpty())
                                    @foreach ($beasiswa->jenjang as $key => $jenjang)
                                        @php
                                            $class = ['required', 'privacy', 'time'][array_rand(['required', 'privacy', 'time'])];
                                        @endphp
                                        <li class="{{ $class }}">{{ $jenjang->NamaJenjang }}</li>
                                    @endforeach
                                @endif

                            </ul>
                        </div>

                        <div class="btn-box">
                            <a href="tel:{{ $beasiswa->Kontak }}" class="theme-btn btn-style-one">Daftar Sekarang</a>
                            {{-- <button class="bookmark-btn"><i class="flaticon-bookmark"></i></button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="candidate-detail-outer">
            <div class="auto-container">
                <div class="row">
                    <div class="content-column col-lg-8 col-md-12 col-sm-12">
                        <div class="job-detail">
                            <h4>Deskripsi Beasiswa</h4>
                            <p>{{ $beasiswa->Deskripsi }}</p>
                            <p>Mauris nec erat ut libero vulputate pulvinar. Aliquam ante erat, blandit at pretium et,
                                accumsan ac est. Integer vehicula rhoncus molestie. Morbi ornare ipsum sed sem condimentum,
                                et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam. Mauris nec
                                erat ut libero vulputate pulvinar.</p>
                            <br>
                            <h4>Persyaratan Beasiswa</h4>
                            <p>{{ $beasiswa->Persyaratan }}</p>
                            <p>Mauris nec erat ut libero vulputate pulvinar. Aliquam ante erat, blandit at pretium et,
                                accumsan ac est. Integer vehicula rhoncus molestie. Morbi ornare ipsum sed sem condimentum,
                                et pulvinar tortor luctus. Suspendisse condimentum lorem ut elementum aliquam. Mauris nec
                                erat ut libero vulputate pulvinar.</p>



                        </div>
                    </div>

                    <div class="sidebar-column col-lg-4 col-md-12 col-sm-12">
                        <aside class="sidebar">

                            <div class="sidebar-widget">
                                <!-- Job Skills -->
                                <h4 class="widget-title">Jurusan</h4>
                                <div class="widget-content">
                                    <ul class="job-skills">
                                        @if ($beasiswa->jurusan->isNotEmpty())
                                            @foreach ($beasiswa->jurusan as $key => $jurusan)
                                                <li><a href="">{{ $jurusan->NamaJurusan }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>


                            <div class="sidebar-widget">
                                <h4 class="widget-title">Profil 
                                    @if ($beasiswa->TipeBeasiswa === 'Non-Kampus')
                                        {{ $beasiswa->perusahaan->NamaPerusahaan }}
                                    @elseif($beasiswa->TipeBeasiswa === 'Kampus')
                                        {{ $beasiswa->kampus->NamaKampus }}
                                    @endif
                                </h4>
                                <div class="widget-content">
                                    <ul class="job-overview">
                                        @if ($beasiswa->TipeBeasiswa === 'Non-Kampus')
                                            <li>
                                                <i class="icon fa-solid fa-location-dot"></i>
                                                <h5>Alamat:</h5>
                                                <span>{{ $beasiswa->perusahaan->Alamat }}</span>
                                            </li>

                                            <li>
                                                <i class="icon fa-solid fa-address-book"></i>
                                                <h5>Kontak:</h5>
                                                <span><a href="{{ $beasiswa->perusahaan->Kontak }}">{{ $beasiswa->perusahaan->Kontak }}</a></span>
                                            </li>

                                            <li>
                                                <i class="icon fa-solid fa-link"></i>
                                                <h5>Website:</h5>
                                                <span><a href="{{ $beasiswa->perusahaan->Website }}">{{ $beasiswa->perusahaan->Website }}</a></span>
                                            </li>
                                        @elseif($beasiswa->TipeBeasiswa === 'Kampus')
                                            <li>
                                                <i class="icon fa-solid fa-location-dot"></i>
                                                <h5>Alamat:</h5>
                                                <span>{{ $beasiswa->kampus->Alamat }}</span>
                                            </li>

                                            <li>
                                                <i class="icon fa-solid fa-address-book"></i>
                                                <h5>Kontak:</h5>
                                                <span><a href="{{ $beasiswa->kampus->Kontak }}">{{ $beasiswa->kampus->Kontak }}</a></span>
                                            </li>

                                            <li>
                                                <i class="icon fa-solid fa-link"></i>
                                                <h5>Website:</h5>
                                                <span><a href="{{ $beasiswa->kampus->Website }}">{{ $beasiswa->kampus->Website }}</a></span>
                                            </li>
                                        @endif




                                    </ul>
                                </div>

                            </div>


                        </aside>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End candidate Detail Section -->
@endsection

@section('js')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
