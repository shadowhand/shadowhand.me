/*globals $ window document */
$(function(){
	$("#tweets").html('').tweet({
		avatar_size: 32,
		count: 3,
		fetch: 20,
		filter: function(t){ return ! /^@\w+/.test(t["tweet_raw_text"]); },
		username: "shadowhand",
	});
});