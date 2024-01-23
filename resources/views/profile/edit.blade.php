@extends('layouts.front.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard" style="padding-left:5%;padding-right:5%">
        <div class="dashboard-outer">


            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>My Profile</h4>
                                @if ($status === 'aktif')
                                    <span class="text-success">
                                        <i class="fas fa-check-circle"></i> Akun sudah diverifikasi
                                    </span>
                                @elseif($verifikasi)
                                    <span class="text-warning">Akun sedang dalam proses verifikasi</span>
                                @else
                                    <span class="text-danger">Akun belum diverifikasi</span>
                                @endif
                            </div>


                            @if (!$verifikasi)
                                <div class="message-box warning">
                                    <i class="fas fa-info-circle"></i>
                                    <p>&nbsp;&nbsp;Harap isi riwayat prestasi terlebih dahulu jika ada.</p>
                                    <button class="close-btn"><span class="close_icon"></span></button>
                                </div>
                            @endif


                            <div class="widget-content">




                                <form method="post" action="{{ route('profile.update') }}" class="default-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div style="text-align: center;">
                                        @if (!empty($user->Gambar))
                                            <img src="{{ Storage::url($user->Gambar) }}" width="70" height="70"
                                                class="img-thumbnail">
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="gambar">User Picture</label>
                                        <div class="mb-3">
                                            <input class="form-control" type="file" id="formFile" name="Gambar">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Nama Depan</label>
                                            <input type="text" name="NamaDepan"
                                                value="{{ old('NamaDepan', $user->NamaDepan) }}">
                                        </div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Nama Belakang</label>
                                            <input type="text" name="NamaBelakang"
                                                value="{{ old('NamaBelakang', $user->NamaBelakang) }}">
                                        </div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Email address</label>
                                            <input type="email" name="email" value="{{ old('email', $user->email) }}">
                                        </div>



                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Alamat</label>
                                            <input type="text" name="Alamat" value="{{ old('Alamat', $user->Alamat) }}">
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Tanggal Lahir</label>
                                            <input type="text" name="TanggalLahir" id="tanggal-lahir" class="datepicker"
                                                value="{{ old('TanggalLahir', $user->TanggalLahir) }}">
                                        </div>


                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Jenjang</label>
                                            <select name="JenjangID" id="jenjang">
                                                <option value="">Pilih Jenjang</option>
                                                @foreach ($jenjang as $jenjangs)
                                                    <option value="{{ $jenjangs->JenjangID }}"
                                                        {{ old('JenjangID', $user->JenjangID) === $jenjangs->JenjangID ? 'selected' : '' }}>
                                                        {{ $jenjangs->NamaJenjang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Jurusan</label>
                                            <select name="JurusanID" id="jurusan">
                                                <option value="">Pilih Jurusan</option>
                                                @foreach ($jurusan as $jurusans)
                                                    <option value="{{ $jurusans->JurusanID }}"
                                                        {{ old('JurusanID', $user->JurusanID) == $jurusans->JurusanID ? 'selected' : '' }}>
                                                        {{ $jurusans->NamaJurusan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>



                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Nilai Rata Rata</label>
                                            <input type="text" name="NilaiRata"
                                                value="{{ old('NilaiRata', $user->NilaiRata) }}">
                                        </div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Pekerjaan Orang Tua</label>
                                            <input type="text" name="PekerjaanOrtu"
                                                value="{{ old('PekerjaanOrtu', $user->PekerjaanOrtu) }}">
                                        </div>
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Pendapatan Orang Tua</label>
                                            <input type="text" name="PendapatanOrtu" id="PendapatanOrtu"
                                                value="{{ 'Rp. ' . number_format($user->PendapatanOrtu, 0, ',', '.') }}">
                                        </div>


                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <label>Tahun Lulus</label>
                                            <input type="number" name="TahunLulus"
                                                value="{{ old('TahunLulus', $user->TahunLulus) }}">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">

                                        </div>
                                        
                                        @if (!$verifikasi)
                                            <div class="message-box warning">
                                                <i class="fas fa-info-circle"></i>
                                                <p>&nbsp;&nbsp;Harap isi riwayat prestasi terlebih dahulu jika ada.</p>
                                                <button class="close-btn"><span class="close_icon"></span></button>
                                            </div>
                                        @endif
                                        <!-- Input -->
                                        <div class="form-group col-lg-6 col-md-12">
                                            <button class="theme-btn btn-style-one">Kirim Formulir</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <style>
                        .btn-group {
                            display: flex;
                            gap: 10px;
                            /* Atur jarak antara tombol-tombol */
                        }
                    </style>

                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Riwayat Prestasi</h4>
                            </div>

                            <div class="widget-content">
                                @if ($user->riwayatPrestasi->count() > 0)
                                    @foreach ($user->riwayatPrestasi as $prestasi)
                                        <form method="post" action="{{ route('prestasi.update', $prestasi) }}"
                                            class="default-form">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <!-- Input Prestasi -->
                                                <div class="form-group col">
                                                    <label>Prestasi</label>
                                                    <input id="prestasi" name="prestasi" type="text"
                                                        autocomplete="off" value="{{ $prestasi->prestasi }}">
                                                </div>

                                                <!-- Input Tahun -->
                                                <div class="form-group col">
                                                    <label>Tahun</label>
                                                    <input id="tahun" name="tahun" type="number"
                                                        autocomplete="off" value="{{ $prestasi->tahun }}">
                                                </div>

                                                <div class="form-group col" style="padding-top: 35px">
                                                    <div class="btn-group" role="group" aria-label="Simpan atau Hapus">
                                                        <button type="submit"
                                                            class="theme-btn btn-style-one">Update</button>
                                                        <form method="POST"
                                                            action="{{ route('prestasi.destroy', $prestasi) }}"
                                                            class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="theme-btn btn-style-two"
                                                                onclick="confirmDelete(event)">Hapus</button>
                                                        </form>

                                                    </div>
                                                </div>



                                            </div>
                                        </form>
                                    @endforeach
                                @else
                                    <p>Tidak ada riwayat prestasi.</p>
                                @endif

                                <form method="post" action="{{ route('prestasi.store') }}" class="default-form">
                                    @csrf
                                    <div class="row">
                                        <!-- Input Prestasi -->
                                        <div class="form-group col">
                                            <label>Prestasi</label>
                                            <input id="prestasi" name="prestasi" type="text" autocomplete="off">
                                        </div>

                                        <!-- Input Tahun -->
                                        <div class="form-group col">
                                            <label>Tahun</label>
                                            <input id="tahun" name="tahun" type="number" autocomplete="off">
                                        </div>

                                        <div class="form-group col" style="padding-top: 35px">
                                            <button class="theme-btn btn-style-one">Simpan</button>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4>Password</h4>
                            </div>

                            <div class="widget-content">
                                <form method="post" action="{{ route('password.update') }}" class="default-form">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <!-- Input -->
                                        <div class="form-group col-lg-4 col-md-12">
                                            <label>Password Lama</label>
                                            <input id="current_password" name="current_password" type="password"
                                                autocomplete="current-password">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-4 col-md-12">
                                            <label>Password Baru</label>
                                            <input id="password" name="password" type="password"
                                                autocomplete="new-password">
                                        </div>

                                        <!-- Input -->
                                        <div class="form-group col-lg-4 col-md-12">
                                            <label>Konfirmasi Password</label>
                                            <input id="password_confirmation" name="password_confirmation"
                                                type="password" autocomplete="new-password">
                                        </div>



                                        <div class="form-group col-lg-6 col-md-12">
                                            <button class="theme-btn btn-style-one">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>



                </div>


            </div>
        </div>
    </section>

    <!-- End Dashboard -->
@endsection

@section('js')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @if ($errors->updatePassword)
        @foreach ($errors->updatePassword->all() as $error)
            <script>
                Swal.fire(
                    'Ubah Gagal',
                    '{{ $error }}',
                    'warning'
                )
            </script>
        @endforeach
    @endif



    @if (session('status') === 'profile-updated')
        <script>
            Swal.fire(
                'Berhasil',
                'Data Berhasil Diubah',
                'success'
            )
        </script>
    @endif

    @if (session('status') === 'password-updated')
        <script>
            Swal.fire(
                'Berhasil',
                'Data Berhasil Diubah',
                'success'
            )
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // Trigger change event for "jenjang" select on page load
            $('#jenjang').trigger('change');
        });

        $(document).ready(function() {
            // When the "jenjang" select element changes
            $('#jenjang').change(function() {
                var jenjangID = $(this).val(); // Get the selected jenjangID

                // Make an AJAX request to fetch the corresponding jurusan options
                $.ajax({
                    url: '/api/get-jurusan', // Update with the URL to your backend endpoint
                    type: 'GET',
                    data: {
                        jenjangID: jenjangID
                    },
                    success: function(response) {
                        var jurusanSelect = $('#jurusan'); // Get the jurusan select element
                        jurusanSelect.empty(); // Clear existing options

                        // Add the retrieved jurusan options to the select element
                        response.forEach(function(jurusan) {
                            jurusanSelect.append(
                                $('<option>', {
                                    value: jurusan.JurusanID,
                                    text: jurusan.NamaJurusan,
                                    selected: jurusan.JurusanID ==
                                        '{{ $user->JurusanID }}' // Auto select based on user data
                                })
                            );
                        });
                    }
                });
            });

            // Trigger change event for "jenjang" select on page load
            $('#jenjang').trigger('change');
        });

        $(document).ready(function() {
            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd', // Set the desired date format
                changeMonth: true,
                changeYear: true,
                yearRange: '-100:+0' // Adjust the year range as needed
            });
        });

        $(document).ready(function() {
            // Function to format the input value
            function formatRupiah(angka) {
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });

                return formatter.format(angka);
            }

            // Event listener for the input field
            $('#PendapatanOrtu').on('input', function() {
                var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var formattedValue = formatRupiah(value); // Format the value

                $(this).val(formattedValue);
            });
        });
    </script>
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Mencegah form submit langsung

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.closest('form').submit(); // Submit form jika konfirmasi diterima
                }
            });
        }
    </script>
    @if ($verifikasi)
        <script>
            Swal.fire({
                title: 'Mohon Tunggu...',
                html: 'Data Anda telah berhasil disimpan. ' +
                    'Mohon tunggu admin untuk memverifikasi data Anda.',
                allowOutsideClick: false,
                didOpen: function() {
                    Swal.showLoading();
                }
            });
        </script>
    @endif


@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
