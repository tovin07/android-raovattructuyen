package com.tv.test;

import android.app.Activity;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.tv.btl.R;

public class HandleActivity extends Activity {

	private ProgressBar bar;
	private Handler handler;
	private int i=0;
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.test_handle);
	    
	    bar=(ProgressBar)findViewById(R.id.progressBar1);
	    handler = new Handler();
	    
	}
	
	public void startProgress(View v){
		Runnable runable = new Runnable() {
			
			public void run() {
			
				while(true){
					if(i<10) i++;
					handler.post(new Runnable() {
					
					public void run() {
						bar.setProgress(i);						
					}
					
				});
					handler.post(new Runnable() {
						
						public void run() {
							Toast.makeText(HandleActivity.this, i+"", Toast.LENGTH_SHORT).show();
							
						}
					});
				try{
					Thread.sleep(1000);
				}
				catch(InterruptedException e){
					e.printStackTrace();
				}
				}
				
			
				
			}
		};
		new Thread(runable).start();
	}

}
