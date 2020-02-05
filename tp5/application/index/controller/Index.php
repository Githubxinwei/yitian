<?php
namespace app\index\controller;

use \app\index\model\User as UserModel;
use think\Controller;
use app\index\model\Cart;
class Index extends Controller
{
    public function index(Cart $cart)
    {
		$uid = session('uid');
		$data = $cart->where('uid',4)->count('num');
		session('data',$data);

		$user = new UserModel();
		$list = $user;
		return View('',compact('list'));
    }
}
