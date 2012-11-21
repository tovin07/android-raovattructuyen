package com.tv.net;

public class ServerConfig {
	public static final String DOMAIN = "http://10.0.2.2:85/raovattructuyen/";
	
/**
 * 	product url controller
 */
	public static final String NEW_PRODUCT = DOMAIN+"?t=product&a=newProduct&";
	public static final String FEED=DOMAIN+"?t=product&a=getfeed";
	public static final String MY_PAGE = DOMAIN+"?t=product&a=getpage&";
	
/**
 * 	user url controller	
 */
	public static final String REGISTER=DOMAIN+"?t=user&a=register&";
	public static final String LOGIN=DOMAIN+"?t=user&a=checklogin&";
	public static final String INFO=DOMAIN+"?t=user&a=userinfo&";
	public static final String MYPAGE = DOMAIN+"?t=product&a=getpage&";

/**
 * 	comment url controller	
 */
	public static final String GETCM = DOMAIN+"?t=comment&a=viewComment&";
	public static final String NEWCOMMENT = DOMAIN+"?t=comment&a=postComment&";

}
