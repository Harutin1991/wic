var url = window.location.pathname;

$(document).ready(function () {
	
});

function searchPlaces(){
	var zip = $('#zip_code').val();
	var country = $('#country').val();
	var json_data = {
		'zip':zip,
		'country':country,
	};
	$.ajax({
		method: 'post',
		data: json_data,
		url: '/ajax/search',
		success: function (res) {
			var obj = jQuery.parseJSON(res);
			if(obj['success']){
				$('#places_list').html(obj['list']);
			}else{
				$('#places_list').html('<p style="color:red">Result Not Found. Please check Zip Code and Choose rigth Country</p>')
			}
			
		}
	});
	return false;
}