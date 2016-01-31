window.onload = function onLoad() {
	setInterval("updatebot()",1000);
};

function updatebot() {
	$.ajax({
		type: "GET",
		url: "botstatus.php",
		success: function(msg){
			$('#statusbot').html(msg);
		}
	});
}