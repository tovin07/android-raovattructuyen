package com.tv.listener;

import java.util.List;

import com.tv.model.User;

public interface FollowListener {
	public void checkFollow(int result);
	public void addFollow(int result);
	public void unFollow(int result);
	public void reLoadFollow(List<User> params);
	public void loadMoreFollow(List<User> params);
}
