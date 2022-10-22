<?php require_once("dashboard.php") ?>

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
                                            <h5 class="m-b-10">Models Page</h5>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="exampleInputPassword1">Model Name</label>
                                                        <input type="text" id="name" class="form-control" id="exampleInputPassword1" placeholder="Name">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
													<div class="form-group">
                                                        <label>Height</label>
                                                        <input type="text" id="height" class="form-control" placeholder="Height">
                                                    </div>
                                                </div>
												<div class="col-md-4">
													<div class="form-group">
                                                        <label>Bust</label>
                                                        <input type="text" id="bust" class="form-control" placeholder="Bust">
                                                    </div>
                                                </div>
												<div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="exampleInputPassword1">Waist</label>
                                                        <input type="text" id="waist" class="form-control" id="exampleInputPassword1" placeholder="Waist">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
													<div class="form-group">
                                                        <label>Hips</label>
                                                        <input type="text" id="hips" class="form-control" placeholder="Hips">
                                                    </div>
                                                </div>
												<div class="col-md-4">
													<div class="form-group">
                                                        <label>Shoe</label>
                                                        <input type="text" id="shoe_size" class="form-control" placeholder="Shoe">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<div class="form-group">
														<label for="exampleFormControlTextarea1">About Model</label>
														<textarea class="form-control"  id="about_model" placeholder="About Model" rows="4"></textarea>
													</div>
												</div>
												<div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>ID Number</label>
                                                        <input type="text" id="id_number" class="form-control" placeholder="ID Number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Image</label>
                                                        <input type="file" id="models_image" name="model_image" class="form-control" placeholder="Image">
                                                    </div>
                                                </div>
												<div class="col-md-12">
													<button type="button" id="save_model" class="btn btn-primary">Submit</button>
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
    <script type="text/javascript" src="../assets/js/customjs/save_model.js"></script>


