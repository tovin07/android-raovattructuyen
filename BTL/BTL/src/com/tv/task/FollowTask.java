package com.tv.task;

import java.util.ArrayList;
import java.util.List;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Fragment;
import android.os.AsyncTask;

import com.tv.btl.BaseApplication;
import com.tv.listener.FollowListener;
import com.tv.model.User;
import com.tv.net.FollowController;

public class FollowTask extends AsyncTask<User, String, JSONObject> {
	private int type;
	private User user;

	public static final int CHECKFOLLOW = 0;
	public static final int ADDFOLLOW = 1;
	public static final int UNFOLLOW = 2;
	public static final int GETFOLLOW = 3;
	public static final int MORE_FOLLOW=4;

	private FollowListener context;
	private FollowController fController;

	public FollowTask(int mType, FollowListener mActivity) {
		this.type = mType;
		this.context = mActivity;
		fController = new FollowController();
	}

	@Override
	protected JSONObject doInBackground(User... params) {
		JSONObject json = null;
		switch (type) {
		case CHECKFOLLOW:
			json = fController.checkFollow(params[0], params[1]);
			break;
		case ADDFOLLOW:
			json = fController.addFollow(params[0], params[1]);
			break;
		case UNFOLLOW:
			json = fController.unFollow(params[0], params[1]);
			break;
		case GETFOLLOW:
			json = fController.getFollow(params[0]);
			break;
		case MORE_FOLLOW:
			BaseApplication bs = (BaseApplication) ((((Fragment) context)
					.getActivity()).getApplication());
			
			json=fController.moreFollow(params[0], bs.getPage_friend()+1);
		default:
			break;
		}
		return json;
	}

	protected void onPostExecute(JSONObject json) {
		switch (type) {
		case CHECKFOLLOW:
			checkFollow(json);
			break;
		case ADDFOLLOW:
			addFollow(json);
			break;
		case UNFOLLOW:
			unFollow(json);
			break;
		case GETFOLLOW:
			getFollow(json);
			break;
		case MORE_FOLLOW:
			moreFollow(json);
			break;
		default:
			break;
		}

	}

	private void checkFollow(JSONObject json) {
		try {
			int result = Integer.parseInt(json.getString("result"));
			context.checkFollow(result);
		} catch (JSONException e) {

		}
	}

	private void addFollow(JSONObject json) {
		try {
			int result = Integer.parseInt(json.getString("result"));
			context.addFollow(result);
		} catch (JSONException e) {

		}
	}

	private void unFollow(JSONObject json) {
		try {
			int result = Integer.parseInt(json.getString("result"));
			context.unFollow(result);

		} catch (JSONException e) {
		}
	}

	public void getFollow(JSONObject json) {
		List<User> userList = new ArrayList<User>();
		int maxPage = 0;
		try {
			BaseApplication bs = (BaseApplication) ((((Fragment) context)
					.getActivity()).getApplication());
			bs.setPage_friend(1);

//			maxPage = Integer.parseInt(json.getString("maxid"));
			JSONArray user = json.getJSONArray("users");
			for (int i = 0; i < user.length(); i++) {
				User u = new User();
				JSONObject s = user.getJSONObject(i);
				// s=user.getJSONObject(i);
				u.setFullname(s.getString("user_fullname"));
				u.setUername(s.getString("user_username"));
				u.setId(Integer.parseInt(s.getString("user_id")));
				u.setEmail(s.getString("user_email"));
				u.setPhone(s.getString("user_tel"));
				String url = "http://10.0.2.2:85/raovattructuyen/"
						+ s.getString("user_avatar");
				u.setLinkava(url);
				userList.add(u);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
//		BaseApplication bs = (BaseApplication) ((((Fragment) context)
//				.getActivity()).getApplication());
//		if (maxPage != bs.getMaxPage()) {
//			bs.setMaxPage(maxPage);
//			bs.setPage_page(1);
//			context.reLoad(userList);
//		}
		context.reLoadFollow(userList);
	}
	
	public void moreFollow(JSONObject json){
		try {
			List<User> userList = new ArrayList<User>();
			int page=Integer.parseInt(json.getString("page"));
			BaseApplication bs = (BaseApplication) ((((Fragment) context)
					.getActivity()).getApplication());
			bs.setPage_friend(page);
			JSONArray user = json.getJSONArray("users");
			for (int i = 0; i < user.length(); i++) {
				User u = new User();
				JSONObject s = user.getJSONObject(i);
				// s=user.getJSONObject(i);
				u.setFullname(s.getString("user_fullname"));
				u.setUername(s.getString("user_username"));
				u.setId(Integer.parseInt(s.getString("user_id")));
				u.setEmail(s.getString("user_email"));
				u.setPhone(s.getString("user_tel"));
				String url = "http://10.0.2.2:85/raovattructuyen/"
						+ s.getString("user_avatar");
				u.setLinkava(url);
				userList.add(u);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
//		
	}
}
