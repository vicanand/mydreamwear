function init_owl(){
	$( '.quick-view' ).on( 'click', function(e) {
        e.preventDefault();
        var target = $(this).attr("href");
        var _this = $( ''+target );
        $( _this ).addClass( 'popup-open' );

        var sync1 = $( _this ).find( '.p-preview .slider' );
        var sync2 = $( _this ).find( '.thumb-slider' );

        sync1.owlCarousel({
            singleItem: true,
            slideSpeed: 1000,
            navigation: false,
            pagination: false,
            afterAction: syncPosition,
            responsiveRefreshRate: 200,
        });

        sync2.owlCarousel({
            items: 4,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [979, 4],
            itemsTablet: [768, 4],
            itemsMobile: [479, 3],
            pagination: false,
            navigation: true,
            navigationText: [
                '<i class="fa fa-angle-left"></i>',
                '<i class="fa fa-angle-right"></i>'
            ],
            responsiveRefreshRate: 100,
            afterInit: function (el) {
                el.find(".owl-item").eq(0).addClass("synced");
            }
        });

        function syncPosition(el) {
            var current = this.currentItem;
            $( sync2 )
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced")
            if ($(".slider-images").data("owlCarousel") !== undefined) {
                center(current)
            };
        }

        $( sync2 ).on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).data("owlItem");
            sync1.trigger("owl.goTo", number);
        });

        function center(number) {
            var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
            var num = number;
            var found = false;
            for (var i in sync2visible) {
                if (num === sync2visible[i]) {
                    var found = true;
                }
            }

            if (found === false) {
                if (num > sync2visible[sync2visible.length - 1]) {
                    sync2.trigger("owl.goTo", num - sync2visible.length + 2)
                } else {
                    if (num - 1 === -1) {
                        num = 0;
                    }
                    sync2.trigger("owl.goTo", num);
                }
            } else if (num === sync2visible[sync2visible.length - 1]) {
                sync2.trigger("owl.goTo", sync2visible[1])
            } else if (num === sync2visible[0]) {
                sync2.trigger("owl.goTo", num - 1)
            }
        }
    });
    $( '.popup-close' ).on( 'click', function(e) {
        e.preventDefault();
        $( this ).parents( '.popup' ).removeClass( 'popup-open' );
    });
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
				if (message.msg == "false") {
					alert("Please login to continue!");
				}else if(message.msg == "exists"){
					alert("Item Already in your Cart!");
				}else{
					alert("Item Added to your Cart!");
				}
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
				if (message.msg == "false") {
					alert("Please login to continue!");
				}else if(message.msg == "exists"){
					alert("Item Already in your wishlist!");
				}else{
					alert("Item Added to your wishlist!");
				}
			}
		});
	})
	$("a[data-gal^='prettyPhoto']").prettyPhoto({
        hook: 'data-gal',
        animation_speed:'normal',
        theme:'light_square',
        slideshow:3000,
        social_tools: false
    });
}


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
			if (message.msg == "false") {
				alert("Please login to continue!");
			}else if(message.msg == "exists"){
				alert("Item Already in your Cart!");
			}else{
				alert("Item Added to your Cart!");
			}
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
			if (message.msg == "false") {
				alert("Please login to continue!");
			}else if(message.msg == "exists"){
				alert("Item Already in your wishlist!");
			}else{
				alert("Item Added to your wishlist!");
			}
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
	var res = $(".signin").validate();
	console.log(res);
	console.log(res.errorList.length);
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	var curform = $(this);
	if($(".signin").validate().errorList.length == 0){
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
	}
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
				$(".signup")[0].reset();
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


$(".listupload").submit(function(e){
	e.preventDefault();
	if($("#file").val() != ""){
		$(".imageupload").submit();
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
						$(".listupload")[0].reset();
						$(".imageupload")[0].reset();
						alert("Item Upoaded!");

					}else{
						alert("Upload Failed, Check your title/images!");
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
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	$.ajax({
		type: "POST",
		url: "newitem.php",
		data: formData,
		success: function(msg) {
			if (msg != "false") {
				alert("Item Updated!");
			}else{
				alert("Update Failed, Check your title/images!");
			}
		}
	})
})

$(".resetpass").submit(function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	if ($("#pass").val() == $("#pass1").val() && $("#pass").val().length >= 8 && $("#pass1").val().length >= 8) {
		$.ajax({
			type: "POST",
			url: url,
			data: formData,
			success: function(msg) {
				if (msg != "false") {
					alert("Password changed successfully!");
					window.location.href = "login-register.php";
				}else{
					alert("Password can not be changed. Try Again!");
				}
			}
		})
	}else{
		$("#pass").val("");
		$("#pass1").val("");
		alert("Passwords donot match or enter atleast 8 characters.");
	}
})

