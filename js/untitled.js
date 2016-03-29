$(".add-to-cart-button").click(function(e){
	e.preventDefault();
	$("#pageloader").show();
	var item = $(this).parent().parent();
	var itemcode = $(this).attr("data");
	var quant = $("#quantity").val();
	if(!quant){
		quant = 1;
	}
	$.ajax({
		type: "POST",
		url: "wishcart.php",
		data: {"itemcode":itemcode, "type":"cart", "quantity":quant},
		success: function(data) {
			var message = JSON.parse(data);
			if(message.cart){
				$("#cart_list").html(message.cart);
				$("#cart-number").text(message.count);
				$("#totalamthead").text(message.total);
			}
			$("#pageloader").hide();
			//console.log(message);
			alert(message.msg);
			
		}
	});
})
$(".add-to-wishlist").click(function(e){
	e.preventDefault();
	var itemcode = $(this).attr("data");
	$.ajax({
		type: "POST",
		url: "wishcart.php",
		data: {"itemcode":itemcode, "type":"wish"},
		success: function(msg) {
			var message = JSON.parse(msg);
			alert(message.msg);
		}
	});
})
$(".removefromcart").click(function(e){
	e.preventDefault();
	var itemcode = $(this).attr("data");
	var item = $(this).parent().parent();
	$.ajax({
		type: "POST",
		url: "wishcart.php",
		data: {"itemcode":itemcode, "action":"removefromcart"},
		success: function(msg) {
			item.remove();
			$("#item-"+itemcode).remove();
			var total = 0.00;
			$(".units").each(function(){
				//console.log($(this).text().replace("₹", ""));
				total = total + parseFloat($(this).text().replace("₹", ""));
			})
			$(".totalamt").text("₹"+total);
			var num = parseInt($("#cart-number").text());
			$("#cart-number").text(num-1);
			alert(msg);
		}
	});
})
$(".removefromwish").click(function(e){
	e.preventDefault();
	var itemcode = $(this).attr("data");
	var item = $(this).parent().parent();
	$.ajax({
		type: "POST",
		url: "wishcart.php",
		data: {"itemcode":itemcode, "action":"removefromwish"},
		success: function(msg) {
			item.remove();
			alert(msg);
		}
	});
})


$("#filternow").click(function(){
	var minprice = parseFloat($(this).attr("data-min"));
	var maxprice = parseFloat($(this).attr("data-max"));
	$(".product").each(function(){
		var product = $(this);
		var itemprice = parseFloat($(this).attr("data-price"));
		if (itemprice > maxprice || itemprice < minprice) {
			product.hide();
		}else{
			product.show();
		}
	})
})

$(".orderby").change(function(){
	var sorting = $(this).val();
	if(sorting == "highlow"){
		$(".product").sort(sort_li_desc).appendTo('.products');
	}else{
		$(".product").sort(sort_li_asc).appendTo('.products');
	}
})

function sort_li_asc(a, b){
	return parseFloat($(b).data('price')) < parseFloat($(a).data('price')) ? 1 : -1;    
}
function sort_li_desc(a, b){
	return parseFloat($(b).data('price')) > parseFloat($(a).data('price')) ? 1 : -1;    
}

$("#quantity").change(function(){
	var qty = $(this).val();
	var rent = $(".rent-single").text();
	var retail = $(".retail-single").text();
	console.log(qty+"--"+rent+"--"+retail);
})

$(".signin").submit(function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	var curform = $(this);
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		success: function(msg) {
			if (msg == "true") {
				window.location.href = "index.php";
			}else{
				curform.find("input").css("border-color", "red");
				alert("Email or Password is not correct !");
			}
			
		}
	});
})

$(".signup").submit(function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	var curform = $(this);
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		success: function(msg) {
			if (msg == "true") {
				alert("Signup successful! Please login to continue.")
			}else{
				curform.find("input").css("border-color", "red");
				alert("Email or Mobile is already registered !");
			}
			
		}
	});
})


