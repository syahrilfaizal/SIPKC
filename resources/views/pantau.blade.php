@extends('layout.app')

@section('title', 'Pantau')
{{-- <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" /> --}}

@push('style')
    <!-- DataTable CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <style>
        /* Styling untuk Card */




        /* Styling untuk Status */
        .status {
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
            color: #fff;
        }

        .status.menunggu {
            background-color: #dc3545;
            /* Merah */
        }

        .status.diproses {
            background-color: #ffc107;
            /* Kuning */
        }

        .status.selesai {
            background-color: #28a745;
            /* Hijau */
        }

        /* Styling untuk Gambar */
        .table img {
            border-radius: 5px;
            max-width: 100px;
            height: auto;
        }
    </style>
@endpush


@section('content')
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <!-- loader wrapper -->
            <div class="preloader-wrap p-3">
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer mb-3">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
            </div>
            <!-- loader wrapper -->



            @if (auth()->user()->role !== 'admin')

            @foreach ($reports as $report)
                <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                    <div class="card-body p-0 d-flex">
                        <figure class="avatar me-3">
                            <img src="{{ asset('images/user-7.png') }}" alt="image" class="shadow-sm rounded-circle w45">
                        </figure>
                        <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                            {{ $report->user->name }}
                            <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                                {{ $report->created_at->diffForHumans() }}
                            </span>
                        </h4>
                        <div class="flex-grow-1 d-flex flex-row-reverse ms-auto">
                            <div class="fw-600 btn position-relative text-grey-900 text-dark font-xs">
                                <div class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-success">
                                    {{ $report->status }}
                                </div>
                            </div>
                        </div>
                        <a href="#" class="ms-auto" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i>
                        </a>

                        {{-- <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg">
                            <div class="card-body p-0 d-flex">
                                <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link</h4>
                            </div>
                            <!-- Tambahkan opsi lainnya di sini -->
                        </div> --}}
                    </div>
                    <div class="card-body p-0">
                        @foreach ($report->categories as $category)
                            <span class="badge rounded-pill bg-primary-gradiant me-2">{{ $category->name }}</span>
                        @endforeach
                    </div>

                    <div class="card-body p-0 me-lg-5">
                        <p class="fw-500 lh-26 font-xssss w-100">
                            {{ $report->desc }}
                        </p>
                    </div>

                    <div class="card-body d-block p-0">
                        <div class="row ps-2 pe-2" style="max-height: 300px; overflow-y: auto;">
                            @if ($report->image_url)
                                <div class="p-1">
                                    <a href="{{ asset($report->image_url) }}" data-lightbox="roadtrip">
                                        <img src="{{ asset('storage/' . $report->image_url) }}" class="rounded-3 w-100"
                                            alt="image">
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0 me-lg-5">
                        <p class="fw-500  lh-26 font-xssss w-100">
                            {{ $report->location }}
                        </p>
                    </div>

                    <div class="card-body d-flex p-0 mt-3">
                        <a href="#"
                            class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2 like-btn"
                            data-report-id="{{ $report->id }}"
                            data-is-liked="{{ $report->likes->where('user_id', auth()->id())->count() > 0 }}">
                            <i
                                class="feather-heart me-2 btn-round-xs font-xss {{ $report->likes->where('user_id', auth()->id())->count() > 0 ? 'bg-red-gradiant text-white' : 'bg-white text-grey-900' }}"></i>
                            <span class="like-count ms-2 text-grey-600">{{ $report->likes()->count() }}</span>
                        </a>

                        {{-- {{-- <a href="#"
                            class="location-btn ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"
                            data-lat="{{ $report->lat }}" data-lng="{{ $report->lng }}">
                            <i class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i>
                            <span class="d-none-xs">Lokasi</span>
                        </a> --}}
                    </div>
                </div>
            @endforeach
            @else
                <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                    <div class="card-body p-0">
                        <div id="map" style="height: 400px; width: 100%;"></div>
                    </div>
                </div>
                <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                    {{-- <h5 class="mb-4">Laporan Status</h5> --}}
                    <table id="reportTable" class="table table-striped table-bordered table-hover dt-responsive">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Description</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reports as $report)
                                <tr>
                                    <td>{{ $report->user->name }}</td>
                                    <td class="ellipsis">{{ $report->desc }}</td>
                                    <td class="ellipsis">{{ $report->location }}</td>
                                    <td>
                                        <div class="d-flex align-self-center">
                                            <div class="rounded-circle d-flex align-items-center "
                                                style="width: 20px; height: 20px; background-color: {{ $report->status == 'menunggu' ? 'red' : ($report->status == 'diproses' ? 'yellow' : 'green') }}">
                                            </div>
                                            <form class="status-form" data-report-id="{{ $report->id }}">
                                                @csrf
                                                <select class="status-select" name="status"
                                                    style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;">


                                                    <option value="menunggu"
                                                        {{ $report->status == 'menunggu' ? 'selected' : '' }}
                                                        class="status-menunggu">Menunggu</option>
                                                    <option value="diproses"
                                                        {{ $report->status == 'diproses' ? 'selected' : '' }}
                                                        class="status-diproses">Diproses</option>
                                                    <option value="selesai"
                                                        {{ $report->status == 'selesai' ? 'selected' : '' }}
                                                        class="status-selesai">Selesai</option>
                                                </select>
                                            </form>
                                        </div>

                                    </td>
                                    <td>
                                        @foreach ($report->categories as $category)
                                            <span
                                                class="badge rounded-pill bg-primary-gradiant me-2">{{ $category->name }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        @if ($report->image_url)
                                            <img src="{{ asset('storage/' . $report->image_url) }}" alt="Image">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            @endif

            {{-- <div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                    
                </div>
            </div> --}}


            {{-- <div class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
                <div class="card-body p-0 d-flex">
                    <figure class="avatar me-3"><img src="images/user-8.png" alt="image"
                            class="shadow-sm rounded-circle w45"></figure>
                    <h4 class="fw-700 text-grey-900 font-xssss mt-1">Anthony Daugloi <span
                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">2 hour ago</span></h4>
                    <a href="#" class="ms-auto" id="dropdownMenu5" data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss"></i></a>
                    <div class="dropdown-menu dropdown-menu-start p-4 rounded-xxl border-0 shadow-lg"
                        aria-labelledby="dropdownMenu5">
                        <div class="card-body p-0 d-flex">
                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Save Link <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved
                                    items</span></h4>
                        </div>
                        <div class="card-body p-0 d-flex mt-2">
                            <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide Post <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved
                                    items</span></h4>
                        </div>
                        <div class="card-body p-0 d-flex mt-2">
                            <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">Hide all from Group <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved
                                    items</span></h4>
                        </div>
                        <div class="card-body p-0 d-flex mt-2">
                            <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">Unfollow Group <span
                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved
                                    items</span></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0 mb-3 rounded-3 overflow-hidden">
                    <video controls autoplay loop class="float-right w-100">
                        <source src="images/pohonrubuh.mp4" type="video/mp4">
                    </video>
                </div>

                <div class="card-body p-0 me-lg-5">
                    <p class="fw-500 text-grey-500 lh-26 font-xssss w-100 mb-2">Lorem ipsum dolor sit amet, consectetur
                        adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus
                        mollis pharetra. Proin blandit ac massa sed rhoncus <a href="#"
                            class="fw-600 text-primary ms-2">See more</a></p>
                </div>
                <div class="card-body d-flex p-0">
                    <a href="#"
                        class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2"><i
                            class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss"></i> <i
                            class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss"></i>2.8K Like</a>
                    <div class="emoji-wrap">
                        <ul class="emojis list-inline mb-0">
                            <li class="emoji list-inline-item"><i class="em em---1"></i> </li>
                            <li class="emoji list-inline-item"><i class="em em-angry"></i></li>
                            <li class="emoji list-inline-item"><i class="em em-anguished"></i> </li>
                            <li class="emoji list-inline-item"><i class="em em-astonished"></i> </li>
                            <li class="emoji list-inline-item"><i class="em em-blush"></i></li>
                            <li class="emoji list-inline-item"><i class="em em-clap"></i></li>
                            <li class="emoji list-inline-item"><i class="em em-cry"></i></li>
                            <li class="emoji list-inline-item"><i class="em em-full_moon_with_face"></i></li>
                        </ul>
                    </div>
                    <a href="#" class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                            class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg"></i><span
                            class="d-none-xss">22 Comment</span></a>
                    <a href="#"
                        class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss"><i
                            class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg"></i><span
                            class="d-none-xs">Share</span></a>
                </div>
            </div> --}}
        </div>

        <!-- main content -->

        <!-- right chat -->
        <div class="right-chat nav-wrap mt-2 right-scroll-bar">
            <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">

                <!-- loader wrapper -->
                <div class="preloader-wrap p-3">
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="box shimmer mb-3">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                    <div class="box shimmer">
                        <div class="lines">
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                            <div class="line s_shimmer"></div>
                        </div>
                    </div>
                </div>
                <!-- loader wrapper -->
            </div>
        </div>

        <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                <div class="card-body d-flex align-items-center p-4">
                    <h4 class="fw-700 mb-0 font-xssss text-grey-900">Download Data</h4>
                </div>

                <!-- Berdasarkan Kategori -->
                <div class="card-body p-3 border-top-xs bor-0">
                    <h4 class="fw-700 font-xss mb-3">Berdasarkan Kategori</h4>

                    <!-- Infrastruktur -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="feather-briefcase text-grey-500 me-3 font-lg"></i>
                        <div>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0">Infrastruktur</h4>
                            <div class="d-flex">
                                <a href="{{ route('exportpdf', ['categoryId' => 1]) }}"
                                    class="btn btn-sm bg-primary-gradiant me-2 text-white font-xssss">PDF</a>
                                <a href="{{ url('/export/1') }}"
                                    class="btn btn-sm bg-primary-gradiant text-white font-xssss">Excel</a>
                            </div>
                        </div>
                    </div>

                    <!-- Sampah -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="feather-trash-2 text-grey-500 me-3 font-lg"></i>
                        <div>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0">Sampah</h4>
                            <div class="d-flex">
                                <a href="{{ route('exportpdf', ['categoryId' => 2]) }}"
                                    class="btn btn-sm bg-primary-gradiant me-2 text-white font-xssss">PDF</a>
                                <a href="{{ url('/export/2') }}"
                                    class="btn btn-sm bg-primary-gradiant text-white font-xssss">Excel</a>
                            </div>
                        </div>
                    </div>

                    <!-- Lingkungan -->
                    <div class="d-flex align-items-center mb-3">
                        <i class="feather-sun text-grey-500 me-3 font-lg"></i>
                        <div>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0">Lingkungan</h4>
                            <div class="d-flex">
                                <a href="{{ route('exportpdf', ['categoryId' => 3]) }}"
                                    class="btn btn-sm bg-primary-gradiant me-2 text-white font-xssss">PDF</a>
                                <a href="{{ url('/export/3') }}"
                                    class="btn btn-sm bg-primary-gradiant text-white font-xssss">Excel</a>
                            </div>
                        </div>
                    </div>

                    <!-- Lalu Lintas -->
                    <div class="d-flex align-items-center">
                        <i class="feather-navigation text-grey-500 me-3 font-lg"></i>
                        <div>
                            <h4 class="fw-600 text-grey-900 font-xssss mt-0">Lalu Lintas</h4>
                            <div class="d-flex">
                                <a href="{{ route('exportpdf', ['categoryId' => 4]) }}"
                                    class="btn btn-sm bg-primary-gradiant me-2 text-white font-xssss">PDF</a>
                                <a href="{{ url('/export/4') }}"
                                    class="btn btn-sm bg-primary-gradiant text-white font-xssss">Excel</a>
                            </div>
                        </div>
                    </div>
                </div>


            @endsection

            @push('scripts')
                <!-- DataTable CSS -->
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.dataTables.css">
                <!-- DataTable JS -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>


                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                    // Inisialisasi peta dan atur pusat koordinat (contoh: Balikpapan)
                    var map = L.map('map').setView([-1.2379, 116.8529], 13); // Default ke Balikpapan

                    // Tambahkan tile layer dari OpenStreetMap
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    // Fungsi untuk menentukan warna marker berdasarkan status
                    function getMarkerColor(status) {
                        switch (status) {
                            case 'menunggu':
                                return 'red'; // Merah untuk status menunggu
                            case 'diproses':
                                return 'yellow'; // Kuning untuk status diproses
                            case 'selesai':
                                return 'green'; // Hijau untuk status selesai
                            default:
                                return 'blue'; // Default ke biru jika status tidak dikenal
                        }
                    }

                    // Loop untuk menambahkan marker berdasarkan data laporan
                    @foreach ($reports as $report)
                        @if ($report->lat && $report->lng)
                            // Menentukan warna berdasarkan status laporan
                            var markerColor = getMarkerColor("{{ $report->status }}");

                            // Menambahkan marker dengan warna yang sesuai
                            var marker = L.circleMarker([{{ $report->lat }}, {{ $report->lng }}], {
                                color: markerColor,
                                radius: 8, // Ukuran marker
                                fillColor: markerColor,
                                fillOpacity: 0.7
                            }).addTo(map);

                            // Menambahkan popup dengan informasi laporan
                            marker.bindPopup(
                                "<b>{{ $report->user->name }}</b><br>{{ $report->desc }}<br>Status: <b>{{ $report->status }}</b>"
                            ).openPopup();
                        @endif
                    @endforeach
                </script>
                <script>
                    $(document).ready(function() {
                        $('#reportTable').DataTable({
                            scrollX: true,

                        });
                    });
                </script>

                <script>
                    $(document).ready(function() {
                        $('.status-select').change(function() {
                            const form = $(this).closest('form');
                            const reportId = form.data('report-id');
                            const status = $(this).val();

                            $.ajax({
                                url: `/reports/${reportId}/update-status`,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    status: status
                                },
                                success: function(response) {
                                    // Add visual feedback
                                    const select = form.find('.status-select');
                                    select.removeClass('status-menunggu status-diproses status-selesai')
                                        .addClass(`status-${status}`);

                                    // Optional: Show success message
                                    alert('Status updated successfully');
                                },
                                error: function(xhr) {
                                    alert('Error updating status');
                                    // Revert to previous value on error
                                    $(this).val($(this).data('previous-value'));
                                }
                            });
                        }).each(function() {
                            // Store initial value
                            $(this).data('previous-value', $(this).val());
                        });
                    });
                </script>
            @endpush
