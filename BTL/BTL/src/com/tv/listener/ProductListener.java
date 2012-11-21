package com.tv.listener;

import java.util.List;

import com.tv.model.Product;

public interface ProductListener {
	public void saveFinish();
	public void reload(List<Product> params);
}
