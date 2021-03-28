$(document).ready(function(){

	$('.toggle-cs').on('click', function(e) {

		e.preventDefault();

		$(this).closest('.list-item').find('.list-child').slideToggle();

	});

	if($('.check__checkbox_all').length > 0) {

		$('.check__checkbox_all').each(function() {

			var count = $(this).find('.list-child input[type="checkbox"]').length;

			var check = $(this).find('.list-child input[type="checkbox"]:checked').length;

			if(count == check) $(this).find('.parent-check').prop('checked', true);

		});

	}

	$('.check__checkbox_all .parent-check').on('change', function() {

		if($(this).prop('checked')) {

			$(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').prop('checked', true);

		}else{

			$(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').prop('checked', false);

		}

	});

	$('.check__checkbox_all .list-child input[type="checkbox"]').on('change', function() {

		var count = $(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]').length;

		var check = $(this).closest('.check__checkbox_all').find('.list-child input[type="checkbox"]:checked').length;

		if(count == check) $(this).closest('.check__checkbox_all').find('.parent-check').prop('checked', true);

			else $(this).closest('.check__checkbox_all').find('.parent-check').prop('checked', false);

	});


	$('#eq_cates').on('change', function() {
		var id = $(this).val();
		var action = $(this).closest('form').attr('data-filter');
		var token = $('input[name="_token"]').val();
		$.ajax({
			type:"POST",
			url:action,
			data: {
				'_token' : token,
				'id' : id,
			},
			success:function(data){
				console.log(data)
				if(data.check == 'true') {
					$('#ClassId').html(data.html);
					$('#ClassId .select2').select2();
				}
			}
		});
	});


});

(function($) {

	'use strict';

	if($('.check__checkbox_all').length > 0) {



	}

});

