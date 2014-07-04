function $$(id){
	return document.getElementById(id);
} 

onload = function(e) {
	var i =0;
	
	/* Tooltip */
	$(document).tooltip({
		track: true
	});
	
	/* Date Pickers */
	$(".datepicker").datepicker({
		dateFormat: 'dd-M-yy',
		showOtherMonths: true,
		}
	);
	
	$("input[name=issue_date]").val(issue_date);
	$("input[name=pay_date]").val(pay_date);
	
	/* Period Date Pickers */
	
	$( "#from" ).datepicker({
        defaultDate: "-1m",
        changeMonth: false,
        showOtherMonths: true,
        numberOfMonths: 3,
        dateFormat: 'dd-M-yy',
        onClose: function( selectedDate ) {
        	$( "#to" ).datepicker( "option", "minDate", selectedDate );
        }
    });
    $( "#to" ).datepicker({
        defaultDate: "-1m",
        changeMonth: false,
        showOtherMonths: true,
        numberOfMonths: 3,
        dateFormat: 'dd-M-yy',
        onClose: function( selectedDate ) {
            $( "#from" ).datepicker( "option", "maxDate", selectedDate );
        }
    });
	
	/* Calculate Amount/Price */
	$('input[name=quantity]').bind('input', function(){
		calc_amount('quantity');
	});
	
	$('input[name=price]').bind('input', function(){
		calc_amount('price');
	});
	
	$('input[name=amount]').bind('input', function(){
		calc_amount('amount');
	});
	
	/*------------------------------------*/
	/* Form auto-submit */
	$('.form_send').bind('click', function(e){
		e.preventDefault();
		var suffix = this.id.split('_');
		$('#form_' + suffix[1]).submit();
	});
	
	$('.select_autosend').bind('change', function() {
		this.form.submit();
	});
	
	$('.input_text_autosend').bind('change', function() {
		this.form.submit();
	});
	
	/*------------------------------------*/
	
	/* Select tag color manager */
	$('select').bind('change', function(e) {
		if (this.value >= 0) {
			this.style.color = '#333';
		} else {
			this.style.color = '#aaa';
		}
	});
	
	var selects = document.querySelectorAll('select');
	for (i = 0; i < selects.length; i++) {
		if(selects[i].value >= 0) {
			selects[i].style.color = '#333';	
		} 		
	}

};


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

/**
 * @param{string} elem
 * 
 * */
function calc_amount(elem)
{
	var qty = parseFloat($('input[name=quantity]').val()) || 0;
	var price = parseFloat($('input[name=price]').val()) || 0;
	var amount = parseFloat($('input[name=amount]').val()) || 0;
	if (elem == 'price' || elem == 'quantity') {
		$('input[name=amount]').val(parseFloat(qty * price).toFixed(5));
	}
	if (elem == 'amount') {
		$('input[name=price]').val(parseFloat(amount / qty).toFixed(5));
	}
	
}