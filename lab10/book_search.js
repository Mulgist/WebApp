window.onload = function() {
    $("b_xml").onclick=function(){
		//construct a Prototype Ajax.request object
		new Ajax.Request("./books.php", {
			method: "get",
			parameters: {category: getCheckedRadio($$('input[name="category"]')), delay: 0},
			onSuccess: showBooks_XML,
			onException: ajaxFailed
		});
    }
    $("b_json").onclick=function(){
		//construct a Prototype Ajax.request object
		new Ajax.Request("./books_json.php", {
			method: "get",
			parameters: {category: getCheckedRadio($$('input[name="category"]')), delay: 0},
			onSuccess: showBooks_JSON,
			onException: ajaxFailed
		});
    }
};

function getCheckedRadio(radio_button){
	for (var i = 0; i < radio_button.length; i++) {
		if(radio_button[i].checked){
			return radio_button[i].value;
		}
	}
	return undefined;
}

function showBooks_XML(ajax) {
	var parser, xmlData, count, li;
	var title, author, year;
	// alert(ajax.responseText);
	parser = new DOMParser();
	xmlData = parser.parseFromString(ajax.responseText, "text/xml");
	count = xmlData.getElementsByTagName("books")[0].childElementCount;

	$("books").innerHTML = null;
	for (var i = 0; i < count; i++) {
		li = document.createElement('li');
		title = xmlData.getElementsByTagName("book")[i].getElementsByTagName("title")[0].childNodes[0].nodeValue;
		author = xmlData.getElementsByTagName("book")[i].getElementsByTagName("author")[0].childNodes[0].nodeValue;
		year = xmlData.getElementsByTagName("book")[i].getElementsByTagName("year")[0].childNodes[0].nodeValue;
		$("books").appendChild(li);
		li.innerHTML = title + ", by " + author + " (" + year + ")";
	}
}

function showBooks_JSON(ajax) {
	var jsonData, book, li;
	// alert(ajax.responseText);
	jsonData = JSON.parse(ajax.responseText);

	$("books").innerHTML = null;
	for (var i = 0; i < jsonData.books.length; i++) {
		book = jsonData.books[i];
		li = document.createElement('li');
		$("books").appendChild(li);
		li.innerHTML = book.title + ", by " + book.author + " (" + book.year + ")";
	}
}

function ajaxFailed(ajax, exception) {
	var errorMessage = "Error making Ajax request:\n\n";
	if (exception) {
		errorMessage += "Exception: " + exception.message;
	} else {
		errorMessage += "Server status:\n" + ajax.status + " " + ajax.statusText + 
		                "\n\nServer response text:\n" + ajax.responseText;
	}
	alert(errorMessage);
}
