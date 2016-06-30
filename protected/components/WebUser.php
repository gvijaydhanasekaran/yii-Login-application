<?php
class WebUser extends CWebUser {

	public function getDisplayName() {
		if(Yii::app()->user->getIsGuest()){
			return "";
		}else{
			$model = User::model()->findByPk(Yii::app()->user->id);
			if($model){
				return $model->first_name;
			}
		}
	}
	
	public function getUserType() {
		if(Yii::app()->user->getIsGuest()){
			return "";
		}else{
			$model = User::model()->findByPk(Yii::app()->user->id);
			if($model){
				return $model->user_type;
			}
		}
	}
	public function getStatus() {
		if(Yii::app()->user->getIsGuest()){
			return "";
		}else{
			$model = User::model()->findByPk(Yii::app()->user->id);
			if($model){
				return $model->status;
			}
		}
	}

	public function getUserData() {
		if(Yii::app()->user->getIsGuest()){
			return new User();
		}else{
			$model = User::model()->findByPk(Yii::app()->user->id);
			if($model){
				return $model;
			}
		}
	}
}
