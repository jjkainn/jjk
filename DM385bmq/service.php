<?php
include 'entity.php';

class LoginService{
	// µÇÂ¼
	public function Login($username,$password){
		if($username && $username=="admin-i" && $password && $password=="1"){
			$user=new User();
			$user->username=$username;
			$user->password=$password;
			$user->role=$this->GetUserRole($username,$password);
			return $user;
		}
		return false;
	}
	
	public function GetUserRole($username,$password){
		return "admin";
	}
}
?>
