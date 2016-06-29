<div class="view">

		<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('first_name')); ?>:</b>
	<?php echo CHtml::encode($data->first_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_name')); ?>:</b>
	<?php echo CHtml::encode($data->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('username')); ?>:</b>
	<?php echo CHtml::encode($data->username); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password')); ?>:</b>
	<?php echo CHtml::encode($data->password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_hint')); ?>:</b>
	<?php echo CHtml::encode($data->password_hint); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('user_type')); ?>:</b>
	<?php echo CHtml::encode($data->user_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_at')); ?>:</b>
	<?php echo CHtml::encode($data->created_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_ip')); ?>:</b>
	<?php echo CHtml::encode($data->created_ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('activated_at')); ?>:</b>
	<?php echo CHtml::encode($data->activated_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_at')); ?>:</b>
	<?php echo CHtml::encode($data->login_at); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login_session')); ?>:</b>
	<?php echo CHtml::encode($data->login_session); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_hash')); ?>:</b>
	<?php echo CHtml::encode($data->password_hash); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_hash_at')); ?>:</b>
	<?php echo CHtml::encode($data->password_hash_at); ?>
	<br />

	*/ ?>

</div>