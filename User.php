<?php

/*All the funtionalities of this website included here
We have a praent class 
User is the parent class
Bsic user and Admin class extends from This class
For keep The project simple i implimented connection in the user class
*/
	class User{
		protected $connection;
		protected $result;
		protected $assocRow;
		protected $userIDSession;
		public static  $dbName="notice_board";
		public static  $userName="root";
		public static  $hostName="localhost";
		public static  $password="";
		public static  $port="";

		
		//User constractor will give us a error if connection failed and return false
		function __construct(){
			$bool = 0;
			if($this->connection = mysqli_connect(User::$hostName,User::$userName,User::$password,User::$dbName)){
				$bool =1;
			} else {
				$this->getError();
			}
			return $bool;
		}
		
		//this function will give us any mysql error might need for debuging :D
		protected function getError(){
			if(mysqli_error($this->connection)){
				$error = mysqli_error($this->connection);
				echo("<p>Mysql connect error ".$error ."</p>");
			}
			if(mysqli_error($this->connection)){
				return(true);
			} else {
				return(false);
			} 
		}
		
		
		
		#this function will set a index called error to assoc["error"] if cant login and return all assoc row value from db if valid
		public function getLoginAssoc($postvalue){
			$this->assocRow = array();
			//get username and password from post value
			$userName= $postvalue["username"];
			$password = $postvalue["password"];
			if(empty($postvalue['username']) || empty($postvalue['password']) ){
				$this->assocRow['error'] = "*Both field must be provided"; 
			}
			if(count($this->assocRow)==0){
				$sql ="select * from users where user_id='$userName' and password='$password';";
				$result = mysqli_query($this->connection,$sql);
				//mysqli_error();
				$rowCount = mysqli_num_rows($result);
				if($rowCount<=0){
					$this->assocRow['error'] = "*No matching Username or password";
				} else {
					$this->assocRow= mysqli_fetch_assoc($result);
				}
			}
			return($this->assocRow);
		}
		#only return assoc row
		public function getAssocRow($userId){
			$sql ="select * from users where user_id='$userId';";
			$result = mysqli_query($this->connection,$sql);
			return(mysqli_fetch_assoc($result));
		}
		//insert a user into database
		private function insertUser($userID,$password,$name,$email,$gender,$user_image_path){
			$sql = "insert into users(user_id,password,name,email,gender,user_image_path) values('$userID','$password','$name','$email','$gender','$user_image_path');";
			$result = mysqli_query($this->connection,$sql);
			if(!$result){
				$this->getError();
			}
		}
		
		//check existance of user in db
		public function isUserAvilable($userID){
			$sql = "select * from users where user_id='$userID';";
			$result = mysqli_query($this->connection,$sql);
			$avilable = false;
			if(mysqli_num_rows($result)>0){
				$avilable = true;
			}
			if(!$result){
				$this->getError();
			}
			return($avilable);
		}
		//validation of registered it's finally call insert user if no form error found
		public function getRegistered($postValue,$files){
			#this will return a error count value if registered failed.
			$error = array();
			if(empty($postValue['username'])){
				$error['username']="*Username is empty";
			}
			if(!preg_match('/^\w{5,}$/', $postValue['username']) && !empty($postValue['username'])) { // \w equals "[0-9A-Za-z_]"
				$error['username']="*alphanumeric & longer than or equals 5 chars";
			} 
			if($this->isUserAvilable($postValue['user_id'])){
				$error[''] = "User already Exists in the database";
			}
			if(empty($postValue['password'])){
				$error['password'] = "*Password is empty";
			}
			if(empty($postValue['email'])){
				$error['email'] = "*Email is empty";
			}
			if(empty($postValue['name'])){
				$error['name'] = "*Name is empty";
			}
			
			if(count($error)==0){
				
				if(empty($postValue['male'])){
					$gender = "Female";
				} else {
					$gender = "Male";
				}
				$path ="uploads/person.jpg";
				if($files['images']['size']>1000){
					//now done coding for uploading image
					$path="uploads/".$files['images']['name'];
					$fileName=$files['images']['tmp_name'];
					if(isset($files['images'])){
						if(file_exists($path)){
							$error['images']="Image Already Exist";
						} else {
							move_uploaded_file($fileName,$path);
						}

					}
				}
				
				if(count($error)==0){
					User::insertUser($postValue['username'],$postValue['password'],$postValue['name'],$postValue['email'],$gender,$path);
					$error['success']="Successfully Registered click <a href='index.php'>login</a>";
			
				}
			}
			return($error);
		}
		 
		#this function will return sql query result with all data of notice board
		public function getAllDataFromNoticeBoardQueryResult(){
			$sql="select * from notice order by create_time DESC;";
			$result = mysqli_query($this->connection,$sql);
			$this->getError();
			return($result);
		}
		//this function is do query type of things for update users password
		protected function updatePassword($userID,$password){
			$sql="update users set password='$password' where user_id='$userID';";
			$result = mysqli_query($this->connection,$sql);
			$this->getError();
			return($result);
		}
		//this function will validate password form
		public function passwordValidation($userID,$post){
			$error = array();
			$oldPassword = $post['op'];
			$sql="select * from users  where user_id='$userID' and password='$oldPassword';";
			$rowCount = 0;
			if(!empty($post['cp']) && !empty($post['np'])){
				$result = mysqli_query($this->connection,$sql);
				$this->getError();
				$rowCount = mysqli_num_rows($result);
			}
			
			if(empty($post['op'])){
				$error['op'] = "<p style='color:red;'>This field can not be empty</p>";
			}
			if(empty($post['np'])){
				$error['np'] = "<p style='color:red;'>This field can not be empty</p>";
			}
			if(empty($post['cp'])){
				$error['cp'] = "<p style='color:red;'>This field can not be empty</p>";
			}
			if($rowCount<=0){
				$error['op'] = "<p style='color:red;'>You Entered Wrong Password</p>";
			}
			if($post['np']!=$post['cp'] && !empty($post['cp']) && !empty($post['np']) ){
				$error['np'] = "<p style='color:red;'>Password dosen't match</p>";
				$error['cp'] = "<p style='color:red;'>Password dosen't match</p>";
			}
			if(count($error)==0){
				$this->updatePassword($userID,$post['np']);
				$error['success']="<p style='color:green;'>Password Updated Successfuly</p>";
			}
			return($error);
			
		}
		/*this function will validate update user form if error found then $error['error'] will be set else $error['success'] will be set*/
		public function updateUserFormValidationAndUpdate($userID,$post){
			$error = array();
			if(empty($post['n']) || empty($post['e']) ){
				$error['error'] = "False";
			} else {
				$error['success'] = "Profile Successfuly Updated ";
				if($post['gen']=='f'){
					$gender = "Female";
				} else {
					$gender = "Male";
				}
				$this->updateUser($userID,$post['n'],$post['e'],$gender);
			}
			return($error);
		}
		#this function will update particular user by his user id
		public function updateUser($userID,$name,$email,$gender){
			$sql = "update users set name='$name',email='$email',gender='$gender' where user_id='$userID';";
			$result = mysqli_query($this->connection,$sql);
			$this->getError();
		}
		#this function will get used when a massage need to send to a particular user
		protected function sendMessageToSpecificUser($userID,$message,$sender){
			$sql="insert into massages(user_id,message_body,sender) values ('$userID','$message','$sender');";
			$result = mysqli_query($this->connection,$sql);
			return !$this->getError();
		}
		#this function will return all messages for a particular user
		public function getAllMessageQueryResult($userID){
			$sql="select * from massages where user_id='$userID';";
			$result = mysqli_query($this->connection,$sql);
			$this->getError();
			return($result);
		}
		#sendMessageForm validation goes here
		public function validationAndSendMessageToParticularUser($post,$sender){
			$error = array();
			$error['success']="";
			$error['error'] = "";
			if(empty($post['username']) || empty($post['message'])){
				$error['error']= "<p style='color:red'>username or message can not be empty</p>";
			} else {
				$user_id = $post['username'];
				$message = $post['message'];
				
				$sql = "select * from users where user_id='$user_id';";
				$result = mysqli_query($this->connection,$sql);
				if(mysqli_num_rows($result)>0){
					$this->sendMessageToSpecificUser($user_id,$message,$sender);
					$error['success'] = "<p style='color:green'>Message Sent Successfuly</p>";
				} else {
					$error['error']="<p style='color:red'>Username you entered is not register to our Database</p>";
				}
				
			}
			return($error);
		}
		#this function will delete massages by id
		public function deleteMessageById($messageID){
			$sql="Delete from massages where message_id=$messageID;";
			$result = mysqli_query($this->connection,$sql);
			$this->getError();
			return($result);
		}
		#this function will use for update image
		public function updateUserPhotos($files,$userID,$old_image_path){
			$destination = "uploads/".$files['image']['name'];
			$fileName = $files['image']['tmp_name'];
			$error = array();
			if(file_exists($destination)){
				$error['image']="<p style='color:green;'>change the image files to another name first</p>";
			} else {
				if($old_image_path!='uploads/person.jpg'){
					unlink($old_image_path);
				}
				
				move_uploaded_file($fileName,$destination);
				$error['success']="<p styles='color:green;'>File Uploaded successfully</p>";
				$sql="update users set user_image_path='$destination' where user_id='$userID';";
				mysqli_query($this->connection,$sql);
				$this->getError();
			}
			return($error);
		}

	}
	//This class is for basic user it's extends user class
	class BasicUser extends User{
		function __construct(){
			User::__construct();
		}
		
		
	}
	//This class is for admin user it also extends user class
	class AdminUser extends User{
		function __construct(){
			User::__construct();
		}
		
		#delete basic user
		public function deleteUser($userID){
			$sql ="delete from users where user_id = '$userID'";
			$result=mysqli_query($this->connection,$sql);
			return !$this->getError();
		}
		
		#incert new notice by title and body(no image provided)
		private function incertNewNoticeWithoutImage($title,$body){
			$sql = "insert into notice(notice_title,notice_body) values ('$title','$body');";
			$result = mysqli_query($this->connection,$sql);
			return !$this->getError();
		}
		#validate and Insert New notice and insert new notice
		public function validateAndInsertNewNotice($post){
			$error = array();
			$error['error']="";
			if(empty($post['notice_title']) || empty($post['notice_body'])){
				$error['error'] = "<p style='color:red'>Both field must be filled</p>";
			} else {
				$notice_title =$post['notice_title'];
				$notice_body = $post['notice_body'];
				$this->incertNewNoticeWithoutImage($notice_title,$notice_body);
				$this->getError();
				$error['success'] = "<p style='color:Green'>New Notice Successfully inserted</p>";
			}
			return($error);
		}
		
		#delete notice via notice id
		public function deleteNotice($noticeID){
			$sql = "delete from notice where notice_id='$notificationID'";
			$result = mysqli_query($this->connection,$sql);
			return !$this->getError();
		}
				#this function  is used for send massage to all users
		public function sendMessageToAllUser($message,$sender){
			$sql1 = "select user_id from users;";
			$result1= mysqli_query($this->connection,$sql1);
			$assoc1 = array();
			while($assoc1 = mysqli_fetch_assoc($result1)){
				$sql2 = "insert into massages(user_id,message_body,sender) values ('".$assoc1['user_id']."','$message','$sender');";
				mysqli_query($this->connection,$sql2);
			}
		}
		public function getAllUserResult(){
			$sql ="select * from users;";
			$result = mysqli_query($this->connection,$sql);
			return($result);
		}

	}
?>