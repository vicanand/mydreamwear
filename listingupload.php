<?php 
	require_once 'header-internal.php';
	$result = file_get_contents($baseurl."/categories");
	$data = json_decode($result, true);
	$cats = $data["data"];
?>

<?php if(isset($_SESSION["userid"])) { ?>
		<div id="content" class="site-content account-page">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">New Product Upload</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2>Upload Images</h2>
						<form class="imageupload" method="post" action="test.php" enctype="multipart/form-data">
							<div class="input-field">
								<label>&nbsp;</label>
								<input type="file" id="file" class="input-text" name="files[]" multiple="true" required>
							</div>
							<div class="input-field">
								<!-- <input type="submit" class="btn btn-success" value="Upload"> -->
							</div>
						</form>
						<div id="preview"></div>
						
					</div>
					<div class="col-md-6">
						<div class="register">
							<h2 class="heading-title">Upload Listing</h2>
							<!-- <p>Create your own Rimbus account.</p> -->

							<form class="listupload" disable="true" method="post" action="newitem.php">
								<!-- <div class="input-field">
									<label>Title</label>
									<input type="text" class="input-text" name="title" required>
								</div> -->
								<div class="input-field">
									<label>Title</label>
									<input type="text" class="input-text" name="title" required>
								</div>
								<div class="input-field">
									<input id="allimages" type="hidden" class="input-text" name="image" >
								</div>
								<div class="input-field">
									<label>Brand</label>
									<input type="text" class="input-text" name="brand" required>
										
								</div>
								<div class="input-field">
									<label>Fabric</label>
									<input type="text" class="input-text" name="fabric" required>
										
								</div>
								<div class="input-field">
									<label>Lookup Type</label>
									<select type="text" class="selectbox" name="lookupid" required>
										<option value="1">Anarkali</option>
										<option value="2">Lehenga</option>
										<option value="3">Dress</option>
									</select>
								</div>
								<div class="input-field">
									<label>Category</label>
									<select type="text" class="selectbox" name="category" required>
										<?php foreach($cats as $value) { ?>
										<option value="<?php echo $value["id"]; ?>"><?php echo strtoupper($value["name"]); ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="input-field">
									<label>Occasion</label>
									<select type="text" class="selectbox" name="ocasid" required>
										<option value="1">Party</option>
										<option value="2">Wedding</option>
										<option value="3">Casual</option>
									</select>
								</div>
								
								<div class="input-field">
									<label>Color</label>
									<input type="text" class="input-text" name="color" required>
								</div>
								<div class="input-field">
									<label>Tag</label>
									<input type="text" class="input-text" name="tag" required>
								</div>
								<div class="input-field">
									<label>City</label>
									<select type="text" class="selectbox" name="city" required>
										<option value="bangalore">Bangalore</option>
									</select>
								</div>
								<div class="input-field">
									<label>Decription</label>
									<textarea type="text" class="input-text" name="description" rows="3" required></textarea>
								</div>
								<div class="input-field">
									<label>Size</label>
									<select type="text" class="selectbox" name="size" required>
										<option value="XS">XS</option>
										<option value="S">S</option>
										<option value="M">M</option>
										<option value="L">L</option>
										<option value="XL">XL</option>
										<option value="XXL">XXL</option>
										
									</select>
								</div>
								<div class="input-field">
									<label>Retail Price</label>
									<input type="text" class="input-text" name="retail-price" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Rent Price</label>
									<input type="text" class="input-text" name="rent-price" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Security Deposit</label>
									<input type="text" class="input-text" name="security-deposit" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Maximum days for rent</label>
									<input type="text" class="input-text" name="max-days" pattern="\d{2}" required>
								</div>
								<div class="input-field">
									<label>Designer</label>
									<input type="text" placeholder="enter designer id for now!" class="input-text" name="designer" required>
								</div>
								
									<input type="hidden" class="input-text" name="seller" value="<?php echo $_SESSION["userid"]; ?>" required>
								
								<div class="input-field">
									<input type="submit" class="btn btn-success" value="Add Item">
								</div>
							</form>
							
							
						</div><!-- .register -->
					</div>
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .site-content -->

<?php }else{
	echo "<br><br><br><br><br><h2 class='center'>Unauthorized</h2><br><br><br><br><br>";
}
?>

<?php require_once 'footer.php';?>