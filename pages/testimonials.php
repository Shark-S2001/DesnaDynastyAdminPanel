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
                                                <h5 class="m-b-10">Testimonial Page</h5>
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
                                                    <label for="exampleInputPassword1">Client Title</label>
                                                        <input type="text" class="form-control" id="client_title" placeholder="Example, Manager">
                                                    </div>
                                                </div>
                                                <br/>
                                                <div class="col-md-6">
													<div class="form-group">
                                                        <label>CLient Name</label>
                                                        <input type="text" class="form-control" id="client_name" placeholder="Client Name">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">Testimony Heading</label>
														<input type="text" class="form-control" id="testimony_heading" placeholder="Testimony Heading">
													</div>
												</div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">Testimony Body</label>
														<textarea class="form-control" id="testimony_body" rows="4"></textarea>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
                                                        <label>Client Image</label>
                                                        <input type="file" class="form-control" id="client_photo" placeholder="Client Image">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<button type="submit" id="submit_testimony" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript" src="../assets/js/customjs/add_testimony.js"></script>


