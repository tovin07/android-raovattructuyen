package com.tv.listener;

import java.util.List;

import com.tv.model.Comment;

public interface CommentListener {
	public void reload(List<Comment> params);
	public void saveComment();
}
