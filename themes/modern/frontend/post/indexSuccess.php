<?php 
	use_helper('Text');
	use_helper('Pagination');
	
	slot('page_type', 'post/index');
	slot('robots', 'noindex, follow');
	
	// fix for locales
	setlocale(LC_ALL, sfConfig::get('app_view_locale', null));
?>

 
<?php if ($searchQuery = sfContext::getInstance()->getRequest()->getGetParameter('query')) : ?>
	<div class="row"><div class="span12">
		<h1>
			<?php echo __('Your Search for'); ?>
			<em><?php echo $searchQuery; ?></em>
			<small><?php echo sizeof($posts); ?> <?php echo __('results'); ?></small>
		</h1>
	</div></div>
<?php endif; ?>

<?php if ($archive = sfContext::getInstance()->getRequest()->getGetParameter('year')) : ?>
	<div class="row"><div class="span12">
		<h1>
			<?php echo __('Archive for'); ?>
			<?php echo $archive; ?>
		</h1>
	</div></div>
<?php endif; ?>

<?php
	// posts
    if (empty($posts) || sizeof($posts) == 0) {
        ?>
        <div class="alert alert-error">
        <p><strong><?php echo __('No posts found.'); ?></strong> <?php echo __('It seemes no posts match your criteria. Reasons may be'); ?></p>
        <ul>
            <li><?php echo __('You have selected an archive with no posts. I promise to write more in the future!'); ?></li>
            <li><?php echo __('There are no posts matching your search criteria. Just ask me to write about the topic you are such curious about!'); ?></li>
        </ul>
        <div class="alert-actions">
          <a class="btn small" href="<?php echo url_for('post/index'); ?>"><?php echo __('Return to index'); ?></a>
        </div>
      </div>
        <?php
    } else {

        $rowItems = 0;
        foreach ($posts as $post) {
            if ($post->isMicropost()) {
                if ($rowItems == 0) {
                    echo '<div class="row">';
                }
                if ($rowItems == 2) {
                    $rowItems = 0;
                    echo '</div><div class="row">';
                }
                $rowItems++;

                echo '<div class="span6 micropost" id="post-'.$post->getId().'">';
                include_partial('post', array('post' => $post));
                include_partial('meta', array('post' => $post));
                echo '</div>';            
            } else {
                if ($rowItems > 0) {
                    $rowItems = 0;
                    echo '</div>';
                }
                echo '<div class="row"><div class="span12 post" id="post-'.$post->getId().'">';
                include_partial('post', array('post' => $post));
                include_partial('meta', array('post' => $post));
                echo '</div></div>';
            }
        }
    
    }
?>

<br clear="both" />
