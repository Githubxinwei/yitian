<?php

namespace app\index\controller;
use think\Db;
use app\index\model\User as userModel;
use think\Loader;
use think\Controller;
use think\Validate;
use app\index\model\Cart;
use app\index\model\Orders;
class User extends Controller
{
	public function login()
	{
		//显示登录页面
		return $this->fetch();
	}
	public function checklogin(UserModel $user)
	{
		$rule = [
		'username|真实姓名' => 'require|length:2,12',
		'password|用户密码' => 'require|length:6,12',
		'__token__' => 'require|token',
		];
		$message = [
		'username.require' => '用户名不符合',
		'password.length' => '用户密码长度应该为6至12位',
		];
		$data = input('post.');
		$validate = new Validate($rule,$message);
		$result = $validate->check($data);
		if(!$result){
			return $validate->getError();
		}
		$data = $user->get(['username'=>input('post.username')]);
		if($data->password == md5(input('post.password'))){
			session('username',$data->username);
			session('uid',$data->uid);
			//如果html里面要用到session，php文件里面要设置session,只有这样才可以把你想要的值传过去。
			session('avater',$data->avater);
			$this->success('登录成功','Index/index');
		}else{
			$this->error('登录失败');
		}
	}
	public function out()
	{
		session(null);
		$this->success('退出成功','Index/index');
		//$this->redirect('user/login');
	}
	public function register()
	{
		return $this->fetch();
	}
	public function checkusername(UserModel $user)
	{
		
		$data = $user->get(['username'=>input('post.username')]);
		if(!$data){
			return false;		
		} else {
			return true;
		}

		/*
		if (!captcha_check(input('post.code'))) {
			$this->error('验证码不正确');
		}
		$validate = Loader::validate('User');
		if(!$validate->check(input('post.'))){
			$this->error($validate->getError());
		}
		if($user->allowField(true)->save(input('post.'))){
			$this->success('注册成功','index/index');
		}else{
			$this->error('注册失败','index/index');
		}
		*/
		
		
	}

	public function checkregister(UserModel $user)
	{
		
		if (!captcha_check(input('post.code'))) {
			$this->error('验证码不正确');
		}
		$validate = Loader::validate('User');
		if(!$validate->check(input('post.'))){
			$this->error($validate->getError());
		}

		$data = $user->allowField(true)->save(input('post.'));

		if($data){
			$this->success('注册成功','index/index');
		}else{
			$this->error('注册失败','index/index');
		}
		
		
	}

	public function user()
	{
		$uid = session('uid');
		$odata = Db::name('orders')->alias('o')->join('goods g','o.gid = g.gid')->where('o.uid',$uid)->select();
		
		$this->assign('odata',$odata);
		return $this->fetch();
	}
	
	public function integral()
	{
		return $this->fetch();
	}
	public function useraddress()
	{
		return $this->fetch();
	}
	public function userintegral()
	{
		return $this->fetch();
	}
	public function userinfo()
	{
		return $this->fetch();
	}
	public function userpassword()
	{
		return $this->fetch();
	}
	public function  cart()
	{	
		
		$uid = session('uid');
		$sortdata = Db::name('cart')->alias('c')->join('goods g','g.gid = c.gid')->where('c.uid',$uid)->select();
		$this->assign('sortdata',$sortdata);
		return $this->fetch();
		
	}
	public function putcart(Cart $cart)
	{
		$cart->uid = session('uid');
		$cart->gid = $_GET['gid'];
		$num = $_GET['num'];
		if(!empty($num)){
			$cart->num = $num;
		}else{
			$cart->num = 1;
		}
		$data = Db::name('cart')->where('uid',$cart->uid)->where('gid',$cart->gid)->select();
		if(!empty($data[0])){
			$result = Db::name('cart')->where('cid',$data[0]['cid'])->update(['num'=>$data[0]['num']+$cart->num]);
			echo json_encode(['code'=>1]);
		}else{
			$result = $cart->save();
			echo json_encode(['code'=>1]);
		}
	}
	public function changecart(Cart $cart)
	{
		
		$cid = $_POST['cid'];
		$num = $_POST['num'];
		$result = Db::name('cart')->where('cid',$cid)->update(['num'=>$num]);
		
	}
	public function delcart(Cart $cart)
	{
		$cid = $_GET['cid'];
		$list  = $cart->get($cid);
		$list->delete();
		$this->redirect('user/cart');
	}
	public function orders(Orders $orders)
	{	
		
		
		return $this->fetch();
	}
	public function collection()
	{
		return $this->fetch();
	}
	
}