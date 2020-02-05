<?php
namespace app\admin\validate;

use \think\Validate;

class User extends Validate
{
	protected $rule = [
		'username|用户名' => 'require|length:2,4',
		'password|密码' => 'require|confirm:repassword',
		'__token__' => 'require|token',
	
	];
	
	protected $message = [
		'username.require' => '用户名必填',
		'username.length' => '用户名长度应该为2至4位',
		'password.require' => '密码必填',
		'password.confirm' => '两次密码不一致',
	
	];
}