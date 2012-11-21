package com.tv.model;

import java.io.File;

import android.graphics.Bitmap;

public class Product {
	private int pid;
	private String pname;
	private String des;
	private int uid;
	private String uname;
	private String pathImage;
	private String url;
	private Bitmap image;
	private String date;
	private String visitcount;
	private Bitmap avatar;
	private boolean init=false;
	
	public int getPid() {
		return pid;
	}
	public void setPid(int pid) {
		this.pid = pid;
	}
	public String getPname() {
		return pname;
	}
	public void setPname(String pname) {
		this.pname = pname;
	}
	public String getDes() {
		return des;
	}
	public void setDes(String des) {
		this.des = des;
	}
	public int getUid() {
		return uid;
	}
	public void setUid(int uid) {
		this.uid = uid;
	}
	public String getUname() {
		return uname;
	}
	public void setUname(String uname) {
		this.uname = uname;
	}
	public String getPathImage() {
		return pathImage;
	}
	public void setPathImage(String pathImage) {
		this.pathImage = pathImage;
	}
	public String getUrl() {
		return url;
	}
	public void setUrl(String url) {
		this.url = url;
	}
	public Bitmap getImage() {
		return image;
	}
	public void setImage(Bitmap image) {
		this.image = image;
	}
	public String getDate() {
		return date;
	}
	public void setDate(String date) {
		this.date = date;
	}
	public String getVisitcount() {
		return visitcount;
	}
	public void setVisitcount(String visitcount) {
		this.visitcount = visitcount;
	}
	
	public Bitmap getBitmap(){
		return this.avatar;
	}
	
	public boolean getInit(){
		return init;
	}
	
	public void setBitmap(Bitmap avatar){
		this.avatar=avatar;
	}
	
	public void setInit(boolean b){
		init=b;
	}

}
