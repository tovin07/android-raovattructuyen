package com.tv.net;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.tv.model.Product;
import com.tv.model.User;

/**
 * Class tương tác server
 * @author misugi_jun91
 *
 */
public class UserController {
	
	private JsonHandler handler;

	
	public UserController(){
		handler = new JsonHandler();
		
	}
	
	/** Không dùng nữa, để làm template
	 * 	@return JsonObject respone['checkuser']; giá trị trả về là kiểu int: 0 không thể đăng ký, 1 là được đăng ký
	 * 
	 *
	public int checkUsername(String username){
		 int result=0;
		 List<NameValuePair> param = new ArrayList<NameValuePair>();
		 param.add(new BasicNameValuePair("username", username));
		 String url=URL_USERNAME+"a=check&";
		 JSONObject user = handler.getJsonFromUrlByGet(url, param);
		 try{
			 String usercheck=user.getString(CHECK_USER);
			 result=Integer.parseInt(usercheck);
			 }
		 catch(JSONException e){
			 e.printStackTrace();
			 
		 }
		 return result;
	}
	/*
	
	/**
	 * Đăng kí người dùng
	 * @param user : truyền vào 1 đối tượng user
	 * @return trả về 1 json 
	 */
	public JSONObject registerUser(User user){
		
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_username",user.getUsername()));
		params.add(new BasicNameValuePair("user_password", user.getPassword()));
		params.add(new BasicNameValuePair("user_email", user.getEmail()));
		params.add(new BasicNameValuePair("user_fullname", user.getFullname()));
		params.add(new BasicNameValuePair("user_address",user.getAddress()));
		params.add(new BasicNameValuePair("user_tel", user.getPhone()));
		params.add(new BasicNameValuePair("user_taikhoan", user.getTaikhoan()));
		String url=ServerConfig.REGISTER;
		JSONObject us =handler.getJsonFromUrlByPost(url, params);
		return us;
	}
	
	public JSONObject loginUser(User user){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_username", user.getUsername()));
		params.add(new BasicNameValuePair("user_password", user.getPassword()));
		String url=ServerConfig.LOGIN;
		JSONObject us =handler.getJsonFromUrlByPost(url, params);
		return us;
	}
	
	public JSONObject getUserInfo(User user){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_id",user.getId()+""));
		System.out.println("id "+user.getId());
		String url=ServerConfig.INFO;
		JSONObject uif= handler.getJsonFromUrlByGet(url, params);
		return uif;
	}
	
}
