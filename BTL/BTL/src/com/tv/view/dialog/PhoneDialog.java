package com.tv.view.dialog;

import com.tv.btl.R;

import android.app.AlertDialog;
import android.app.Dialog;
import android.app.DialogFragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;

public class PhoneDialog extends DialogFragment{
	TextView phone = null;
	TextView email = null;
	
	public Dialog onCreateDialog(Bundle savedInstanceState){
		AlertDialog.Builder builder =new AlertDialog.Builder(getActivity());
		LayoutInflater inflate = getActivity().getLayoutInflater();
		View v=inflate.inflate(R.layout.tel_mail, null);
		builder.setView(v).setNegativeButton("Ẩn", null);
//		phone = (TextView) v.findViewById(R.id.)
		return builder.create();
		
	}
	
	public void doNegativeClick() {
		dismiss();
	}
}
