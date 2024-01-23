@extends('layouts.front.app')

@section('content')

    <!-- About Section -->
    <section class="about-section-two">
        <div class="auto-container">
            <div class="row">
                <!-- Content Column -->
                <div class="content-column col-lg-6 col-md-12 col-sm-12 order-2">
                    <div class="inner-column wow fadeInRight">
                        <div class="sec-title">
                            <h2>Dapatkan Beasiswa Terbaik dan Lengkap</h2>
                            <div class="text">Temukan beasiswa yang sempurna dari seluruh dunia. Jelajahi beragam peluang
                                untuk mendanai pendidikan Anda. Dapatkan akses ke informasi terperinci dan panduan
                                pendaftaran.</div>
                        </div>
                        <ul class="list-style-one">
                            <li>Buka potensi Anda dengan beasiswa yang mengubah hidup</li>
                            <li>Maksimalkan peluang kesuksesan dengan panduan ahli</li>
                            <li>Buka pintu ke peluang pendidikan yang luar biasa</li>
                        </ul>
                        <a href="#" class="theme-btn btn-style-one">Cari Beasiswa</a>
                    </div>
                </div>


                <!-- Image Column -->
                <div class="image-column col-lg-6 col-md-12 col-sm-12">
                    <figure class="image-box wow fadeInLeft"><img src="/images/resource/image-3.png" alt="">
                    </figure>

                    <!-- Count Employers -->
                    <div class="applicants-list wow fadeInUp">
                        <div class="title-box">
                            <h4>Applicants List</h4>
                        </div>
                        <ul class="applicants">
                            <li class="applicant">
                                <figure class="image"><img src="/images/resource/applicant-1.png" alt="">
                                </figure>
                                <h4 class="name">Brooklyn Simmons</h4>
                                <span class="designation">Web Developer</span>
                            </li>

                            <li class="applicant">
                                <figure class="image"><img src="/images/resource/applicant-2.png" alt="">
                                </figure>
                                <h4 class="name">Courtney Henry</h4>
                                <span class="designation">Web Developer</span>
                            </li>

                            <li class="applicant">
                                <figure class="image"><img src="/images/resource/applicant-3.png" alt="">
                                </figure>
                                <h4 class="name">Marvin McKinney</h4>
                                <span class="designation">Web Developer</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End About Section -->

    <!-- Testimonial Section Two -->
    <section class="testimonial-section-two">
        <div class="container-fluid">
            <div class="testimonial-left"><img src="/images/resource/testimonial-left.png" alt=""></div>
            <div class="testimonial-right"><img src="/images/resource/testimonial-right.png" alt=""></div>
            <!-- Sec Title -->
            <div class="sec-title text-center">
                <h2>Testimoni Dari Pelanggan Kami</h2>
                <div class="text">Dengarlah apa yang pelanggan kami katakan</div>
            </div>

            <div class="carousel-outer wow fadeInUp">
                <!-- Testimonial Carousel -->
                <div class="testimonial-carousel owl-carousel owl-theme">

                    <!--Testimonial Block -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="thumb"><img src="/images/resource/testi-thumb-1.png" alt="">
                            </div>
                            <h4 class="title">Kualitas yang luar biasa!</h4>
                            <div class="text">Tanpa Fund MyEdu, saya tidak akan bisa meraih beasiswa yang saya impikan.
                                Mereka dengan cepat membantu saya menemukan beasiswa dan mengurus semuanya! Tim Fund MyEdu
                                bekerja sangat keras untuk menjamin kualitas yang tinggi.</div>
                            <div class="info-box">
                                <h4 class="name">Siti Rahayu</h4>
                                <span class="designation">Mahasiswa Teknik Informatika</span>
                            </div>
                        </div>
                    </div>

                    <!--Testimonial Block -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="thumb"><img src="/images/resource/testi-thumb-1.png" alt="">
                            </div>
                            <h4 class="title">Sangat membantu!</h4>
                            <div class="text">Dengan Fund MyEdu, saya berhasil menemukan beasiswa yang cocok dengan
                                kebutuhan saya. Mereka memberikan panduan dan informasi yang sangat berguna. Terima kasih
                                Fund MyEdu!</div>
                            <div class="info-box">
                                <h4 class="name">Andi Susanto</h4>
                                <span class="designation">Mahasiswa Ekonomi</span>
                            </div>
                        </div>
                    </div>

                    <!--Testimonial Block -->
                    <div class="testimonial-block-two">
                        <div class="inner-box">
                            <div class="thumb"><img src="/images/resource/testi-thumb-1.png" alt="">
                            </div>
                            <h4 class="title">Berkualitas tinggi!</h4>
                            <div class="text">Fund MyEdu adalah solusi terbaik bagi mereka yang mencari beasiswa
                                berkualitas. Mereka tidak hanya menemukan beasiswa yang tepat, tetapi juga memberikan
                                panduan yang luar biasa untuk sukses dalam proses pendaftaran.</div>
                            <div class="info-box">
                                <h4 class="name">Rizki Pratama</h4>
                                <span class="designation">Mahasiswa Teknik Sipil</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End Testimonial Section -->
@endsection
