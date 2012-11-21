package com.tv.camera;

import android.annotation.TargetApi;
import android.app.ActionBar;
import android.app.ActionBar.Tab;
import android.app.Activity;
import android.app.Fragment;
import android.app.FragmentTransaction;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.Window;
import android.widget.Toast;

import com.tv.btl.R;
import com.tv.view.Frag_feed;
import com.tv.view.Frag_friends;
import com.tv.view.Frag_mypage;

@TargetApi(14)
public class TestFragment extends Activity {
	private Frag_feed fragFeed;
	private Frag_friends fragFriends;
	private Frag_mypage fragMypage;
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_ACTION_BAR);
		setContentView(R.layout.layout_home);

		final ActionBar actionBar = getActionBar();
		actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_TABS);
		actionBar.setLogo(R.drawable.ic_newpost);
		actionBar.setHomeButtonEnabled(true);
//		actionBar.setDisplayHomeAsUpEnabled(true);
		
		fragFeed= new Frag_feed();
		fragFriends=new Frag_friends();
		fragMypage=new Frag_mypage();
		
		Tab tab_mypage = actionBar.newTab();
		tab_mypage.setText("My page");
		tab_mypage.setTabListener(new TabListner(fragMypage,1));
		actionBar.addTab(tab_mypage);
		
		Tab tab_myfirend = actionBar.newTab();
		tab_myfirend.setText("My Friend");
		tab_myfirend.setTabListener(new TabListner(fragFriends,2));
		actionBar.addTab(tab_myfirend);
		
		Tab tab_myfeed = actionBar.newTab();
		tab_myfeed.setText("My Feed");
		tab_myfeed.setTabListener(new TabListner(fragFeed,3));
		actionBar.addTab(tab_myfeed);
		if (savedInstanceState != null) {
			int savedIndex = savedInstanceState.getInt("SAVED_INDEX");
			getActionBar().setSelectedNavigationItem(savedIndex);
		}
		

	}

	 class TabListner implements ActionBar.TabListener
	 {
		 private Fragment fragment;
		 private int id;
		 public TabListner(Fragment ft,int id){
			 this.fragment=ft;
			 this.id=id;
		 }
		public void onTabReselected(Tab tab, FragmentTransaction ft) {
			System.out.println("aaa");
			
		}

		public void onTabSelected(Tab tab, FragmentTransaction ft) {
			ft.replace(R.id.home_container, fragment, "");
		}

		public void onTabUnselected(Tab tab, FragmentTransaction ft) {
			
			
		}
		 
	 }
	protected void onSaveInstanceState(Bundle outState) {
		super.onSaveInstanceState(outState);
		outState.putInt("SAVED_INDEX", getActionBar()
				.getSelectedNavigationIndex());
	}
	
	public boolean onCreateOptionsMenu(Menu menu) {
		// getMenuInflater().inflate(R.menu.layout_main, menu);
		getMenuInflater().inflate(R.menu.home_option, menu);
		return true;
	}
	
	public boolean onOptionsItemSelected(MenuItem item){
		int c = item.getItemId();
		switch (c){
		case android.R.id.home: 
			Toast.makeText(this, "test thoi", Toast.LENGTH_SHORT).show();
			return true;
		case R.id.home_option_post :
			return true;
		case R.id.home_option_acc :
			return true;
		case R.id.home_option_about :
			return true;
		}
		return (super.onOptionsItemSelected(item));		
	}
	
	public void onClick(View v){
	}
	
	
}
