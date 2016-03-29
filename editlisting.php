<?php 
	require_once 'header-internal.php';
	
	$cats = json_decode(file_get_contents($baseurl."/categories"), true)["data"];
	$result = file_get_contents($baseurl."/getitem/".$_GET["item"]);
	
	$data = json_decode($result, true)["data"];
?>

<?php if(isset($_SESSION["userid"]) && $_SESSION["usertype"] == "seller") { ?>
		<div id="content" class="site-content account-page">
			<div class="breadcrumb">
				<div class="container">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><span class="current">Login / Register</span></li>
					</ul>
				</div><!-- .container -->
			</div><!-- .breadcrumb -->

			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h2>Uploaded Images</h2>
						<?php //var_dump($data); //echo $result;?>
						<div id="preview">
							<?php 
								$imgarray = $data["imgs"]; 
								foreach ($imgarray as $value) {
							?>
									<img src="images/items/<?php echo $value["image"]; ?>">
							<?php } ?>
							
						</div>
						<!-- <h4><?php //echo $result; ?></h4> -->
					</div>
					<div class="col-md-6">
						<div class="register">
							
							<h2 class="heading-title">Edit This Listing</h2>
							<!-- <p>Create your own Rimbus account.</p> -->

							<form class="listupdate" method="post" action="updateitem.php">
								<!-- <div class="input-field">
									<label>Title</label>
									<input type="text" class="input-text" name="title" required>
								</div> -->
								<div class="input-field">
									<label>Title</label>
									<input type="text" class="input-text" value="<?php echo $data["title"]; ?>" name="title" required>
								</div>
								<div class="input-field">
									<input id="allimages" type="hidden" class="input-text" name="image" value="">
								</div>
								<div class="input-field">
									<label>Brand</label>
									<select type="text" class="selectbox" name="brand" required>
										<option value="">-Select-</option>
										<option value="lee" <?php if($data["brand"] == "lee") echo "selected"; ?>>Lee</option>
										<option value="wrangler" <?php if($data["brand"] == "wrangler") echo "selected"; ?>>Wrangler</option>
									</select>
								</div>
								<div class="input-field">
									<label>Fabric</label>
									<select type="text" class="selectbox" name="fabric" required>
										<option value="">-Select-</option>
										<option value="cotton" <?php if($data["fabric"] == "cotton") echo "selected"; ?>>Cotton</option>
										<option value="linen" <?php if($data["fabric"] == "linen") echo "selected"; ?>>Linen</option>
									</select>
								</div>
								<div class="input-field">
									<label>Lookup Type</label>
									<select type="text" class="selectbox" name="lookupid" required>
										<option value="">-Select-</option>
										<option value="1" <?php if($data["lookup_type_id"] == "1") echo "selected"; ?>>Anarkali</option>
										<option value="2" <?php if($data["lookup_type_id"] == "2") echo "selected"; ?>>Lahenga</option>
										<option value="3" <?php if($data["lookup_type_id"] == "3") echo "selected"; ?>>Saree</option>
									</select>
								</div>
								<div class="input-field">
									<label>Category</label>
									<select type="text" class="selectbox" name="category" required>
										<?php foreach($cats as $value) { ?>
										<option value="<?php echo $value["id"]; ?>" <?php if($data["category_id"] == $value["id"]) echo "selected"; ?>><?php echo strtoupper($value["name"]); ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="input-field">
									<label>Occasion</label>
									<select type="text" class="selectbox" name="occasion" required>
										<option value="">-Select-</option>
										<option value="1" <?php if($data["occasion_id"] == "1") echo "selected"; ?>>Party</option>
										<option value="2" <?php if($data["occasion_id"] == "2") echo "selected"; ?>>Wedding</option>
										<option value="3" <?php if($data["occasion_id"] == "3") echo "selected"; ?>>Casual</option>
									</select>
								</div>
								
								<div class="input-field">
									<label>Color</label>
									<input type="text" class="input-text" name="color" value="<?php echo $data["colors"]; ?>" required>
								</div>
								<div class="input-field">
									<label>Tag</label>
									<input type="text" class="input-text" name="tag" value="<?php echo $data["tags"]; ?>" required>
								</div>
								<div class="input-field">
									<label>City</label>
									<select type="text" class="selectbox" name="city" required>
										<option value="">-Select-</option>
										<option value="bangalore" <?php if($data["city"] == "bangalore") echo "selected"; ?>>Bangalore</option>
										<option value="mangalore" <?php if($data["city"] == "mangalore") echo "selected"; ?>>Mangalore</option>
									</select>
								</div>
								<div class="input-field">
									<label>Decription</label>
									<textarea type="text" class="input-text" name="description" rows="3" required><?php echo $data["description"]; ?></textarea>
								</div>
								<div class="input-field">
									<label>Retail Price</label>
									<input type="text" value="<?php echo $data["retail_price"]; ?>" pattern="[0-9]+([\.,][0-9]+)?" class="input-text" name="retail-price" required>
								</div>
								<div class="input-field">
									<label>Rent Price</label>
									<input type="text" value="<?php echo $data["rent_price"]; ?>" class="input-text" name="rent-price" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Security Deposit</label>
									<input type="text" value="<?php echo $data["security_deposit"]; ?>" class="input-text" name="security-deposit" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Maximum days for rent</label>
									<input type="text" value="<?php echo $data["max_days_for_rent"]; ?>" class="input-text" name="max-days" pattern="[0-9]+([\.,][0-9]+)?" required>
								</div>
								<div class="input-field">
									<label>Designer</label>
									<input type="text" value="<?php echo $data["designer_id"]; ?>" class="input-text" name="designer" required>
								</div>
								<input type="hidden" class="input-text" name="seller" value="<?php echo $_SESSION["userid"]; ?>" required>
								<input type="hidden" class="input-text" name="itemcode" value="<?php echo $_GET["itemcode"]; ?>" required>
								<input type="hidden" class="input-text" name="seller" value="<?php echo $_SESSION["userid"]; ?>" required>
								<input type="hidden" class="input-text" name="update" value="true" required>
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