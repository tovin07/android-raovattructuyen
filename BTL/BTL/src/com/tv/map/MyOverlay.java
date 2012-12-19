package com.tv.map;

import java.util.ArrayList;

import android.app.AlertDialog;
import android.content.Context;
import android.graphics.drawable.Drawable;
import android.view.MotionEvent;
import android.widget.Toast;

import com.google.android.maps.GeoPoint;
import com.google.android.maps.ItemizedOverlay;
import com.google.android.maps.MapView;
import com.google.android.maps.OverlayItem;

public class MyOverlay extends ItemizedOverlay<OverlayItem> {
	private ArrayList<OverlayItem> mapOverlays = new ArrayList<OverlayItem>();

	private Context context;

	public MyOverlay(Drawable defaultMarker) {
		super(boundCenterBottom(defaultMarker));
	}

	public MyOverlay(Drawable defaultMarker, Context context) {
		this(defaultMarker);
		this.context = context;
	}

	@Override
	protected OverlayItem createItem(int i) {
		return mapOverlays.get(i);
	}

	@Override
	public int size() {
		return mapOverlays.size();
	}

	public void clear(){
		mapOverlays.clear();
	}
	@Override
	protected boolean onTap(int index) {

		return true;
	}

	public void addOverlay(OverlayItem overlay) {
		mapOverlays.add(overlay);
		this.populate();
	}

	public boolean onTouchEvent(MotionEvent event, MapView mapView) {

		if (event.getAction() == 1) {
			GeoPoint geopoint = mapView.getProjection().fromPixels(
					(int) event.getX(), (int) event.getY());
			// latitude
			double lat = geopoint.getLatitudeE6() / 1E6;
			// longitude
			double lon = geopoint.getLongitudeE6() / 1E6;
			Toast.makeText(context, "Lat: " + lat + ", Lon: " + lon,
					Toast.LENGTH_SHORT).show();
		}
		return false;
	}

}
