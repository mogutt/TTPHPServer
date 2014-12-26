<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

include_once(APPPATH."core/TT_Controller.php");

class User extends TT_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');
		$this->load->model('depart_model');
	}

	public function index()
	{
		$this->config->site_url();
		$this->load->view('base/header');
		$this->load->view('base/user');
		$this->load->view('base/footer');
	}

	public function all()
	{
		$perpage = 10000;
		$departs = $this->depart_model->getList(array('status'=>0,'pid !='=>0), '*', 0, $perpage);
		$_departs = array();
		foreach ($departs as $key => $value) {
			$_departs[$value['id']] = $value;
		}
		$start = $this->input->get('start');
		if(!$start){
			$start =  0;
		}
		$perpage = 10;
		$users = $this->user_model->getList(array('status'=>0), '*', $start*$perpage, $perpage);
		foreach ($users as $key => $value) {
			if($value['sex'] == 0){
				$users[$key]['sex'] = '女';
			}else{
				$users[$key]['sex'] = '男';
			}
			if(isset($_departs[$value['departId']])){
				$users[$key]['depart_value'] = $_departs[$value['departId']]['title'];
			}else{
				$users[$key]['depart_value'] = '数据错误';
			}
			if($users[$key]['avatar']){
				$users[$key]['avatar_value'] = $this->config->config['msfs_url'].$users[$key]['avatar'];
			}
		}
		$count = $this->user_model->getCount(array('status'=>0));
		$result = array(
			'users'=>$users,
			'page'=>$start,
			'count'=>ceil($count/10),
			'departs'=>$_departs
		);
		echo json_encode($result);
	}

	public function del()
	{
		$id = $this->input->post('id');
		$result = $this->user_model->update(array('status'=>1), $id);
		if($result){
			echo 'success';
		}
	}

	public function add()
	{
		$params = array(
			'title'=>$this->input->post('title'),
			'uname'=>$this->input->post('uname'),
			'pwd'=>md5($this->input->post('title')),
			'avatar'=>$this->input->post('avatar'),
			'nickName'=>$this->input->post('nickName'),
			'departId'=>$this->input->post('departId'),
			'sex'=>$this->input->post('sex'),
			'position'=>$this->input->post('position'),
			'mail'=>$this->input->post('mail'),
			'telphone'=>$this->input->post('telphone'),
			'jobNumber'=>$this->input->post('jobNumber'),
			'created'=>time(),
			'updated'=>time()
		);
		$result = $this->user_model->insert($params);
		if($result){
			echo 'success';
		}
	}

	public function edit()
	{
		$params = array(
			'title'=>$this->input->post('title'),
			'uname'=>$this->input->post('uname'),
			'avatar'=>$this->input->post('avatar'),
			'nickName'=>$this->input->post('nickName'),
			'departId'=>$this->input->post('departId'),
			'sex'=>$this->input->post('sex'),
			'position'=>$this->input->post('position'),
			'mail'=>$this->input->post('mail'),
			'telphone'=>$this->input->post('telphone'),
			'jobNumber'=>$this->input->post('jobNumber'),
			'updated'=>time()
		);
		$id = $this->input->post('id');
		$pwd = $this->input->post('pwd');
		if($pwd){
			$params['pwd'] = md5($pwd);
		}
		$result = $this->user_model->update($params,$id);
		if($result){
			echo 'success';
		}
	}

	public function get()
	{
		$id = $this->input->post('id');
		$result = $this->user_model->getOne(array('id'=>$id));
		if($result){
			echo json_encode($result);
		}
	}

	public function upload()
	{
		try{
		    $filename=$this->input->get('filename');
		    $ext = pathinfo($filename, PATHINFO_EXTENSION);
		    $filename = time().".".$ext;
		    $input = file_get_contents("php://input");
		    file_put_contents('./download/'.$filename, $input);
		    $res = $this->_upload('./download/'.$filename);
		    if($res['error_code'] == 0){	    	
			    $array = array(
			    	'status' =>'success',
			    	'file' =>$res['path'],
			    	'real_path'=>$this->config->config['msfs_url'].$res['path']
			    );
		    }else{
		    	$array = array(
			    	'status' =>'fail',
			    	'file' =>'',
			    	'real_path'=>''
			    );
		    }
			echo json_encode($array);
		}
		catch(Exception $e)
		{
			$array = array(
				'status' =>'fail',
				'file' =>0
			);
			echo json_encode($array);
		}
	}

	public function _upload($filename)
	{
		$ch = curl_init();
		$data = array('filename'=>'@'.$filename);
		curl_setopt($ch,CURLOPT_URL,$this->config->config['msfs_url']);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($ch,CURLOPT_POST,true);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		$result = curl_exec($ch);
		curl_close($ch);
		return json_decode($result,1);
	}

}