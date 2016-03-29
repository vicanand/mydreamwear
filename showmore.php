<?php
session_start();
$url = $_POST["url"]; 
$items = json_decode(file_get_contents($url, true))->data;

$output = "";

$size = sizeof($items);

$res_obj = new stdClass();
$res_obj->size=$size;

$price_array = array();
foreach ($items as $value) { 
	$imgArray = $value->imgs;
	array_push($price_array, (int)$value->rent_price);
	$output .= '<div class="product" data-price="'.$value->rent_price.'">
		<div class="p-inner row">
			<div class="p-thumb col-md-4 col-sm-6">
				<a href="single-product.php?item='.$value->itemcode.'">
					<img src="images/items/'.$imgArray[0]->image.'" alt="">
				</a>
			</div>

			<div class="p-info col-md-8 col-sm-6">
				<a href="#product-quickview-'.$value->itemcode.'" class="quick-view">QUICK LOOK</a>
				<h3 class="p-title"><a href="single-product.php?item='.$value->itemcode.'">'.ucwords($value->title).'</a></h3>
				
				<span class="price">
					<ins><span class="amount">₹'.$value->rent_price.'</span></ins>
					<del>₹'.$value->retail_price.'</del>
				</span>

				<div class="p-desc">
					<p>'.$value->description.'</p>
				</div>

				<div class="p-actions">';
				
				if($_SESSION["usertype"] != "seller" && isset($_SESSION["name"])){
					$output .= '<a href="#" data="'.$value->itemcode.'" class="button black add-to-cart-button"><i class="icon-cart"></i><span>Add to cart</span></a>
													<a href="#" data="'.$value->itemcode.'" class="button black add-to-wishlist"><i class="icon-heart"></i></a>';
				}

				$output .= '<a href="#product-quickview-'.$value->itemcode.'" class="button square dark quick-view"><i class="icon-zoom"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div id="product-quickview-'.$value->itemcode.'" class="quickview popup">
		<div class="quickview-inner popup-inner clearfix">
			<a href="#" class="popup-close">Close</a>
			<div class="images">
				<div class="p-preview">
                	<div class="slider">';
                		foreach ($imgArray as $key) { 
            			$output .= '<div class="item">
                			<a data-gal="prettyPhoto['.$value->itemcode.']" href="images/items/'.$key->image.'" target="_blank">
                				<img src="images/items/'.$key->image.'" alt="'.$key->image.'">
                			</a>
                		</div>';
                		}

                		
                $output .= '</div>
                </div>

				<div class="p-thumb">
					<div class="thumb-slider">';
						foreach ($imgArray as $key) { 
						$output .= '<div class="item">
                			<a href="images/items/'.$key->image.'">
                				<img src="images/items/'.$key->image.'" alt="'.$key->image.'">
                			</a>
                		</div>';
                		}
					$output .= '</div>
				</div>
			</div>

			<div class="summary">
				<h3 class="p-title"><a href="single-product.php?item='.$value->itemcode.'">'.ucwords($value->title).'</a></h3>
				<h4>'.$value->brand.'</h4><br>
				<span class="price">
					<ins><span class="amount">₹'.$value->rent_price.'</span></ins>
					<del>₹'.$value->retail_price.'</del>
				</span>

				<div class="p-desc">
					<p>'.$value->description.'</p>
				</div>

				<form action="#">
					<div class="attribute clearfix">
						<div class="attr-item pull-left">
							<label>Color:</label>
							<div class="selectbox medium">
								<select name="color">
									<option value="'.$value->colors.'">'.$value->colors.'</option>
								</select>
							</div>
						</div>

						<div class="attr-item pull-right">
							<label>Size:</label>
							<div class="selectbox medium">
								<select name="size">
									<option value="'.$value->size.'">'.$value->size.'</option>
								</select>
							</div>
						</div>
					</div>

					<div class="attribute attribute-actions clearfix">
						<div class="attr-item">
							<label>Qty:</label>
							<div class="quantity">
								<input type="number" step="1" min="0" value="1" title="Qty" class="qty" size="4">
							</div>
						</div>

						
					</div>
				</form>

			</div>
		</div>

		<div class="mask popup-close"></div>
	</div>';

} 


$price_max = max($price_array);
$res_obj->result=$output;
$res_obj->max=$price_max;
echo json_encode($res_obj);

?>