$(".imageupload").submit(function(e){
	e.preventDefault();
	var formData = new FormData($(this)[0]);
	var	url = $(this).attr("action");
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: function(msg) {
			$("#allimages").attr("value", msg);
			//alert("Image upload. Continue to fill rest of the details.");
		}
	});
})

$("#abc").click(function(){
	var def = $("#file")[0].files;
	var names = "";
	for (var i = 0; i < def.length; i++)
    {
    	var initname = $("#file")[0].files[i].name;
    	var name_ext = initname.split(".");
    	var img_name = CryptoJS.MD5(name_ext[0]+Date.now)+"."+name_ext[1];
		names = names + img_name + ",";
    }
    names = names.replace(/(^,)|(,$)/g, "");
    console.log(names);
})

$(".listupload").submit(function(e){
	e.preventDefault();
	if($("#file").val() != ""){
		var def = $("#file")[0].files;
		var names = "";
		for (var i = 0; i < def.length; i++)
	    {
	    	var initname = $("#file")[0].files[i].name;
	    	var name_ext = initname.split(".");
	    	var img_name = CryptoJS.MD5(name_ext[0]+Date.now)+"."+name_ext[1];
			names = names + img_name + ",";
	    }
	    names = names.replace(/(^,)|(,$)/g, "");
	    $("#allimages").attr("value", names);
		var formData = $(this).serializeArray();
		console.log(formData);
		var url = $(this).attr("action");
		if($("#file").val() != ""){
			$.ajax({
				type: "POST",
				url: "newitem.php",
				data: formData,
				success: function(msg) {
					if (msg != "false") {
						$(".imageupload").submit();
					}else{
						alert("Some error has occured. Try with another title!");
					}
				}
			})
		}else{
			alert("Upload atleast an image first!");
		}
	}else{
		alert("Upload atleast an image first!");
	}
})

$(".listupdate").submit(function(e){
	e.preventDefault();
	//if($("#file").val() != ""){
	//	$(".imageupload").submit();
		var formData = $(this).serializeArray();
	//	console.log(formData);
		var url = $(this).attr("action");
	//	if($("#file").val() != ""){
			$.ajax({
				type: "POST",
				url: "newitem.php",
				data: formData,
				success: function(msg) {
					alert(msg);
				}
			})
	//	}else{
	//		alert("Upload atleast an image first!");
	//	}
	//}else{
	//	alert("Upload atleast an image first!");
	//}
})


if(document.getElementById("file")){
var inputLocalFont = document.getElementById("file");
inputLocalFont.addEventListener("change",previewImages,false); //bind the function to the input
}
function previewImages(){
    var fileList = this.files;

    var anyWindow = window.URL || window.webkitURL;
    	var data = "";
        for(var i = 0; i < fileList.length; i++){
          //get a blob to play with
          var objectUrl = anyWindow.createObjectURL(fileList[i]);
          // for the next line to work, you need something class="preview-area" in your html
          data += '<img src="' + objectUrl + '" />';
          
          // get rid of the blob
          window.URL.revokeObjectURL(fileList[i]);
        }
        $('#preview').html(data);


}


$(".checkout-form").submit(function(e){
	e.preventDefault();
	var url = $(this).attr("action");
	var message = "";
	var formData = $(this).serializeArray();
	//console.log(formData);
	$(".checkoutitem").each(function(){
		var itemcode = $(this).attr("data-code");
		var price = $(this).attr("data-price");
		var title = $(this).attr("data-title");
		var newformData = formData.slice();
		newformData.push({name:"itemcode", value:itemcode});
		newformData.push({name:"itemname", value:title});
		newformData.push({name:"rentamt", value:price});
		newformData.push({name:"total", value:price});
		console.log(newformData);
		$.ajax({
			type: "POST",
			url: url,
			data: newformData,
			success: function(msg) {
				message = msg;
			}
		})
	})
	// alert(message);
	window.location.href = "order-complete.php";

})