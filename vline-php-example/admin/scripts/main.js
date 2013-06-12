$(document).ready(function(e) {
    $(".del").click(function(event) {
		event.preventDefault();
		var r=confirm("Are you sure you want to delete this user?");
		if (r==true)   {  
		   window.location = $(this).attr('href');
		}
	
	});
	
});

function trytosubmit(){
	var that = $(this);
	
	if($.trim($("#name").val()) == '' || $.trim($("#username").val()) == '' || $.trim($("#password").val()) == ''){
		alert("All fields are madantory");	
		return false;
	}
	
	var result = $.ajax({
		url: './actions/checkusername.php',
		method: 'POST',
		async: false,
		data:'username='+$("#username").val()+"&exclude=-1"
	}).responseText;	
	var data = JSON.parse(result);
	if(data.valid){
		return true;
	}
	else{
		alert('The selected username is already been used by another user. Please select an other one');
		return false;
	}
}