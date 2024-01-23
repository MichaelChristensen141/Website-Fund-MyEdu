@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Jenjang</h3>
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
                                        Jenjang</button>
                                </div>
                            </div>

                            <div class="widget-content">
                                <div class="table-outer">
                                    <table class="default-table manage-job-table">
                                        <thead>
                                            <tr>

                                                <th width="20%">Nama Jenjang</th>
                                                <th width="30%">Deskripsi</th>
                                                <th>Created At</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($jenjang as $item)
                                                <tr>

                                                    <td>
                                                        <h6>{{ $item->NamaJenjang }}</h6>
                                                    </td>
                                                    <td>{{ $item->Deskripsi }}</td>
                                                    <td class="status">{{ $item->created_at }}</td>
                                                    <td>
                                                        <div class="option-box">
                                                            <ul class="option-list">

                                                                <li><button data-text="Reject Aplication"
                                                                        onclick="openModalEdit{{ $item->JenjangID }}()"><span
                                                                            class="la la-pencil"></span></button></li>
                                                                <li><button data-text="Hapus Jenjang"
                                                                        onclick="hapus({{ $item->JenjangID }})"><span
                                                                            class="la la-trash"></span></button></li>

                                                                {{-- modal --}}
                                                                <div class="model modal edit{{ $item->JenjangID }}"
                                                                    style="opacity: 1; display: none;">
                                                                    <div class="model modal"
                                                                        style="opacity: 1; display: inline-block;">
                                                                        <!-- Login modal -->
                                                                        <div id="login-modal">
                                                                            <!-- Login Form -->
                                                                            <div class="login-form default-form">
                                                                                <h3>Edit Data Jenjang
                                                                                    {{ $item->NamaJenjang }}
                                                                                </h3>
                                                                                <div class="form-inner">

                                                                                    <!-- Form to Add Jenjang -->
                                                                                    <form method="POST"
                                                                                        action="{{ route('masterdata.jenjang.update', $item->JenjangID) }}">
                                                                                        @csrf
                                                                                        @method('PUT')

                                                                                        <div class="form-group">
                                                                                            <label for="NamaJenjang">Nama
                                                                                                Jenjang</label>
                                                                                            <input type="text"
                                                                                                id="NamaJenjang"
                                                                                                name="NamaJenjang"
                                                                                                value="{{ $item->NamaJenjang }}"
                                                                                                required>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label
                                                                                                for="Deskripsi">Deskripsi</label>
                                                                                            <textarea id="Deskripsi" name="Deskripsi" required> {{ $item->Deskripsi }}</textarea>
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
                                                                    function openModalEdit{{ $item->JenjangID }}() {
                                                                        var originalDiv = $('.model.modal.edit{{ $item->JenjangID }}');
                                                                        var originalHtml = originalDiv.html();
                                                                        var newDiv = $(
                                                                            '<div class="jquery-modal blocker current"><div class="model modal edit{{ $item->JenjangID }}"></div></div>'
                                                                        );
                                                                        newDiv.find('.model.modal.edit{{ $item->JenjangID }}').css({
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
                                    {{ $jenjang->links() }}
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
                    <h3>Tambah Data Jenjang</h3>
                    <div class="form-inner">

                        <!-- Form to Add Jenjang -->
                        <form method="POST" action="{{ route('masterdata.jenjang.store') }}">
                            @csrf

                            <div class="form-group">
                                <label for="NamaJenjang">Nama Jenjang</label>
                                <input type="text" id="NamaJenjang" name="NamaJenjang" placeholder="Nama Jenjang"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="Deskripsi">Deskripsi</label>
                                <textarea id="Deskripsi" name="Deskripsi" placeholder="Deskripsi" required></textarea>
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
            var jenjangId = id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Jenjang akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the jenjang
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/masterdata/jenjang/' + jenjangId);
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
