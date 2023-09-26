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
                        <h2 class="my-4">Edit Gallery</h2>
                        <form action="{{ route('galleries.update', $gallery->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')

                            <div class="form-group mb-1">
                                <label for="title">Gallery Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title', $gallery->title) }}" required>
                            </div>

                            <div class="form-group mb-1">
                                <label for="images">Add or Update Images</label>
                                <input type="file" class="form-control-file" id="images" name="images[]" multiple
                                    accept="image/*">
                                <small class="form-text text-muted">You can upload multiple images.</small>
                            </div>

                            <div class="row">
                                <label>Current Images</label>
                                <div class="gal">
                                    @if ($gallery->images->count() > 0)
                                        @foreach ($gallery->images as $image)
                                            <div class="">
                                                <div class="edit">
                                                    <a href="{{ asset('storage/' . $image->path) }}">
                                                        <img src="{{ asset('storage/' . $image->path) }}"
                                                            alt="Gallery Image" class="img-thumbnail">
                                                    </a>
                                                    <div class="form-check mb-3">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="delete_images[]" value="{{ $image->id }}">
                                                        <label class="form-check-label">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p>No images available for this gallery.</p>
                                    @endif
                                </div>
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

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this gallery?")) {
                // If the user confirms, submit the form
                document.querySelector('form').submit();
            }
        }
    </script>

</body>

</html>
