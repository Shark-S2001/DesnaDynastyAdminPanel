<?php 
  require_once("dashboard.php");

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
                                        <h5 class="m-b-10">Promotion Videos Page</h5>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                            <!-- [ breadcrumb ] end -->
                            <div class="row">
                                <!-- [ form-element ] start -->
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Promotion Videos</label>
                                                            <input type="file" class="form-control" id="promo_video" placeholder="Video">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button type="button" id="submit_video" class="btn btn-primary">Save</button>
                                                        <img src="../assets/images/loading.gif" id="LoadingImage" style="display:none" />
                                                    </div>
                                                </div>
                                            </form>
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
    <script type="text/javascript" src="../../../admin/assets/js/customjs/add_promo_video.js"></script>

