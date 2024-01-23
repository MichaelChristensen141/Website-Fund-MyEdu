@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Kelola Users</h3>
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
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>
                                                        @if (empty($user->Gambar))
                                                            <img src="{{ url('/images/telkom.jpeg') }}" width="70"
                                                                height="70" class="img-thumbnail">
                                                        @else
                                                            <img src="{{ Storage::url($user->Gambar) }}" width="70"
                                                                height="70" class="img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <h6>{{ $user->NamaDepan }} {{ $user->NamaBelakang }}</h6>
                                                        {{ $user->email }}
                                                    </td>
                                                    <td>
                                                        @if ($user->jurusan)
                                                            {{ $user->jurusan->NamaJurusan }}
                                                        @else
                                                            <span style="color: red;">Data Jurusan Tidak Tersedia</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($user->jenjang)
                                                            {{ $user->jenjang->NamaJenjang }}
                                                        @else
                                                            <span style="color: red;">Data Jenjang Tidak Tersedia</span>
                                                        @endif
                                                    </td>


                                                    <td class="status">
                                                        {{ $user->created_at ? date('d F Y', strtotime($user->created_at)) : '' }}
                                                    </td>
                                                    <td>
                                                        @if (!empty($user->Status))
                                                            {{ ucfirst($user->Status) }}
                                                        @else
                                                            Tidak Aktif
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="option-box">
                                                            <ul class="option-list">

                                                                <li><button data-text="Lihat Akun  {{ $user->NamaDepan }}"
                                                                        onclick="openModalEdit{{ $user->id }}()"><span
                                                                            class="la la-eye"></span></button></li>


                                                                {{-- modal --}}
                                                                <div class="model modal edit{{ $user->id }}"
                                                                    style="opacity: 1; display: none;">
                                                                    <div class="model modal"
                                                                        style="opacity: 1; display: inline-block;">
                                                                        <!-- Login modal -->
                                                                        <div id="login-modal">
                                                                            <!-- Login Form -->
                                                                            <div class="login-form default-form">
                                                                                <h3>Lihat Data Users
                                                                                    {{ $user->NamaDepan }}
                                                                                </h3>
                                                                                <div class="form-inner">

                                                                                    <!-- Form to Add Jurusan -->
                                                                                    <form method="POST"
                                                                                        action="{{ route('masterdata.jurusan.update', $user->id) }}">
                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <div class="form-group">
                                                                                                    <label
                                                                                                        for="NamaDepan">Nama
                                                                                                        Lengkap
                                                                                                    </label>
                                                                                                    <input type="text"
                                                                                                        id="NamaDepan"
                                                                                                        name="NamaDepan"
                                                                                                        value="{{ $user->NamaDepan }} {{ $user->NamaBelakang }}"
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
                                                                                                        value="{{ $user->email }}"
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
                                                                                                        value="{{ $user->TahunLulus }}"
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
                                                                                                        value="{{ $user->jenjang ? $user->jenjang->NamaJenjang : 'Data Jenjang Tidak Tersedia' }}"
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
                                                                                                        value="{{ $user->jurusan ? $user->jurusan->NamaJurusan : 'Data Jurusan Tidak Tersedia' }}"
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
                                                                                                        value="{{ $user->TanggalLahir ? date('d F Y', strtotime($user->TanggalLahir)) : '' }}"
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
                                                                                                        value="{{ $user->Alamat }}"
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
                                                                                                        value="{{ $user->NilaiRata }}"
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
                                                                                                        value="{{ $user->PekerjaanOrtu }}"
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
                                                                                                        value="{{ 'Rp. ' . number_format($user->PendapatanOrtu, 0, ',', '.') }}"
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
                                                                                                        value="{{ $user->created_at ? date('d F Y', strtotime($user->created_at)) : '' }}"
                                                                                                        readonly>
                                                                                                </div>

                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                @if ($user->riwayatPrestasi->isNotEmpty())
                                                                                                    <div
                                                                                                        class="form-group">
                                                                                                        <label
                                                                                                            for="RiwayatPrestasi">Riwayat
                                                                                                            Prestasi</label>
                                                                                                        @foreach ($user->riwayatPrestasi as $prestasi)
                                                                                                            <div class="row"
                                                                                                                style="padding-bottom: 10px">
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
                                                                    function openModalEdit{{ $user->id }}() {
                                                                        var originalDiv = $('.model.modal.edit{{ $user->id }}');
                                                                        var originalHtml = originalDiv.html();
                                                                        var newDiv = $(
                                                                            '<div class="jquery-modal blocker current"><div class="model modal edit{{ $user->id }}"></div></div>'
                                                                        );
                                                                        newDiv.find('.model.modal.edit{{ $user->id }}').css({
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

                                    {{ $users->links() }}
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
        function hapus(id) {
            var id = id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Jurusan akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the Jurusan
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/masterdata/jurusan/' + id);
                    form.innerHTML = '@csrf @method('DELETE')';

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
