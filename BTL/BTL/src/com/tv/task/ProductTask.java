package com.tv.task;

import java.util.ArrayList;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.Fragment;
import android.os.AsyncTask;

import com.tv.btl.BaseApplication;
import com.tv.listener.ProductListener;
import com.tv.listener.UserListener;
import com.tv.model.Comment;
import com.tv.model.Product;
import com.tv.net.ProductController;
import com.tv.net.UserController;
import com.tv.view.Frag_feed;

public class ProductTask extends AsyncTask<Product, String, JSONObject> {
	
	private int type;
	private Product product;
	
	public static final int NEWPOST = 0;
	public static final int VIEWPOST = 1;
	public static final int FEED=2;
	public static final int MYPAGE=3;
	public static final int MORE_PAGE=4;
	

	private ProductListener context;
	private ProductController pController ;

	public ProductTask(int mType, ProductListener mActivity){
		this.type=mType;
		this.context=mActivity;
		pController = new ProductController();
	}
	
	
	@Override
	protected JSONObject doInBackground(Product... params) {
		JSONObject json=null;
		switch (type) {
		case NEWPOST:
			json=pController.newPost(params[0]);
			break;
		case FEED:
			json=pController.getFeed();
			break;
		case MYPAGE:
			json=pController.getMyPage(params[0]);
			break;
		case MORE_PAGE:
			int page =((BaseApplication)((Frag_feed)context).getActivity().getApplication()).getFeedPage();
			json=pController.moreFeed(page+1);
			break;
		default:
			
			break;
		}
		return json;
	}

	public void onPostExecute(JSONObject json){
		switch (type) {
		case NEWPOST:
			NewPost(json);
			break;		
		case FEED:
			Feed(json);
			break;
		case MYPAGE:
			MyPage(json);
			break;
		default:
			break;
		}
	}
	
	public void NewPost(JSONObject json){
		try {
			String result=json.getString("result");
			if(Integer.parseInt(result)==1){
				context.saveFinish();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}		
	}
	
	public void Feed(JSONObject json){
		List<Product> productList=new ArrayList<Product>();
		int maxFeed=0;
		try{
		 maxFeed = Integer.parseInt(json.getString("maxid"));
		JSONArray product=json.getJSONArray("product");
		JSONArray username = json.getJSONArray("user_name");
		for(int i=0;i<product.length();i++){
			Product pr = new Product();
			JSONObject s=product.getJSONObject(i);
			//s=product.getJSONObject(i);
			pr.setPname(s.getString("product_name"));
			pr.setDate(s.getString("post_publicationDate"));
			pr.setDes(s.getString("product_description"));
			pr.setPid(Integer.parseInt(s.getString("product_id")));
			String url ="http://10.0.2.2:85/raovattructuyen/"+s.getString("product_avatar");
			pr.setUrl(url);
			String name =username.getString(i);
			pr.setUname(name);
			productList.add(pr);
		}
		}
		catch(Exception e){
			e.printStackTrace();
		}
		if()
		context.reload(productList);
		
	}
	
	public void MyPage(JSONObject json){
		List<Product> productList=new ArrayList<Product>();
		try{
		System.out.println("bbbbbbbb");
		JSONArray product=json.getJSONArray("product");
		for(int i=0;i<product.length();i++){
			Product pr = new Product();
			JSONObject s=product.getJSONObject(i);
			//s=product.getJSONObject(i);
			pr.setPname(s.getString("product_name"));
			pr.setDate(s.getString("post_publicationDate"));
			pr.setDes(s.getString("product_description"));
			pr.setPid(Integer.parseInt(s.getString("product_id")));
			String url ="http://10.0.2.2:85/raovattructuyen/"+s.getString("product_avatar");
			pr.setUrl(url);
			productList.add(pr);
		}
		}
		catch(Exception e){
			e.printStackTrace();
		}
		context.reload(productList);
		
	}
	
	public void ViewPost(JSONObject json){
		try {
			
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}
}
