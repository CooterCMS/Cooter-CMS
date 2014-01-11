$(document).ready(function(){

$('#subscribeForm').modalPopLite({ openButton: '#subscribeButton', closeButton: '#close-btn'});
$('#unSubscribeForm').modalPopLite({ openButton: '#unSubscribeButton', closeButton: '#close-btn'});

var dataString = {
	vwcsT : csfr_token_value
};

$('#subscribeButton').click(function(){

$('#subscribeForm').show();

$('#loadingmessage').css('position', 'fixed')
.css('left', '45%')
.css('top', '45%')
.show();

	$.ajax({
		type: "POST",
		url: 'http://www.valleywestcornerstore.com/coupons/subscribe_form/subscribe',
		data: dataString,
		cache: false,
		success: function(html){
			
			$('#subscribeForm').html(html);

			$('#subscribe').click(function(){
			
			var post_email = $('input[name="email"]').val();
			
			var dataString = {
				email : post_email, 
				vwcsT : csfr_token_value
			};
			
				$.ajax({
					type: "POST",
					data: dataString,
					url: base_url+'coupons/subscribe',
					cache: false,
					success:function(html){
						var obj = JSON && JSON.parse(html) || $.parseJSON(html);
						if(obj.valid_email == true){
							
							// Show message
							$('#subscribeForm').html(obj.message);
							
						}else{
							// Show Error Message
							$('.error_message').show();
							$('.error_message').html(obj.message);
							$('.error_message').fadeOut(4000);
						}
						
					},
					complete: function(){
						
						
					}
				});
			});

		},
		complete: function() {
			
			$('#loadingmessage').hide();
		}
	});
	
});

$('#unSubscribeButton').click(function(){

$('#unSubscribeForm').show();

$('#loadingmessage').css('position', 'fixed')
.css('left', '45%')
.css('top', '45%')
.show();

	$.ajax({
		type: "POST",
		url: 'http://www.valleywestcornerstore.com/coupons/subscribe_form/unsubscribe',
		data: dataString,
		cache: false,
		success: function(html){
			$('#unSubscribeForm').html(html);

			$('#unsubscribe').click(function(){
			
			var post_email = $('input[name="email"]').val();
			var post_comment = $('input[name="comment"]:checked').val();
			
			var dataString = {
				comment : post_comment,
				email : post_email, 
				vwcsT : csfr_token_value
			};
			
				$.ajax({
					type: "POST",
					data: dataString,
					url: base_url+'coupons/unsubscribe',
					cache: false,
					success:function(html){
						
						var obj = JSON && JSON.parse(html) || $.parseJSON(html);
						
						if(obj.valid_email == true){
							
							// Show message
							$('#unSubscribeForm').html(obj.message);
							
						}else{
							// Show Error Message
							$('.error_message').show();
							$('.error_message').html(obj.message);
							$('.error_message').fadeOut(4000);
						}
						
						
					},
					complete: function(){
						
						
					}
				});
			});

		},
		complete: function() {
			
			$('#loadingmessage').hide();
		}
	});
	
});  
 
});