<?php
namespace app\index\validate;

use \think\Validate;

class User extends Validate
{
	protected $rule = [
		'username|真实姓名' => 'require|length:2,12',
		'password|用户密码' => 'require|length:6,12',
		'password|用户密码' => 'require|confirm:repassword',
		'tel|手机号' => 'number|length:11',
		'tel|手机号' => 'require',
		'__token__' => 'require|token',
		];
	protected $message = [
		'username.require' => '用户名必须填',
		'username.length' => '用户名长度应该为2至12位',
		'password.length' => '用户密码长度应该为6至12位',
		'password.confirm' => '前后密码不一致',
		'tel'=>'手机号必填',
		'tel.length'=>'手机号长度必须为11位',
		];
}