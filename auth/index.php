<?php	 
require_once("../includes/header.php");

?>
<!-- [ auth-signin ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
	<br/><br/><br/>
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						<br/><br/><br/>
						<h4 class="mb-3 f-w-400">Login into your account</h4><br/><br/>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-mail"></i></span>
							</div>
							<input type="email" class="form-control" id="email_address" placeholder="Username">
						</div>
						<br/>
						<br/>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" class="form-control" id="password" placeholder="Password">
						</div>
						<br/><br/>
						<!-- <div class="form-group text-left mt-2">
							<div class="checkbox checkbox-primary d-inline">
								<input type="checkbox" name="checkbox-fill-1" id="checkbox-fill-a1" checked="">
								<label for="checkbox-fill-a1" class="cr"> Save credentials</label>
							</div>
						</div> -->
						<button class="btn btn-primary mb-4" id="loginBtn">Login</button>
						
					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="../assets/images/index-image.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>


<script src="../assets/vendors/js/vendor.bundle.base.js"></script>
<script type="text/javascript" src="../assets/js/customjs/auth.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script type="text/javascript" src="../assets/js/notify.min.js"></script> 
