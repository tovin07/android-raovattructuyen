package com.tv.view;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Random;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.hardware.Camera;
import android.hardware.Camera.CameraInfo;
import android.os.Bundle;
import android.os.Environment;
import android.view.Gravity;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.btl.Ulti;
import com.tv.camera.CameraTask;
import com.tv.camera.PhotoHandler;
import com.tv.listener.ProductListener;
import com.tv.model.Product;
import com.tv.task.ProductTask;

public class NewPost extends Activity implements ProductListener {
	private PhotoHandler phandler;
	private int camera;
	private boolean back=false;
	private String path;
	private FileOutputStream fo;
	String uri;
	EditText pname = null;
	EditText des = null;
	ImageView pimage = null;

	public void onCreate(Bundle save) {
		super.onCreate(save);
		setContentView(R.layout.post_product);
		pname = (EditText) findViewById(R.id.pp_name);
		des = (EditText) findViewById(R.id.pp_description);
		pimage = (ImageView) findViewById(R.id.pp_image);
		
	}

	public void onTakePhoto(View v){
		  Intent intent = new Intent("android.media.action.IMAGE_CAPTURE");
          startActivityForResult(intent, 1);		
	}
	
	public void onSave(View v) {
		if(uploadAble()){
			Product pr = new Product();
			int uid=((BaseApplication)getApplication()).getID();
			String pr_name =pname.getText().toString();
			String pr_Des= des.getText().toString();
			System.out.println("dess"  +pr_Des);
			pr.setUid(uid);
			pr.setPname(pr_name);
			pr.setDes(pr_Des);
			pr.setPathImage(uri);
			ProductTask t= new ProductTask(ProductTask.NEWPOST, this);
			t.execute(pr);
		}
		else
		{
			System.out.println("aâqqƯ");
			Toast t= Toast.makeText(this, "Kiểm tra lại các trường", Toast.LENGTH_SHORT);
			t.setGravity(Gravity.CENTER, 0, 0);
			t.show();
		}
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
			
			//path folder Image container
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
			Bitmap b = BitmapFactory.decodeFile(uri);
			pimage.setImageBitmap(b);
			Ulti.scaleImage(pimage, 400);
		}
		
//		CameraTask t = new CameraTask();
//		t.execute(uri);

	}
	
	private boolean uploadAble(){
		boolean c=true;
		c=c&&!pname.getText().toString().equals("");
		c=c&&!des.getText().toString().equals("");
		return c;
	}

	public void saveFinish() {
		finish();
	}

	public void reloadFeed() {
		// TODO Auto-generated method stub
		
	}

	public void reload() {
		// TODO Auto-generated method stub
		
	}

	public void reload(List<Product> params) {
		// TODO Auto-generated method stub
		
	}
	
	
}
