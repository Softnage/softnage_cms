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
                        <div class="d-flex justify-content-between">
                            <h2>Gallery</h2>
                            <a href="{{ route('galleries.create') }}" class="btn btn-success mb-3">
                                <i class="fas fa-plus"></i> Create Gallery
                            </a>
                        </div>
                        <div class="row mt-4">
                            @foreach ($galleries as $gallery)
                                <div class="galcard">
                                    <h3 class="card-title mb-3 mt-5" style="font-size: 1.5rem; font-weight: 700">
                                        {{ $gallery->title }}</h3>
                                    <div class="gal mb-3">
                                        @if ($gallery->images->count() > 0)
                                            @foreach ($gallery->images as $image)
                                                <a href="{{ asset('storage/' . $image->path) }}">
                                                    <img src="{{ asset('storage/' . $image->path) }}"
                                                        alt="Gallery Image" class="card-img-top">
                                                </a>
                                            @endforeach
                                        @else
                                            <p>No images available for this gallery.</p>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('galleries.edit', $gallery->id) }}"
                                            class="btn btn-primary">Edit</a>
                                        <form action="{{ route('galleries.destroy', $gallery->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                onclick="confirmDelete()">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.btn-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    if (!confirm("Are you sure you want to delete this gallery?")) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>

    <style>
        .gal {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
        }

        .gal img {
            height: 40vh;
            object-fit: cover;
            border-radius: 20px;
            padding: 1rem;
            width: 100%;
        }
    </style>

</body>

</html>
