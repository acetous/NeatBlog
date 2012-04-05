// global vars

$(function(){
	// prettyprint
	prettyPrint();
	
	// textarea autoresize
	$('textarea').autoResize();
	$('textarea').each(function() { $(this).change(); });
	
	// Feature: "Unread Posts"
	if (window.page_type == "post/index" && window.location.search == "" && Modernizr.localstorage) {
		var keyLastread = 'lastread_post';
		var keyUnread = 'unread_posts';
		
		var unreadPosts = JSON.parse(sessionStorage.getItem(keyUnread));
		if (null == unreadPosts) unreadPosts = new Array();
		
		// find unread posts
		if (null != localStorage.getItem(keyLastread)) {
			var read = false;
			$('div.post, div.micropost').each(function() {
				var post = $(this).attr('id');
				if (localStorage.getItem(keyLastread) == post)
					read = true;
				
				if (!read) unreadPosts.push(post);
			});
		}
		
		// mark unread posts
		$.each(unreadPosts, function(index, post) {
			$('#'+post+' .post-meta span.label').first().addClass('label-warning');
		});
		
		// save data
		localStorage.setItem(keyLastread, $('div.post, div.micropost').first().attr('id'));
		sessionStorage.setItem(keyUnread, JSON.stringify(unreadPosts));
	}
	
	// Feature: "Unread Comments"
	if (window.page_type == "post/index" && window.location.search == "" && Modernizr.localstorage) {
		var key = 'comments-read';
		
		var readComments = JSON.parse(localStorage.getItem(key));
		if (null == readComments) readComments = new Object();
		
		var unreadComments = JSON.parse(sessionStorage.getItem(key));
		if (null == unreadComments) unreadComments = new Array();
		
		// search for unread comments
		$('div.post, div.micropost').each(function() {
			var post = parseInt($(this).attr('id').replace('post-', ''));
			var label = $(this).find('.post-meta span.label').last();
						
			var currentComments = parseInt(label.text());
			var knownComments = parseInt(readComments[post]) || 0;
			
			if (currentComments > knownComments)
				unreadComments.push(post);
			if (currentComments != knownComments)
				readComments[post] = currentComments;
		});
		
		// mark unread comments
		$.each(unreadComments, function(index, post) {
			$('#post-'+post+' .post-meta span.label').last().addClass('label-warning');
		});
		
		// save data
		localStorage.setItem(key, JSON.stringify(readComments));
		sessionStorage.setItem(key, JSON.stringify(unreadComments));
	}
	
	// mark unread comments as read
	if (window.page_type == "post/show" &&  Modernizr.localstorage) {
		var key = 'comments-read';
		
		var chunks = window.location.pathname.split("/");
		var post = parseInt(chunks[chunks.length - 2]);
		
		var unreadComments = JSON.parse(sessionStorage.getItem(key));
		if (null == unreadComments) unreadComments = new Array();
		
		if (unreadComments.indexOf(post) > -1) {
			unreadComments.splice(unreadComments.indexOf(post), 1);
			
			sessionStorage.setItem(key, JSON.stringify(unreadComments));
		}
		
		// update comment-count
		var readComments = JSON.parse(localStorage.getItem(key));
		if (null == readComments) readComments = new Object();
		
		var commentCount = $("div.comment").length;
		if (commentCount > 0 && commentCount != readComments[post] ) {
			readComments[post] = commentCount;
			localStorage.setItem(key, JSON.stringify(readComments));
		}
	}
	
	// Commentform-toggle
	if (window.page_type == "post/show") {
		$('#comment-form').hide();
		$('#comments').removeClass('span6').addClass('span12');
		$('#comment-form-hint').click(function() {
			$('#comment-form').show();
			$('#comment-form-hint').hide();
			$('#comments').removeClass('span12').addClass('span6');
		});
		$('input[type="reset"]').click(function() {
			$('#comment-form').hide();
			$('#comment-form-hint').show();
			$('#comments').removeClass('span6').addClass('span12');
		});
	}
});