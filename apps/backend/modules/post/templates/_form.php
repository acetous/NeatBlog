<?php use_javascript('showdown.js'); ?>
<?php use_javascript('showdown-gui.js'); ?>

<?php use_javascript('plupload.min.js'); ?>
<?php use_javascript('plupload.html5.min.js'); ?>
<?php use_stylesheet('uploader.css'); ?>

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

<div class="annotation"><?php echo __('Images'); ?></div>
<div id="imagechooser">
<br clear="left" />
</div>
<button id="imagechooser-button"><?php echo __('Choose files'); ?></button>
<div class="error" id="imagechooser-error"><p><?php echo __('Your webbrowser needs to be HTML5 capable to upload files!'); ?></p></div>
<script type="text/javascript">
var image_path = '/uploads/other/';
$(function() {
	// handle view
	$("button#imagechooser-button").hide();
	
	// uploader config
	var uploader = new plupload.Uploader({
		runtimes:	'html5',
		url:		'<?php echo url_for('upload'); ?>',
		max_file:	'10mb',
		filters: [
        	{title: 'Images', extensions: 'jpg,jpeg,gif,png'}
  		],
  		browse_button: 'imagechooser-button',
  		drop_element: 'imagechooser',

  		file_data_name: 'blog_upload[file]'
	});

	uploader.bind('Init', function (up, params) {
		if (params.runtime == 'html5') {
			$("div#imagechooser-error").hide();
			$("div#imagechooser-error").html('');
		}
	});
	
	// initialize the uploader
	uploader.init();

	uploader.bind('FilesAdded', function (up, files) {
		$.each(files, function(i, file) {
			// remove existing file
			$("div#imagechooser span.name").each(function(i, element) {
				if ($(this).html() == file.name) {
					$(this).parent("span").remove();
				}
			});
			$("div#imagechooser").prepend('<div class="image-upload" id="'+file.id+'"><span class="name">'+file.name+'</span></div>');
		});
		up.start();
	});

	uploader.bind('UploadProgress', function (up, file) {
		$("div#"+file.id).html('<span class="name">'+file.percent+'%<br />'+file.name+'</span>');
	});

	uploader.bind('FileUploaded', function (up, file) {
		$("div#"+file.id)
			.html('<img src="'+image_path + file.name+'" /><br /><span class="name">'+file.name+'</span>')
			.removeClass('image-upload')
			.addClass('image');
	});

	uploader.bind('Error', function (up, error) {
		var msg;
		if (typeof error.file != 'undefined') {
			msg = '<p>'+error.file.name+' <?php echo __('failed'); ?>: "'+error.message+'"</p>';
		} else {
			msg = '<p><?php echo __('An error occured'); ?>: "'+error.message+'"</p>';
		}
		$("div#imagechooser-error")
			.append(msg)
			.show();
	});
});
</script>
<style>
#imagechooser {
	min-height: 50px;
	background: #FFFEE3;
	border: 1px solid #8F8F8F;
	margin-bottom: 20px;
}
</style>

<div class="annotation"><?php echo __('Preview'); ?></div>
<div id="blog_post_preview" class="post"></div>