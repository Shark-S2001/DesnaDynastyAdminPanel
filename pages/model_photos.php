<?php
require_once("dashboard.php") ?>

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
                                            <h5 class="m-b-10">Model Photos/Images Page</h5>
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
                                <!-- [ form-element ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <form>
                                            <div class="row">
                                            <div class="col-md-12">
                                                    <div class="form-group">
                                                    <label for="exampleInputPassword1">ID Number</label>
                                                        <input type="text" id="id_number"  class="form-control"  placeholder="ID Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Model Photos</label>
                                                    <input type="file" id="single_model_images" name="single_model_images[]" multiple="multiple" class="form-control" placeholder="Text">
                                                </div>
                                                </div>
												<div class="col-md-12">
													<button type="button" id="model_images" class="btn btn-primary">Upload</button>
                                                    <img src="../assets/images/loading.gif" id="LoadingImage" style="display:none" />
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- [ form-element ] end -->
                                <!-- [ Main Content ] end -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../includes/footer.php") ?>
    <script type="text/javascript" src="../../../admin/assets/js/customjs/upload_single_model_images.js"></script>


