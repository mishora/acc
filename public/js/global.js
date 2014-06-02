function $(id) {
	return document.getElementById(id);
}
/**
 * @param{string} target
 * @param{string} msg
 * @param{boolean} has_overlay
 * @param{string=} msg_color
 */
function dialog_box_show(target, msg, has_overlay, msg_color) {

	if (msg_color) {
		$(target).style.color = msg_color;
	}
	if ($(target)) {
		$(target).style.display = 'block';
		$('dialog-box-msg').innerHTML = msg;
		if (has_overlay) {
			$('overlay').style.display = 'block';
		} else {
			console.log('global.js: Unable to get element overlay!');
		}
	}
}

/**
 * @param{string} target
 * @param{boolean} has_overlay
 */
function dialog_box_hide(target, has_overlay)
{
	if ($(target)) {
		$(target).style.display = 'none';
		if (has_overlay) {
			$('overlay').style.display = 'none';
		} else {
			console.log('global.js: Unable to get element overlay!');
		}
	}
}
