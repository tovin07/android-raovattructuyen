package com.tv.model;

import android.graphics.Bitmap;

public class User {
	private int id;
	private String username;
	private String password;
	private String email;
	private String fullname;
	private String address;
	private String phone;
	private String taikhoan;
	private String linkava;
	private int danhvong;
	private int trangthai;
	private Bitmap avatar;
	private boolean init=false;
	
	public Bitmap getAvatar() {
		return avatar;
	}
	public void setAvatar(Bitmap avatar) {
		this.avatar = avatar;
	}
	public boolean isInit() {
		return init;
	}
	public void setInit(boolean init) {
		this.init = init;
	}
	public int getId() {
		return id;
	}
	public void setId(int id) {
		this.id = id;
	}
	public String getUsername() {
		return username;
	}
	public void setUername(String uername) {
		this.username = uername;
	}
	public String getPassword() {
		return password;
	}
	public void setPassword(String password) {
		this.password = password;
	}
	public String getEmail() {
		return email;
	}
	public void setEmail(String email) {
		this.email = email;
	}
	public String getFullname() {
		return fullname;
	}
	public void setFullname(String fullname) {
		this.fullname = fullname;
	}
	public String getPhone() {
		return phone;
	}
	public void setPhone(String phone) {
		this.phone = phone;
	}
	public String getAddress() {
		return address;
	}
	public void setAddress(String address) {
		this.address = address;
	}
	
	public String getTaikhoan(){
		return this.taikhoan;
	}
	public void setTaikhoan(String taikhoan) {
		this.taikhoan = taikhoan;
	}
	public String getLinkava() {
		return linkava;
	}
	public void setLinkava(String linkava) {
		this.linkava = linkava;
	}
	public int getDanhvong() {
		return danhvong;
	}
	public void setDanhvong(int danhvong) {
		this.danhvong = danhvong;
	}
	public int getTrangthai() {
		return trangthai;
	}
	public void setTrangthai(int trangthai) {
		this.trangthai = trangthai;
	}
	
	
}
