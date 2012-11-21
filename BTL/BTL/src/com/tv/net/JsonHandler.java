package com.tv.net;

import java.io.BufferedReader;
import java.io.File;
import java.io.FilterInputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.UnsupportedEncodingException;
import java.util.ArrayList;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.client.utils.URLEncodedUtils;
import org.apache.http.entity.mime.FormBodyPart;
import org.apache.http.entity.mime.HttpMultipartMode;
import org.apache.http.entity.mime.MultipartEntity;
import org.apache.http.entity.mime.content.ContentBody;
import org.apache.http.entity.mime.content.FileBody;
import org.apache.http.entity.mime.content.StringBody;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.json.JSONException;
import org.json.JSONObject;

import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.hardware.Camera.Size;
import android.util.Log;

public class JsonHandler {
	public JsonHandler() {

	}
	
	/**
	 * Lấy dữ liệu trên web thông qua post.Bao gồm 1 Defaulthttp Client ,HttpPost, httpRespone và inputstream
	 * @param url : url
	 * @param params ?t=...&a=... thông qua List<NameValuePair>
	 * @return JSonObjet
	 * 
	 */
	public static JSONObject getJsonFromUrlByPost(String url,
		List<NameValuePair> params) {
		InputStream is = null;
		String json = null;
		JSONObject jObject = null;
		System.out.println("url" +url);
		// tao http request
		try {
			// defaultHttpCLient
			DefaultHttpClient httpClient = new DefaultHttpClient();
			HttpPost httpPost = new HttpPost(url);
		
			
			
		String temp =URLEncodedUtils.format(params, "utf-8");
		
			httpPost.setEntity(new UrlEncodedFormEntity(params,HTTP.UTF_8));
			//httpPost.setHeader("Accept","text/html");
		
			System.out.println(EntityUtils.toString(httpPost.getEntity())+"checkloi");
			HttpResponse httpResponse = httpClient.execute(httpPost);
			HttpEntity httpEntity = httpResponse.getEntity();
			is = httpEntity.getContent();
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				System.out.println(line);
				sb.append(line + "n");
			}
			is.close();
			reader.close();
			json = sb.toString();
		}

		catch (Exception e) {
			Log.e("error tai day", e.toString());

		}
		// parse object to json
		try {
			jObject = new JSONObject(json);

		} catch (JSONException e) {
			Log.e("JSon error", e.toString());
		}
		return jObject;

	}

	/**
	 * Lấy dữ liệu trên web thông qua phương thức get.Khác với by post là httpGet không setEntry
	 * nên phải dùng URLEncodeUlti để encode List<NameValuePair>
	 * @param url 
	 * @param params truyền tham số qua List<NameValuePair>
	 * @return
	 */
	public static JSONObject getJsonFromUrlByGet(String url,
			List<NameValuePair> params) {
		InputStream is = null;
		String json = null;
		JSONObject jObject = null;
		try {
			DefaultHttpClient httpClient = new DefaultHttpClient();
			if (params != null) {
				String urlParams = URLEncodedUtils.format(params, "utf-8");
				url = url + urlParams;
			}
			System.out.println("1"+url);
			HttpGet httpGet = new HttpGet(url);
			HttpResponse httpResponse = httpClient.execute(httpGet);
			HttpEntity httpEntity = httpResponse.getEntity();
			is = httpEntity.getContent();
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "n");
			
			}
			is.close();
			reader.close();
			json = sb.toString();
		} catch (Exception e) {
			Log.e("error", e.toString());

		}
		// parse object to json
		try {
			jObject = new JSONObject(json);

		} catch (JSONException e) {
			Log.e("JSon error", e.toString());
		}
		return jObject;
	}
	
	public static JSONObject getJsonFromUpload(String url,String path,ArrayList<PairValue> value){
		InputStream is = null;
		String json = null;
		JSONObject jObject = null;
		System.out.println("url" +url);
		// tao http request
		try {
			File f=null;
			// defaultHttpCLient
			DefaultHttpClient httpClient = new DefaultHttpClient();
			HttpPost httpPost = new HttpPost(url);
			//FileEntity 
			MultipartEntity entity = new MultipartEntity(HttpMultipartMode.BROWSER_COMPATIBLE);
			if(!path.equals(""))
			f =new File(path);
			else
			{
				f=new File("");
			}
			FileBody fileBody = new FileBody(f);
			
			entity.addPart("file",fileBody);
			httpPost.setEntity(entity);
			System.out.println("ttttt");
			if(value!=null && value.size()!=0){
				for(int i=0;i<value.size();i++){
					System.out.println("xxx " +value.get(i).getName()+value.get(i).getValue());
				PairValue p=value.get(i);
				FormBodyPart part = new FormBodyPart(p.getName(), new StringBody(p.getValue()));
				entity.addPart(part);
				}
			}
//			FormBodyPart part = new FormBodyPart("ppp", new StringBody("111"));
//			entity.addPart(part);
			
		
			//System.out.println(EntityUtils.toString(httpPost.getEntity())+"checkloi");
			HttpResponse httpResponse = httpClient.execute(httpPost);
			HttpEntity httpEntity = httpResponse.getEntity();
			is = httpEntity.getContent();
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				System.out.println(line);
				sb.append(line + "n");
			}
			is.close();
			reader.close();
			json = sb.toString();
		}

		catch (Exception e) {
			Log.e("error tai day", e.toString());

		}
		// parse object to json
		try {
			jObject = new JSONObject(json);

		} catch (JSONException e) {
			Log.e("JSon error", e.toString());
		}
		return jObject;
	}
	
	public static Bitmap getBitMapFromNet(String url){
		Bitmap bm = null;
		InputStream is=null;
		try {
			DefaultHttpClient httpClient = new DefaultHttpClient();
			System.out.println(url);
			HttpGet httpGet = new HttpGet(url);
			HttpResponse httpRespone = httpClient.execute(httpGet);
			HttpEntity entity=httpRespone.getEntity();
			try{
			is=entity.getContent();
			bm=BitmapFactory.decodeStream(is);
			System.out.println("thanh cong");
			}
			finally{
				if(is!=null)
					is.close();
			}
		} catch (UnsupportedEncodingException e) {
			e.printStackTrace();
		} catch (ClientProtocolException e) {
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}
		 return bm;
		
	}
	
	
	static class FlushedInputStream extends FilterInputStream {
        public FlushedInputStream(InputStream inputStream) {
            super(inputStream);
        }

        @Override
        public long skip(long n) throws IOException {
            long totalBytesSkipped = 0L;
            while (totalBytesSkipped < n) {
                long bytesSkipped = in.skip(n-totalBytesSkipped);
                if (bytesSkipped == 0L) break;
                totalBytesSkipped += bytesSkipped;
            }
            return totalBytesSkipped;
        }
    }
	
	

}
