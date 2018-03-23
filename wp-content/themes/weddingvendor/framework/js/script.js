// JavaScript Document

jQuery(document).ready(function() {
	if(jQuery('.check_date').hasClass('date'))
	{
		jQuery('.date').datepicker({  maxDate: new Date(),dateFormat: 'yy-mm-dd' });			
	}
});

