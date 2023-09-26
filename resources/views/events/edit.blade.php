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
                        <h2>Edit Event</h2>
                        <form action="{{ route('events.update', $event->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ $event->title }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea name="description" class="form-control" rows="5">{{ $event->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label for="start_time">Start Time</label>
                                <input type="datetime-local" name="start_time" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($event->start_time)->format('Y-m-d\TH:i') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="end_time">End Time</label>
                                <input type="datetime-local" name="end_time" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($event->end_time)->format('Y-m-d\TH:i') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control-file"
                                    onchange="previewImage(event)">
                            </div>
                            <div class="mb-3">
                                @if ($event->image)
                                    <img id="imagePreview" src="{{ asset('storage/' . $event->image) }}" alt="Preview"
                                        style="width: 100px; height: 100px; display: block; margin-top: 10px; object-fit:cover; border-radius:10px">
                                @else
                                    <img id="imagePreview" src="#" alt="Preview"
                                        style="max-width: 100%; max-height: 200px; display: none;">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
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
</body>

</html>
