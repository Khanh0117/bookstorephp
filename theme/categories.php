<?php require_once('inc/top.php');?>
	<title>Categories</title>
<?php
if(isset($_GET['del']) and isset($_SESSION['usernameadmin'])){
	$del_id = $_GET['del'];
	$del_query = "DELETE FROM `category` WHERE `ID` = '$del_id'";
	if(mysqli_query($conn, $del_query)){
		echo "<script>alert('Delete category success! Category has been deleted.');window.location='./categories.php'</script>";
	}
	else{
		echo "<script>alert('Delete category fail! Some error has occurred.');window.location='./categories.php'</script>";
	}
}
?>
</head>

<body>

    <?php require_once('inc/preload.php');?>
    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php require_once('inc/web-form.php');?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="./index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Categories</li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
					<div class="col-lg-5 col-md-12">
						<div class="card">
							<div class="card-body">
								<div class="card-title">
									<h4>Add Category</h4>
								</div>
								<form action="inc/process.php" method="post">
									<div class="form-group">
										<label for="category">Category Name:*</label>
										<input type="text" placeholder="Category Name" class="form-control" name="cat-name" required>
									</div>
									<input type="submit" value="Add Category" name="add-category" class="btn btn-primary">
								</form>
							</div>
						</div>
						<?php
						if(isset($_GET['edit'])){
							$edit_id = $_GET['edit'];
							$get_cat_id = "select * from category where ID = '$edit_id'";
							$run_edit_id = mysqli_query($conn, $get_cat_id);
							if(mysqli_num_rows($run_edit_id)>0){
								$row_edit_id = mysqli_fetch_array($run_edit_id);
								$edit_name = $row_edit_id['cate_name'];
						?>
						<div class="card">
						<div class="card-body">
							<div class="card-title">
									<h4>Edit Category</h4>
								</div>
							<form action="inc/process.php?edit_category=<?php echo $edit_id?>" method="post">
								<div class="form-group">
									<label for="category">Edit Category Name:*</label>
									<input type="text" placeholder="Edit Category Name" class="form-control" name="edit-cat-name" value="<?php echo $edit_name;?>" required>
								</div>
								<input type="submit" value="Edit Category" name="edit-category" class="btn btn-primary">
							</form>
						</div>
						</div>
						<?php
							}
						}
						?>
					</div>
                	<div class="col-lg-7 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3>Categories</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>Categories ID</th>
                                                <th>Categories Name</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$query = "select * from category order by id asc";
											$run = mysqli_query($conn, $query);
											if(mysqli_num_rows($run)>0){
												while($row = mysqli_fetch_array($run)){
													$cat_id = $row['ID'];
													$cat_name = $row['cate_name'];
											?>
                                            <tr>
                                                <td><?php echo $cat_id?></td>
                                                <td><?php echo $cat_name?></td>
												<td><a href="categories.php?edit=<?php echo $cat_id?>"><button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></button></a></td>
                                                <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?php echo $cat_id?>"><i class="fa fa-close"></i></button></td>
                                            </tr>
											<div class="modal fade" id="exampleModal<?php echo $cat_id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											  <div class="modal-dialog" role="document">
												<div class="modal-content">
												  <div class="modal-header">
													<h3 class="modal-title" id="exampleModalLabel<?php echo $cat_id?>" style="margin: auto;text-align: center;">Are you sure to delete<br> Category <?php echo $cat_id?>. <?php echo $cat_name?> ?</h3>
												  </div>
												  <div class="modal-footer" style="margin: auto;">
													<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
													<a href="categories.php?del=<?php echo $cat_id?>"><button type="button" class="btn btn-danger">Yes, delete it !</button></a>
												  </div>
												</div>
											  </div>
											</div>
											<?php
												}
											}
											else{
												echo "No Categories Found";
											}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
        
        
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; Designed & Developed by <a href="https://themeforest.net/user/quixlab">Quixlab</a> 2018</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <?php require_once('inc/footer.php');?>
	