<?php

namespace app\admin\controller;

use \think\Controller;
use \app\admin\model\Goods as GoodsModel;
use \app\admin\model\Category;
use \think\Db;
class Goods extends Controller
{
	public function index()
	{
		return $this->fetch();
	}

	public function sale(GoodsModel $goods)
	{
		$list = $goods->order('gid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function shelf(GoodsModel $goods)
	{
		$list = $goods->order('gid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function fix(GoodsModel $goods)
	{
		$list = $goods->order('gid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function recover(GoodsModel $goods)
	{
		$list = $goods->order('gid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}



	public function allgoods(GoodsModel $goods)
	{
		$datafruit = $goods->where('pid',1)->limit(20)->order('sort','desc')->select();
		$datavage = $goods->where('pid',2)->limit(20)->order('sort','desc')->select();
		$this->assign('datafruit',$datafruit);
		$this->assign('datavage',$datavage);
		return $this->fetch();
	}

	public function detailed(GoodsModel $goods)
	{
		$cid = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',1)->select();
		$sort = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.cid',1)->order('sort','desc')->select();
		$this->assign('sort',$sort);
		$this->assign('data',$data);
		return $this->fetch();
	}

	public function fruit(GoodsModel $goods)
	{
		/*
		$cid = $_GET['cid'];
		$gid = $_GET['gid'];
		$gdata = $goods->get($gid)->toArray();
		$cdata = Db::name('category')->where('cid',$cid)->select();
		$this->assign('sort',$sort);
		$this->assign('data',$data);
		*/
		$list = $goods->order('gid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function vegetable(GoodsModel $vegetable)
	{
		$data = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',2)->select();
		$sort = Db::name('category')->alias('c')->join('goods g','g.pid = c.pid')->where('c.pid',2)->order('sort','desc')->select();
		$this->assign('data',$data);
		$this->assign('sort',$sort);
		return $this->fetch();
	}

	public function groupbuy()
	{
		return $this->fetch();
	}
}	