$(".forgotpass").submit(function(e){
	e.preventDefault();
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	var type = '<?php echo $_GET["type"]; ?>';
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		success: function(msg) {
			if (msg != "false") {
				$(".forgotpass")[0].reset();
				alert("Password reset link sent to your email!");
			}else{
				alert("Error check your email!");
			}
		}
	})
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


$(".checkoutform").submit(function(e){
	e.preventDefault();
	var url = $(this).attr("action");
	var message = "";
	var formData = $(this).serializeArray();

	$('input,textarea,select').each(function(){
		if($(this).val() == ""){
			return;
		}
	})
	
	var redirect = "false";
	
	if($(".checkoutitem").length > 0){
		$(".checkoutitem").each(function(){
			var itemcode = $(this).attr("data-code");
			var price = $(this).attr("data-price");
			var title = $(this).attr("data-title");
			var newformData = formData.slice();
			newformData.push({name:"itemcode", value:itemcode});
			newformData.push({name:"itemname", value:title});
			newformData.push({name:"rentamt", value:price});
			newformData.push({name:"total", value:price*2});
			console.log(newformData);
			$.ajax({
				type: "POST",
				url: url,
				data: newformData,
				success: function(msg) {
					// redirect = msg;
				}
			})
		})
		
			window.location.href = "order-complete.php";
		
	
	}else{
		alert("There is nothing in your cart");
	}

})

$("#processcart").click(function(e){
	e.preventDefault();
	if ($(".cart-table tbody tr").length > 0) {
		window.location.href = "checkout.php";
	}else{
		alert("There is nothing in your cart");
	}
})

$(document).ready(function(){
	$(".signin").validate();
	$(".checkout-form").validate();
	$(".forgotpass").validate();
	$(".resetpass").validate();
})

$(".sub-menu").each(function(){
	if($(this).children().length < 1){
		$(this).remove();
	}
})

// $(window).scroll(function() {
//     if($(window).scrollTop() + $(window).height() == $(document).height()) {
//         //alert("bottom!");
//     }
// });

$("#showmore").click(function(e){
	e.preventDefault();
	var me = $(this);
	$(this).hide();

	$("#ajaxloader").show();
	var i_url = $(this).attr("data-url");
	var i_index = parseInt($(this).attr("data-index"));
	var i_count = parseInt($(this).attr("data-count"));
	var new_url = i_url+i_index+"/"+i_count;
	$(this).attr("data-index", i_index+i_count);

	$.ajax({
		type: "POST",
		url: "showmore.php",
		data: {"url":new_url},
		success: function(msg) {
			var res = JSON.parse(msg);
			$("#productslist").append(res.result);
			init_owl();

			var min_val = parseInt($('#filternow').attr("data-min"));
		    var max_val = parseInt(res.max);
		    if(max_val){
			    $('#slider-range').slider({

			        range: true,

			        min: min_val,

			        max: max_val,

			        values: [min_val, max_val],

			        slide: function (event, ui) {

			            $('#amount').text('₹' + ui.values[0] + ' - ₹' + ui.values[1]);
			            $('#filternow').attr("data-min",ui.values[0]);
			            $('#filternow').attr("data-max",ui.values[1]);
			        }

			    });

			    $('#amount').text('₹' + $('#slider-range').slider('values', 0) + ' - ₹' + $('#slider-range').slider('values', 1));
			    $('#filternow').attr("data-min",$('#slider-range').slider('values', 0));
			    $('#filternow').attr("data-max",$('#slider-range').slider('values', 1));

			}
			$("#ajaxloader").hide();
			if (res.size < 9) {
				me.hide();	
			}else{
				me.show();
			}
			
		}
	})
})

$(".contact-form").submit(function(e){
	e.preventDefault();
	$("#contact-submit").hide();
	$("#ajaxloader").show();
	var formData = $(this).serializeArray();
	var url = $(this).attr("action");
	$.ajax({
		type: "POST",
		url: url,
		data: formData,
		success: function(msg) {
			if (msg == "Sent") {
				$("#ajaxloader").hide();
				$(".contact-form")[0].reset();
				$("#result").html("Your message has been sent successfully!");
			}else{
				$("#ajaxloader").hide();
				$("#contact-submit").show();
				alert("Email not sent! Try Again.");
			}
		}
	})
})

$(".datepicker").datepicker({ minDate: 0});