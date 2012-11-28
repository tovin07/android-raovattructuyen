package com.tv.btl;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;

import com.tv.camera.CameraTest;
import com.tv.camera.TestFragment;
import com.tv.downloadimage.TestDownLoadImage;

public class MainActivity extends Activity {

	
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
    
    public void onMainScreen(View v){
    	Intent i = new Intent(this,LoginActivity.class);
    	startActivity(i);  
    }
    
    public void onTest(View v){
    	 Intent i = new Intent(this,CameraTest.class);
         startActivity(i);    
    }
    
    public void onFragment(View v){
    	Intent i = new Intent(this,TestDownLoadImage.class);
    	startActivity(i);
    }

    
}
