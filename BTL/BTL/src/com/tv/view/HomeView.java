package com.tv.view;

import android.annotation.TargetApi;
import android.app.ActionBar;
import android.app.ActionBar.Tab;
import android.app.Activity;
import android.app.Fragment;
import android.app.FragmentTransaction;
import android.content.Intent;
import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;
import android.view.Window;
import android.widget.Toast;

import com.tv.btl.R;
import com.tv.listener.FragListener;

@TargetApi(14)
public class HomeView extends Activity {
	 Fragment globalFragment;
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_ACTION_BAR);
		setContentView(R.layout.layout_home);

		final ActionBar actionBar = getActionBar();
		actionBar.setNavigationMode(ActionBar.NAVIGATION_MODE_TABS);
		actionBar.setLogo(R.drawable.ic_newpost);
		actionBar.setHomeButtonEnabled(true);

		Tab tab_mypage = actionBar.newTab();
		tab_mypage.setText("Trang chủ");
		tab_mypage.setTabListener(new TabListener<Frag_mypage>(this, "Tag mypage",
				Frag_mypage.class));
		actionBar.addTab(tab_mypage);
		
		Tab tab_friends = actionBar.newTab();
		tab_friends.setText("Theo dõi");
		tab_friends.setTabListener(new TabListener<Frag_friends>(this, "Tag friend",
				Frag_friends.class));
		actionBar.addTab(tab_friends);
		
		Tab tab_feed = actionBar.newTab();
		tab_feed.setText("Hệ thống");
		tab_feed.setTabListener(new TabListener<Frag_feed>(this, "Tag feed",
				Frag_feed.class));
		actionBar.addTab(tab_feed);
		
		if (savedInstanceState != null) {
			int savedIndex = savedInstanceState.getInt("SAVED_INDEX");
			getActionBar().setSelectedNavigationItem(savedIndex);
		}

	}

	protected void onSaveInstanceState(Bundle outState) {
		super.onSaveInstanceState(outState);
		outState.putInt("SAVED_INDEX", getActionBar()
				.getSelectedNavigationIndex());
	}
	
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.home_option, menu);
		return true;
	}
	
	public boolean onOptionsItemSelected(MenuItem item){
		int c = item.getItemId();
		switch (c){
		case android.R.id.home: 
			Toast.makeText(this, "test thoi", Toast.LENGTH_SHORT).show();
			Intent y = new Intent(this, NewPost.class);
			startActivity(y);
			return true;
		case R.id.home_option_account :
			Toast.makeText(this, "aaa", Toast.LENGTH_SHORT).show();
			Intent i= new Intent(this, Account.class);
			startActivity(i);
			return true;
		case R.id.home_option_refresh:
			if(globalFragment instanceof Frag_feed){
				System.out.println("aaa");
				((Frag_feed) globalFragment).init();
			}
			else if(globalFragment instanceof Frag_mypage)
			{
				((Frag_mypage) globalFragment).init();
			}
			else if(globalFragment instanceof Frag_friends){
				((Frag_friends) globalFragment).init();
			}
			return true;
		}
		
			
		return (super.onOptionsItemSelected(item));		
	}
	
	public  class TabListener<T extends Fragment> implements
			ActionBar.TabListener {

		Fragment myFragment = null;
		private final Activity myActivity;
		private final String myTag;
		private final Class<T> myClass;

		public TabListener(Activity activity, String tag, Class<T> cls) {
			myActivity = activity;
			myTag = tag;
			myClass = cls;
		}

		public void onTabSelected(Tab tab, FragmentTransaction ft) {

			myFragment = myActivity.getFragmentManager()
					.findFragmentByTag(myTag);

			// Check if the fragment is already initialized
			if (myFragment == null) {
				// If not, instantiate and add it to the activity
				myFragment = Fragment
						.instantiate(myActivity, myClass.getName());
				ft.add(android.R.id.content, myFragment, myTag);
			} else {
				// If it exists, simply attach it in order to show it
				ft.attach(myFragment);
			}
			globalFragment=myFragment;
			
		}

		public void onTabUnselected(Tab tab, FragmentTransaction ft) {

			Fragment myFragment = myActivity.getFragmentManager()
					.findFragmentByTag(myTag);

			if (myFragment != null) {
				// Detach the fragment, because another one is being attached
				ft.detach(myFragment);
			}
			

		}

		public void onTabReselected(Tab tab, FragmentTransaction ft) {
			

		}

	}
}
