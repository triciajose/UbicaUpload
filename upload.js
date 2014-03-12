function CopyMe(oFileInput, sTargetID) {
    document.getElementById(sTargetID).value = oFileInput.value;
}

function Submit() {
	// $("#confirmation").show();
	$('#confirmation').css("display", "inline");

}
