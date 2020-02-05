<?php

namespace app\index\controller;

use think\Controller;

class Order extends Controller
{
	public function cart()
	{
		return $this->fetch();
	}
	public function orders()
	{
		return $this->fetch();
	}
}
