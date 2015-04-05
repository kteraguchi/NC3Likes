<?php
/**
 * Bbs post view template
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */
?>

<?php echo $this->Form->create('', array(
		'div' => false,
		//'class' => 'inline-block',
		'type' => 'post',
		'url' => '/likes/likes/like/' . $frameId
	)); ?>

	<?php echo $this->Form->hidden('Like.id'); ?>

	<?php echo $this->Form->hidden('Like.plugin_key', array(
			'value' => $this->request->params['plugin'],
		)); ?>

	<?php echo $this->Form->hidden('Like.block_key', array(
			'value' => $blockKey,
		)); ?>

	<?php echo $this->Form->hidden('Like.content_key', array(
			'value' => $contentKey,
		)); ?>

	<?php echo $this->Form->hidden('Like.is_liked', array(
			'value' => 1,
		)); ?>

	<?php echo $this->Form->hidden('Like.is_liked', array(
			'value' => 0,
		)); ?>

	<?php echo $this->Form->button('<span class="glyphicon glyphicon-thumbs-down"></span> ' . $unlikeCounts, array(
			'name' => 'save_' . NetCommonsBlockComponent::STATUS_PUBLISHED,
			'class' => 'btn-link',
			'style' => 'margin: 0px; padding: 0px; border-left-style: 0px; border-right-style: 0px;'
		)); ?>
<?php echo $this->Form->end();

