package com.tv.task;

import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.os.AsyncTask;
import android.widget.Toast;

import com.tv.btl.BaseApplication;
import com.tv.listener.UserListener;
import com.tv.model.User;
import com.tv.net.UserController;

/**
 * Lớp thực hiện nhiệm vụ chạy ngầm , yêu cầu lớp Controller tương tác với server
 * @author misugi_jun91
 *
 */
public class UserTask extends AsyncTask<User, String, JSONObject>{
	
	
	private int type;
	private User user;
	
	public static final int CHECK_USERNAME=0;
	public static final int REGISTER=1;
	public static final int LOGIN=2;
	public static final int INFO=3;		
	public static final int MYPAGE=4;
	
	private UserListener context;
	private UserController uController ;
	
	public UserTask(int mType,UserListener mActivity){
		this.type=mType;
		this.context=mActivity;
		uController = new UserController();
	}
	/**
	 * Do task in new thread not main thread
	 */
	@Override
	protected JSONObject doInBackground(User... params) {
		
		JSONObject json=null;
		switch (type) {
		case REGISTER:
			json=uController.registerUser(params[0]);
			break;
		case LOGIN:
			json=uController.loginUser(params[0]);
			break;
		case INFO:
			json=uController.getUserInfo(params[0]);
			break;
		default:
			break;
		}
		return json;
//		int resutl=uController.checkUsername(params[0]);
//		System.out.println(resutl);
//		return Integer.valueOf(resutl);
	}
	
	
	/**
	 * Go in to main thread after do the thread above
	 */
	protected void onPostExecute(JSONObject json){
		switch (type) {
		case REGISTER:
			System.out.println("nhan duoc goi tin");
			register(json);
			break;
		case LOGIN:
			login(json);
			break;
		case INFO:
			getUserInfo(json);
			break;
		default:
			break;
		}
		
	}
	
//	private void checkUsername(Integer value){
//		switch (value) {
//		case 0:
//			Toast.makeText((Activity)context, "Khong the dang ky tai khoan nay", Toast.LENGTH_SHORT).show();
//			
//			break;
//
//		default:
//			Toast.makeText((Activity)context, "Co the dang ky tai khoan nay", Toast.LENGTH_SHORT).show();
//			break;
//		}
//	}
	
	private void register(JSONObject json){
		int result=0;
		try{
			//TODO đăng kí tài khoản thành công tại đây
			String register=json.getString("register");
			if(Integer.parseInt(register)==1){
				context.alertMessage("Đăng kí tài khoản thành công");
				String uid =json.getString("uid");
				((BaseApplication)((Activity)context).getApplication()).setID(Integer.parseInt(uid));
				System.out.println("uid"+((BaseApplication)((Activity)context).getApplication()).getID());
				
			}
			else
			{
				String checkuser=json.getString("checkusername");
				if(Integer.parseInt(checkuser)==0)
				{
					context.alertMessage("Tên đăng nhập đã được sử dụng");
				}
			}
			
		}
		catch(JSONException e){
			e.printStackTrace();
		}
	}
	
	private void login(JSONObject json)
	{
		try{
			String uid = json.getString("uid");
			int user_id=Integer.parseInt(uid);
			if(user_id==-1){
				context.alertMessage("Kiểm tra tài khoản và mật khẩu");
			}
			else
			{
				String displayName=json.getString("username");
				String url=json.getString("avatar");
				BaseApplication bs=(BaseApplication)((Activity)context).getApplication();
				bs.setID(Integer.parseInt(uid));
				String username = json.getString("username");
				bs.setUsername(username);
				String urlavatar =json.getString("avatar");
				bs.setUrlAvatar(urlavatar);
				context.loginComplete();
			}
				
		}
		catch(JSONException e){
			
		}
	}
	
	/*
	 *   $respone['fullname']=$user->getUser_fullname();
        $respone['email']=$user->getUser_email();
        $respone['phone']=$user->getUser_tel();
        $respone['address']=$user->getUser_address();
        $respone['taikhoan']=$user->getUser_taikhoan();
	 */
	private void getUserInfo(JSONObject json){
		try{
			String fullname=json.getString("fullname");
			String email=json.getString("email");
			String phone=json.getString("phone");
			String address=json.getString("address");
			String taikhoan=json.getString("taikhoan");
			User user = new User();
			user.setFullname(fullname);
			user.setEmail(email);
			user.setPhone(phone);
			user.setAddress(address);
			user.setTaikhoan(taikhoan);
			context.setUserInfo(user);
		}
		catch(JSONException e){
			
		}
	}
}
