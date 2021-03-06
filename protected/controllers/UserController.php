<?php

class UserController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/column2';

	/**
	* @return array action filters
	*/
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	* Specifies the access control rules.
	* This method is used by the 'accessControl' filter.
	* @return array access control rules
	*/
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('create', 'activate', 'changepassword', 'forgetpassword', 'newActivation'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'view', 'admin', 'delete', 'index'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionForgetpassword()
	{
		$model =  new User();
		$model->password = '';
		$model->scenario = "reset-password";
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->scenario = "reset-password";

			if($model->validate()){
				$userModel = User::model()->findByAttributes(array('email' => $model->email));
				if($userModel) {
					if($userModel->status == User::ACTIVED)
						$userModel->sendResetMail();
					else
						$userModel->sendActivationMail();
				} else {
					$msg = "Email not found in our database. Please sign up";
					$model->addError('email', $msg);
				}
			}
		}

		$this->render('forgetPassword',array(
			'model'=>$model,
		));
	}

	public function actionChangepassword($id='')
	{
		$model = $this->loadModel($id);
		$model->password = '';

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->password_hash = '';
			$model->password_hash_at = '';
			if($model->save()){
				// print_r(User::sendMail());exit();
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('changepassword',array(
			'model'=>$model,
		));
	}

	public function actionNewActivation($key = '')
	{
		if($key){
			$model = User::model()->findByAttributes(array('password_hash' => $key));
			if($model) {
				$sql = "UPDATE `user` SET `status`='".User::ACTIVED."' WHERE `id`='".$model->id."'";
				// print_r($sql);exit();
				// $data = Yii::app()->db->createCommand($sql)->queryAll();
				$model->status = User::ACTIVED;
				$model->activated_at = new CDbExpression('NOW()');
				$model->password_hash = '';
				$model->password_hash_at = '';
				$model->update();
					$msg = "Account Activated successfully";
			} else {
				$msg = "URL has been expired.";
			}
			$this->redirect(array('site/notification','msg'=>$msg));
		}
	}

	public function actionActivate($key = '')
	{
		if($key){
			$model = User::model()->findByAttributes(array('password_hash' => $key));
			if($model) {
				$hashedDate = new DateTime($model->password_hash_at);
				$currentDate = new DateTime(date("Y-m-d H:i:s"));
				$diff = $currentDate->diff($hashedDate);
				$hours = $diff->h;
				$hours = $hours + ($diff->days*24);
				if($hours > 24) {
					$msg = "Url was expired. Try again";
					$this->redirect(array('site/notification','msg'=>$msg));
				} else {
					$this->redirect(array('changepassword','id'=>$model->id));
				}
			}
		}
	}

	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$model = $this->loadModel($id);
		// print_r($model->sendMail());
		// exit();

		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new User;
		
		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->status = User::PENDING;
			if($model->save()){
				$model->sendActivationMail();
				// print_r(User::sendMail());exit();
				// $this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		unset($model->password);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
		$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
