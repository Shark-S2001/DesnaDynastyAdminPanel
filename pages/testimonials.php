<?php 
require_once("dashboard.php");

// Check user permissions if needed
// if (!hasPermission('manage_testimonials')) {
//     header("Location: unauthorized.php");
//     exit();
// }
?>

<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <div class="pcoded-content">
            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header">
                            <div class="page-block">
                                <div class="card">
                                    <div class="card-body"> 
                                        <div class="row align-items-center">
                                            <div class="col-md-12">
                                                <div class="page-header-title">
                                                    <h5 class="m-b-10">Testimonial Page</h5>
                                                    <p class="text-muted">Add new client testimonials to showcase on the website</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->

                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Add New Testimonial</h5>
                                    </div>
                                    <div class="card-body">
                                        <form id="testimonialForm" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="client_title">Client Title</label>
                                                        <input type="text" class="form-control" id="client_title" name="client_title" 
                                                               placeholder="Example: Manager, CEO" required>
                                                        <small class="form-text text-muted">Professional title of the client</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="client_name">Client Name</label>
                                                        <input type="text" class="form-control" id="client_name" name="client_name" 
                                                               placeholder="Full Name" required>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="testimony_heading">Testimonial Heading</label>
                                                        <input type="text" class="form-control" id="testimony_heading" name="testimony_heading" 
                                                               placeholder="Short testimonial summary" required>
                                                        <small class="form-text text-muted">Max 100 characters</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="testimony_body">Testimonial Content</label>
                                                        <textarea class="form-control" id="testimony_body" name="testimony_body" 
                                                                  rows="4" maxlength="500" required></textarea>
                                                        <small class="form-text text-muted">Max 500 characters</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="client_photo">Client Image</label>
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" id="client_photo" name="client_photo" 
                                                                   accept="image/jpeg, image/png, image/webp" required>
                                                            <label class="custom-file-label" for="client_photo">Choose image file</label>
                                                        </div>
                                                        <small class="form-text text-muted">Recommended size: 400x400px (JPG/PNG/WEBP)</small>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 mt-3">
                                                    <button type="submit" id="submit_testimony" class="btn btn-primary">
                                                        <span id="submitText">Submit Testimonial</span>
                                                        <div id="LoadingImage" class="spinner-border spinner-border-sm text-light ml-2" role="status" style="display:none">
                                                            <span class="sr-only">Loading...</span>
                                                        </div>
                                                    </button>
                                                    <button type="reset" class="btn btn-outline-secondary ml-2">Reset Form</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="../../../admin/assets/js/customjs/add_testimony.js"></script>

<script>
// Enhance file input display
document.getElementById('client_photo').addEventListener('change', function(e) {
    var fileName = e.target.files[0] ? e.target.files[0].name : "Choose image file";
    document.querySelector('.custom-file-label').textContent = fileName;
});

// Basic form validation
document.getElementById('testimonialForm').addEventListener('submit', function(e) {
    const form = e.target;
    if (!form.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
        form.classList.add('was-validated');
    }
});
</script>