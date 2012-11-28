package com.tv.view;

import java.util.ArrayList;
import java.util.List;

import android.app.Fragment;
import android.app.ListFragment;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.listener.FollowListener;
import com.tv.model.Product;
import com.tv.model.User;
import com.tv.model.User;
import com.tv.net.DownloadProduct;
import com.tv.net.DownloadUser;
import com.tv.task.FollowTask;
import com.tv.task.ProductTask;
import com.tv.task.UserTask;
import com.tv.view.Frag_feed.FragmentArray;

public class Frag_friends extends ListFragment implements FollowListener{
	public static final String UID = "uid";
	public static final String FULLNAME = "fullname";
	public static final String EMAIL = "email";
	public static final String USERNAME = "uname";
	public static final String TEL = "tel";
	public static final String URL = "image_url";
	
	View FragmentView;
	List<User> model = new ArrayList<User>();
	FollowArray adapter = null;
	User user = null;
	Button vmore;
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		FragmentView = inflater.inflate(R.layout.frag_friends, container,
				false);
		return FragmentView;
	}

	public void onDestroy() {
		super.onDestroy();
		System.out.println("destroy");
	}

	public void init() {
		
		setListAdapter(adapter);
		FollowTask t = new FollowTask(FollowTask.GETFOLLOW, this);
		User us = new User();
		us.setId(((BaseApplication)getActivity().getApplication()).getID());
		t.execute(us);
		vmore=(Button) FragmentView.findViewById(R.id.frag_friend_more);
		vmore.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				// TODO Auto-generated method stub
				
			}
		});

	}
	
	public void loadMore(){
		BaseApplication bs =(BaseApplication) getActivity().getApplication();
	
		if(bs.getPage_friend()!=0){
			FollowTask t= new FollowTask(FollowTask.MORE_FOLLOW, this);
			User s= new User();
			s.setId(bs.getID());
			t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, s);
		}
	}
	
	public void onActivityCreated(Bundle Save) {
		super.onActivityCreated(Save);
		adapter = new FollowArray();
		init();
		vmore =(Button) FragmentView.findViewById(R.id.frag_friend_more);
		vmore.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				viewMore();
			}
		});
	}

	public void viewMore(){
		
//		BaseApplication bs =(BaseApplication) getActivity().getApplication();
//		System.out.println(bs.getFeedPage());
//		if(bs.getFeedPage()!=0){
//			FollowTask t = new UserTask(FollowTask.MORE_FEED, this);
//			t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, new User());
//		}
		
	}
	
	class FollowArray extends ArrayAdapter<User> {

		public FollowArray() {
			super(Frag_friends.this.getActivity(), R.layout.row_friend, model);

		}

		public View getView(int position, View convertView, ViewGroup parent) {
			View v = convertView;
			Holder h;
			if (v == null) {
				System.out.println(position + "  Null");
				LayoutInflater inflate = getActivity().getLayoutInflater();
				v = inflate.inflate(R.layout.row_friend, parent, false);
				h = new Holder(v);
				v.setTag(h);

			} else {
				h = (Holder) v.getTag();

			}
			h.img.setTag((model.get(position)).getLinkava());
			h.populate(model.get(position));
			return v;
		}
	}

	class Holder {
		TextView uname, email, tel;
		ImageView img;
		User u;

		public Holder(View v) {
			uname = (TextView) v.findViewById(R.id.rowf_username);
			email = (TextView) v.findViewById(R.id.rowf_email);
			tel = (TextView) v.findViewById(R.id.rowf_tel);
			img = (ImageView) v.findViewById(R.id.rowf_avatar);

		}

		public void populate(User user) {

			if (!user.isInit() && user.getLinkava().equals(img.getTag())) {
				uname.setText(user.getFullname());
				email.setText(user.getEmail());
				tel.setText(user.getPhone());
				DownloadUser  dl= new DownloadUser(this.img, user);
				dl.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, "");
			} else if (user.isInit() && user.getLinkava().equals(img.getTag())) {
				uname.setText(user.getFullname());
				email.setText(user.getEmail());
				tel.setText(user.getPhone());
				this.img.setImageBitmap(user.getAvatar());
			}

		}
	}

	public void onListItemClick(ListView list, View view, int position, long id) {
		Intent i = new Intent(getActivity(), FriendView.class);
		user = model.get(position);
		i.putExtra(UID, user.getId());
		i.putExtra(FULLNAME, user.getFullname());
		i.putExtra(USERNAME, user.getUsername());
		i.putExtra(EMAIL, user.getEmail());
		i.putExtra(TEL, user.getPhone());
		i.putExtra(URL, user.getLinkava());
		startActivity(i);
	}	
	
	public void reLoadFollow(List<User> params) {
		System.out.println("sizeeee " + params.size());

		for (int i = model.size() - 1; i >= 0; i--) {
			model.remove(i);
		}
		adapter.clear();
		for (int i = 0; i < params.size(); i++) {
			model.add(params.get(i));
		}
		adapter.notifyDataSetChanged();
		System.out.println("count" + adapter.getCount());		
	}

	public void loadMoreFollow(List<User> params) {
		for(int i=0;i<params.size();i++){
			model.add(params.get(i));
		}
		adapter.notifyDataSetChanged();
		
	}
	
	public void checkFollow(int result) {}
	public void addFollow(int result) {}
	public void unFollow(int result) {}
}
