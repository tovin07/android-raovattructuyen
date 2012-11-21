package com.tv.view.dialog;

import com.tv.btl.R;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.EditText;

public class ChangePassword extends DialogFragment{
	
	public Dialog onCreateDialog(Bundle savedInstanceState){
		AlertDialog.Builder builder =new AlertDialog.Builder(getActivity());
		LayoutInflater inflate = getActivity().getLayoutInflater();
		View v=inflate.inflate(R.layout.change_pass, null);
		builder.setView(v).setTitle("Thay đổi mật khẩu").setPositiveButton("Hủy",null).setNegativeButton("Đồng ý", null);
		return builder.create();
		
	}

}
