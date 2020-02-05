<?php 
namespace app\admin\controller;

use \think\Controller;
use \app\admin\model\Admin as AdminModel;
use \think\Loader;
use \think\Request;
use \think\Session;

class Admin extends Controller
{
	public function index()
	{
		if (!(empty(Session::get('name')))) {
			return $this->fetch();
		} else {
			return $this->error('没有登陆');
		}
		
	}

	public function default()
	{
		return $this->fetch();
	}
	public function login($name='',$password='')
	{
		/* $username = $_POST['username'];
		$password = $_POST['password'];
		$sql = "select * from user where username='$username' and password='$password'";
		$data = new AdminModel();
		$result = $data->query($sql);
		if ($result) {
			$_SESSION['username'] = $username;
			return $this->success('登录成功','Admin/index');
		} else{
			return $this->error('登录失败');
		}
		*/
		// 赋值（当前作用域）
		Session::set('name',$name);
		$data = AdminModel::get([
			'name' => $name,
			'password' => $password
			]);
		if($data){
		   return $this->success('登录成功','Admin/index');
		}else{
			return $this->error('登录失败');
		}
    }
	
	public function logout()
	{
		session('name',null);
		return $this->success('退出成功','http://yitian.com/admin');
	}

}