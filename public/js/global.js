function $(id) {
	return document.getElementById(id);
}

/**
 * @param{string} target
 * @param{*} val
 */
function set_selected_option(target, val)
{
	var i;
	var elem = document.querySelector('select[name=' + target + ']');
	var options = elem.querySelectorAll('option');
	
	if (!elem) {
		return false;
	}
	for (i = 0; i < options.length; i++) {
		if (options[i].value == val) {
			options[i].selected = true;
			elem.style.color = "#333";
			break;
		}		
	}
	
}
