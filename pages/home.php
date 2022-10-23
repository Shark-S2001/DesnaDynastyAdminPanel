<?php 
  require_once("dashboard.php");

?>
<div class="row">
<div class="col-lg-6 grid-margin stretch-card">
	<div class="card">
	<div class="card-body">
		<h4 class="card-title">Models </h4>
		<canvas id="lineChart"></canvas>
	</div>
	</div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
	<div class="card">
	<div class="card-body">
		<h4 class="card-title">Uploads</h4>
		<canvas id="barChart"></canvas>
	</div>
	</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 grid-margin stretch-card">
	<div class="card">
	<div class="card-body">
		<h4 class="card-title">Blogs</h4>
		<canvas id="areaChart"></canvas>
	</div>
	</div>
</div>
<div class="col-lg-6 grid-margin stretch-card">
	<div class="card">
	<div class="card-body">
		<h4 class="card-title">Events</h4>
		<canvas id="doughnutChart"></canvas>
	</div>
	</div>
</div>
</div>

<?php require_once("../includes/footer.php") ?>