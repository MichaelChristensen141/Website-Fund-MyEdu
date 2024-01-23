@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Verifikasi Users</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4></h4>


                            </div>

                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Nama</th>
                                                <th>Jurusan</th>
                                                <th>Jenjang</th>
                                                <th>Tanggal Daftar</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($verifikasi as $item)
                                                <tr>
                                                    <td>
                                                        @if (empty($item->user->Gambar))
                                                            <img src="{{ url('/images/telkom.jpeg') }}" width="70"
                                                                height="70" class="img-thumbnail">
                                                        @else
                                                            <img src="{{ Storage::url($item->user->Gambar) }}"
                                                                width="70" height="70" class="img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h6>{{ $item->user->NamaDepan }} {{ $item->user->NamaBelakang }}
                                                        </h6>
                                                        {{ $item->user->email }}
                                                    </td>
                                                    <td>
                                                        @if ($item->user->jurusan)
                                                            {{ $item->user->jurusan->NamaJurusan }}
                                                        @else
                                                            <span style="color: red;">Data Jurusan Tidak Tersedia</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->user->jenjang)
                                                            {{ $item->user->jenjang->NamaJenjang }}
                                                        @else
                                                            <span style="color: red;">Data Jenjang Tidak Tersedia</span>
                                                        @endif
                                                    </td>


                                                    <td class="status">
                                                        {{ $item->user->created_at ? date('d F Y', strtotime($item->user->created_at)) : '' }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($item->user->Status))
                                                            {{ ucfirst($item->user->Status) }}
                                                        @else
                                                            Tidak Aktif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="option-box">
                                                            <ul class="option-list">

                                                                <li><button
                                                                        data-text="Lihat Akun {{ $item->user->NamaDepan }}"
                                                                        onclick="openModalEdit{{ $item->user->id }}()"><span
                                                                            class="la la-eye"></span></button></li>
                                                                <li>
                                                                    <button
                                                                        data-text="Verifikasi Akun {{ $item->user->NamaDepan }}"
                                                                        onclick="verifikasi({{ $item->user->id }})">
                                                                        <span class="la la-pencil"></span>
                                                                    </button>
                                                                </li>
                                                                <li>
                                                                    <button
                                                                        data-text="Reject Akun {{ $item->user->NamaDepan }}"
                                                                        onclick="reject({{ $item->user->id }})">
                                                                        <span class="la la-times"></span>
                                                                    </button>
                                                                </li>

                                                                {{-- modal --}}
                                                                <div class="model modal edit{{ $item->user->id }}"
                                                                    style="opacity: 1; display: none;">
                                                                    <div class="model modal"
                                                                        style="opacity: 1; display: inline-block;">
                                                                        <!-- Login modal -->
                                                                        <div id="login-modal">
                                                                            <!-- Login Form -->
                                                                            <div class="login-form default-form">
                                                                                <h3>Lihat Data
                                                                                    {{ $item->user->NamaDepan }}
                                                                                </h3>
                                                                                <div class="form-inner">

                                                                                    <!-- Form to Add Jurusan -->
                                                                                    <form method="POST"
                                                                                        action="{{ route('masterdata.jurusan.update', $item->user->id) }}">
                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="NamaDepan">Nama
                                                                                                        Depan</label>
                                                                                                    <input type="text"
                                                                                                        id="NamaDepan"
                                                                                                        name="NamaDepan"
                                                                                                        value="{{ $item->user->NamaDepan }} {{ $item->user->NamaBelakang }}"
                                                                                                        required>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="email">Email</label>
                                                                                                    <input type="email"
                                                                                                        id="email"
                                                                                                        name="email"
                                                                                                        value="{{ $item->user->email }}"
                                                                                                        required>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="TahunLulus">Tahun
                                                                                                        Lulus</label>
                                                                                                    <input type="number"
                                                                                                        id="TahunLulus"
                                                                                                        name="TahunLulus"
                                                                                                        value="{{ $item->user->TahunLulus }}"
                                                                                                        required>
                                                                                                </div>


                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="NamaJenjang">Nama
                                                                                                        Jenjang</label>
                                                                                                    <input type="text"
                                                                                                        id="NamaJenjang"
                                                                                                        name="NamaJenjang"
                                                                                                        value="{{ $item->user->jenjang ? $item->user->jenjang->NamaJenjang : 'Data Jenjang Tidak Tersedia' }}"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="NamaJurusan">Nama
                                                                                                        Jurusan</label>
                                                                                                    <input type="text"
                                                                                                        id="NamaJurusan"
                                                                                                        name="NamaJurusan"
                                                                                                        value="{{ $item->user->jurusan ? $item->user->jurusan->NamaJurusan : 'Data Jurusan Tidak Tersedia' }}"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="TanggalLahir">Tanggal
                                                                                                        Lahir</label>
                                                                                                    <input type="text"
                                                                                                        id="TanggalLahir"
                                                                                                        name="TanggalLahir"
                                                                                                        value="{{ $item->user->TanggalLahir ? date('d F Y', strtotime($item->user->TanggalLahir)) : '' }}"
                                                                                                        readonly>
                                                                                                </div>


                                                                                            </div>
                                                                                        </div>



                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="Alamat">Alamat</label>
                                                                                                    <input type="text"
                                                                                                        id="Alamat"
                                                                                                        name="Alamat"
                                                                                                        value="{{ $item->user->Alamat }}"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">

                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="NilaiRata">Nilai
                                                                                                        Rata-rata</label>
                                                                                                    <input type="number"
                                                                                                        id="NilaiRata"
                                                                                                        name="NilaiRata"
                                                                                                        value="{{ $item->user->NilaiRata }}"
                                                                                                        readonly>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="PekerjaanOrtu">Pekerjaan
                                                                                                        Orang Tua</label>
                                                                                                    <input type="text"
                                                                                                        id="PekerjaanOrtu"
                                                                                                        name="PekerjaanOrtu"
                                                                                                        value="{{ $item->user->PekerjaanOrtu }}"
                                                                                                        readonly>
                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">

                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="PendapatanOrtu">Pendapatan
                                                                                                        Orang Tua</label>
                                                                                                    <input type="text"
                                                                                                        id="PendapatanOrtu"
                                                                                                        name="PendapatanOrtu"
                                                                                                        value="{{ 'Rp. ' . number_format($item->user->PendapatanOrtu, 0, ',', '.') }}"
                                                                                                        readonly>
                                                                                                </div>

                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="Created">Tanggal
                                                                                                        Daftar</label>
                                                                                                    <input type="text"
                                                                                                        id="Created"
                                                                                                        name="Created"
                                                                                                        value="{{ $item->user->created_at ? date('d F Y', strtotime($item->user->created_at)) : '' }}"
                                                                                                        readonly>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                @if ($item->user->riwayatPrestasi->isNotEmpty())
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label
                                                                                                            for="RiwayatPrestasi">Riwayat
                                                                                                            Prestasi</label>
                                                                                                        @foreach ($item->user->riwayatPrestasi as $prestasi)
                                                                                                            <div
                                                                                                                class="row" style="padding-bottom: 10px">
                                                                                                                <div
                                                                                                                    class="col">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="RiwayatPrestasi"
                                                                                                                        name="RiwayatPrestasi[]"
                                                                                                                        value="{{ $prestasi['prestasi'] }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                                <div
                                                                                                                    class="col">
                                                                                                                    <input
                                                                                                                        type="text"
                                                                                                                        id="Tahun"
                                                                                                                        name="Tahun[]"
                                                                                                                        value="{{ $prestasi['tahun'] }}"
                                                                                                                        readonly>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                @endif
                                                                                            </div>
                                                                                        </div>


                                                                                        <br>
                                                                                        {{-- <div class="form-group"
                                                                                            style="text-align: right;">
                                                                                            <input type="submit"
                                                                                                class="theme-btn btn-style-one"></input>
                                                                                        </div> --}}
                                                                                    </form>


                                                                                </div>
                                                                            </div>
                                                                            <!--End Login Form -->
                                                                        </div>
                                                                        <!-- End Login Module -->
                                                                        <a
                                                                            onclick="closeModal()"class="close-modal ">Close</a>
                                                                    </div>
                                                                </div>

                                                                <script>
                                                                    function openModalEdit{{ $item->user->id }}() {
                                                                        var originalDiv = $('.model.modal.edit{{ $item->user->id }}');
                                                                        var originalHtml = originalDiv.html();
                                                                        var newDiv = $(
                                                                            '<div class="jquery-modal blocker current"><div class="model modal edit{{ $item->user->id }}"></div></div>'
                                                                        );
                                                                        newDiv.find('.model.modal.edit{{ $item->user->id }}').css({
                                                                            'opacity': '1',
                                                                            'display': 'inline-block'
                                                                        }).html(originalHtml);
                                                                        $('body').append(newDiv);
                                                                    }
                                                                </script>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    {{ $verifikasi->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function openModalTambah() {
            var originalDiv = $('.model.modal.tambah');
            var originalHtml = originalDiv.html();
            var newDiv = $(
                '<div class="jquery-modal blocker current"><div class="model modal tambah"></div></div>');
            newDiv.find('.model.modal.tambah').css({
                'opacity': '1',
                'display': 'inline-block'
            }).html(originalHtml);
            $('body').append(newDiv);
        }



        function closeModal() {
            $('.jquery-modal.blocker.current').remove();
        }
    </script>

    <script>
        // Tampilkan SweetAlert saat tombol hapus diklik
        function verifikasi(id) {
            var id = id;

            Swal.fire({
                title: 'Verifikasi Akun',
                text: 'Anda yakin ingin memverifikasi akun ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Verifikasi',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the Jurusan
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/users/verifikasi/' + id);
                    form.innerHTML = '@csrf';

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        function reject(id) {
            var id = id;

            Swal.fire({
                title: 'Reject Akun',
                text: 'Anda yakin ingin menolak verifikasi akun ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Reject',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the Jurusan
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/users/reject/' + id);
                    form.innerHTML = '@csrf';

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection

@section('css')
    <style>
        #login-modal {
            max-width: 900px;
        }

        .modal {
            max-width: 900px;
        }
    </style>
@endsection
