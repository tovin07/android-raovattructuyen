package com.tv.net;

import java.io.File;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONObject;

import android.app.Activity;

import com.tv.btl.BaseApplication;
import com.tv.model.Product;
import com.tv.model.User;

public class ProductController {
	private JsonHandler handler;
	
	public ProductController() {
		
		handler = new JsonHandler();
	}

	public JSONObject newPost(Product product) { 
		ArrayList<PairValue> params= new ArrayList<PairValue>();
		PairValue pname = new PairValue("product_name", product.getPname());
		PairValue pDes=new PairValue("product_description", product.getDes());
		PairValue pUid = new PairValue("user_id", product.getUid()+"");
		params.add(pname);
		params.add(pDes);
		params.add(pUid);
		
		String path=product.getPathImage();
		System.out.println("path la" +path);
		String url=ServerConfig.NEW_PRODUCT;
		return handler.getJsonFromUpload(url, path, params);
	}
	
	public JSONObject getFeed(){
		String url = ServerConfig.FEED;
		return handler.getJsonFromUrlByGet(url,null );
	}
	
	public JSONObject moreFeed(int page){
		String url=ServerConfig.FEED;
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("page",page+"" ));
		return handler.getJsonFromUrlByGet(url, params);
	}
	
	public JSONObject getMyPage(Product product){
		List<NameValuePair> params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("user_id",product.getUid()+""));
		String url=ServerConfig.MY_PAGE;
		JSONObject pmp= handler.getJsonFromUrlByGet(url, params);
		return pmp;
	}
	

	
//	public JSONObject newPost(Product product){
//		List<NameValuePair> params = new ArrayList<NameValuePair>();
//		params.add(new BasicNameValuePair("product_name", product.getPname()));	params.add(new BasicNameValuePair("product_description", product.getDes()));
//		params.add(new BasicNameValuePair("user_id", product.getUid()+""));
//		params.add(new B)
//	}
}
