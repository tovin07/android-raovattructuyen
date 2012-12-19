package com.tv.btl;

import android.annotation.TargetApi;
import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.FragmentActivity;
import android.view.Gravity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;
import com.tv.btl.R;
import com.tv.listener.UserListener;
import com.tv.map.GoogleMap;
import com.tv.model.User;
import com.tv.net.UserController;
import com.tv.task.UserTask;
import com.tv.view.HomeView;
import com.tv.view.dialog.RegisterDialog;

public class LoginActivity extends Activity implements UserListener {

	private Button loginOk;
	private Button loginRegister;
	private RegisterDialog dialog;
	private EditText username;
	private EditText password;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.login_acitivity);
		loginOk = (Button) findViewById(R.id.login_ok);
		loginRegister = (Button) findViewById(R.id.login_register);
		dialog = new RegisterDialog(this);
		username = (EditText) findViewById(R.id.login_username);
		password = (EditText) findViewById(R.id.login_password);

	}

	public void onLogin(View v) {
		String user_username = username.getText().toString();
		String user_password = password.getText().toString();
		User u = new User();
		u.setUername(user_username);
		u.setPassword(user_password);
		UserTask t = new UserTask(UserTask.LOGIN, this);
		t.execute(u);
	}

	public void onRegister(View v) {
		dialog.show(getFragmentManager(), "register dialog");
	}

	public void registerSubmit(User user) {
		UserTask t = new UserTask(UserTask.REGISTER, this);
		t.execute(user);

	}

	public void alertMessage(String message) {
		Toast noti = Toast.makeText(this, message, Toast.LENGTH_SHORT);
		noti.setGravity(Gravity.CENTER, 0, 0);
		noti.show();

	}

	public void loginComplete() {
		System.out.println("dau xanh rau ma");
		Intent t = new Intent(this, HomeView.class);
		startActivity(t);


	}

	public void getUserInfo() {
		
		
	}

	public void getAvatarInfo() {
		
		
	}

	public void setUserInfo(User user) {
		// TODO Auto-generated method stub
		
	}

	public void viewInfo(User user) {
		// TODO Auto-generated method stub
		
	}
	
	public void testMap(View view){
		Intent t = new Intent(this,GoogleMap.class);
		startActivity(t);
	}
}
