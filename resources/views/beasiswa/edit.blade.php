@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Buat Beasiswa Baru</h3>
                

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <form action="{{ route('dashboard.beasiswa.update', $beasiswa->BeasiswaID) }}" method="POST"
                        class="default-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Ls widget -->
                        <div class="ls-widget">
                            <div class="tabs-box">
                                <div class="widget-title">
                                    <h4>Basic Info</h4>
                                </div>

                                <div class="widget-content">
                                    <div class="default-form">
                                        <div class="row">
                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Nama Beasiswa</label>
                                                <input type="text" name="NamaBeasiswa" placeholder="Nama Beasiswa"
                                                    value="{{ old('NamaBeasiswa', $beasiswa->NamaBeasiswa) }}">
                                            </div>

                                            <!-- About Beasiswa -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Deskripsi Beasiswa</label>
                                                <textarea name="Deskripsi" placeholder="Deskripsi Beasiswa">{{ old('Deskripsi', $beasiswa->Deskripsi) }}</textarea>
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Tanggal Pendaftaran</label>
                                                <input type="text" name="TanggalPendaftaran" class="datepicker"
                                                    value="{{ old('TanggalPendaftaran', $beasiswa->TanggalPendaftaran) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Tanggal Penutupan</label>
                                                <input type="text" name="TanggalPenutupan" class="datepicker"
                                                    value="{{ old('TanggalPenutupan', $beasiswa->TanggalPenutupan) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Kontak</label>
                                                <input type="text" name="Kontak" placeholder="Kontak"
                                                    value="{{ old('Kontak', $beasiswa->Kontak) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Tahun Masuk</label>
                                                <input type="number" name="TahunMasuk" placeholder="Tahun Masuk"
                                                    value="{{ old('TahunMasuk', $beasiswa->TahunMasuk) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Pembiayaan</label>
                                                <input type="text" name="Pembiayaan" placeholder="Pembiayaan"
                                                    id="Pembiayaan" value="{{ old('Pembiayaan', $beasiswa->Pembiayaan) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-6 col-md-12">
                                                <label>Jumlah Penerima</label>
                                                <input type="number" name="JumlahPenerima" placeholder="Jumlah Penerima"
                                                    value="{{ old('JumlahPenerima', $beasiswa->JumlahPenerima) }}">
                                            </div>

                                            <!-- Input -->
                                            <div class="form-group col-lg-12 col-md-12">
                                                <label>Persyaratan</label>
                                                <textarea name="Persyaratan" placeholder="Persyaratan">{{ old('Persyaratan', $beasiswa->Persyaratan) }}</textarea>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Ls widget -->
                            <div class="ls-widget">
                                <div class="tabs-box">
                                    <div class="widget-title">
                                        <h4>Penerima Beasiswa</h4>
                                    </div>

                                    <div class="widget-content">
                                        <div class="default-form">
                                            <div class="row">
                                                <!-- Input -->
                                                <div class="form-group col-lg-6 col-md-12">
                                                    <label>Tipe Beasiswa</label>
                                                    <select name="TipeBeasiswa" id="TipeBeasiswa">
                                                        <option value="Kampus"
                                                            {{ old('TipeBeasiswa', $beasiswa->TipeBeasiswa) == 'Kampus' ? 'selected' : '' }}>
                                                            Kampus
                                                        </option>
                                                        <option value="Non-Kampus"
                                                            {{ old('TipeBeasiswa', $beasiswa->TipeBeasiswa) == 'Non-Kampus' ? 'selected' : '' }}>
                                                            Non-Kampus
                                                        </option>
                                                    </select>
                                                </div>

                                                <!-- Input -->
                                                <div class="form-group chosen-search col-lg-6 col-md-12" id="kampusIdDiv"
                                                    style="display: none;">
                                                    <!-- Search Select -->
                                                    <label>Pilih Kampus</label>
                                                    <select class="chosen-search-select" name="KampusID">
                                                        @foreach ($kampus as $item)
                                                            <option value="{{ $item->KampusID }}"
                                                                {{ old('KampusID', $beasiswa->KampusID) == $item->KampusID ? 'selected' : '' }}>
                                                                {{ $item->NamaKampus }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <!-- Input -->
                                                <div class="form-group col-lg-6 col-md-12" id="perusahaanIdDiv"
                                                    style="display: none;">
                                                    <label>Pilih Perusahaan</label>
                                                    <select class="chosen-search-select" name="PerusahaanID">
                                                        @foreach ($perusahaan as $item)
                                                            <option value="{{ $item->PerusahaanID }}"
                                                                {{ old('PerusahaanID', $beasiswa->PerusahaanID) == $item->PerusahaanID ? 'selected' : '' }}>
                                                                {{ $item->NamaPerusahaan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">
                                                    <label>Pilih Jenjang</label>
                                                    <!-- Search Select -->
                                                    <div class="form-group">
                                                        <select data-placeholder="Choose a category..."
                                                            class="chosen-select" multiple tabindex="4" name="jenjang[]">
                                                            @foreach ($jenjang as $item)
                                                                <option value="{{ $item->JenjangID }}"
                                                                    {{ in_array($item->JenjangID, old('jenjang', $beasiswa->jenjang->pluck('JenjangID')->toArray())) ? 'selected' : '' }}>
                                                                    {{ $item->NamaJenjang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12">
                                                    <label>Pilih Jurusan</label>
                                                    <!-- Search Select -->
                                                    <div class="form-group">
                                                        <select data-placeholder="Choosea category..." class="chosen-select"
                                                            multiple tabindex="4" name="jurusan[]">
                                                            @foreach ($jurusan as $item)
                                                                <option value="{{ $item->JurusanID }}"
                                                                    {{ in_array($item->JurusanID, old('jurusan', $beasiswa->jurusan->pluck('JurusanID')->toArray())) ? 'selected' : '' }}>
                                                                    {{ $item->NamaJurusan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Input -->
                                                <div class="form-group col-lg-12 col-md-12 text-right">
                                                    <a href="{{ route('dashboard.beasiswa.index') }}" class="theme-btn btn-style-two">Kembali</a>
                                                    <button class="theme-btn btn-style-one">Simpan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- End Dashboard -->
@endsection

@section('js')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
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
            $('#Pembiayaan').on('input', function() {
                var value = $(this).val().replace(/\D/g, ''); // Remove non-numeric characters
                var formattedValue = formatRupiah(value); // Format the value

                $(this).val(formattedValue);
            });
        });

        $(document).ready(function() {
            // Initially hide the "Kampus ID" and "Perusahaan ID" input fields
            $('#kampusIdDiv').hide();
            $('#perusahaanIdDiv').hide();

            // Event listener for the "Tipe Beasiswa" select dropdown
            $('#TipeBeasiswa').change(function() {
                var selectedOption = $(this).val();

                // Show/hide the appropriate input field based on the selected option
                if (selectedOption === 'Kampus') {
                    $('#kampusIdDiv').show();
                    $('#perusahaanIdDiv').hide();
                } else if (selectedOption === 'Non-Kampus') {
                    $('#kampusIdDiv').hide();
                    $('#perusahaanIdDiv').show();
                }
            });

            // Trigger the change event on page load to ensure correct initial state
            $('#TipeBeasiswa').trigger('change');
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
