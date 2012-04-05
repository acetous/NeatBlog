<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="commentform" class="form-stacked" action="<?php echo url_for('comment_create', $post) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>

    <fieldset>

    <legend><?php echo __('Write a comment'); ?></legend><br />

    <?php echo $form->renderHiddenFields(false); ?>

    <?php echo $form->renderGlobalErrors() ?>

    <div class="clearfix">
    <?php echo $form['author']->renderLabel() ?>
    <?php echo $form['author']->renderError() ?>
    <div class="input">
        <?php echo $form['author']->render(array('class' => 'span6', 'placeholder' => __('Anonymous'))); ?>
    </div>
    </div>

    <div class="clearfix">
    <?php echo $form['content']->renderLabel() ?>
    <?php echo $form['content']->renderError() ?>
    <div class="input"><?php echo $form['content']->render(array('class' => 'span6')); ?></div>
    </div>

    <div class="form-actions">
        <input type="submit" class="btn btn-primary" value="<?php echo __('Post Comment'); ?>" />
        <input type="reset" class="btn" value="<?php echo __('Cancel'); ?>" />
    </div>

</fieldset>
</form>
