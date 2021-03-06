<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="row">
	<div class="col-md-offset-3">
		<h1>Login </h1>

		<div class="form">
		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'login-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<p class="note">Fields with <span class="required">*</span> are required.</p>

			<div class="row">
				<?php echo $form->labelEx($model,'username'); ?>
				<?php echo $form->textField($model,'username'); ?>
				<?php echo $form->error($model,'username'); ?>
			</div>

			<div class="row">
				<?php echo $form->labelEx($model,'password'); ?>
				<?php echo $form->passwordField($model,'password'); ?>
				<?php echo $form->error($model,'password'); ?>
			</div>

			<?php if(CCaptcha::checkRequirements()): ?>
			<div class="row">
			    <?php echo $form->labelEx($model,'verifyCode'); ?>
			    <div>
			    <?php //$this->widget('CCaptcha'); ?>
			    <?php $this->widget('CCaptcha',array('buttonLabel'=>'Get New Code','buttonType'=>'label',
			    		'buttonOptions'=>array( 'class'=>'sample')));

				?>
			    <?php echo $form->textField($model,'verifyCode'); ?>
			    </div>
			    <div class="hint">Please enter the letters as they are shown in the image above.
			    <br/>Letters are not case-sensitive.</div>
			    <?php echo $form->error($model,'verifyCode'); ?>
			</div>
			<?php endif; ?>

			<div class="row rememberMe">
				<?php echo $form->checkBox($model,'rememberMe'); ?>
				<?php echo $form->label($model,'rememberMe'); ?>
				<?php echo $form->error($model,'rememberMe'); ?>
			</div>

			<div class="row buttons">
				<?php echo CHtml::submitButton('Login'); ?>
			</div>

		<?php $this->endWidget(); ?>
		</div><!-- form -->
	</div>
</div>

