<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'type'=>'horizontal',
)); ?>

<p class="help-block">Fields with <span class="required">*</span> are required.</p>

<?php //echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldGroup($model,'first_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php echo $form->textFieldGroup($model,'last_name',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php echo $form->textFieldGroup($model,'email',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>155)))); ?>

	<?php echo $form->textFieldGroup($model,'username',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php echo $form->passwordFieldGroup($model,'password',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>
	
	<?php echo $form->passwordFieldGroup($model,'confirmPassword',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php //echo $form->textFieldGroup($model,'password_hint',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php //echo $form->dropDownListGroup($model,'user_type', array('widgetOptions'=>array('data'=>array("C"=>"C","F"=>"F","E"=>"E",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

	<div class="form-group">
		<?php echo $form -> labelEx($model, 'user_type', array('class' => 'col-sm-3 control-label ')); ?>
		<div class="col-sm-9">
			<?php
				// $CourseArray = Course::getCourseList();

			$form -> widget('bootstrap.widgets.TbSelect2', 
				array(
					'model' => $model,
					'attribute' => 'user_type', 
					'data' => array("C"=>"Company","F"=>"Freelancer","E"=>"Employers",), 
					'options' => array('allowClear' => true, ), 
					'htmlOptions' => array(
						//'empty'=>'',
						'placeholder' => "Select User Type", 
						'style' => 'width:400px;', 
						'class'=>'span5',
					), 
				)); 
			?>
			<?php echo $form -> error($model, 'user_type'); ?>
		</div>
	</div>


	<?php //echo $form->dropDownListGroup($model,'status', array('widgetOptions'=>array('data'=>array("P"=>"P","A"=>"A","D"=>"D",), 'htmlOptions'=>array('class'=>'input-large')))); ?>

	<?php //echo $form->textFieldGroup($model,'created_at',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php //echo $form->textFieldGroup($model,'created_ip',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>100)))); ?>

	<?php //echo $form->textFieldGroup($model,'activated_at',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php //echo $form->textFieldGroup($model,'login_at',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

	<?php //echo $form->textFieldGroup($model,'login_session',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>500)))); ?>

	<?php //echo $form->textFieldGroup($model,'password_hash',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>255)))); ?>

	<?php //echo $form->textFieldGroup($model,'password_hash_at',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5')))); ?>

<div class="form-actions col-md-offset-5">
	<?php $this->widget('booster.widgets.TbButton', array(
			'buttonType'=>'submit',
			'context'=>'primary',
			'label'=>$model->isNewRecord ? 'Register' : 'Update Profile',
		)); ?>
</div>


<?php $this->endWidget(); ?>
