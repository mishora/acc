function $$(id){
	return document.getElementById(id);
} 

onload = function(e){	
	/* Date Pickers */
	$(".datepicker").datepicker();
	$(".datepicker").datepicker('option', 'dateFormat', 'dd-M-yy');
	$("input[name=issue_date]").val(issue_date);
	$("input[name=pay_date]").val(pay_date);
	
	/* Calculate Amount */
	$('input[name=quantity]').bind('input', function(){
		calc_amount();
	});
	$('input[name=price]').bind('input', function(){
		calc_amount();
	});
};


/**
 * @param{string} target
 * @param{*} val
 */
function set_selected_option(target, val)
{
	var i;
	var elem = document.querySelector('select[name=' + target + ']');
	console.log(target);
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

function calc_amount()
{
	var qty = parseFloat($('input[name=quantity]').val()) || 0;
	var price = parseFloat($('input[name=price]').val()) || 0;
	console.log(typeof(qty) + "   " + qty);
	$('input[name=amount]').val(parseFloat(qty * price).toFixed(5));
}