// copies uploaded file information to proper div
function CopyMe(oFileInput, sTargetID) {
    document.getElementById(sTargetID).value = oFileInput.value;
}

// confirmation line
function Submit() {
	$('#confirmation').css("display", "inline");

}

// toggle new folder visibility
function Report(value) {
	if (value == "New Folder") {
		$('#hidden').show();
	}
	else {
		$('#hidden').hide();
	}
}

// error messages
function Error() {
	$('#error').css("display", "inline");
}