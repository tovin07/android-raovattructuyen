package com.tv.net;

import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.widget.ImageView;

public 	class DownloadImage extends AsyncTask<String, String, Bitmap>{
	private ImageView img;
	
	public DownloadImage(ImageView img){
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
