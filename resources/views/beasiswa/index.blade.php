@extends('layouts.back.app')

@section('content')
    <!-- Dashboard -->
    <section class="user-dashboard">
        <div class="dashboard-outer">
            <div class="upper-title-box">
                <h3>Beasiswa</h3>
            </div>

            <div class="row">
                <div class="row">
                    <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class="icon fas fa-check-circle"></i>
                            </div>
                            <div class="right">
                                <h4>{{ $original }}</h4>
                                <p>Beasiswa Original</p>
                            </div>
                        </div>
                    </div>
                    <div class="ui-block col-xl-3 col-lg-6 col-md-6 col-sm-12">
                        <div class="ui-item">
                            <div class="left">
                                <i class="icon fas fa-users"></i>
                            </div>
                            <div class="right">
                                <h4>{{ $thirdParty }}</h4>
                                <p>Beasiswa Crawling</p>
                            </div>
                        </div>
                    </div>




                </div>
                <div class="col-lg-12">
                    <!-- Ls widget -->
                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="ls-widget">
                        <div class="tabs-box">
                            <div class="widget-title">
                                <p href="{{ route('dashboard.beasiswa.create') }}" class="theme-btn btn-style-five  ">
                                    Crawling Progress = {{ $crawlingCount }}</p>


                            </div>
                            <div class="widget-title">

                                <div class="row">

                                    @foreach (range(1, ENV('API_COUNT')) as $index)
                                        @php
                                            $name = 'API_NAME' . $index;
                                            $link = 'API_LINK' . $index;
                                        @endphp
                                        <div class="col-md-4 py-2">
                                            <a href="{{ route('index.beasiswa.crawlingOne', $index) }}"
                                                class="theme-btn btn-style-two" >Crawling
                                                {{ ENV($name) }}</a>
                                        </div>
                                    @endforeach
                                    <div class="col-md-4 py-2">
                                        <a href="{{ route('index.beasiswa.crawling') }}"
                                            class="theme-btn btn-style-four">Crawling Semua</a>
                                    </div>
                                </div>



                            </div>
                        </div>
                        <div class="widget-title">
                            <p href="{{ route('dashboard.beasiswa.create') }}" class="theme-btn btn-style-five  ">
                            </p>

                            <div class="chosen-outer">

                                <!-- Button trigger modal -->
                                <a style="margin-left: 30px" href="{{ route('dashboard.beasiswa.create') }}"
                                    class="theme-btn btn-style-one ">Tambah
                                    Beasiswa</a>
                            </div>
                        </div>


                        <div class="widget-content">
                            <div class="table-outer">
                                <table class="default-table manage-job-table">
                                    <thead>
                                        <tr>
                                            <th width="10%">#</th>
                                            <th width="25%">Nama Beasiswa</th>
                                            <th width="20%">Beaiswa</th>
                                            <th width="20%">Insitusi</th>
                                            <th width="20%">Tanggal Pendaftaran</th>
                                            <th width="20%">Referensi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($beasiswa as $item)
                                            <tr>
                                                <td>
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
                                                            <img src="{{ Storage::url($item->kampus->Gambar) }}"
                                                                width="70" height="70" class="img-thumbnail">
                                                        @endif
                                                    @endif
                                                </td>
                                                <td>
                                                    <h6>{{ $item->NamaBeasiswa }}</h6>
                                                    <span class="info"><i class="icon flaticon-map-locator"></i>
                                                        @if ($item->TipeBeasiswa === 'Kampus')
                                                            {{ $item->kampus->Alamat }}
                                                        @else
                                                            {{ $item->perusahaan->Alamat }}
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>

                                                    @if ($item->jenjang->isNotEmpty())
                                                        <strong>Jengjang: </strong>
                                                        @foreach ($item->jenjang as $jenjang)
                                                            {{ $jenjang->NamaJenjang }},
                                                        @endforeach
                                                        <br>
                                                    @endif
                                                    @if ($item->jurusan->isNotEmpty())
                                                        <strong>Jurusan: </strong>
                                                        @foreach ($item->jurusan as $jurusan)
                                                            {{ $jurusan->NamaJurusan }},
                                                        @endforeach
                                                        <br>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->TipeBeasiswa === 'Kampus')
                                                        <strong>Insitusi:</strong> Kampus<br>
                                                        <strong>Kampus:</strong> {{ $item->kampus->NamaKampus }}<br>
                                                        <strong>Kontak:</strong> {{ $item->kampus->Kontak }}
                                                    @else
                                                        <strong>Insitusi:</strong> Non-Kampus<br>
                                                        <strong>Perusahaan:</strong>
                                                        {{ $item->perusahaan->NamaPerusahaan }}<br>
                                                        <strong>Kontak:</strong> {{ $item->perusahaan->Kontak }}
                                                    @endif

                                                </td>
                                                <td>{{ $item->TanggalPendaftaran ? date('d F Y', strtotime($item->TanggalPendaftaran)) : '' }}
                                                    <br> <strong>Sampai</strong> <br>
                                                    {{ $item->TanggalPenutupan ? date('d F Y', strtotime($item->TanggalPenutupan)) : '' }}
                                                </td>
                                                <td>
                                                    @if ($item->CrawlingId == null)
                                                        <strong>Original</span>
                                                        @else
                                                            <strong>Thidiparty</span>
                                                    @endif

                                                </td>
                                                <td>
                                                    <div class="option-box">
                                                        <ul class="option-list">
                                                            <li>
                                                                <div class="btn-group">
                                                                    <a href="{{ route('dashboard.beasiswa.edit', $item->BeasiswaID) }}"
                                                                        class="btn btn-primary" data-toggle="tooltip"
                                                                        data-placement="top" title="Edit Beasiswa">
                                                                        <span class="la la-edit"></span>
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger"
                                                                        onclick="hapus({{ $item->BeasiswaID }})"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Hapus Beasiswa">
                                                                        <span class="la la-trash"></span>
                                                                    </button>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>



                                </table>
                                {{ $beasiswa->links() }}
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
        // Tampilkan SweetAlert saat tombol hapus diklik
        function hapus(id) {
            var BeasiswaId = id;

            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: 'Data Beasiswa akan dihapus secara permanen!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Delete confirmation is confirmed
                    // Proceed with the POST request to delete the Beasiswa
                    var form = document.createElement('form');
                    form.setAttribute('method', 'POST');
                    form.setAttribute('action', '/dashboard/beasiswa/' + BeasiswaId);
                    form.innerHTML = '@csrf @method('DELETE')';

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection

@section('css')
@endsection
