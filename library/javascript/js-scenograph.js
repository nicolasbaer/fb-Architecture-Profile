function changeToggleButtonIcon(icon_id) {
	var icon  = document.getElementById( icon_id );
    if (icon.className == 'icon-chevron-down') {
		icon.className = 'icon-chevron-up'
	}
	else {
		icon.className = 'icon-chevron-down'
	}
}