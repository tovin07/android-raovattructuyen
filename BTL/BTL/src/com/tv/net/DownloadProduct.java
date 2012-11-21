package com.tv.net;

import com.tv.model.Product;

import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.widget.ImageView;

public 	class DownloadProduct extends AsyncTask<String, String, Bitmap>{
	private ImageView img;
	private Product pr;

	public DownloadProduct(ImageView img, Product pr) {
		this.img = img;
		this.pr = pr;
	}

	@Override
	protected Bitmap doInBackground(String... params) {
		Bitmap b = null;
		if (img.getTag().equals(pr.getUrl())) {
			b = JsonHandler.getBitMapFromNet(pr.getUrl());
		}
		return b;

	}

	protected void onPostExecute(Bitmap b) {
		if (img.getTag().equals(pr.getUrl())) {
			this.img.setImageBitmap(b);
			this.pr.setBitmap(b);
			this.pr.setInit(true);
		} else {
			return;
		}
	}

}