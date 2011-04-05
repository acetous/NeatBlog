<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('comment_create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php echo $form->renderHiddenFields(false); ?>

<?php echo $form->renderGlobalErrors() ?>

<?php echo $form['author']->renderLabel() ?>
<?php echo $form['author']->renderError() ?>
<?php echo $form['author'] ?>
          
<?php echo $form['content']->renderLabel() ?>
<?php echo $form['content']->renderError() ?>
<?php echo $form['content'] ?>

<input type="submit" value="<?php echo __('Post!'); ?>" />

      
