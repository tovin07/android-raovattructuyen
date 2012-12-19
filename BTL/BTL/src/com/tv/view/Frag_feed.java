package com.tv.view;

import java.util.ArrayList;
import java.util.List;

import android.app.ListFragment;
import android.content.Intent;
import android.graphics.Bitmap;
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
import com.tv.listener.FragListener;
import com.tv.listener.ProductListener;
import com.tv.model.Product;
import com.tv.net.DownloadImage;
import com.tv.net.DownloadProduct;
import com.tv.net.JsonHandler;
import com.tv.task.ProductTask;

public class Frag_feed extends ListFragment implements ProductListener {
	public static final String UID = "uid";
	public static final String PID = "pid";
	public static final String PNAME = "pname";
	public static final String UNAME = "uname";
	public static final String PUBLICDATE = "public_date";
	public static final String URL = "image_url";
	public static final String DESCRIPTION = "description";
	public static final String LON="lon";
	public static final String LAT="lat";

	View FragmentView;
	List<Product> model = new ArrayList<Product>();
	FragmentArray adapter = null;
	Product product = null;
	Button vmore;
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		FragmentView = inflater.inflate(R.layout.frag_feed, container, false);
		
		return FragmentView;
	}
	

	public void onActivityCreated(Bundle Save) {
		super.onActivityCreated(Save);
		adapter = new FragmentArray();
		init();
		vmore =(Button) FragmentView.findViewById(R.id.frag_feed_more);
		vmore.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				viewMore();
			}
		});
	}
	
	public void viewMore(){
		
		BaseApplication bs =(BaseApplication) getActivity().getApplication();
		System.out.println(bs.getFeedPage());
		if(bs.getFeedPage()!=0){
			ProductTask t = new ProductTask(ProductTask.MORE_FEED, this);
			t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, new Product());
		}
		
	}

	public void onStart() {
		super.onStart();
	}

	public void saveFinish() {
		// TODO Auto-generated method stub

	}

	public void reloadFeed() {
		// TODO Auto-generated method stub

	}

	class FragmentArray extends ArrayAdapter<Product> {
		TextView pname, uname, date;
		ImageView img;
		Product pr;

		public FragmentArray() {
			super(Frag_feed.this.getActivity(), R.layout.row, model);

		}

		public View getView(int position, View convertView, ViewGroup parent) {
			View v = convertView;
			Holder h;
			if (v == null) {
				System.out.println(position + "  Null");
				LayoutInflater inflate = getActivity().getLayoutInflater();
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

	public void onListItemClick(ListView list, View view, int position, long id) {
		Intent i = new Intent(getActivity(), ViewPost.class);
		product = model.get(position);
		i.putExtra(Frag_feed.UID, product.getUid());
		i.putExtra(PID, product.getPid());
		i.putExtra(PNAME, product.getPname());
		i.putExtra(UNAME, product.getUname());
		i.putExtra(PUBLICDATE, product.getDate());
		i.putExtra(URL, product.getUrl());
		i.putExtra(DESCRIPTION, product.getDes());
		i.putExtra(LON, product.getLon());
		i.putExtra(LAT, product.getLat());
		startActivity(i);

	}

	public void onDestroy() {
		super.onDestroy();
		System.out.println("destroy");
	}

	public void init() {
		
		setListAdapter(adapter);
		ProductTask t = new ProductTask(ProductTask.FEED, this);
		Product f = new Product();
		t.execute(f);

	}

	public void reload(List<Product> params) {
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


	public void loadMore(List<Product> params) {
		for(int i=0;i<params.size();i++){
			model.add(params.get(i));
		}
		adapter.notifyDataSetChanged();
		
	}
	
	
	
}
