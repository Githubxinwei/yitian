<?php

namespace app\admin\controller;

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