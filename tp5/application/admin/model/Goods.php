<?php
namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Goods extends Model
{
	use SoftDelete;
	protected static $deleteTime = 'delete_time';
	protected $auto = ['createip','password'];
	protected $insert = [];
	protected $update = [];

	public function setCreateipAttr($value)
	{
		return Request()->ip();
	}

	public function setPasswordAttr($value)
	{
		return md5($value);
	}
}