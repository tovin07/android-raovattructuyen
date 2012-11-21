package com.tv.view;

import java.util.ArrayList;
import java.util.List;

import android.app.ListFragment;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.listener.ProductListener;
import com.tv.model.Product;
import com.tv.net.DownloadImage;
import com.tv.net.DownloadProduct;
import com.tv.task.ProductTask;
import com.tv.view.Frag_feed.Holder;

public class Frag_mypage extends ListFragment implements ProductListener{
	private View FragmentView = null;
	List<Product> model = new ArrayList<Product>();
	FragmentArray adapter =null;
	Product product = null;

	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		FragmentView = inflater.inflate(R.layout.frag_mypage, container, false);
		return FragmentView;

	}

	public void onActivityCreated(Bundle Save) {
		super.onActivityCreated(Save);
		adapter = new FragmentArray();
		init();
		System.out.println("mypage: activty created");
	}

	public void onStart() {
		super.onStart();
		System.out.println("mypage: onStart");
	}

	public void onDestroy() {
		super.onDestroy();
		System.out.println("mypage: onDestroy");
	}

	public void onPause() {
		super.onPause();
		System.out.println("mypage: onPause");
	}

	public void onStop() {
		super.onStop();
		System.out.println("onStop");
	}

	public void onListItemClick(ListView list, View view, int position, long id) {
		Intent i = new Intent(getActivity(), ViewPost.class);
		product = model.get(position);
		i.putExtra(Frag_feed.PID, product.getPid());
		i.putExtra(Frag_feed.PNAME, product.getPname());
		i.putExtra(Frag_feed.UNAME, ((BaseApplication)getActivity().getApplication()).getUsername());
		i.putExtra(Frag_feed.PUBLICDATE, product.getDate());
		i.putExtra(Frag_feed.URL, product.getUrl());
		i.putExtra(Frag_feed.DESCRIPTION, product.getDes());
		startActivity(i);
	}

	class FragmentArray extends ArrayAdapter<Product>{
		
		public FragmentArray() {
			super(Frag_mypage.this.getActivity(), R.layout.row_mypage,model);
			
		}
		
		 public View getView(int position, View convertView, ViewGroup parent){
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

	public void saveFinish() {
	}
	
	public void init(){
		System.out.println("init");
		setListAdapter(adapter);
		ProductTask t= new ProductTask(ProductTask.MYPAGE, this);
		Product p = new Product();
//		int uid = 44;
		int uid=((BaseApplication)getActivity().getApplication()).getID();
		p.setUid(uid);
		t.execute(p);
		
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
	
}
