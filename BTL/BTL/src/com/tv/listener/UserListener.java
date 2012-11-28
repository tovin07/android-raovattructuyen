package com.tv.listener;

import com.tv.model.User;

public interface UserListener {
	public void alertMessage(String message);
	public void registerSubmit(User user);
	public void loginComplete();
	public void setUserInfo(User user);
	public void getAvatarInfo();
	public void viewInfo(User user);
}
