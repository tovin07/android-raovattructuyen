package com.tv.test;

import com.tv.btl.R;
import com.tv.btl.R.layout;

import android.app.Activity;
import android.content.ComponentName;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Toast;

public class TestServiceAcitivity2 extends Activity {
	Intent serviceIntent;
	ComponentName service;
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.test_service);
	    serviceIntent = new Intent(this,TestService.class);
	}
	
	public void startService(View v){
		service=startService(serviceIntent);
		Toast.makeText(this, service.getClassName()+"started", Toast.LENGTH_LONG).show();
	}
	
	
	public void stopService(View v){
		stopService(serviceIntent);
		Toast.makeText(this, service.getClassName()+"stop", Toast.LENGTH_LONG).show();
		
	}
	
	public void callIntent(View v){
		
	}

}
