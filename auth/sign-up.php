<?php 
 //require_once("../includes/header.php")
 ?>
<!-- [ auth-signup ] start -->
<div class="auth-wrapper">
	<div class="auth-content container">
		<div class="card">
			<div class="row align-items-center">
				<div class="col-md-6">
					<div class="card-body">
						<img src="../assets/images/logo-dark.png" alt="" class="img-fluid mb-4">
						<h4 class="mb-3 f-w-400">Sign up into your account</h4><br/>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-user"></i></span>
							</div>
							<input type="text" class="form-control" placeholder="Username">
						</div>
                        <br/>
						<div class="input-group mb-2">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-mail"></i></span>
							</div>
							<input type="email" class="form-control" placeholder="Email address">
						</div>
                        <br/>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="feather icon-lock"></i></span>
							</div>
							<input type="password" class="form-control" placeholder="Password">
						</div>
                        <br/>
						<div class="form-group text-left mt-2">
							<div class="checkbox checkbox-primary d-inline">
								<input type="checkbox" name="checkbox-fill-2" id="checkbox-fill-2">
								<label for="checkbox-fill-2" class="cr">Send me the <a href="#!"> Newsletter</a> weekly.</label>
							</div>
						</div>
                        <br/>
						<button class="btn btn-primary mb-4">Sign up</button>
						<p class="mb-2">Already have an account? <a href="index.php" class="f-w-400">Log in</a></p>
					</div>
				</div>
				<div class="col-md-6 d-none d-md-block">
					<img src="../assets/images/auth-bg.jpg" alt="" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</div>

<?php require_once("../includes/footer.php") ?>
