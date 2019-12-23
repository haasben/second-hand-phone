<?php

namespace app\index\controller;
use think\Controller;
use think\Db;

class Login extends Controller {


    public function index(){

    	if(IS_POST){
    		$data = input();
			$result = $this->validate($data,
		    [	
		    	'username|账号'=>'require',
		        'password|密码'=>'require|min:6'
		    ]);
			if(true !== $result){
			    // 验证失败 输出错误信息
			    return return_ajax(2,$result);
			}
			$user_count = Db::name('users')
	            ->where('mobile|email',$data['username'])
	            ->where('password',encrypt($data['password']))
            	->limit(1)
            	->find();
            if(empty($user_count)){
            	return return_ajax(2,'账号和密码不匹配');
            }
            session("user",$user_count);
            session('uid',$user_count['user_id']);

            return return_ajax(1,'登陆成功');

    	}
    	
    	return $this->fetch();
    }
    //注册
    public function register(){

	    	if(IS_POST){
	    		$data = input();
				$result = $this->validate($data,
			    [	
			    	'mobile|手机号'=>'require',
			        'password|密码'=>'require|min:6'
			    ]);
				if(true !== $result){
				    // 验证失败 输出错误信息
				    return return_ajax(2,$result);
				}
				//验证手机号是否是发送短信的手机号
				if($data['mobile'] != cookie('mobile')){
					return return_ajax(2,'与接收验证码手机号不符');
				}elseif($data['code'] !=cookie('v_code')){
					return return_ajax(2,'验证码错误');

				}

	    		$user_count = Db::name('users')
		            ->where('mobile',$data['mobile'])
	            	->count();
		        if ($user_count > 0) {
		        	return return_ajax(2,'账号已存在');
		        }
		        unset($data['code']);
		        $name = '用户'.mb_substr($data['mobile'],7,11);
				$data['nickname'] = $name;
		        $data['password'] = encrypt($data['password']);
		        $data['reg_time'] = time();
		  //       $head_pic ='/public/static/images/logo/pc_home_logo_default.png';
				// $data['head_pic'] = $head_pic;
		        // $switch = tpCache('distribut.switch');
		        // // 成为分销商条件
		        // $distribut_condition = tpCache('distribut.condition');
		        // 直接成为分销商, 每个人都可以做分销
		        $data['is_distribut']  = 1;
		        
		        $user_id = M('users')->add($data);
		        if (!$user_id) {
		        	return return_ajax(2,'添加失败');

		        } else {
		            // 会员注册赠送积分
		            $isRegIntegral = tpCache('integral.is_reg_integral');
		            if ($isRegIntegral == 1) {
		                $pay_points = tpCache('integral.reg_integral');
		            } else {
		                $pay_points = 0;
		            }
		            //$pay_points = tpCache('basic.reg_integral'); // 会员注册赠送积分
		            if ($pay_points > 0)
		                accountLog($user_id, 0, $pay_points, '会员注册赠送积分'); // 记录日志流水
		            return return_ajax(1,'添加成功');
		            // return array('status' => 1, 'msg' => '添加成功', 'user_id' => $user_id);
		        }
		    }else{
		    	return $this->fetch();
		    }
    }
    

    /*******************发送验证码**************************/
    public function send_msg($mobile){
		$mobiles = cookie('mobile');

		if(!empty($mobiles)){
			return return_ajax(2,'验证码获取频繁');exit;
		}
		//查询手机号是否已经注册账号
		$user_count = Db::name('users')
            ->where('mobile',$data['mobile'])
        	->count();
        if ($user_count > 0) {
        	return return_ajax(3,'账号已存在，请直接登陆');
        }

		if(is_mobile($mobile)){
			$code = mt_rand(1000,9999);
			// if(send_msg_api($mobile,$code)['code'] == '0'){
				cookie('mobile',$mobile,60);
				cookie('v_code',$code);

				return return_ajax(1,'验证码发送成功');exit;
			// }else{
			// 	return return_ajax(2,'验证码发送失败，请稍候再试');exit;
			// }

		}else{
			return return_ajax(2,'请输入正确的手机号');exit;
		}
	}


	/*******************忘记密码重置**************************/
	public function reset(){
		if(IS_POST){
			$data = input();
			$result = $this->validate($data,
		    [	
		    	'mobile|手机号'=>'require',
		        'password|密码'=>'require|min:6'
		    ]);
			if(true !== $result){
			    // 验证失败 输出错误信息
			    return return_ajax(2,$result);
			}
			//验证手机号是否是发送短信的手机号
			if($data['mobile'] != cookie('mobile')){
				return return_ajax(2,'与接收验证码手机号不符');
			}elseif($data['code'] !=cookie('v_code')){
				return return_ajax(2,'验证码错误');
			}
			$user_count = Db::name('users')
            ->where('mobile',$data['mobile'])
        	->update([
        		'password'=>encrypt($data['password'])
        	]);
        	return return_ajax(1,'修改成功');

		}

		return $this->fetch();
	}

   	public function reset_send_msg($mobile){
		$mobiles = cookie('mobile');

		if(!empty($mobiles)){
			return return_ajax(2,'验证码获取频繁');exit;
		}
		//查询手机号是否已经注册账号
		$user_count = Db::name('users')
            ->where('mobile',$mobile)
        	->count();
        if ($user_count == 0) {
        	return return_ajax(2,'账号不存在，请先注册');
        }

		if(is_mobile($mobile)){
			$code = mt_rand(1000,9999);
			// if(send_msg_api($mobile,$code)['code'] == '0'){
				cookie('mobile',$mobile,60);
				cookie('v_code',$code);

				return return_ajax(1,'验证码发送成功');exit;
			// }else{
			// 	return return_ajax(2,'验证码发送失败，请稍候再试');exit;
			// }

		}else{
			return return_ajax(2,'请输入正确的手机号');exit;
		}
	}


}