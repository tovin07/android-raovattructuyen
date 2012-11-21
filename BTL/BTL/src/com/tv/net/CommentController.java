package com.tv.net;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import com.tv.model.Comment;
import com.tv.model.Product;

public class CommentController {
	private JsonHandler handler;
	
	public CommentController() {
		
		handler = new JsonHandler();
	}

	public JSONObject getComment(Comment comment){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("product_id",comment.getProduct_id()+""));
		String url=ServerConfig.GETCM;
		JSONObject pmp= handler.getJsonFromUrlByGet(url, params);
		return pmp;
	}

	public JSONObject newComment(Comment comment) { 
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("product_id",comment.getProduct_id()+""));
		params.add(new BasicNameValuePair("comment_content", comment.getComment_content()));
		params.add(new BasicNameValuePair("user_id", comment.getUser_id()+""));
		
		String url=ServerConfig.NEWCOMMENT;
		return handler.getJsonFromUrlByPost(url, params);
	}
	
}
