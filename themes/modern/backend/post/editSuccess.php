<?php
	use_javascript('/../scripts/showdown.js');
	
	use_javascript('/../scripts/plupload.min.js');
	use_javascript('/../scripts/plupload.html5.min.js');
	use_stylesheet('/../styles/uploader.css');
	
	slot('page_type', 'post/edit');
?>

<div class="page-header">
<h1><?php echo $form->getObject()->isNew() ? __('New Post') : $form->getObject()->getTitle(); ?></h1>
</div>

<div class="row"><div class="span12">
<ul id="tabs" class="nav nav-tabs">
	<li class="active"><a href="#source" data-toggle="tab"><?php echo __('Source'); ?></a></li>
	<li><a href="#preview" data-toggle="tab"><?php echo __('Preview'); ?></a></li>
	<li><a href="#files" data-toggle="tab"><?php echo __('Files'); ?></a></li>
	<?php if (!$form->getObject()->isNew()) : ?>
		<li><a href="#comments" data-toggle="tab"><?php echo __('Comments'); ?> (<?php echo sizeof($form->getObject()->getComments()); ?>)</a></li>
	<?php endif; ?>
</ul>

<div class="tab-content">
<div id="source" class="tab-pane fade active in">

	<form class="form-horizontal" action="<?php echo url_for('post_'.($form->getObject()->isNew() ? 'create' : 'update'), $form->getObject()); ?>" method="POST">
	<fieldset>
		<legend><?php echo __('Write your post'); ?></legend>
	
	<?php if ($form->hasGlobalErrors()) : ?>
		<div class="error"><?php echo $form->renderGlobalErrors(); ?></div>
	<?php endif; ?>
	
	<?php $checkboxes = array(); ?>
	<?php foreach ($form as $field) : ?>
		<?php if ($field->isHidden()) continue; ?>
		<?php 
			if (is_a($field->getWidget(), 'sfWidgetFormInputCheckbox')) {
				$checkboxes[] = $field;
				continue;
			}
		?>
		
		<div class="control-group <?php echo $field->hasError() ? 'error' : ''?>">
			<?php echo $field->renderLabel(null, array('class' => 'control-label')); ?>
			<div class="controls">
				<?php echo $field->render(array('class' => 'input-xxlarge ' . ($field->hasError() ? 'error' : ''))); ?>
				<?php echo $field->renderError(); ?>
				<?php if($field->renderHelp() != "") : ?><p class="help-block"><?php echo $field->renderHelp(); ?></p><?php endif; ?>
			</div>
			
		</div>
	<?php endforeach; ?>
	
	<div class="control-group">
		<label id="optionsCheckboxes"><?php echo __('Options'); ?></label>
			<div class="controls">
				<?php foreach ($checkboxes as $field) : ?>
					<label class="checkbox">
						<?php echo $field->render(); ?>
						<?php echo $field->renderLabelName(); ?>
					</label>
				<?php endforeach; ?>
		</div>
	</div>
	
	<div class="form-actions">
		<input type="submit" class="btn btn-primary" value="<?php echo __('Post!'); ?>"> 
		<?php echo link_to(__('Abort'), 'post/index', array('class' => 'btn')) ?>
		
		<?php if (!$form->getObject()->isNew()) : ?>
			<?php echo link_to(__('Delete'), 'post_delete', $form->getObject(), array('method' => 'delete', 'confirm' => __('Really delete?'), 'class' => 'btn btn-danger pull-right')) ?>
		<?php endif; ?>
	</div>	
	
	<?php echo $form->renderHiddenFields(); ?>
	
	</fieldset>
	</form>
</div>

<div id="preview" class="tab-pane fade">
</div>

<div id="files" class="tab-pane fade">
	<h3><?php echo __('Files'); ?></h3>
	
	<div id="imagechooser">
	<br clear="left" />
	</div>
	<button id="imagechooser-button"><?php echo __('Choose files'); ?></button>
	<div class="error" id="imagechooser-error"><p><?php echo __('Your webbrowser needs to be HTML5 capable to upload files!'); ?></p></div>
	<script type="text/javascript">
	var image_path = '<?php echo str_ireplace('/backend', '', sfContext::getInstance()->getRequest()->getRelativeUrlRoot()); ?>/uploads/<?php echo ($form->getObject()->isNew() ? 'other' : $form->getObject()->getDateTimeObject('created_at')->format('Y/m/').$form->getObject()->getId()); ?>/';
	var image_global_path = '<?php echo str_ireplace('/backend', '', sfContext::getInstance()->getRequest()->getRelativeUrlRoot()); ?>/uploads/global/';
	$(function() {
		// handle view
		$("button#imagechooser-button").hide();
	
		// load existing images
		load_files();
		
		// uploader config
		var uploader = new plupload.Uploader({
			runtimes:	'html5',
			url:		'<?php echo url_for('file_upload') . ( $form->getObject()->isNew() ? '' : '?id='.$form->getObject()->getId() ); ?>',
			max_file:	'10mb',
			filters: [
	        	{title: '<?php echo __('Images'); ?>', extensions: 'jpg,jpeg,gif,png'}
	  		],
	  		browse_button:	'imagechooser-button',
	  		drop_element:	'imagechooser',
	
	  		file_data_name:	'blog_upload[file]'
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
						$(this).parent("div").remove();
					}
				});
				$("div#imagechooser").prepend('<div class="image-upload" id="'+file.id+'"><span class="name">'+file.name+'</span></div>');
			});
			up.start();
		});
	
		uploader.bind('UploadProgress', function (up, file) {
			$("div#"+file.id).html(file.percent+'%<br /><span class="name">'+file.name+'</span>');
		});
	
		uploader.bind('FileUploaded', function (up, file) {
			$("div#"+file.id).remove();
			load_files();
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
	function load_files() {
		$.getJSON('<?php echo url_for('file_index', array('sf_format' => 'json')) . ($form->getObject()->isNew() ? '' : '?post='.$form->getObject()->getId()); ?>', function(data) {
			$("div#imagechooser div.image").remove();
			$.each(data.globalFiles, function(index, file) {
				$("div#imagechooser").prepend('<div class="image"><img src="'+image_global_path+file+'" /><br /><span class="name">'+file+'</span></div>');
			});
			$.each(data.files, function(index, file) {
				$("div#imagechooser").prepend('<div class="image"><img src="'+image_path+file+'" /><br /><span class="name">'+file+'</span></div>');
			});
		});
	}
	</script>
	<style>
	#imagechooser {
		width: 95%;
		margin: auto;
		min-height: 300px;
		background: #FFFEE3;
		border: 1px solid #8F8F8F;
	}
	</style>

</div>

<?php if (!$form->getObject()->isNew()) : ?>
<div id="comments" class="tab-pane fade">
	<?php include_component('comment', 'list', array('comments' => $form->getObject()->getComments())); ?>
</div>
<?php endif; ?>
</div>

</div></div>
