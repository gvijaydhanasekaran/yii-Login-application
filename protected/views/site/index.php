<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<div class="row">
	<div class="col-md-3 col-md-offset-2">
		<img src="<?php echo yii::app()->getBaseUrl(); ?>/images/man.png" height="250">
	</div>
	<div class="col-md-6">
		<img src="<?php echo yii::app()->getBaseUrl(); ?>/images/world.png" height="250">
	</div>
</div>

