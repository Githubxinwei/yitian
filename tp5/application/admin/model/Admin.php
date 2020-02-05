<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Admin extends Model
{
	use SoftDelete;
	protected static $deleteTime = 'delete_time';
	
	protected $atuo = ['createip','password'];
	
	protected $insert = [];
	protected $update = [];
	
	public function setCreateipAttr()
	{
		return Request()->ip();
	}
	
	public function setPasswordAttr($value)
	{
		return md5($value);
	}
}