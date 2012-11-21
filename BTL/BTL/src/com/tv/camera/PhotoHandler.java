package com.tv.camera;

import java.io.File;
import java.io.FileOutputStream;
import java.text.SimpleDateFormat;
import java.util.Date;

import com.tv.btl.BaseApplication;

import android.app.Activity;
import android.content.Context;
import android.hardware.Camera;
import android.hardware.Camera.PictureCallback;
import android.os.Environment;
import android.text.format.DateFormat;

public class PhotoHandler implements PictureCallback{
	private Context context;
	private String path;
	public PhotoHandler(Context context){
		this.context=context;
	}
	public void onPictureTaken(byte[] data, Camera camera) {
		 File pictureFileDir =getDir();
		 SimpleDateFormat dateFormat= new SimpleDateFormat("yyyymmddhhmmss");
		 String date=dateFormat.format(new Date());
		 String photoFile="Raovat"+date+".jpg";
		 String filename=path+File.separator+photoFile;
		 File pictureFile = new File(filename);
		 try{
			 FileOutputStream fos = new FileOutputStream(pictureFile);
			 fos.write(data);
			 fos.close();
			 System.out.println("new image saved"+photoFile);
		 }
		 catch(Exception error){
			 System.out.println(error);
			 System.err.println("can't save image");
		 }
	}
	
	private File getDir() {
	    File sdDir = Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_PICTURES);
	    File f=new File(sdDir, "RaovatStore");
	    path=f.getPath();
	    return f;
	  }

}
