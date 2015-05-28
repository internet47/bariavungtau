	$(document).ready(function(){
		$("a[rel^='prettyOverlay'],a[rel^='prettyPhoto']").prettyPhoto({
			animationSpeed: 'normal',      /* fast/slow/normal */
			padding: 40,                   /* padding for each side of the picture */
			opacity: 0.35,                 /* Value betwee 0 and 1 */
			showTitle: true,               /* true/false */
			allowresize: true,             /* true/false */
			counter_separator_label: '/'   /* The separator for the gallery counter 1 "of" 2 */
		});
	});
