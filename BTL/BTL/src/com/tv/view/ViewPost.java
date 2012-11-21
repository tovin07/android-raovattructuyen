package com.tv.view;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.List;

import android.app.Activity;
import android.app.ListActivity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.listener.CommentListener;
import com.tv.model.Comment;
import com.tv.model.Product;
import com.tv.net.DownloadImage;
import com.tv.task.CommentTask;
import com.tv.view.Frag_feed.Holder;
import com.tv.view.dialog.PhoneDialog;

public class ViewPost extends Activity implements CommentListener {
	private int product_id;
	private String username = "";
	private String productname = "";
	private String publicdate = "";
	private String description = "";
	private String imageurl = "";
	private PhoneDialog dialog;

	TextView pname, uname, date, des, url;
	ListView list;
	ImageView image;
	EditText comment;

	List<Comment> model = new ArrayList<Comment>();
	CommentArray adapter = null;
	Comment cm = null;

	public void onCreate(Bundle saveBundle) {
		super.onCreate(saveBundle);
		setContentView(R.layout.viewpost);
		Intent i = getIntent();

		pname = (TextView) findViewById(R.id.vp_pname);
		uname = (TextView) findViewById(R.id.vp_username);
		date = (TextView) findViewById(R.id.vp_date);
		des = (TextView) findViewById(R.id.vp_description);
		image = (ImageView) findViewById(R.id.vp_image);
		comment = (EditText) findViewById(R.id.vp_addcm);
		list = (ListView) findViewById(R.id.vp_listcm);

		product_id = i.getIntExtra(Frag_feed.PID, 1);
		productname = i.getStringExtra(Frag_feed.PNAME);
		username = i.getStringExtra(Frag_feed.UNAME);
		publicdate = i.getStringExtra(Frag_feed.PUBLICDATE);
		description = i.getStringExtra(Frag_feed.DESCRIPTION);
		imageurl = i.getStringExtra(Frag_feed.URL);
		System.out.println("pid : " + product_id);

		pname.setText(productname);
		uname.setText(username);
		date.setText(publicdate);
		des.setText(description);

		DownloadImage download = new DownloadImage(image);
		download.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, imageurl);
		
		adapter = new CommentArray();
		init();
	}

	public void init() {
		list.setAdapter(adapter);
		CommentTask t = new CommentTask(CommentTask.GETCM, this);
		Comment f = new Comment();
		f.setProduct_id(product_id);
		t.execute(f);
		for (int i = model.size() - 1; i >= 0; i--) {
			model.remove(i);
		}

	}

	public void onSaveComment(View v) {
		CommentTask t = new CommentTask(CommentTask.NEWCOMMENT, this);
		Comment c = new Comment();
		c.setUser_id(((BaseApplication) getApplication()).getID());
		c.setUser_name(((BaseApplication) getApplication()).getUsername());
		c.setComment_content(comment.getText().toString());
		c.setProduct_id(product_id);
		Calendar cal = Calendar.getInstance();
		SimpleDateFormat sdf = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
		adapter.add(c);
		adapter.notifyDataSetChanged();
		t.execute(c);
	}

	class CommentArray extends ArrayAdapter<Comment> {
		TextView uname, date, content;
		Comment cm;

		public CommentArray() {
			super(ViewPost.this, android.R.layout.simple_list_item_1, model);

		}

		public View getView(int position, View convertView, ViewGroup parent) {
			View v = convertView;
			CommentHolder h;
			if (v == null) {
				LayoutInflater inflate = getLayoutInflater();
				v = inflate.inflate(R.layout.row_comment, parent, false);
				h = new CommentHolder(v);
				v.setTag(h);
				cm = model.get(position);
			}
			else {
				h = (CommentHolder) v.getTag();

			}
			h.populateComment(model.get(position));
			return v;
		}
	}

	class CommentHolder {
		TextView uname, date, content;
		Comment cm;

		public CommentHolder(View v) {
			uname = (TextView) v.findViewById(R.id.rowcm_uname);
			date = (TextView) v.findViewById(R.id.rowcm_date);
			content = (TextView) v.findViewById(R.id.rowcm_content);

		}
		
		public void populateComment(Comment cm){
			date.setText(cm.getComment_date());
			uname.setText(cm.getUser_name());
			content.setText(cm.getComment_content());
			
		}

	}

	public void reload(List<Comment> params) {
		System.out.println("sizeeee " + params.size());
		for (int i = 0; i < params.size(); i++) {
			model.add(params.get(i));
		}
		adapter.notifyDataSetChanged();
		System.out.println("count" + adapter.getCount());
	}

	public void saveComment() {
		System.out.println("comment thanh cong!");

	}

}
