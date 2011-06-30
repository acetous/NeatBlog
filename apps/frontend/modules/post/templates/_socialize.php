<?php if (sfConfig::get('app_other_social_integration')) : ?>
<div class="social">
	<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo $url ?>" data-count="horizontal" data-via="acetous">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
</div>
<div class="social">	
	<a title="Post to Google Buzz" class="google-buzz-button" href="http://www.google.com/buzz/post" data-button-style="small-count" data-url="<?php echo $url ?>"></a>
	<script type="text/javascript" src="http://www.google.com/buzz/api/button.js"></script>
</div>
<div class="social">
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
	<g:plusone href="<?php echo $url ?>"></g:plusone>
</div>
<div class="social" style="float: right;">
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=115586655198096&amp;xfbml=1"></script><fb:like href="<?php echo $url ?>" width="<?php echo $width; ?>" show_faces="true" font=""></fb:like>
</div>
<?php endif; ?>