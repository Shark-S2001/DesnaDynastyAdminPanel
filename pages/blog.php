<?php 
    require_once("dashboard.php"); 
?>
<div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="main-body">
                        <div class="page-wrapper">
                            <div class="page-header">
                            <div class="page-block">
                            <div class="card">
                            <div class="card-body"> 
                                <div class="row align-items-center">
                                <div class="col-md-12">
                                        <div class="page-header-title">
                                        <h5 class="m-b-10">Blogs Page</h5>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label for="exampleInputPassword1">Title</label>
                                                        <input type="text" id="blog_title" class="form-control" id="exampleInputPassword1" placeholder="Title">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
													<div class="form-group">
                                                        <label>Subject</label>
                                                        <input type="text" id="blog_subject" class="form-control" placeholder="Text">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">Blogs Body</label>
														<textarea class="form-control" id="blog_body" rows="4"></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" id="blog_image" class="form-control" placeholder="Text">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<button type="button" id="save_blog" class="btn btn-primary">Submit</button>
                                                    <img src="../assets/images/loading.gif" id="LoadingImage" style="display:none" />
                                                </div>
                                            </div>
                                            </div>
                                        </form>
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
    <script type="text/javascript" src="../assets/js/customjs/save_blog.js"></script>

