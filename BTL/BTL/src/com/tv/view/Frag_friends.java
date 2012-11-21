package com.tv.view;

import com.tv.btl.R;
import com.tv.btl.R.layout;

import android.app.ListFragment;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;
import android.widget.Toast;

public class Frag_friends extends ListFragment {
	public View onCreateView(LayoutInflater inflater, ViewGroup container,
			Bundle savedInstanceState) {
		View FragmentView = inflater.inflate(R.layout.frag_friends, container,
				false);
		return FragmentView;
	}
	
	public void onActivityCreated(Bundle Save) {
		super.onActivityCreated(Save);
		reLoad();
		System.out.println("friend: activty created");
	}

	public void onStart() {
		super.onStart();
		System.out.println("friend: onStart");
	}

	public void onDestroy() {
		super.onDestroy();
		System.out.println("friend: onDestroy");
	}

	public void onPause() {
		super.onPause();
		System.out.println("friend: onPause");
	}

	public void onStop() {
		super.onStop();
		System.out.println("friend: onStop");
	}

	public void reLoad(){
		
	}
}
