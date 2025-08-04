$(document).ready(function()
{
	$(".role-table .checker-helper-col").change(function()
	{
		var _this = this;
		
		$(".role-table td:nth-child(" + ($(_this).closest("th").prevAll().length + 1) + ")").each(function()
		{
			if($(this).find("[type='checkbox']").length > 0) $(this).find("[type='checkbox']").prop("checked", $(_this).prop("checked")).change();
		});
	});
	
	$(".role-table .checker-helper-row").change(function()
	{
		var _this = this;
		
		$(_this).closest("td,th").nextAll().each(function()
		{
			if($(this).find("[type='checkbox']").length > 0) $(this).find("[type='checkbox']").prop("checked", $(_this).prop("checked")).change();
		});
	});
});

(function($)
{
	$.fn.a = function()
	{
		
	};
})(jQuery);