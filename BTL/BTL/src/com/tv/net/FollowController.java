package com.tv.net;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.tv.model.Product;
import com.tv.model.User;

public class FollowController {
	private JsonHandler handler;

	
	public FollowController(){
		handler = new JsonHandler();		
	}

	public JSONObject checkFollow(User u1, User u2){
		String url = ServerConfig.CHECKFOLLOW;
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("userfollow",u1.getId()+""));
		params.add(new BasicNameValuePair("userfollowed",u2.getId()+""));
		JSONObject cf= handler.getJsonFromUrlByGet(url, params);
		return cf;
	}
	
	public JSONObject addFollow(User u1, User u2){
		String url = ServerConfig.ADDFOLLOW;
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("userfollow",u1.getId()+""));
		params.add(new BasicNameValuePair("userfollowed",u2.getId()+""));
		JSONObject af= handler.getJsonFromUrlByGet(url, params);
		return af;
	}

	public JSONObject unFollow(User u1, User u2){
		String url = ServerConfig.UNFOLLOW;
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("userfollow",u1.getId()+""));
		params.add(new BasicNameValuePair("userfollowed",u2.getId()+""));
		JSONObject uf= handler.getJsonFromUrlByGet(url, params);
		return uf;
	}
	
	public JSONObject getFollow(User user){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_id",user.getId()+""));
		params.add(new BasicNameValuePair("page",1+""));
		String url=ServerConfig.GETFOLLOW;
		JSONObject pmp= handler.getJsonFromUrlByGet(url, params);
		return pmp;
	}
	
	public JSONObject moreFollow(User user,int page){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_id",user.getId()+""));
		params.add(new BasicNameValuePair("page",1+""));
		String url=ServerConfig.GETFOLLOW;
		JSONObject pmp= handler.getJsonFromUrlByGet(url, params);
		return pmp;
	}
}
