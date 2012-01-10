<?php 
	use_helper('Text');
	use_helper('Pagination');
	
	slot('page_type', 'homepage');
	
	// fix for locales
	setlocale(LC_ALL, sfConfig::get('app_view_locale', null));
?>

<?php 
    if (empty($posts)) {
        ?>
        <div class="alert-message block-message warning">
        <p><strong><?php echo __('No posts found.'); ?></strong> <?php echo __('It seemes no posts match your criteria. Reasons may be'); ?></p>
        <ul>
            <li><?php echo __('You have selected a month in the archives with no posts. I promise to write more in the future!'); ?></li>
            <li><?php echo __('There are no posts matching your search criteria. Just ask me to write about the topic you are this curious about!'); ?></li>
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

                echo '<div class="span8 micropost" id="post-'.$post->getId().'">';
                include_partial('post', array('post' => $post));
                include_partial('meta', array('post' => $post));
                echo '</div>';            
            } else {
                if ($rowItems > 0) {
                    $rowItems = 0;
                    echo '</div>';
                }
                echo '<div class="row"><div class="span16" id="post-'.$post->getId().'">';
                include_partial('post', array('post' => $post));
                include_partial('meta', array('post' => $post));
                echo '</div></div>';
            }
        }
    
    }
?>

<br clear="both" />
