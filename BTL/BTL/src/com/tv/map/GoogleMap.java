package com.tv.map;


import com.google.android.maps.GeoPoint;
import com.google.android.maps.MapActivity;
import com.google.android.maps.MapController;
import com.google.android.maps.MapView;
import com.google.android.maps.MyLocationOverlay;
import com.google.android.maps.OverlayItem;
import com.tv.btl.R;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.graphics.drawable.Drawable;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Bundle;

public class GoogleMap extends MapActivity {
	
	private MapController mapController;
	  private MapView mapView;
	  private LocationManager locationManager;
	  private MyOverlay itemizedoverlay;
	  private MyLocationOverlay myLocationOverlay;
	  private double lon;
	  private double lat;

	  public void onCreate(Bundle bundle) {
	    super.onCreate(bundle);
	    setContentView(R.layout.googlemap); 
	    Intent i=getIntent();
	    lon=i.getDoubleExtra("lon", 0);
	    lat=i.getDoubleExtra("lat", 0);
	    // Configure the Map
	    mapView = (MapView) findViewById(R.id.google_map);
	    mapView.setBuiltInZoomControls(true);
	    mapView.setStreetView(true);
	    mapController = mapView.getController();
	    mapController.setZoom(14); // Zoon 1 is world view
//	    locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
//	    locationManager.requestLocationUpdates(LocationManager.GPS_PROVIDER, 0,
//	        0, new GeoUpdateHandler());

	    myLocationOverlay = new MyLocationOverlay(this, mapView);
	    mapView.getOverlays().add(myLocationOverlay);
	    
//	    myLocationOverlay.runOnFirstFix(new Runnable() {
//	      public void run() {
//	        mapView.getController().animateTo(myLocationOverlay.getMyLocation());
//	      }
//	    });

	    Drawable drawable = this.getResources().getDrawable(R.drawable.marker);
	    itemizedoverlay = new MyOverlay( drawable,this);
	    GeoPoint geoPoint = new GeoPoint((int)(lat * 1E6), (int)(lon * 1E6));
	    createMarker(geoPoint);
	    mapController.animateTo(geoPoint);
	  }

	
	  protected boolean isRouteDisplayed() {
	    return false;
	  }

//	  public class GeoUpdateHandler implements LocationListener {
//
//	   
//	    public void onLocationChanged(Location location) {
//	      int lat = (int) (location.getLatitude() * 1E6);
//	      int lng = (int) (location.getLongitude() * 1E6);
//	      GeoPoint point = new GeoPoint(lat, lng);
//	     // createMarker();
//	      mapController.animateTo(point); // mapController.setCenter(point);
//
//	    }
//
//	  
//	    public void onProviderDisabled(String provider) {
//	    }
//
//	   
//	    public void onProviderEnabled(String provider) {
//	    }
//
//	    
//	    public void onStatusChanged(String provider, int status, Bundle extras) {
//	    }
//	  }

	  private void createMarker(GeoPoint p) {
	   // GeoPoint p = mapView.getMapCenter();
	    OverlayItem overlayitem = new OverlayItem(p, "test", "test");
	    itemizedoverlay.addOverlay(overlayitem);
	    if (itemizedoverlay.size() > 0) {
	    	System.out.println("aaaa");
	      mapView.getOverlays().add(itemizedoverlay);
	    }
	  }

	  @Override
	  protected void onResume() {
	    super.onResume();
	    myLocationOverlay.enableMyLocation();
	    myLocationOverlay.enableCompass();
	  }

	  @Override
	  protected void onPause() {
	    super.onPause();
	    myLocationOverlay.disableMyLocation();
	    myLocationOverlay.disableCompass();
	  }
	} 
