jQuery(function($)
{
	$('html').noisy({
		'intensity' : 0.18,
		'size' : 200,
		'opacity' : 0.08,
		'fallback' : '',
		'monochrome' : false
	});

	$('#social a').tipsy({ gravity: 's' });

	$('#header h1').each(function()
	{
		var $head = $(this);
		var $body = $('body');

		// Get the baseline offset
		var top = $head.position().top;

		var fader = function()
		{
			// Get the current and maximum scroll
			var cur = $body.scrollTop() - top;
			var max = $body.height();

			if (cur > 0)
			{
				// Fade to the next level
				$head.stop(true, false).fadeTo('fast', 1 - (cur / max));
			}
		};
		var timer = null;

		$(window).scroll(function()
		{
			// Use a timer for performance
			timer && clearTimeout(timer);
			timer = setTimeout(fader, 20);
		});
	});
});
