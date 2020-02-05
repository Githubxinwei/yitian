<?php
namespace app\admin\validate;

use \think\Validate;

class Admin extends Validate
{
	protected $rule = [
		'name|用户名' 	=> 'require|length:2,12',
		'password|密码'   	=> 'require|confirm:password',
		'__token__' 	  	=> 'require|token',

	];

	protected $message = [
		'name.require'  => '用户名必填',
		'name.length'	=> '用户名长度应该为2至12位',
		'password.require'	=> '密码必填',
		'password.confirm'	=> '密码错误',
	];
}