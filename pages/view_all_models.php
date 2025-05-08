<?php 
require_once("dashboard.php");

// Fetch all models except those with approved=2 (deleted or permanently disapproved)
$stmt = $conn->prepare("SELECT * FROM model WHERE approved <> 2");
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
                                                    <h5 class="m-b-10">View All Models</h5>
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
                                                        <br/>
                                                        <div style="width:100%; text-align:center">
                                                            <?php
                                                            // Safely construct image path
                                                            $imagePath = $_SESSION['path'] . '/models/' . $row['image_path'];
                                                            
                                                            // Check if file exists before displaying
                                                            if (file_exists($imagePath)) {
                                                                // Get MIME type for proper display
                                                                $mimeType = mime_content_type($imagePath);
                                                                $imageData = base64_encode(file_get_contents($imagePath));
                                                                echo "<img src='data:{$mimeType};base64,{$imageData}' 
                                                                      alt='Model Image: " . htmlspecialchars($row['model_name']) . "' 
                                                                      style='object-fit: cover; max-width: auto; height: 200px; border-radius: 300px;'>";
                                                            } else {
                                                                // Fallback image if file doesn't exist
                                                                echo "<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII=' 
                                                                      alt='Image not found' 
                                                                      style='object-fit: cover; max-width: auto; height: 200px; border-radius: 300px;'>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="item-content text-center before_cover cs">
                                                        <div class="card-body">
                                                            <div class="links-wrap">
                                                                Name: <a class="p-link" title="View model details" href="#"><?=htmlspecialchars($row["model_name"])?></a>
                                                            </div>
                                                            <div>
                                                                <span>Gender: <?=strtoupper(htmlspecialchars($row["gender"]))?></span>
                                                            </div>
                                                            <div>
                                                                <span>Age: <?=calculateAge($row["dob"], date('Y-m-d'))?></span>
                                                            </div>
                                                            <div>
                                                                <span>Tel: <?=htmlspecialchars($row["phone_number"])?></span>
                                                            </div>
                                                            <div>
                                                                <span>Residence: <?=htmlspecialchars($row["home_town"])?></span>
                                                            </div>
                                                            <br/>
                                                            <div>
                                                                <button type="button" 
                                                                        class="btn btn-outline-success btnDis" 
                                                                        id="dis_<?=$row["id"]?>"
                                                                        data-model-id="<?=$row["id"]?>">
                                                                    Disapprove Model
                                                                </button>
                                                                <br/><br/>
                                                                <button type="button" 
                                                                        class="btn btn-outline-danger btnDel" 
                                                                        id="del_<?=$row["id"]?>"
                                                                        data-model-id="<?=$row["id"]?>">
                                                                    Delete Model
                                                                </button>
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
<script type="text/javascript" src="../../../admin/assets/js/customjs/disapprove_model.js"></script>
<script type="text/javascript" src="../../../admin/assets/js/customjs/delete_model.js"></script>