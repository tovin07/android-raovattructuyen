package com.tv.btl;

import android.app.Application;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;

public class BaseApplication extends Application{
	private int ID;
	private int feed_c_id;
	private int friend_c_id;
	private String username;
	private int feed_page=1;
	private int page_page=1;
	private int page_friend=1;
	private int view_page=1;
	public int getPage_page() {
		return page_page;
	}

	public void setPage_page(int page_page) {
		this.page_page = page_page;
	}

	private String urlAvatar;
	private int  maxFeed=0;
	private int maxPage=0;
	private int maxFriend=0;
	private int maxViewFriend=0;
	public int getPage_friend() {
		return page_friend;
	}

	public void setPage_friend(int page_friend) {
		this.page_friend = page_friend;
	}

	public int getView_page() {
		return view_page;
	}

	public void setView_page(int view_page) {
		this.view_page = view_page;
	}

	public int getMaxFriend() {
		return maxFriend;
	}

	public void setMaxFriend(int maxFriend) {
		this.maxFriend = maxFriend;
	}

	public int getMaxViewFriend() {
		return maxViewFriend;
	}

	public void setMaxViewFriend(int maxViewFriend) {
		this.maxViewFriend = maxViewFriend;
	}

	public int getMaxFeed() {
		return maxFeed;
	}

	public void setMaxFeed(int maxFeed) {
		this.maxFeed = maxFeed;
	}

	public int getMaxPage() {
		return maxPage;
	}

	public void setMaxPage(int maxPage) {
		this.maxPage = maxPage;
	}

	//change avatar -- save Avatar
	private Bitmap avatar;
	
	public void onCreate(){
		Bitmap image = BitmapFactory.decodeResource(getResources(), R.drawable.noavatar);
		avatar =image;
		ID=-1;
		feed_c_id=-1;
		friend_c_id=-1;
		super.onCreate();
	}
	
	public void setID(int _id){
		ID=_id;
	}
	
	public int getID(){
		return ID;
	}
	
	public void setFeedCId(int _feedid){
		feed_c_id = _feedid;
	}
	
	public int getFeedCId(){
		return feed_c_id;
	}
	
	public void setFriendCId(int _friendid){
		feed_c_id = _friendid;
	}
	
	public int getFriendCId(){
		return friend_c_id;
	}
	
	public void setAvatar(String url){
		
	}
	
	public Bitmap getAvatar(){
		return this.avatar;
	}
	
	public String getUsername(){
		return this.username;
	}
	
	public void setUsername(String username){
		this.username=username;
	}
	
	public void setFeedPage(int page){
		this.feed_page=page;
	}
	
	public int getFeedPage(){
		return this.feed_page;
	}

	public String getUrlAvatar() {
		return urlAvatar;
	}

	public void setUrlAvatar(String urlAvatar) {
		this.urlAvatar = urlAvatar;
	}
	
	
	
}
