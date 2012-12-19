package com.tv.camera;

import java.util.ArrayList;

import org.json.JSONObject;

import com.tv.model.PairValue;
import com.tv.net.JsonHandler;

import android.os.AsyncTask;

public class CameraTask extends AsyncTask<String, String, JSONObject>{
	private String url="http://10.0.2.2:85/raovattructuyen/upload.php";
	@Override
	protected JSONObject doInBackground(String... params) {
		ArrayList<PairValue> value = new ArrayList<PairValue>();
		PairValue p = new PairValue("tungvu", "tungvu");
		value.add(p);
		JSONObject json =JsonHandler.getJsonFromUpload(url, params[0],value);
		return json;
	}
	
	protected void onPostExcute(JSONObject object){
		System.out.println("lay dc json");
	}

}
