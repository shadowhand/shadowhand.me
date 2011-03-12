/*globals $ window document */
$(function(){
	$("#tweets").html('').tweet({
		avatar_size: 32,
		count: 8,
		fetch: 40,
		filter: function(t){ return ! /^@\w+/.test(t["tweet_raw_text"]); },
		username: "shadowhand",
	});

	$.getJSON('https://github.com/shadowhand.json?callback=?', function(feed)
	{
		var commits = [];

		$.each(feed, function(i, item)
		{
			if (item.type == 'PushEvent' && item.payload.size && item.url)
			{
				commits.push([
					$('<a class="tweet_avatar"></a>').attr('href', 'https://github.com/'+ item.actor).html(
						$('<img width="32" height="32" />').attr('src', 'http://www.gravatar.com/avatar/'+ item.payload.actor_gravatar +'?s=32')
					),
					$('<span class="tweet_time"></span>').html(
							$('<a></a>')
							  .attr('href', item.url)
							  .attr('datetime', item.created_at)
							  .html(item.created_at)
					),
					'<span class="tweet_text">'
						+ item.payload.size + ' commit'+ (item.payload.size != 1 ? 's' : '') +' to '
						+ '<a href="https://github.com/'+ item.payload.repo +'">'+ item.payload.repo + '</a>' +
					'</span>'
				]);
			}
		});

		var github = $('#github').html('');
		var listed = $('<ul class="tweet_list"></ul>');

		$.each(commits.slice(0, 8), function(c, row)
		{
			$.each(row, function(i, block)
			{
				row[i] = $('<div></div>').html(block).html();
			})

			$('<li></li>').html(row.join(' ')).appendTo(listed);
		});

		listed
			.find('.tweet_time a').clockwinder({ attr:false, alwaysRelative:true }).end()
			.children('li:first').addClass('tweet_first').end()
			.children('li:even').addClass('tweet_odd').end()
			.children('li:odd').addClass('tweet_even').end()
			.appendTo(github);
	});
});