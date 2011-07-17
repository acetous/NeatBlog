<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="commentform" action="<?php echo url_for('comment_create', $post) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php echo $form->renderHiddenFields(false); ?>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form['author']->renderLabel() ?>
<?php echo $form['author']->renderError() ?><br />
<?php echo $form['author'] ?><br />

<?php echo $form['content']->renderLabel() ?>
<?php echo $form['content']->renderError() ?><br />
<?php echo $form['content'] ?><br />

<button type="submit" class="button big primary"><?php echo __('Post!'); ?></button>

<script type="text/javascript">
$(function() {
	
});
</script>