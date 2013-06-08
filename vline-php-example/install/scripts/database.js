$(document).ready(function(e) {
	$(".navbar-form").submit(function(e){
		e.preventDefault();
		return false;
	});
	
    $(".checkconn").click(function(){
		$.ajax({
			url: './actions/checkconnection.php',
			method: 'POST',
			async: true,
			data:$(".navbar-form").serialize(),
			success:function(results){
				var data = JSON.parse(results);
				if(data.connected){
					alert('Connected!');
				}
				else{
					alert('Failed to connect');
				}
			}
		});	
	});
	
});

function tryToGoToNextStep(){
	$.ajax({
		url: './actions/checkconnection.php',
		method: 'POST',
		async: true,
		data:$(".navbar-form").serialize(),
		success:function(results){
			var data = JSON.parse(results);
			if(data.connected){
				$(".navbar-form").unbind().submit();
			}
			else{
				alert('Your current configuration is not valid');
			}
		}
	});		
}