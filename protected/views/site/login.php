<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<h1>Login 
	<?php print_r(CHttpRequest::getUserHostAddress());?> <br>
	<?php print_r(ip2long(CHttpRequest::getUserHostAddress())); ?><br>
	<?php print_r(Yii::app()->request->getUserHostAddress()); ?> <br>
	<?php print_r(Yii::app()->request->userHostAddress); ?> <br>
	<?php print_r($_SERVER['REMOTE_ADDR']); ?><br>
	<?php print_r($_SERVER['HTTP_USER_AGENT']); ?>
</h1>

                
<?php //echo $form->hiddenField($model,'ip',array('value'=>Yii::app()->request->userHostAddress,)); ?>


<p>Please fill out the following form with your login credentials:</p>

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
		<p class="hint">
			Hint: You may login with <kbd>demo</kbd>/<kbd>demo</kbd> or <kbd>admin</kbd>/<kbd>admin</kbd>.
		</p>
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
