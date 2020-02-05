<?php
namespace app\admin\controller;

use \think\Controller;
use \app\admin\model\User as UserModel;
use \app\admin\model\Upload as UploadModel;
use \think\Loader;
use \think\Db;
use \think\Request;
use \think\Session;

class User extends Controller
{
	public function index(UserModel $user)
	{
		if (!(empty(Session::get('name')))) {
			$list = $user->order('uid','desc')->paginate(10);
		
			$page = $list->render();
		
			return View('',compact('list','page'));
		} else {
			return $this->error('没有登陆');
		}
		
	}

	public function up($uid)
	{
		return View('',compact('uid'));
	}

	//上传头像
	public function upload($uid)
	{
	 	$file = request()->file('f');
    	// 移动到框架应用根目录/public/uploads/ 目录下
    	$info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');

    	$path = $info->getSavename();

    	$file = 'uploads'.'/'.str_replace('\\', '/', $path);

    	$user = new UserModel;

    	$result = $user -> where('uid',$uid) -> update(['avater' => $file]);

    	if ($result) {
    		$this->success('上传成功','User/alter');
    	} else {
    		$this->error('上传失败');
    	}

	}

	public function recycle(UserModel $user)
	{
	
		$list = $user->onlyTrashed()->order('uid','desc')->paginate(10);
		
		$page = $list->render();
		
		return View('',compact('list','page'));
	}

	public function alter(UserModel $user)
	{
		$list = $user->order('uid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function drop(UserModel $user)
	{
		$list = $user->order('uid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}
	
	public function insert(UserModel $user)
	{
		$list = $user->order('uid','desc')->paginate(10);

		$page = $list->render();

		return View('',compact('list','page'));
	}

	public function add()
	{
		return $this->fetch();
	}
	
	public function edit($uid)
	{
		$info = UserModel::get($uid);
		
		return View('',compact('info'));
	}
	
	public function update()
	{
		$validate = Loader::validate('User');
		
		if (!$validate->check(input('post.'))) {
			$this->error($validate->getError());
		}
		
		$user = new UserModel();
		
		if ($user->allowField(true)->isUpdate(true)->save(input('post.'))) {
			//$this->redirect('User/index');
			$this->success('修改成功','User/alter');
		} else {
			$this->error('修改失败');
		}
	}

	public function restore($uid)
	{
		$result = Db::name('user')->where('uid',$uid)->update(['delete_time' => Null]);

		if ($result) {
			$this->success('还原成功','User/recycle');
		} else {
			$this->error('还原失败');
		}
		

	}
	

	public function delete($uid)
	{
		if (UserModel::destroy($uid)) {
			$this->success('删除成功','User/drop');
		} else {
			$this->error('删除失败');
		}
	}
	
	public function create()
	{
		$validate = Loader::validate('User');
		
		if (!$validate->check(input('post.'))) {
			$this->error($validate->getError());
		}
		
		$user = new UserModel(input('post.'));
		
		$data = $user->allowField(true)->save();
		
		if ($data) {
			$this->success('添加成功','User/insert');
		} else {
			$this->error('添加失败');
		}
	}
}