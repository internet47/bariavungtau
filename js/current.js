/* ------------------------------------------------------- */
/* Update�F2010.03.03
/* ���݈ʒu�̃i�r�Q�[�V�����𔽓]������ׂ�js�t�@�C��
/* ------------------------------------------------------- */

$(document).ready( function() {
		$("#globalNav li a,#nav a").each( function() {
				var url = document.URL.split("#");
				if ( this == url[0] || this + "index.html" == url[0]) {
						$(this).addClass("current");
				}
		});
});
$(function() {
  $(".current").each(function(){
		$(this).find('img').each(function(){
			this.currentSrc = this.getAttribute('src').replace("_off.", "_on.");
			$(this).attr('src',this.currentSrc);
		});
	});
});
