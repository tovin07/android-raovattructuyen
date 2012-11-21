package com.tv.downloadimage;


import java.util.ArrayList;

import com.tv.btl.R;
import com.tv.net.JsonHandler;

import android.app.Activity;
import android.app.ListActivity;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.Toast;

public class TestDownLoadImage extends ListActivity {
	private ArrayList<ImageDownload> urls;
	private ArrayList<DownloadTask> tasks;
	private String[] url={	"http://dantri21.vcmedia.vn/zoom/327_245/jcjZsmdamOhPYNEOw8Up/Image/2012/08/tt18-19379.jpg",
			"http://dantri21.vcmedia.vn/zoom/94_79/x8SuE6cccccccccccccJ/Image/2012/11/Anh-2.2-7b4e3.JPG",
			"http://dantri21.vcmedia.vn/zoom/94_79/kLmtCyYGgph1lHhk1u5h/Image/2012/11/cafe-fd33b.jpg",
			"http://dantri21.vcmedia.vn/zoom/94_79/a4R9SzOKIZ3rZJpaVTug/Image/2012/11/Anh-bien-tap/NSChiTrung-fd0cd-f4f84.jpg",
			"http://dantri21.vcmedia.vn/zoom/130_100/http://dantri4.vcmedia.vn/ugBpMKnpIXHccccccccc/Image/2012/11/deo-ca-2-c6425.JPG",
			"http://dantri21.vcmedia.vn/zoom/130_100/87f1qPhjcalNI3wAqb6p/Image/2012/11/Bien-Dong-22a4a.jpg",
			"http://dantri21.vcmedia.vn/zoom/130_100/elVaF199bomfqIyKul5/Image/2012/11/vn-fac70.jpg",
			"http://dantri21.vcmedia.vn/zoom/130_100/kLmtCyYGgph1lHhk1u5h/Image/2012/11/giaoduc-52c1b.jpg",
			"http://dantri21.vcmedia.vn/zoom/130_100/7dBrKnsutwiOg2hPbvFQ/Image/NAM-2012/THANG-11/Tuan-2/chihao-2-2bb9f.JPG"
	};
	DownloadAdapter adapter;
	private Bitmap bg;
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.testdownload);
	  
	  adapter = new DownloadAdapter();
	  tasks=new ArrayList<TestDownLoadImage.DownloadTask>();
	    setListAdapter(adapter);
	}
	
	class DownloadAdapter extends ArrayAdapter<String>{
		public DownloadAdapter(){
			super(TestDownLoadImage.this, R.layout.testrow, url);
			bg=BitmapFactory.decodeResource(getResources(), R.drawable.bgimage);
			
		}
		 public View getView(int position, View convertView, ViewGroup parent){
			View v=convertView;
		
			
			
			if(v!=null)
			{
				
			}
			else
			{
				LayoutInflater inflate=getLayoutInflater();
				v=inflate.inflate(R.layout.testrow, parent, false);
				ImageView _imageView=(ImageView) v.findViewById(R.id.test_image);
				_imageView.setImageBitmap(bg);
				DownloadTask t = new DownloadTask(_imageView);
				tasks.add(t);
				t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR,url[position]);
			
				
				
			}
			
//			ImageDownload id=urls.get(position);
//			if(!id.isDownloaded())
//			{	System.out.println("chua co anh");
//				//h.populate(bg);
//				DownloadTask t = new DownloadTask(_temp);
//				tasks.add(t);
//				t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR,id);
//			}
			
			
			return v;
		}
	}
	
//	class Holder{
//		private ImageView img;
//		public Holder(View row) {
//			img =(ImageView) row.findViewById(R.id.test_image);
//		}
//		
//		public void populate(Bitmap bm){
//			img.setImageBitmap(bm);
//		}
//		
//		public ImageView getImageView(){
//			return this.img;
//		}
//	}
	
	class DownloadTask extends AsyncTask<String, String, Bitmap>{
		private ImageView img;
		private ImageDownload d;
		private String url;
		public DownloadTask(ImageView img){
			this.img=img;
		}
		@Override
		protected Bitmap doInBackground(String... params) {
			
			Bitmap b=JsonHandler.getBitMapFromNet(params[0]);
			return b;
		}
		
		protected void onPostExecute(Bitmap b){
			
			this.img.setImageBitmap(b);
		}
		
	}
	public void onClick(View v){
		urls.remove(0);
		adapter.notifyDataSetChanged();
	}

	public void onDestroy(){
		
		super.onDestroy();
		for(int i=0;i<tasks.size();i++){
			tasks.get(i).cancel(true);
		}
	}
}
