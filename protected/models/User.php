<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $password_hint
 * @property string $user_type
 * @property string $status
 * @property string $created_at
 * @property string $created_ip
 * @property string $activated_at
 * @property string $login_at
 * @property string $login_session
 * @property string $password_hash
 * @property string $password_hash_at
 */
class User extends CActiveRecord
{
	public $confirmPassword;
	const PENDING = 'P';
	const ACTIVED = 'A';
	const DELETED = 'D';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return Default scope initialization 
	 */	
    public function defaultScope()
    {
        $alias = $this->getTableAlias(false,false).".";
        return array(
            'condition'=>$alias.'status !="'.self::DELETED.'"',
        );
    }

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('first_name, last_name, username, password', 'required'),
			array('email','email'),
			array('first_name, last_name, username, password_hint, created_ip', 'length', 'max'=>100),
			array('email', 'length', 'max'=>155),
			array('password, password_hash', 'length', 'max'=>255),
			array('user_type, status', 'length', 'max'=>1),
			array('login_session', 'length', 'max'=>500),
			array('created_at, activated_at, login_at, password_hash_at', 'safe'),

			// Custom Rules
			array('username','uniquecheck'),
			array('password,confirmPassword','required','on'=>'insert'),
			array('password', 'passwordStrength'),
			array('confirmPassword', 'compare', 'compareAttribute'=>'password'),

			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, first_name, last_name, email, username, password, password_hint, user_type, status, created_at, created_ip, activated_at, login_at, login_session, password_hash, password_hash_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * username unique validation
	 */
    public function uniquecheck()
    {
    	if($this->isNewRecord){
	        $found = User::model()->findBySql("Select * from user where username='$this->username'");
    	}else{
	        $found = User::model()->findBySql("Select * from user where username='$this->username' and id!='$this->id'");
    		
    	}
        if($found){
            $msg = '"'. $this-> username. '" already given by another user!';
            $this->addError('username', $msg);
        }        
    }

    /**
	 * password Strength validation
	 */
	public function passwordStrength($attribute,$params){
		if(!empty($this->password)){
			if(strlen($this->password) > 5){
				if(preg_match( '~[A-Z]~', $this->password)){
					if(preg_match( '~\d~', $this->password)){

					}else{
						$this->addError('password', "Password must contains one number");
					}
				}else{
					if(preg_match( '~\d~', $this->password)){
						$this->addError('password', "Password must contains 1 uppercase");
					}else {
						$this->addError('password', "Password must contains 1 uppercase and 1 number");
					}
				}
			}else{
				$this->addError('password', "Password too short! (Minimum 6 characters + 1 uppercase + 1 number)");
			}
		}
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'email' => 'Email',
			'username' => 'Username',
			'password' => 'Password',
			'password_hint' => 'Password Hint',
			'user_type' => 'User Type',
			'status' => 'Status',
			'created_at' => 'Created At',
			'created_ip' => 'Created Ip',
			'activated_at' => 'Activated At',
			'login_at' => 'Login At',
			'login_session' => 'Login Session',
			'password_hash' => 'Password Hash',
			'password_hash_at' => 'Password Hash At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('password_hint',$this->password_hint,true);
		$criteria->compare('user_type',$this->user_type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('created_at',$this->created_at,true);
		$criteria->compare('created_ip',$this->created_ip,true);
		$criteria->compare('activated_at',$this->activated_at,true);
		$criteria->compare('login_at',$this->login_at,true);
		$criteria->compare('login_session',$this->login_session,true);
		$criteria->compare('password_hash',$this->password_hash,true);
		$criteria->compare('password_hash_at',$this->password_hash_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public function beforeSave()
  	{
	    if ($this->isNewRecord) {
	        $this->created_at = new CDbExpression('NOW()');
	        // $this->created_ip = Yii::app()->request->userHostAddress;
	        $this->created_ip = '123.456.789.123';
	        if(Yii::app()->params['sendEmail']){
	        	$this->status = self::PENDING;
	        } else {
	        	$this->status = self::ACTIVED;
	        }
	    }

	    unset($this->password);
        if (isset($_POST['User']['password']) && trim($_POST['User']['password']) != "") {
        	$pass = trim($_POST['User']['password']);
             $this->password = md5($pass);
             $this->password_hint = self::getPasswordHint($pass);
        }

        // $this->password = md5(trim($this->password)); // change the password normal text into md5 text

	    return parent::beforeSave();
	}

	public function getPasswordHint($pass = '')
	{
		if($pass) {
			$length = strlen($pass);
			$start = round($length/2);
			$end = round($length/2);
			$res = "len => $length <br> start => $start <br> end => $end";

			$substr = $pass[(int)($start-2)];
			$substr .= $pass[(int)($start-1)];
			$substr .= $pass[(int)$start];

			$res .= "<br> substr => $substr <br>";
			$res = '';
			for ($i=0; $i <$start-2 ; $i++) { 
				$res .= '*';
			}
			$res .= $substr;
			for ($i=($end+strlen($substr))-2; $i < $length ; $i++) {
				$res .= '*';
			}
			return $res;

		}
	}


	public function checkUser()
	{
		if(Yii::app()->params['stopMutiLogin']){
			return Yii::app()->getController()->redirect(array('site/notification','msg'=>"Already Logined"));
		}
	}

	public function setPasswordHashKey()
	{
		$user = User::model()->findByPk($this->id);
		$user->password_hash = md5($this->email);
		$user->password_hash_at = new CDbExpression('NOW()');
		$user->save(false);
	}

	public function sendMail()
	{
		$link = yii::app()->createUrl("user/activate", array('key'=> md5($this->email)));
		$msg = "Dear ".$this->first_name.", <br> Please click This link to reset the password <b> 
			<a target='_blank' href='".$link."'> Reset Password</a></b><br>
			Thanks,<br>
			Registration Team";

		// return yii::app()->createUrl("user/activate", array('key'=>'vijay'));
		if(Yii::app()->params['sendEmail']){
			$this->setPasswordHashKey();
			return Yii::app()->getController()->redirect(array('site/notification','msg'=>$msg));
		} else {
			$this->setPasswordHashKey();
			// print_r("expression");exit();
			return Yii::app()->getController()->redirect(array('site/notification','msg'=>$msg));
		}
		print_r($this->id);exit();

	}
}