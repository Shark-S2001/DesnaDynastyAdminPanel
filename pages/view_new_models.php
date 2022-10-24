<?php 
  require_once("dashboard.php");

    $stmt = $conn->prepare("SELECT * FROM models WHERE approved=0");
    $stmt->execute();
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
                                            <h5 class="m-b-10">Newly Registered Models</h5>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                   <section class="ds page_models models_square gorizontal_padding section_padding_80 columns_padding_0">
                    <div class="container-fluid">
                    	<div class="isotope_container isotope row masonry-layout bottommargin_20" data-filters=".isotope_filters">
                    	<?php foreach ($stmt as $row): ?>
                    		<div class="isotope-item col-lg-3 col-md-4 col-sm-6">
                    			<div class="vertical-item content-absolute">
                    			   <div class="card">
                    				<div class="item-media">
                    				<a class="p-link" title="" href="single-model.php?id=<?=$row["id"]?>">
                    					<img src="../../images/new_models/<?=$row["image_path"]?>" style="object-fit: scale-down; max-width: 100%" alt="">
                    				</a>
                    					<div class="media-links">
                    					</div>
                    				</div>
                    				<div class="item-content text-center before_cover cs">
                    					
                                        <div class="card-body">
                                            <div class="links-wrap">
                        						Name: <a class="p-link" title=""     href="#">         <?=$row["model_name"]    ?></a>
                        						<a class="p-view prettyPhoto        pull-right" title="" data-gal        ="prettyPhoto[gal]" href="../../images     /new_models/<?=$row["image_path"]?>"         style="object-fit: scale-down;      max-width: 100%"></a>
                        					</div>
                        					 <div>
                    					        <span>Gender: <?=strtoupper        ($row["gender"])?></span>
                    					    </div>
                    					    <div>
                    					       <span>Age: <?php echo calculateAge($row["dob"],date('Y-m-d'));          ?></span>
                    					    </div>
                    					    <div>
                    					        <span>Tel:                 <?=$row["phone_number"]?></span>
                    					    </div>
                    					     <div>
                    					        <span>Residence:                  <?=$row["home_town"]?></span>
                    					    </div>
                    					    <br/>
                    					    <div>
                            				<button type="button" class="btn btn-outline-success">Approve Model          </button>
                    					    </div>
                    					    <br/>
                    					 </div>
                    					 </div>  
                    					
                    					
                    				</div>
                    				<br/>
                    			</div>
                    		</div>
                    		<?php endforeach ?>
                    	</div>
                    
                    </div>
                </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once("../includes/footer.php") ?>
<script type="text/javascript" src="../assets/js/customjs/approve_model.js"></script>

