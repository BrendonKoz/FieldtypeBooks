$(document).ready(function() {

/*
	// Taken from InputfieldEvents - not yet modified for this Fieldtype/Inputtype

	$(document).on("click", ".InputfieldBooksAdd", function(e) {
		$(this).removeClass('ui-state-active');
		var $row = $(this).parents(".InputfieldBooks").find("li.BookTemplate");
		$row.parent('ul').append($row.clone().hide().removeClass('BookTemplate').fadeIn());
		var id = $(this).attr('id');
		setTimeout("$('#" + id + "').removeClass('ui-state-active')", 500);
		return false;
	});

	$(document).on("click", ".InputfieldBooks a.BookClone", function(e) {
		var $row   = $(this).parents("li.Book");
		var $table = $(this).parents("table.InputfieldBooks");
		$table.append($row.clone().hide().fadeIn());
		return false;
	});

	$(document).on("click", ".InputfieldBooks a.BookDel", function(e) {
		var $row = $(this).parents("tr.Book");
		if($row.size() == 0) {
			// delete all
			$(this).parents("thead").next("tbody").find('.BookDel').click();
			return false;
		}
		var $input = $(this).next('input');
		if($input.val() == 1) {
			$input.val(0);
			$row.removeClass("BookTBD");
			$row.removeClass('ui-state-error');
		} else {
			$input.val(1);
			$row.addClass("BookTBD");
			$row.addClass('ui-state-error');
		}
		return false;
	});

	$(document).on("focus", ".InputfieldBooks .datepicker", function() {
		$(this).datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});*/

});