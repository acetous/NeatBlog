<?php use_javascript('showdown'); ?>
<?php use_javascript('showdown-gui'); ?>

<form action="<?php echo url_for('post_'.($form->getObject()->isNew() ? 'create' : 'update'), $form->getObject()); ?>" method="POST">

<?php if ($form->hasGlobalErrors()) : ?>
	<div class="error"><?php echo $form->renderGlobalErrors(); ?></div>
<?php endif; ?>

<?php foreach ($form as $field) : ?>
	<?php if ($field->isHidden()) continue; ?>
	
	<?php echo $field->renderLabel(); ?>
	<?php if ($field->hasError()) : ?><div class="error"><?php echo $field->renderError(); ?></div><?php endif; ?>
	<?php if($field->renderHelp() != "") : ?><div class="annotation"><?php echo $field->renderHelp(); ?></div><?php endif; ?>
	<?php echo $field->render(); ?>
	<br />
<?php endforeach; ?>

<input type="submit" value="<?php echo __('Post!'); ?>" />		

<?php echo $form->renderHiddenFields(); ?>
</form>

<div class="annotation"><?php echo __('Preview'); ?></div>
<div id="blog_post_preview" class="post"></div>