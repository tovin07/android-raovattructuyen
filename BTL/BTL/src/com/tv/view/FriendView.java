package com.tv.view;

import java.util.ArrayList;
import java.util.List;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.AdapterView.OnItemClickListener;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.listener.FollowListener;
import com.tv.listener.ProductListener;
import com.tv.model.Product;
import com.tv.model.User;
import com.tv.net.DownloadImage;
import com.tv.net.DownloadProduct;
import com.tv.task.FollowTask;
import com.tv.task.ProductTask;

public class FriendView extends Activity implements ProductListener, FollowListener{
	private int user_id;
	private String username = "";
	private String fullname = "";
	private String email = "";
	private String tel = "";
	private String imageurl = "";
	private int followaction = 0;

	TextView fname, mail, tel_number;
	ListView list;
	ImageView image;
	Button follow, vmore;
	FragmentArray adapter =null;
	List<Product> model = new ArrayList<Product>();
	User u1 = new User();
	User u2 = new User();
	Product product = null;
	
	
	public void onCreate(Bundle save){
		super.onCreate(save);
		setContentView(R.layout.friend);
		Intent i = getIntent();
		
		fname = (TextView) findViewById(R.id.friend_username);
		mail = (TextView) findViewById(R.id.friend_email);
		tel_number = (TextView) findViewById(R.id.friend_tel);
		image = (ImageView) findViewById(R.id.friend_avatar);
		list = (ListView) findViewById(R.id.friend_list);
		follow = (Button) findViewById(R.id.friend_remove);
		follow.setOnClickListener(new OnClickListener() {
			
			public void onClick(View v) {
				followAcion();
			}
		});
		list.setOnItemClickListener(new OnItemClickListener() {

			public void onItemClick(AdapterView<?> arg0, View arg1, int arg2,
					long arg3) {
				onListItemClick(arg0, arg1, arg2, arg3);
				
			}
		});
		
		user_id = i.getIntExtra(Frag_friends.UID, 0);
		fullname = i.getStringExtra(Frag_friends.FULLNAME);
		email = i.getStringExtra(Frag_friends.EMAIL);
		username = i.getStringExtra(Frag_friends.USERNAME);
		tel = i.getStringExtra(Frag_friends.TEL);
		imageurl = i.getStringExtra(Frag_friends.URL);
		u1.setId(((BaseApplication) getApplication()).getID());
		u2.setId(user_id);
		
		fname.setText(fullname);
		mail.setText(email);
		tel_number.setText(tel);
		DownloadImage download = new DownloadImage(image);
		download.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, imageurl);
		
		adapter = new FragmentArray();
		init();
	}
	
	public void init(){
		System.out.println("init");
		list.setAdapter(adapter);
		ProductTask t= new ProductTask(ProductTask.MYPAGE, this);
		Product p = new Product();
		p.setUid(u2.getId());
		t.execute(p);		
		BaseApplication bs = (BaseApplication) getApplication();
		bs.setView_page(1);
		
	}
	
	public void viewMore(View v){
		BaseApplication bs =(BaseApplication) getApplication();
		
		if(bs.getView_page()!=0){
			Product pr = new Product();
			pr.setUid(user_id);
			ProductTask t = new ProductTask(ProductTask.MORE_PAGE, this);
			t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR,pr);
		}
	}
	
	public void onListItemClick(AdapterView<?> arg0, View view, int position, long id) {
		Intent i = new Intent(FriendView.this, ViewPost.class);
		product = model.get(position);
		i.putExtra(Frag_feed.UID, product.getUid());
		i.putExtra(Frag_feed.PID, product.getPid());
		i.putExtra(Frag_feed.PNAME, product.getPname());
		i.putExtra(Frag_feed.UNAME, username);
		i.putExtra(Frag_feed.PUBLICDATE, product.getDate());
		i.putExtra(Frag_feed.URL, product.getUrl());
		i.putExtra(Frag_feed.DESCRIPTION, product.getDes());
		startActivity(i);
	}

	class FragmentArray extends ArrayAdapter<Product>{
		
		public FragmentArray() {
			super(FriendView.this, R.layout.row_mypage,model);
			
		}
		
		 public View getView(int position, View convertView, ViewGroup parent){
			 View v = convertView;
				Holder h;
				if (v == null) {
					System.out.println(position + "  Null");
					LayoutInflater inflate = getLayoutInflater();
					v = inflate.inflate(R.layout.row, parent, false);
					h = new Holder(v);
					v.setTag(h);

				} else {
					h = (Holder) v.getTag();

				}
				h.img.setTag((model.get(position)).getUrl());
				h.populate(model.get(position));
				return v;
		 }
	}
	 class Holder {
			TextView pname;
			TextView uname;
			TextView date;
			ImageView img;

			public Holder(View v) {
				pname = (TextView) v.findViewById(R.id.row_pname);
				uname = (TextView) v.findViewById(R.id.row_uname);
				date = (TextView) v.findViewById(R.id.row_date);
				img = (ImageView) v.findViewById(R.id.row_image);

			}

			public void populate(Product pr) {

				if (!pr.getInit() && pr.getUrl().equals(img.getTag())) {
					pname.setText(pr.getPname());
					date.setText(pr.getDate());
					uname.setText(pr.getUname());
					DownloadProduct  dl= new DownloadProduct(this.img, pr);
					dl.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, "");
				} else if (pr.getInit() && pr.getUrl().equals(img.getTag())) {
					pname.setText(pr.getPname());
					date.setText(pr.getDate());
					uname.setText(pr.getUname());
					this.img.setImageBitmap(pr.getBitmap());
				}

			}
		}

	 public void saveFinish() {		
	}

	public void reload(List<Product> params) {
		System.out.println("sizeeee "+params.size());
		
		
		for(int i=model.size()-1;i>=0;i--){
			model.remove(i);
		}
		
		for(int i=0;i<params.size();i++){
			model.add(params.get(i));
		}
		adapter.notifyDataSetChanged();
		System.out.println("count"+adapter.getCount());		
	}

	public void loadMore(List<Product> params) {
		// TODO Auto-generated method stub
		
	}

	public void checkFollow(int result) {}

	public void addFollow(int result) {
		switch (result) {
		case 0:
			break;
		case 1:
			followaction = 2;
			follow.setText("Bỏ theo dõi");
			Toast.makeText(FriendView.this, "Đã chọn theo dõi", Toast.LENGTH_SHORT).show();
		default:
			break;
		}
	}

	public void unFollow(int result) {
		switch (result) {
		case 0:
			break;
		case 1:
			followaction = 1;
			follow.setText("Theo dõi");
			Toast.makeText(FriendView.this, "Đã bỏ theo dõi", Toast.LENGTH_SHORT).show();
		default:
			break;
		}
	}

	public void followAcion() {
		FollowTask task = null;
		switch (followaction) {
		case 0:
			task = new FollowTask(FollowTask.CHECKFOLLOW, this);
			task.execute(u1, u2);
			break;
		case 1:
			task = new FollowTask(FollowTask.ADDFOLLOW, this);
			task.execute(u1, u2);
			break;
		case 2:
			task = new FollowTask(FollowTask.UNFOLLOW, this);
			task.execute(u1, u2);
			break;
		default:
			break;
		}
	}

	public void reLoadFollow(List<User> params) {
		// TODO Auto-generated method stub
		
	}

	public void loadMoreFollow(List<User> params) {
		// TODO Auto-generated method stub
		
	}

}
