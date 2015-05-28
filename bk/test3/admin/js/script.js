    $(function() {
      $('.footable').footable();

		$('.defaultvalue').each(function(){
			var txtval = $(this).val();
			$(this).focus(function(){
				if($(this).val() == txtval){
					$(this).val('')
				}
			});
			$(this).blur(function(){
				if($(this).val() == ""){
					$(this).val(txtval);
				}
			});
		});
	
		$("a.tiptip").tipTip();
		$(".tiptip").tipTip();
		
    });
