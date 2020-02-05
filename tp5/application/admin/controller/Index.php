<?php
namespace app\admin\controller;

use think\Request;
use think\Controller;
use think\Db;
use app\admin\model\Data;


class Index extends Controller
{
	public function __construct(Request $request)
	{
		parent::__construct();
		$this->request = $request;
	}
	
	public function select(User $user)
	{
		$list = $user->select();
		
		dump($list);
	}
	
    public function index()
    {
		return $this->fetch();
		
        $result = Db::name('user')->where('uid','>','0')->chunk(2,function($list){
			
			foreach ($list as $user) {
				dump($user);
			}
		});
    }
}
