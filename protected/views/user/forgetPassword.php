<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>
<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>155)))); ?>

<div class="form-actions">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Reset Password' : 'Reset Password',
		)); ?>
</div>

<?php $this->endWidget(); ?>
