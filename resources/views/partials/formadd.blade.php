<style>
    .btn-create-post {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background-color: #4caf50;
        /* Warna hijau */
        color: #fff;
        /* Warna teks */
        font-size: 14px;
        font-weight: 600;
        padding: 10px;
        /* Padding tombol */
        border-radius: 5px;
        /* Sudut melengkung */
        border: none;
        /* Hilangkan border */
        cursor: pointer;
        /* Ubah kursor menjadi pointer */
        width: 100%;
        /* Lebar tombol mengikuti form */
        transition: background-color 0.3s ease, transform 0.2s ease;
        /* Efek transisi */
    }

    .btn-create-post i {
        font-size: 16px;
        /* Ukuran ikon */
        margin-right: 8px;
        /* Jarak ikon dengan teks */
    }

    .btn-create-post:hover {
        background-color: #45a049;
        /* Warna hijau lebih gelap saat hover */
        transform: scale(1.02);
        /* Sedikit membesar saat hover */
    }

    .btn-create-post:active {
        transform: scale(0.98);
        /* Sedikit mengecil saat ditekan */
    }
</style>
<div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
    <form action="#" method="post" enctype="multipart/form-data">
        <div class="card-body p-0 mt-3 position-relative">
            <figure class="avatar position-absolute ms-2 mt-1 top-5">
                <img src="images/user-8.png" alt="image" class="shadow-sm rounded-circle w30">
            </figure>
            <textarea name="message"
                class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                cols="30" rows="4" placeholder="Add a description..."></textarea>
        </div>
        <div class="card-body p-0 mt-3">
            <label class="custom-file-input"
                style="display: flex; justify-content: center; align-items: center; border: 1px solid #ddd; padding: 10px; border-radius: 5px; cursor: pointer;">
                <span id="fileLabel">Choose File</span>
                <input type="file" name="image" accept="image/*" style="display: none;"
                    onchange="handleFileChange(this)">
            </label>
        </div>
        <div class="card-body p-0 mt-3">
            <label for="map" class="font-xssss fw-600 text-grey-500">Select Location:</label>
            <div id="map" style="height: 300px; width: 100%;"></div>
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
        </div>
        <div class="card-body p-0">
            <button type="submit" class="btn-create-post">
                <i class="feather-edit-3 me-2"></i>Create Post
            </button>
        </div>
    </form>
</div>
@push('scripts')
<script>
    // Check if geolocation is available
    if (navigator.geolocation) {
        // Get the user's current position
        navigator.geolocation.getCurrentPosition(
            function(position) {
                // Successfully obtained position
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                
                // Display the coordinates or use them as needed
                console.log("Latitude: " + latitude);
                console.log("Longitude: " + longitude);

                // You can also update form inputs or HTML elements with the coordinates
                document.getElementById('latitude').value = latitude;
                document.getElementById('longitude').value = longitude;
            },
            function(error) {
                // Handle error if the user denies geolocation or there is an issue
                console.error("Error obtaining location: ", error);
                alert("Unable to retrieve your location. Please make sure your location services are enabled.");
            }
        );
    } else {
        // Geolocation is not supported by the browser
        alert("Geolocation is not supported by this browser.");
    }
</script>


@endpush
