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
                                            <h5 class="m-b-10">About Us Page</h5>
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
                                                <label for="exampleInputPassword1">Title</label>
                                                    <input type="text" id="about_title"  class="form-control" id="exampleInputPassword1" placeholder="Title">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">About us Body</label>
                                                    <textarea class="form-control"  id="aboutus_body" rows="8"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" id="submit_about" class="btn btn-primary">Save</button>
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
<script type="text/javascript" src="../assets/js/customjs/save_about_us.js"></script>

