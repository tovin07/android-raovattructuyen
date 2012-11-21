package com.tv.view.dialog;

import android.annotation.TargetApi;
import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.DialogInterface;
import android.graphics.Color;
import android.os.Bundle;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.tv.btl.R;
import com.tv.listener.UserListener;
import com.tv.model.User;

@TargetApi(11)
/**
 * Hiển thị dialog đăng ký tài khoản
 * @author misugi_jun91
 *
 */
public class RegisterDialog extends DialogFragment  {
	
	private Button ok;
	private EditText username;
	private EditText password;
	private EditText confirmPassword;
	private EditText fullname;
	private EditText email;
	private EditText phone;
	private EditText taikhoan;
	private EditText address;
	
	
	private UserListener listener;
	public RegisterDialog(UserListener mListener){
		this.listener=mListener;
		
	}
	
	public Dialog onCreateDialog(Bundle savedInstanceState){
		AlertDialog.Builder builder =new AlertDialog.Builder(getActivity());
		LayoutInflater inflate = getActivity().getLayoutInflater();
		View v=inflate.inflate(R.layout.register_user, null);
		username =(EditText) v.findViewById(R.id.tfUsername);
		password=(EditText) v.findViewById(R.id.tfPassword);
		confirmPassword=(EditText) v.findViewById(R.id.tfCPass);
		fullname=(EditText) v.findViewById(R.id.tfName);
		email=(EditText) v.findViewById(R.id.tfEmail);
		phone = (EditText) v.findViewById(R.id.tfPhone);
		taikhoan=(EditText)v.findViewById(R.id.tfTaikhoan);
		address=(EditText)v.findViewById(R.id.tfAddress);
		builder.setView(v).setTitle("Đăng kí tài khoản").setPositiveButton("Hủy",null).setNegativeButton("Đồng ý", null);
		return builder.create();
		
	}
	
	public User getUser(){
		User user= new User();
		user.setUername(username.getText().toString());
		user.setPassword(password.getText().toString());
		user.setFullname(fullname.getText().toString());
		user.setEmail(email.getText().toString());
		user.setAddress(address.getText().toString());
		user.setPhone(phone.getText().toString());
		user.setTaikhoan(taikhoan.getText().toString());
		return user;
	}
	
	public void onResume()
	{
		super.onResume();
		AlertDialog dialog =(AlertDialog)getDialog();
		Button ok=dialog.getButton(AlertDialog.BUTTON_POSITIVE);
		ok.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				RegisterDialog.this.dismiss();
				
			}
		});
		
		Button cancel = dialog.getButton(AlertDialog.BUTTON_NEGATIVE);
		cancel.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				
				String s=username.getText().toString();
				if(checkSubmit()){
					listener.alertMessage("Chưa điền đủ thông tin");
				}
				else{
					if(!checkPasswordConfirm()) {
						password.setTextColor(Color.parseColor("#FF1A00"));
						confirmPassword.setTextColor(Color.parseColor("#FF1A00"));
						listener.alertMessage("Mật khẩu không khớp");
					}
					else{
						password.setTextColor(Color.parseColor("#92B83E"));
						confirmPassword.setTextColor(Color.parseColor("#92B83E"));
						User user=RegisterDialog.this.getUser();
						listener.registerSubmit(user);
					}
				}
				
				
			}
		});
	}
	
	public boolean checkSubmit(){
		boolean c=false;
		c=c||username.getText().toString().equals("");
		c=c||password.getText().toString().equals("");
		c=c||confirmPassword.getText().toString().equals("");
		c=c||fullname.getText().toString().equals("");
		c=c||phone.getText().toString().equals("");
		c=c||taikhoan.getText().toString().equals("");
		c=c||address.getText().toString().equals("");
		return c;
	}
	
	public boolean checkPasswordConfirm(){
		boolean c=false;
		c=password.getText().toString().equals(confirmPassword.getText().toString());
		return c;
	}
	
	/**
	 * Hiển thị thông báo
	 * @param message thông tin để hiển thị
	 */
	

	
}
