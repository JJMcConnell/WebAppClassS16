var popup = document.getElementById('thePopup');	


document.getElementById('fileinput').addEventListener('change', function(){
	
	popup.style.display = "block";

	var files = this.files;
	var id = 0;

	for(var i=0; i<files.length; i++) {
		previewImage(this.files[i]);
		
	}
	

}, false);

function previewImage(file) {
	
		
	var previewPanel = document.getElementById("preview-panel");
	var imageType = /image.*/;
	
	if (!file.type.match(imageType)) {
		throw "file Type must be an image";
	}

//Creates the div for the image and form to be placed in 
	var preview = document.createElement("div");
	preview.classList.add('preview');

//Creates the form element along with the text, text input, and two buttons
	var form = document.createElement("form");
	

	var description = document.createTextNode('Description: ');

	var descBox = document.createElement("input");
	descBox.setAttribute( "type", "text");
	descBox.setAttribute( "name", "description");
	descBox.setAttribute( "id", "desc");

	var uploadBtn = document.createElement("input");
	uploadBtn.setAttribute( "type", "button");
	uploadBtn.setAttribute( "value", "Upload");
	
//Sends the file to be uploaded and removes the preview from the screen
	uploadBtn.addEventListener("click", function(e) {
		uploadFile(file);
		var x = e.target.parentNode;
		var y = x.parentNode
		y.parentNode.removeChild(y);
	}, false);

	var removeBtn = document.createElement("input");
	removeBtn.setAttribute( "type", "button");
	removeBtn.setAttribute( "value", "Remove");
	removeBtn.setAttribute( "class", "remove");
	
//This adds a listener to remove the div when the button is clicked 
	removeBtn.addEventListener("click", function(e) {
		var x = e.target.parentNode;
		var y = x.parentNode
		y.parentNode.removeChild(y);
		
	}, false);
	

//Attaches the text, text input, and buttons to the form element
	form.appendChild(description);
	form.appendChild(descBox);
	form.appendChild(uploadBtn);
	form.appendChild(removeBtn);

//Creates the image element
	var img = document.createElement("img");
	img.file = file;
	img.setAttribute( "Height", "200px");
	img.setAttribute( "Width", "200px");

//Attaches both the image and the form to the div
	preview.appendChild(img);
	preview.appendChild(form);

//Attaches the div to the panel
	previewPanel.appendChild(preview);

	
	var reader = new FileReader();
	reader.onload = (function(aImg) { return function(e) { aImg.src = e.target.result; };
})(img);
	reader.readAsDataURL(file);


	
}

function uploadFile(file) {
	var url = "upload.php";
        var xhr = new XMLHttpRequest();
        var fd = new FormData();
        xhr.open("POST", url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Every thing ok, file uploaded
                console.log(xhr.responseText); // handle response.
            }
        };
        fd.append('uploaded_file', file);
	 fd.append('description', document.getElementById('desc').value);
        xhr.send(fd);

	
}




// Makes it so that the overlay box will close when clicked outside of 
$( "#thePopup" ).click( function() {

	popup.style.display = "none";

	//This is a really shitty way to force the page to reload so that the new stuff in the database is there
	//Ideally you do some polling for a change in the DB and then ajax it 
	window.location.reload();
});

//Makes it so that the overlay box won't close when clicked inside of 
$( "#preview-panel" ).click( function( e ) {
	e.stopPropagation();
});