@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Perusahaan</h3>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <h4></h4>

                                <div class="chosen-outer">
                                    <!-- Button trigger modal -->
                                    <button type="button" onclick="openModalTambah()"
                                        class="theme-btn btn-style-one ">Tambah
                                        Perusahaan</button>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                            <tr>
                                                <th width="20%">#</th>
                                                <th width="40%">Nama Perusahaan</th>
                                                <th>Kontak</th>
                                                <th>Website</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($perusahaan as $item)
                                                <tr>
                                                    <td>
                                                        @if (empty($item->Gambar))
                                                            <img src="{{ url('/images/telkom.jpeg') }}" width="70"
                                                                height="70" class="img-thumbnail">
                                                        @else
                                                            <img src="{{ Storage::url($item->Gambar) }}" width="70"
                                                                height="70" class="img-thumbnail">
                                                        @endif
                                                    </td>
                                                    <td>

                                                        <h6>{{ $item->NamaPerusahaan }}</h6>
                                                        <span class="info"><i class="icon flaticon-map-locator"></i>
                                                            {{ $item->Alamat }}</span>
                                                    </td>
                                                    <td>{{ $item->Kontak }}</td>
                                                    <td>{{ $item->Website }}</td>
                                                    <td class="status">{{ $item->created_at }}</td>
                                                    <td>
                                                        <div class="option-box">
                                                            <ul class="option-list">

                                                                <li><button data-text="Edit Perusahaan"
                                                                        onclick="openModalEdit{{ $item->PerusahaanID }}()"><span
                                                                            class="la la-pencil"></span></button></li>
                                                                <li><button data-text="Hapus Perusahaan"
                                                                        onclick="hapus({{ $item->PerusahaanID }})"><span
                                                                            class="la la-trash"></span></button></li>

                                                                {{-- modal --}}
                                                                <div class="model modal edit{{ $item->PerusahaanID }}"
                                                                    style="opacity: 1; display: none;">
                                                                    <div class="model modal"
                                                                        style="opacity: 1; display: inline-block;">
                                                                        <!-- Login modal -->
                                                                        <div id="login-modal">
                                                                            <!-- Login Form -->
                                                                            <div class="login-form default-form">
                                                                                <h3>Edit Data Perusahaan
                                                                                    {{ $item->NamaPerusahaan }}
                                                                                </h3>
                                                                                <div class="form-inner">

                                                                                    <!-- Form to Add Perusahaan -->
                                                                                    <form method="POST"
                                                                                        action="{{ route('masterdata.perusahaan.update', $item->PerusahaanID) }}" enctype="multipart/form-data">
                                                                                        @csrf
                                                                                        @method('PUT')
                                                                                        <div style="text-align: center;">
                                                                                            @if (!empty($item->Gambar))
                                                                                                <img src="{{ Storage::url($item->Gambar) }}"
                                                                                                    width="70"
                                                                                                    height="70"
                                                                                                    class="img-thumbnail">
                                                                                            @endif
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="gambar">Logo Kampus</label>
                                                                                            <div class="mb-3">
                                                                                                <input class="form-control" type="file" id="formFile" name="image">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="NamaPerusahaan">Nama
                                                                                                Perusahaan</label>
                                                                                            <input type="text"
                                                                                                id="NamaPerusahaan"
                                                                                                name="NamaPerusahaan"
                                                                                                value="{{ $item->NamaPerusahaan }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="Alamat">Alamat</label>
                                                                                            <input type="text"
                                                                                                id="Alamat"
                                                                                                name="Alamat"
                                                                                                value="{{ $item->Alamat }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="Kontak">Kontak</label>
                                                                                            <input type="text"
                                                                                                id="Kontak"
                                                                                                name="Kontak"
                                                                                                value="{{ $item->Kontak }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="Website">Website</label>
                                                                                            <input type="text"
                                                                                                id="Website"
                                                                                                name="Website"
                                                                                                value="{{ $item->Website }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group"
                                                                                            style="text-align: right;">
                                                                                            <input type="submit"
                                                                                                class="theme-btn btn-style-one"></input>
                                                                                        </div>
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
                                                                    function openModalEdit{{ $item->PerusahaanID }}() {
                                                                        var originalDiv = $('.model.modal.edit{{ $item->PerusahaanID }}');
                                                                        var originalHtml = originalDiv.html();
                                                                        var newDiv = $(
                                                                            '<div class="jquery-modal blocker current"><div class="model modal edit{{ $item->PerusahaanID }}"></div></div>'
                                                                        );
                                                                        newDiv.find('.model.modal.edit{{ $item->PerusahaanID }}').css({
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
                                    {{ $perusahaan->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>



    <div class="model modal tambah" style="opacity: 1; display: none;">
        <div class="model modal" style="opacity: 1; display: inline-block;">
            <!-- Login modal -->
            <div id="login-modal">
                <!-- Login Form -->
                <div class="login-form default-form">
                    <h3>Tambah Data Perusahaan</h3>
                    <div class="form-inner">

                        <!-- Form to Add Perusahaan -->
                        <form method="POST" action="{{ route('masterdata.perusahaan.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="gambar">Logo Perusahaan</label>
                                <div class="mb-3">
                                    <input class="form-control" type="file" id="formFile" name="image">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="NamaPerusahaan">Nama Perusahaan</label>
                                <input type="text" id="NamaPerusahaan" name="NamaPerusahaan"
                                    placeholder="Nama Perusahaan" required>
                            </div>

                            <div class="form-group">
                                <label for="Alamat">Alamat</label>
                                <input type="text" id="Alamat" name="Alamat" placeholder="Alamat" required>
                            </div>

                            <div class="form-group">
                                <label for="Kontak">Kontak</label>
                                <input type="text" id="Kontak" name="Kontak" placeholder="Kontak" required>
                            </div>

                            <div class="form-group">
                                <label for="Website">Website</label>
                                <input type="text" id="Website" name="Website" placeholder="Website" required>
                            </div>

                            <div class="form-group" style="text-align: right;">
                                <input type="submit" class="theme-btn btn-style-one"></input>
                            </div>
                        </form>


                    </div>
                </div>
                <!--End Login Form -->
            </div>
            <!-- End Login Module -->


            <a onclick="closeModal()"class="close-modal ">Close</a>
        </div>
    </div>
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
            var perusahaanId = id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Perusahaan akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the perusahaan
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/masterdata/perusahaan/' + perusahaanId);
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
            max-width: 700px;
        }

        .modal {
            max-width: 700px;
        }
    </style>
@endsection
