@extends('layouts.front.app')

@section('content')
    <!--Page Title-->
    <section class="page-title style-two">
        <div class="auto-container">
            <!-- Job Search Form -->
            <div class="job-search-form">
                <form method="get" action="{{ url()->current() }}">
                    <div class="row">
                        <!-- Form Group -->
                        <div class="form-group col-lg-4 col-md-12 col-sm-12">
                            <span class="icon flaticon-search-1"></span>
                            <input type="text" name="keywords" placeholder="Nama Beasiswa atau Kata Kunci"
                                value="{{ request('keywords') }}">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                            <span class="icon flaticon-map-locator"></span>
                            <input type="text" name="insitusi" placeholder="Nama insitusi"
                                value="{{ request('insitusi') }}">
                        </div>

                        <!-- Form Group -->
                        <div class="form-group col-lg-3 col-md-12 col-sm-12 location">
                            <span class="icon flaticon-briefcase"></span>
                            <select name="type" class="chosen-select">
                                <option value="Semua" {{ request('type') === 'Semua' ? 'selected' : '' }}>Semua
                                </option>
                                <option value="Kampus" {{ request('type') === 'Kampus' ? 'selected' : '' }}>Kampus
                                </option>
                                <option value="Non-Kampus" {{ request('type') === 'Non-Kampus' ? 'selected' : '' }}>
                                    Non-Kampus</option>
                            </select>
                        </div>

                        <!-- Form Group -->
                        <div class="form-group col-lg-2 col-md-12 col-sm-12 text-right">
                            <button type="submit" class="theme-btn btn-style-one">Cari Beasiswa</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Job Search Form -->
        </div>
    </section>
    <!--End Page Title-->

    <!-- Listing Section -->
    <section class="ls-section">
        <div class="auto-container">
            <div class="filters-backdrop"></div>

            <div class="row">
                <!-- Content Column -->
                <div class="content-column col-lg-12">
                    <div class="ls-outer">


                        <div class="row">

                            <!-- Job Block -->
                            @foreach ($beasiswa as $item)
                                <div class="job-block col-lg-6 col-md-12 col-sm-12">
                                    <div class="inner-box" style="height:260px">
                                        <div class="content">
                                            <span class="company-logo">
                                                @if ($item->TipeBeasiswa === 'Non-Kampus')
                                                    @if (empty($item->perusahaan->Gambar))
                                                        <img src="{{ url('/images/telkom.jpeg') }}" width="70"
                                                            height="70" class="img-thumbnail">
                                                    @else
                                                        <img src="{{ Storage::url($item->perusahaan->Gambar) }}"
                                                            width="70" height="70" class="img-thumbnail">
                                                    @endif
                                                @elseif($item->TipeBeasiswa === 'Kampus')
                                                    @if (empty($item->kampus->Gambar))
                                                        <img src="{{ url('/images/telkom.jpeg') }}" width="70"
                                                            height="70" class="img-thumbnail">
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
                                                    <i class="icon fa-solid fa-school"></i>
                                                    @if ($item->jenjang->isNotEmpty())
                                                        @foreach ($item->jenjang as $key => $jenjang)
                                                            {{ $jenjang->NamaJenjang }},
                                                        @endforeach
                                                    @endif

                                                </li>
                                                <li>
                                                    <i class="icon fa-solid fa-building-columns"></i>
                                                    {{ $item->TipeBeasiswa }}

                                                </li>
                                                <li>
                                                    <i class="icon fa-solid fa-location-dot"></i>
                                                    @if ($item->TipeBeasiswa === 'Kampus')
                                                        {{ $item->kampus->NamaKampus }}, {{ $item->kampus->Alamat }}
                                                    @else
                                                        {{ $item->perusahaan->NamaPerusahaan }}.
                                                        {{ $item->perusahaan->Alamat }}
                                                    @endif

                                                </li>
                                                <li>
                                                    <i class="icon fa-solid fa-calendar-days"></i>
                                                    {{ $formattedDate = date('d F Y', strtotime($item->TanggalPendaftaran)) }}
                                                    -
                                                    {{ $formattedDate = date('d F Y', strtotime($item->TanggalPenutupan)) }}
                                                </li>
                                            </ul>
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
                                            <button class="bookmark-btn"><span
                                                    class="fas fa-check-circle text-primary"></span></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach



                        </div>

                        {{ $beasiswa->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Listing Page Section -->
@endsection

@section('js')
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
