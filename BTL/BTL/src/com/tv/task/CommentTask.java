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
import com.tv.listener.CommentListener;
import com.tv.listener.UserListener;
import com.tv.model.Comment;
import com.tv.model.Comment;
import com.tv.net.CommentController;
import com.tv.net.UserController;
import com.tv.view.Frag_feed;

public class CommentTask extends AsyncTask<Comment, String, JSONObject> {
	
	private int type;
	private Comment comment;
	
	public static final int GETCM=0;
	public static final int NEWCOMMENT=1;
	

	private CommentListener context;
	private CommentController cController ;

	public CommentTask(int mType, CommentListener mActivity){
		this.type=mType;
		this.context=mActivity;
		cController = new CommentController();
	}
	
	
	@Override
	protected JSONObject doInBackground(Comment... params) {
		JSONObject json=null;
		switch (type) {
		case GETCM:
			json=cController.getComment(params[0]);
			break;
		case NEWCOMMENT:
			json=cController.newComment(params[0]);
			break;
		default:			
			break;
		}
		return json;
	}

	public void onPostExecute(JSONObject json){
		switch (type) {
		case GETCM:
			GetComment(json);
			break;
		case NEWCOMMENT:
			NewComment(json);
			break;
		default:
			break;
		}
	}
	
	public void GetComment(JSONObject json){
		List<Comment> commentList=new ArrayList<Comment>();
		try{
		System.out.println("bbbbbbbb");
		JSONArray comment=json.getJSONArray("comments");
		for(int i=0;i<comment.length();i++){
			Comment cm = new Comment();
			JSONObject s=comment.getJSONObject(i);
			//s=comment.getJSONObject(i);
			cm.setUser_name(s.getString("user_username"));
			cm.setComment_date(s.getString("comment_publicationDate"));
			cm.setComment_content(s.getString("comment_content"));
			commentList.add(cm);
		}
		}
		catch(Exception e){
			e.printStackTrace();
		}
		context.reload(commentList);		
	}
	
	public void NewComment(JSONObject json){
		try {
			String result=json.getString("result");
			if(result.equals("true")){
				context.saveComment();
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
		
	}
}
