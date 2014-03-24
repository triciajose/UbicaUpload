function CopyMe(oFileInput, sTargetID) {
    document.getElementById(sTargetID).value = oFileInput.value;
}

function Submit() {
	// $("#confirmation").show();
	$('#confirmation').css("display", "inline");

}

function Report(value) {
	if (value == "New Folder") {
		$('#hidden').show();
	}
	else {
		$('#hidden').hide();
	}
}

function Error() {
	$('#error').css("display", "inline");
}