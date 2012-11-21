package com.tv.view;

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
import android.os.Bundle;
import android.os.Environment;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;

import com.tv.btl.BaseApplication;
import com.tv.btl.R;
import com.tv.btl.Ulti;
import com.tv.camera.CameraTask;
import com.tv.listener.UserListener;
import com.tv.model.User;
import com.tv.task.UserTask;
import com.tv.view.dialog.ChangePassword;

public class Account extends Activity implements UserListener {

	private int camera;
	private boolean back=false;
	private String path;
	private FileOutputStream fo;
	private ImageView img;
	private EditText fullname;
	private EditText email;
	private EditText phone;
	private EditText address;
	private EditText taikhoan;
	private ChangePassword dialog;
	String uri;
	/** Called when the activity is first created. */
	@Override
	public void onCreate(Bundle savedInstanceState) {
	    super.onCreate(savedInstanceState);
	    setContentView(R.layout.account);
	    img=(ImageView) findViewById(R.id.account_avatar);
	    fullname=(EditText) findViewById(R.id.account_fullname);
	    email=(EditText) findViewById(R.id.account_email);
	    phone=(EditText) findViewById(R.id.account_tel);
	    address=(EditText) findViewById(R.id.account_address);
	    taikhoan=(EditText) findViewById(R.id.account_taikhoan);
	    User loadUser = new User();
	    loadUser.setId(((BaseApplication)getApplication()).getID());
	    UserTask t = new UserTask(UserTask.INFO, this);
	    t.execute(loadUser);
	    dialog = new ChangePassword();
	}
	
	public void editInfo(View v){
		
	}
	
	public void editPassword(View v){
		dialog.show(getFragmentManager(), "change password dialog");		
	}
	
	//capture image to up for avatar
	public void upAvatar(View v){
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
		Ulti.scaleImage(img, 350);
		CameraTask t = new CameraTask();
		t.execute(uri);

	}

	public void alertMessage(String message) {
		// TODO Auto-generated method stub
		
	}

	public void registerSubmit(User user) {
		
		
	}

	public void loginComplete() {
		// TODO Auto-generated method stub
		
	}

	public void setUserInfo(User user) {
		fullname.setText(user.getFullname());
		email.setText(user.getEmail());
		address.setText(user.getAddress());
		phone.setText(user.getPhone());
		taikhoan.setText(user.getTaikhoan());
		
	}

	public void getAvatarInfo() {
		
		
	}

}
