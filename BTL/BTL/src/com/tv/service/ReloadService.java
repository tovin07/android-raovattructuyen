package com.tv.service;

import android.app.Service;
import android.content.Intent;
import android.os.Binder;
import android.os.IBinder;

public class ReloadService extends Service{
	public String url;
	
	private IBinder binder = new LocalBinder();
	public void setUrl(String url){
		this.url=url;
	}
	
	@Override
	public IBinder onBind(Intent intent) {
		return binder;
	}
	
	public class LocalBinder extends Binder{
		public ReloadService getService(){
			return ReloadService.this;
		}
	}
	
	
	

}
