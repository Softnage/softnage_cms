<!DOCTYPE html>

<html>

<head>
    @include('layouts.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include('layouts.sidebar')
            <!-- Layout container -->
            <div class="layout-page">
                @include('layouts.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h2>Create Event</h2>
                        <form action="{{ route('events.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
                            </div>

                            <div class="form-group mb-3">
                                <label for="start_time">Start Time</label>
                                <input type="datetime-local" name="start_time" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="end_time">End Time</label>
                                <input type="datetime-local" name="end_time" class="form-control">
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control-file"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="mb-3">
                                <img id="imagePreview" src="#" alt="Preview"
                                    style="max-width: 100%; max-height: 200px; display: none;">
                            </div>
                            <button type="submit" class="btn btn-success">Create</button>
                        </form>
                    </div>
                    <!-- / Content -->
                    @include('layouts.footer')

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <script>
        function previewImage(event) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.style.display = 'block';
            imagePreview.style.width = '100px';
            imagePreview.style.height = '100px';
            imagePreview.style.marginBottom = '1rem';
            imagePreview.style.marginTop = '0.5rem';
            imagePreview.style.borderRadius = '10px';
            imagePreview.style.objectFit = 'cover';
            imagePreview.src = URL.createObjectURL(event.target.files[0]);
        }
    </script>
</body>

</html>
