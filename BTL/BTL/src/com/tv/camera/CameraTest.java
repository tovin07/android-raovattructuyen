package com.tv.camera;



import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Random;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.hardware.Camera;
import android.hardware.Camera.CameraInfo;
import android.os.Bundle;
import android.os.Environment;
import android.view.View;
import android.widget.ImageView;

import com.tv.btl.R;
import com.tv.btl.Ulti;


public class CameraTest extends Activity {
	private PhotoHandler phandler;
	private int camera;
	private boolean back=false;
	private String path;
	private FileOutputStream fo;
	private ImageView img;
	String uri;
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.cameratest);
	    img=(ImageView) findViewById(R.id.cameratest_iv);
	   phandler = new PhotoHandler(this);
	    
	}
	public void onClick(View v){
		  Intent intent = new Intent("android.media.action.IMAGE_CAPTURE");
          startActivityForResult(intent, 1);
		
	}
	
	public void onActivityResult(int requestCode,int resultCode,Intent data){
		if (requestCode == 1 && resultCode == RESULT_OK) {
			Bitmap photo = (Bitmap) data.getExtras().get("data");
			ByteArrayOutputStream bytes = new ByteArrayOutputStream();
			photo.compress(Bitmap.CompressFormat.JPEG, 40, bytes);
			Random randomGenerator = new Random();
			randomGenerator.nextInt();
			File folderContainer = new File(
					Environment
							.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES),
					"RVStore");
			if (!folderContainer.exists()) {
				folderContainer.mkdir();
				
			}
			String path = folderContainer.getAbsolutePath();
			SimpleDateFormat dateFormat = new SimpleDateFormat("yyyymmddhhmmss");
			String date = dateFormat.format(new Date());
			String photoFile = "Raovat" + date + ".jpg";
			
			File f = new File(folderContainer.getAbsoluteFile()+photoFile);
			try {
				f.createNewFile();
			} catch (IOException e) {

				e.printStackTrace();
			}

			try {
				fo = new FileOutputStream(f.getAbsoluteFile());
			} catch (FileNotFoundException e) {

				e.printStackTrace();
			}
			try {
				fo.write(bytes.toByteArray());
				fo.close();
			} catch (IOException e) {

				e.printStackTrace();
			}
			uri = f.getAbsolutePath();
		}
		Bitmap b = BitmapFactory.decodeFile(uri);
		img.setImageBitmap(b);
		Ulti.scaleImage(img, 400);
		CameraTask t = new CameraTask();
		t.execute(uri);

	}
	
	private File getDir() {
	    File sdDir = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
	    File f=new File(sdDir, "RaovatStore");
	    path=f.getPath();
	    return f;
	  }
	
	private void findCamera(){
		int num=Camera.getNumberOfCameras();
		int cameraBack=0,cameraFront=0;
		System.out.println("so camera "+num);
		for(int i=0;i<num;i++){
			CameraInfo info = new CameraInfo();
			Camera.getCameraInfo(i, info);
			if(info.facing==CameraInfo.CAMERA_FACING_FRONT)
			{
				cameraFront=i;
			}
			if(info.facing==CameraInfo.CAMERA_FACING_BACK){
				cameraBack=i;
				back=true;
			}
		}
		camera=back?cameraBack:cameraFront;
		System.out.println(camera);
	}
}
