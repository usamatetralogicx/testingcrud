<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
	<form class="kt-form"  id="category-form" enctype="multipart/form-data">
						{!! csrf_field() !!}
						<div class="kt-portlet__body">
							<div class="kt-section kt-section--first">
								<div class="form-group">
									<label>User Name:</label>
									<input type="text" class="form-control" placeholder=""name="name">
									<span class="form-text  name_error" style="font-size: 16px;color: red;"></span>
								</div>
		<div class="container">
			<h2>Add new user</h2>
 <div class="form-group">
									<label>Add Image</label>
									<div>
										<img src=" "height="120px" width="120px" id="avatar" style="border-radius: 15px 50px;
										
										padding: 10px;">
										</div>
									
									
									<input type="file" id="image" name="image" class="form-control">
									<span class="form-text  image_error" style="font-size: 16px;color: red;"></span>
									
								</div>
								
								
							</div>
						</div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js" ></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function(){
		document.getElementById("image").onchange = function () {
var reader = new FileReader();
reader.onload = function (e) {
// get loaded data and render thumbnail.
document.getElementById("avatar").src = e.target.result;
};
// read the image file as a data URL.
reader.readAsDataURL(this.files[0]);
};
$('#category-form').submit(function(e){
e.preventDefault();
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
}
});
var myForm = document.getElementById('category-form');
var formData = new FormData(myForm);
$.ajax({
url: "{{ url('adduser') }}",
method : 'post',
data: formData,
contentType: false,
cache: false,
processData: false,
success: function(result){
if(result.success==0){
if(result.validation==0){
if(result.message.name)
{
$('.name_error').html(result.message.name[0]);
}else{
$('.name_error').html('');
}
if(result.message.image)
{
$('.image_error').html(result.message.image[0]);
}
}
}

else{
bootbox.alert({
title: "Message",
message:result.message,
callback: function(){
$("#category-form").trigger("reset");
$('.name_error').html('');
$('.image_error').html('');
$('#avatar').html('');
// $('.show_image').css('display','none');
}
});
}
}});
});

});


                 

              //   jQuery('#product-form').submit(function(e){
              //     e.preventDefault();
              //     $.ajaxSetup({
              //       headers: {
              //         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              //       }
              //     });
              //     var myForm = document.getElementById('product-form');
              //     var formData = new FormData(myForm);
              //       jQuery.ajax({
              //         url: "{{ url('update/{id}') }}",
              //         method : 'post',
              //         data: formData,
              //         contentType: false,
              //          cache: false,
              //          processData: false,
              //         success: function(result){
              //           if(result.success==0){
              //             if(result.validation==0){
              //               if(result.message.title)
              //               {
              //                 $('.title_error').html(result.message.title[0]);
              //               }
              //              if(result.message.image)
              //               {
              //                 $('.image_error').html(result.message.image[0]);
              //               }
              //               if(result.message.price)
              //               {
              //                 $('.price_error').html(result.message.price[0]);
              //               }
              //               if(result.message.description)
              //               {
              //                 $('.description_error').html(result.message.description[0]);
              //               }

              //             }
              //           }
                        
              //           else{
              //             bootbox.alert({
              //   title: "Message",
              //   message:result.message,
              //   callback: function(){
              //      $("#category-form").trigger("reset");
              //                 $('.image_error').html('');
              //                 $('.category_error').html('');
              //                 $('.show_image').css('display','none');
              //   }   
              // });


              //           }
              //         }});
              //     });

                 
                 // Update record
// $(document).on("click", ".update" , function() {
//   var edit_id = $(this).data('id');

//   var name = $('#name_'+edit_id).val();
//   var image = $('#image_'+edit_id).val();

//   if(name != '' && email != ''){
//     $.ajax({
//       url: "{{url('update')}}"/+id,
//       type: 'post',
//       data: {_token: CSRF_TOKEN,editid: edit_id,name: name,email: email},
//       success: function(response){
//         alert(response);
//       }
//     });
//   }else{
//     alert('Fill all fields');
//   }
// });


           
		
	
</script>
</body>
</html>