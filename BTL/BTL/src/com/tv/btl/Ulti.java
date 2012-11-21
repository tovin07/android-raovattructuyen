package com.tv.btl;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.text.SimpleDateFormat;
import java.util.Date;

import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Matrix;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.os.Environment;
import android.widget.ImageView;
import android.widget.LinearLayout;

public class Ulti {
	/**
	 * Phóng ảnh tương ứng với iamgeview
	 * @param imageview :Imageview truyền vào
	 * @param dophong : độ cần tăng
	 */
	public static void scaleImage(ImageView imageview, int dophong){
		Drawable drawing =imageview.getDrawable();
		Bitmap bitmap=((BitmapDrawable)drawing).getBitmap();
		int width=bitmap.getWidth();
		System.out.println("width image : " +width);
		int height=bitmap.getHeight();
		System.out.println("height image : "+height);
		float xScale=((float)dophong)/width;
		float yScale=((float)dophong)/height;
		float scale=(xScale<=yScale)?xScale:yScale;
		Matrix matrix = new Matrix();
		matrix.postScale(scale, scale);
		Bitmap scaledBitmap= Bitmap.createBitmap(bitmap,0,0,width,height,matrix,true);
		BitmapDrawable result = new BitmapDrawable(scaledBitmap);
		width=scaledBitmap.getWidth();
		height=scaledBitmap.getHeight();
		imageview.setImageDrawable(result);
		
		LinearLayout.LayoutParams params = (LinearLayout.LayoutParams) imageview.getLayoutParams();
		params.width=width;
		params.height=height;
		imageview.setLayoutParams(params);
		
	}
	
	
}
