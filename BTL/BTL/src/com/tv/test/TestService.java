package com.tv.test;

import java.net.MalformedURLException;
import java.net.URL;

import android.app.Service;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.IBinder;
import android.widget.Toast;

public class TestService extends Service{
	private int i=0;
	@Override
	public IBinder onBind(Intent intent) {
		
		return null;
		}
	
	public int onStartCommand(Intent intent, int flags, int startId){
		Toast.makeText(this, "Service Started", Toast.LENGTH_SHORT).show();
		Runnable test = new Runnable() {
			
			public void run() {
				while(true){
					new Task().execute(1,2,3,4,5);
					try{
						Thread.sleep(2000);
					}
					catch(InterruptedException e){
						e.getStackTrace();
					}
				}
				
			}
		};
		new Thread(test).start();
			
	
		return START_STICKY;
	}
	
	private int downloadFile(int i){
		System.out.println(i);
		try{
			Thread.sleep(10000);
		}
		catch(InterruptedException e){
			e.printStackTrace();
		}
		return i*100;
	}

		public void onCreate(){
			super.onCreate();
			
			System.out.println("onCreate");
		}
		
		public void onStart(Intent intent, int startId){
			super.onStart(intent, startId);
			System.out.println("calling by"+startId);
			
		}
		
		public void onDestroy(){
			super.onDestroy();
			System.out.println("myservice destroy");
		}

		private class Task extends AsyncTask<Integer, Integer, Long>{

			@Override
			protected Long doInBackground(Integer... params) {
				for(int i=0;i<params.length;i++){
					downloadFile(i);
				}
				return 100L;
			}
			
//			protected void onProgressUpdate(Integer... progress){
//				for(int i=0;i<5;i++){
//					Toast.makeText(TestService.this, progress[i]+"", Toast.LENGTH_SHORT).show();
//				}
//			}
			
			protected void onPostExecute(Long result){
				Toast.makeText(TestService.this, result+"", Toast.LENGTH_SHORT).show();
			}
			
		}
}
