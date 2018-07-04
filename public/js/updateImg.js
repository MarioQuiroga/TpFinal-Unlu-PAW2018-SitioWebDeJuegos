function updateImg(){	
	var img=document.getElementById("imgAvatar");		
	var fileElem = document.getElementById("inputFile").files[0];

	var reader = new FileReader();
	reader.onload = function(event) {	 
		var ruta=event.target.result;		
		img.src=ruta;
	}
	reader.readAsDataURL(fileElem);
}