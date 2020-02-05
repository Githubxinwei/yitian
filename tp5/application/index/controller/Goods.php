<?php

namespace app\index\controller;

use think\Controller;
use app\index\model\Goods as GoodsModel;
use app\index\model\Cagegory;
use think\Db;
class Goods extends Controller
{
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
		
		$cid = $_GET['cid'];
		$gid = $_GET['gid'];
		$gdata = $goods->get($gid)->toArray();
		$cdata = Db::name('category')->where('cid',$cid)->select();
		$this->assign('gdata',$gdata);
		$this->assign('cdata',$cdata);
		return $this->fetch();
	}
	public function fruit(GoodsModel $fruit)
	{	
		$data = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',1)->select();
		$sort = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',1)->order('sort','desc')->select();
		$this->assign('sort',$sort);
		$this->assign('data',$data);
		return $this->fetch();
	}
	public function vagetable(GoodsModel $vagetable)
	{	
		$data = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',2)->select();
		$sort = Db::name('category')->alias('c')->join('goods g','g.pid = c.cid')->where('c.pid',2)->order('sort','desc')->select();
		$this->assign('data',$data);
		$this->assign('sort',$sort);
		return $this->fetch();
	}
	public function groupbuy()
	{
		return $this->fetch();
	}
}