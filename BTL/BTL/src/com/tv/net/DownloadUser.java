package com.tv.net;

import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.widget.ImageView;

import com.tv.model.User;

public 	class DownloadUser extends AsyncTask<String, String, Bitmap>{
	private ImageView img;
	private User user;

	public DownloadUser(ImageView img, User user) {
		this.img = img;
		this.user = user;
	}

	@Override
	protected Bitmap doInBackground(String... params) {
		Bitmap b = null;
		if (img.getTag().equals(user.getLinkava())) {
			b = JsonHandler.getBitMapFromNet(user.getLinkava());
		}
		return b;

	}

	protected void onPostExecute(Bitmap b) {
		if (img.getTag().equals(user.getLinkava())) {
			this.img.setImageBitmap(b);
			this.user.setAvatar(b);
			this.user.setInit(true);
		} else {
			return;
		}
	}

}
