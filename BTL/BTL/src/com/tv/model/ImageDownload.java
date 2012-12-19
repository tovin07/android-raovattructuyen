package com.tv.model;

import android.graphics.Bitmap;

public class ImageDownload {
	private String url;
	private boolean downloaded=false;
	private Bitmap image;
	public String getUrl() {
		return url;
	}
	
	public void setUrl(String url) {
		this.url = url;
	}
	public boolean isDownloaded() {
		return downloaded;
	}
	public void setDownloaded(boolean downloaded) {
		this.downloaded = downloaded;
	}
	public Bitmap getImage() {
		return image;
	}
	public void setImage(Bitmap image) {
		this.image = image;
	}
	
	
	
	
}
