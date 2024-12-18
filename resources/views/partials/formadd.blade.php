<!-- Tambahkan ini di dalam <head> untuk memasukkan CSS Leaflet -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

<style>
    /* CSS yang sudah Anda miliki */
    .btn-create-post {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #4caf50;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .btn-create-post i {
        font-size: 16px;
        margin-right: 8px;
    }

    .btn-create-post:hover {
        background-color: #45a049;
        transform: scale(1.02);
    }

    .btn-create-post:active {
        transform: scale(0.98);
    }

    /* Tombol Reset Marker */
    .btn-remove-marker {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #f44336;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        padding: 10px;
        border-radius: 5px;
        border: none;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin-top: 10px;
    }

    .btn-remove-marker i {
        font-size: 16px;
        margin-right: 8px;
    }

    .btn-remove-marker:hover {
        background-color: #d32f2f;
        transform: scale(1.02);
    }

    .btn-remove-marker:active {
        transform: scale(0.98);
    }

    /* Gaya untuk peta */
    #map {
        height: 300px;
        width: 100%;
        margin-top: 10px;
    }
</style>

<div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
    
    <form action="{{ route('reports.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="tags" class="font-xssss fw-600 text-grey-500">Description</label>
        <div class="card-body p-0  position-relative">
            
            <figure class="avatar position-absolute ms-2 mt-1 top-5">
                <img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w30">
            </figure>
            <textarea name="message"
                class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss  fw-500 border-light-md theme-dark-bg"
                cols="30" rows="4" placeholder="Add a description..."></textarea>
        </div>
        <div class="card-body p-0 mt-3">
            <label for="tags" class="font-xssss fw-600 text-grey-500">Image</label>
            <label class="custom-file-input"
                style="display: flex; justify-content: center; align-items: center; border: 1px solid #ddd; padding: 10px; border-radius: 5px; cursor: pointer;">
                <span id="fileLabel">Choose File</span>
                <input type="file" name="image" accept="image/*" style="display: none;"
                    onchange="handleFileChange(this)">
            </label>
            <!-- Elemen untuk menampilkan pratinjau gambar -->
            <div id="imagePreview" style="margin-top: 10px; text-align: center;">
                <img id="previewImg" src="" alt="Image Preview"
                    style="max-width: 100%; max-height: 200px; display: none; border: 1px solid #ddd; border-radius: 5px; padding: 5px;">
            </div>
        </div>

        <div class="card-body p-0 mt-3">
            <label for="map" class="font-xssss fw-600 text-grey-500">Select Location:</label>
            <div id="map"></div>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <!-- Tombol untuk mereset marker -->
            <button type="button" id="resetMarkerBtn" class="btn-remove-marker" style="display: none;">
                <i class="feather-trash-2 me-2"></i>Reset Marker
            </button>
        </div>
        <div class="card-body p-0 mt-3 position-relative">

            <textarea name="address" class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss  fw-500 border-light-md theme-dark-bg"
                cols="30" rows="4" placeholder="Alamat"></textarea>
        </div>
        <div class="card-body p-0 mt-3">
            <label for="tags" class="font-xssss fw-600 text-grey-500">Select Tags:</label>
            <select id="tags" name="tags[]" multiple class="form-control"
                style="width: 100%; padding: 10px; border-radius: 5px;">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="card-body p-0 mt-3">
            <button type="submit" class="btn-create-post">
                <i class="feather-edit-3 me-2"></i>Buat Laporan
            </button>
        </div>
    </form>
</div>

@push('styles')
    <!-- Leaflet CSS sudah ditambahkan di atas, jadi tidak perlu di sini -->
@endpush

@push('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Variabel global untuk marker, peta, dan koordinat awal
        let map;
        let marker;
        let initialLatitude;
        let initialLongitude;

        // Fungsi untuk menginisialisasi peta
        function initMap(latitude, longitude) {
            // Simpan koordinat awal
            initialLatitude = latitude;
            initialLongitude = longitude;

            // Inisialisasi peta
            map = L.map('map').setView([latitude, longitude], 16);

            // Tambahkan tile layer (menggunakan OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 18,
                minZoom: 13
            }).addTo(map);

            // Tambahkan marker pada posisi pengguna
            addMarker(latitude, longitude);

            // Event listener untuk dblclick pada peta
            map.on('dblclick', function(e) {
                // Koordinat klik ganda
                const lat = e.latlng.lat;
                const lng = e.latlng.lng;
                // Tambah marker di lokasi baru (akan hapus marker lama jika ada)
                addMarker(lat, lng);
            });
        }

        // Fungsi untuk menambahkan marker di lokasi tertentu
        function addMarker(latitude, longitude) {
            // Jika sudah ada marker sebelumnya, hapus
            if (marker) {
                map.removeLayer(marker);
                marker = null;
            }

            // Tambahkan marker baru
            marker = L.marker([latitude, longitude]).addTo(map)
                .bindPopup('Your Location')
                .openPopup();

            // Update nilai hidden field
            document.getElementById('latitude').value = latitude;
            document.getElementById('longitude').value = longitude;

            // Tampilkan tombol reset marker
            document.getElementById('resetMarkerBtn').style.display = 'inline-flex';

            getAddressFromCoordinates(latitude, longitude);
        }

        // Fungsi untuk mereset marker ke posisi awal
        function resetMarker() {
            // Tambahkan marker di koordinat awal
            addMarker(initialLatitude, initialLongitude);
        }

        // Tambahkan event listener untuk tombol reset marker
        document.getElementById('resetMarkerBtn').addEventListener('click', resetMarker);

        // Fungsi untuk menangani perubahan file
        function handleFileChange(input) {
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                document.getElementById('fileLabel').textContent = fileName;
            } else {
                document.getElementById('fileLabel').textContent = 'Choose File';
            }
        }

        // Fungsi untuk mendapatkan alamat dari koordinat
        function getAddressFromCoordinates(lat, lng) {
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    const address = data.display_name;
                    document.querySelector('textarea[name="address"]').value = address;
                })
                .catch(error => {
                    console.error("Error fetching address: ", error);
                    alert("Unable to fetch address. Please try again.");
                });
        }


        // Cek apakah geolocation tersedia
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    const latitude = position.coords.latitude;
                    const longitude = position.coords.longitude;
                    // Inisialisasi peta dengan koordinat yang lebih akurat
                    initMap(latitude, longitude);
                },
                function(error) {
                    console.error("Error obtaining location: ", error);
                    alert("Unable to retrieve your location. Please make sure your location services are enabled.");
                    initMap(0, 0);
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                }
            );
        } else {
            alert("Geolocation is not supported by this browser.");
            initMap(0, 0);
        }
    </script>
    <script>
        // Fungsi untuk menangani perubahan file
        function handleFileChange(input) {
            const fileLabel = document.getElementById('fileLabel');
            const previewImg = document.getElementById('previewImg');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                fileLabel.textContent = file.name;

                // Buat URL untuk pratinjau gambar
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    previewImg.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                fileLabel.textContent = 'Choose File';
                previewImg.src = '';
                previewImg.style.display = 'none';
            }
        }
    </script>
    <!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tags').select2({
            placeholder: "Choose categories",
            allowClear: true
        });
    });
</script>

@endpush
