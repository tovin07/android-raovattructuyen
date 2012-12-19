package com.tv.view.dialog;

import com.tv.btl.R;
import com.tv.listener.UserListener;
import com.tv.map.GoogleMap;
import com.tv.model.User;
import com.tv.task.UserTask;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class Contact extends DialogFragment implements UserListener{
	private TextView contact_fullname;
	private TextView contact_taikhoan;
	private TextView contact_phone;
	private TextView contact_adrress;
	private Button vmap;
	private User user;
	private int uid;
	private double lon;
	private double lat;
	private Context context;
	public Contact(int uid){
		this.uid=uid;
	}
	public void setUser(User u){
		user=u;
	}
	public void setLongLat(double lon,double lat,Context context){
		this.lon=lon;
		this.lat=lat;
		this.context=context;
	}
	
	public double getLon(){
		return this.lon;
	}
	public Dialog onCreateDialog(Bundle savedInstanceState){
		AlertDialog.Builder builder =new AlertDialog.Builder(getActivity());
		LayoutInflater inflate = getActivity().getLayoutInflater();
		View v=inflate.inflate(R.layout.contact, null);
		contact_fullname=(TextView) v.findViewById(R.id.contact_fullname);
		contact_adrress=(TextView) v.findViewById(R.id.contact_address);
		contact_phone=(TextView) v.findViewById(R.id.contact_phone);
		contact_taikhoan=(TextView) v.findViewById(R.id.contact_taikhoan);
		vmap=(Button) v.findViewById(R.id.contact_viewadd);
		builder.setView(v).setTitle("Thông tin người bán");
		System.out.println("lonnnn"+this.getLon());
		return builder.create();
	}
	
	public void onResume(){
		super.onResume();
		System.out.println("id"+this.uid);
		if(user==null){
			User s= new User();
			s.setId(uid);
			UserTask t = new UserTask(UserTask.VIEW_INFO, this);
			t.executeOnExecutor(AsyncTask.THREAD_POOL_EXECUTOR, s);
		}
		else
		{
			setInfo();
		}
		vmap.setOnClickListener(new View.OnClickListener() {
			
			public void onClick(View v) {
				Intent intent = new Intent(context,GoogleMap.class);
				intent.putExtra("lon", lon);
				intent.putExtra("lat", lat);
				startActivity(intent);
			}
		});
	}
	
	
	public void alertMessage(String message) {
		// TODO Auto-generated method stub
		
	}
	public void registerSubmit(User user) {
		// TODO Auto-generated method stub
		
	}
	public void loginComplete() {
		// TODO Auto-generated method stub
		
	}
	public void setUserInfo(User user) {
		// TODO Auto-generated method stub
		
	}
	public void getAvatarInfo() {
		// TODO Auto-generated method stub
		
	}
	public void viewInfo(User user) {
		this.user=user;
		//contact_fullname.setText("Tên đầy đủ : "+user.getUsername());
		contact_adrress.setText("Địa chỉ : "+user.getAddress());
		contact_phone.setText("Số Điện Thoại : "+user.getPhone());
		contact_taikhoan.setText("Tài khoản : "+user.getTaikhoan());
		
	}
	
	public void setInfo(){
		//contact_fullname.setText("Tên đầy đủ : "+user.getUsername());
		contact_adrress.setText("Địa chỉ : "+user.getAddress());
		contact_phone.setText("Số Điện Thoại : "+user.getPhone());
		contact_taikhoan.setText("Tài khoản : "+user.getTaikhoan());
	}
}
