<!-- resources/views/home.blade.php -->

@extends('layout.app')

@section('title', 'Home')

@section('content')
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <!-- Loader Wrapper -->
            <div class="preloader-wrap p-3">
                <!-- ... (kode loader Anda) ... -->
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
            <!-- End Loader Wrapper -->

            <!-- Daftar Laporan -->
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

            <!-- Carousel Kategori (Jika Diperlukan) -->
            <div class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                <div class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                    <!-- Tambahkan slide kategori jika diperlukan -->
                </div>
            </div>
        </div>

        <!-- Right Chat -->
        <div class="right-chat nav-wrap mt-2 right-scroll-bar">
            <div class="middle-sidebar-right-content bg-white shadow-xss rounded-xxl">
                <!-- Loader Wrapper -->
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
                <!-- End Loader Wrapper -->
            </div>
        </div>

        <!-- Sidebar Kanan untuk Download Data -->
        <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
            <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                <div class="card-body d-flex align-items-center p-4">
                    <h4 class="fw-700 mb-0 font-xssss text-grey-900">Download Data</h4>
                </div>

                <!-- Berdasarkan Kategori -->
                <div class="card-body p-3 border-top-xs bor-0">
                    <h4 class="fw-700 font-xss mb-3">Berdasarkan Kategori</h4>

                    @foreach ($categories as $category)
                        <div class="d-flex align-items-center mb-3">
                            <!-- Anda dapat menyesuaikan ikon berdasarkan kategori jika ada -->
                            <i class="feather-{{ $category->icon ?? 'folder' }} text-grey-500 me-3 font-lg"></i>
                            <div>
                                <h4 class="fw-600 text-grey-900 font-xssss mt-0">{{ $category->name }}</h4>
                                <div class="d-flex">
                                    <a href="{{ route('exportpdf', ['categoryId' => $category->id]) }}"
                                        class="btn btn-sm bg-primary-gradiant me-2 text-white font-xssss">PDF</a>
                                    <a href="{{ route('exportexcel', ['id' => $category->id]) }}"
                                        class="btn btn-sm bg-primary-gradiant text-white font-xssss">Excel</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Berdasarkan Tahun (Jika Diperlukan) -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Fungsi untuk membuka peta dengan marker
        function openMapModal(lat, lng) {
            var map = L.map('map').setView([lat, lng], 13); // Atur lat, lng dan zoom level

            // Menambahkan tile layer (OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Menambahkan marker di lokasi
            L.marker([lat, lng]).addTo(map)
                .bindPopup("Lokasi Laporan")
                .openPopup();
        }

        // Event listener untuk tombol lokasi
        document.querySelectorAll('.location-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                // Ambil data lat, lng dari data atribut
                var lat = this.getAttribute('data-lat');
                var lng = this.getAttribute('data-lng');

                // Panggil fungsi untuk membuka peta dengan marker
                openMapModal(lat, lng);
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
    $('.like-btn').click(function(e) {
        e.preventDefault();
        
        const button = $(this);
        const reportId = button.data('report-id');
        
        $.ajax({
            url: `/reports/${reportId}/like`,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    if (response.isLiked) {
                        button.find('.feather-heart')
                              .removeClass('bg-white text-grey-900')
                              .addClass('bg-red-gradiant text-white');
                    } else {
                        button.find('.feather-heart')
                              .removeClass('bg-red-gradiant text-white')
                              .addClass('bg-white text-grey-900');
                    }
                    // Update jumlah like
                    button.find('.like-count').text(response.likeCount);
                }
            },
            error: function(xhr) {
                if (xhr.status == 401) {
                    window.location.href = '/login';
                }
            }
        });
    });
});
    </script>
@endpush
