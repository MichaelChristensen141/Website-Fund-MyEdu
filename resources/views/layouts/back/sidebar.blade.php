<!-- User Sidebar -->
<div class="user-sidebar">

    <div class="sidebar-inner">
        <ul class="navigation">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="la la-home"></i> Dashboard
                </a>
            </li>
            <!-- Master Data -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#masterDataCollapse" role="button" aria-expanded="false"
                    aria-controls="masterDataCollapse" onclick="masterIcon(this)">
                    <i class="la fas fa-database"></i> Master Data &nbsp; &nbsp;
                    <i
                        class="la fas {{ request()->routeIs('masterdata.kampus.*') ? 'fa-chevron-down' : 'fa-chevron-right' }} float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('masterdata.*') ? 'show' : '' }}" id="masterDataCollapse"
                    style="padding-left:20px">
                    <ul class="nav flex-column ml-3">
                        <!-- Menu Kampus -->
                        <li class="{{ request()->routeIs('masterdata.kampus.index') ? 'active' : '' }}">
                            <a href="{{ route('masterdata.kampus.index') }}">
                                <i class="la far fa-school"></i> Kampus
                            </a>
                        </li>
                        <!-- Menu Perusahaan -->
                        <li class="{{ request()->routeIs('masterdata.perusahaan.index') ? 'active' : '' }}">
                            <a href="{{ route('masterdata.perusahaan.index') }}">
                                <i class="la fas fa-building"></i> Perusahaan
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('masterdata.jenjang.index') ? 'active' : '' }}">
                            <a href="{{ route('masterdata.jenjang.index') }}">
                                <i class="la fas fa-graduation-cap"></i> Jenjang
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('masterdata.jurusan.index') ? 'active' : '' }}">
                            <a href="{{ route('masterdata.jurusan.index') }}">
                                <i class="la fas fa-globe"></i> Jurusan
                            </a>
                        </li>


                        <!-- Tambahkan menu lainnya di sini -->
                    </ul>
                </div>
            </li>

            <!-- Beasiswa Data -->
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#beasiswaDataCollapse" role="button"
                    aria-expanded="false" aria-controls="beasiswaDataCollapse" onclick="masterIcon(this)">
                    <i class="fas fa-university"></i> Beasiswa &nbsp; &nbsp;
                    <i
                        class="la fas {{ request()->routeIs('dashboard.beasiswa.*') ? 'fa-chevron-down' : 'fa-chevron-right' }} float-right"></i>
                </a>
                <div class="collapse {{ request()->routeIs('dashboard.beasiswa.*') ? 'show' : '' }}"
                    id="beasiswaDataCollapse" style="padding-left:20px">
                    <ul class="nav flex-column ml-3">

                        <li class="{{ request()->routeIs('dashboard.beasiswa.create') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.beasiswa.create') }}">
                                <i class="la far fa-school"></i> Tambah Beasiswa
                            </a>
                        </li>

                        <li class="{{ request()->routeIs('dashboard.beasiswa.index') ? 'active' : '' }}">
                            <a href="{{ route('dashboard.beasiswa.index') }}">
                                <i class="fas fa-user-graduate"></i> Lihat Beasiswa
                            </a>
                        </li>


                        <!-- Tambahkan menu lainnya di sini -->
                    </ul>
                </div>
            </li>

            <li class="{{ request()->routeIs('dashboard.users') ? 'active' : '' }}">
                <a href="{{ route('dashboard.users') }}">
                    <i class="fas fa-user"></i> Kelola Users
                </a>
            </li>

            @php
                $pendingVerifikasiCount = \App\Models\Verifikasi::where('status', 'pending')->count();
            @endphp

            <li class="{{ request()->routeIs('dashboard.users.verifikasi') ? 'active' : '' }}">
                <a href="{{ route('dashboard.users.verifikasi') }}">
                    <i class="fas fa-user-cog"></i> Verifikasi Users
                    @if ($pendingVerifikasiCount > 0)
                    <span class="badge text-red">{{ $pendingVerifikasiCount }}</span>
                    @endif
                </a>
            </li>





        </ul>
    </div>


</div>
<!-- End User Sidebar -->
