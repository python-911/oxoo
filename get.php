<?php
/*
// OVOO - SCRAPPER
[x] host = your panel hosting
EXAMPLE: http://localhost/portal/api/get_tv_channel_by_category_id/?api_secret_key=123456=18

[API DATA GET]

GET LATES MOVIES
host/api/get_latest_movies/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET MOVIES
host/api/get_movies/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET FEATURES GENRE
host/api/get_features_genre_and_movie/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET MOVIES BY GENRE ID 
host/api/get_movie_by_genre_id/?api_secret_key=[API_KEY]&id=1 2 3 ETC
------------------------------------------------------------------------------------
GET MOVIES BY COUNTRY ID
host/api/get_movie_by_country_id/?api_secret_key=[API_KEY]&id=7
------------------------------------------------------------------------------------
GET LATEST MOVIES
host/api/get_latest_tvseries/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET MOVIES
host/api/get_tvseries/?api_secret_key=[API_KEY]
host/api/get_tvseries/?api_secret_key=[API_KEY]&page=1 2 3 ETC
------------------------------------------------------------------------------------
GET MOVIES BY GENRE ID
host/api/get_tvseries_by_genre_id/?api_secret_key=[API_KEY]&id=1 2 3 ETC
------------------------------------------------------------------------------------
GET MOVIES BY COUNTRY ID
host/api/get_tvseries_by_country_id/?api_secret_key=[API_KEY]&id=1 2 3 ETC
------------------------------------------------------------------------------------
GET ALL CHANNELS
host/api/get_all_tv_channel/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET TV CHANNEL
host/api/get_tv_channel/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET ALL TV CHANNEL BY CATEGORY
host/api/get_all_tv_channel_by_category/?api_secret_key=[API_KEY]
------------------------------------------------------------------------------------
GET ALL TV CHANNEL BY CATEGORY ID
host/api/get_tv_channel_by_category_id/?api_secret_key=[API_KEY]&id=1 2 3 ETC
------------------------------------------------------------------------------------
GET SINGLE MOVIE,TVSERIES & LIVE TV DETAILS
host/api/get_single_details/?api_secret_key=[API_KEY]&type=tv&id=1 2 3 ETC
host/api/get_single_details/?api_secret_key=[API_KEY]&type=tvseries&id=1 2 3 ETC
host/api/get_single_details/?api_secret_key=[API_KEY]&type=movie&id=1 2 3 ETC
------------------------------------------------------------------------------------
GET SEARCH
host/api/search/?api_secret_key=[API_KEY]&q=radio OR ANYTHING
------------------------------------------------------------------------------------
*/

ob_start();
//error_reporting(0);
set_time_limit(0);
date_default_timezone_set("Europe/Tirane");
$Stream_Provider = "Albdroid TV";
$Stream_Type = " Vod Streaming";
$Stream_Types = " Live Stream";

$MAIN_API_URL = "http://localhost/api/"; // PANEL API

$GET_STREAMS_ATTRIBUTES = "get_tv_channel_by_category_id";
$API_SECRET_KEY_ATTRIBUTES = "?api_secret_key="; // DO NOT TOUCH IT
$API_SECRET_KEY = "dvyl8x2trizhcd5pj4rs207e"; // API FROM /admin/android_setting/
$CATEGORY_ID = '&id='."18"; // CHANGE CAT ID ONLY 1 2 3 ETC

$ALL_ATTRIBUTES = $MAIN_API_URL.$GET_STREAMS_ATTRIBUTES.$API_SECRET_KEY_ATTRIBUTES.$API_SECRET_KEY.$CATEGORY_ID;
//echo $ALL_ATTRIBUTES;

$vod_channels_url = $ALL_ATTRIBUTES;
$vod_channels_url_object  = file_get_contents($vod_channels_url);
$get_vod_channels  = json_decode($vod_channels_url_object);

echo("#EXTM3U Albdroid TV Streaming #$Stream_Type\n");
header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
foreach($get_vod_channels as $item)
{
$title = $item->tv_name;
$stream_url = $item->stream_url;
$thumbnail = "https://png.kodi.al/tv/albdroid/smart_x1.png"; // CHANGE WITH YOUR LOGO
$tvgid = "Hosted by Albdroid.AL";
$tvg_id = ('tvg-id="'. $tvgid .'"');
$tvg_name = ('tvg-name="'. $Stream_Provider . $Stream_Type .'"');
$tvg_logo = ('tvg-logo="'. $thumbnail .'"');
$grouptitle = "$Stream_Provider$Stream_Type";
$group_title = ('group-title="'. $grouptitle .'"');
echo "\r#EXTINF:-1 $tvg_id $tvg_name $tvg_logo $group_title,$title\n";
echo $stream_url."\n";
}
ob_end_flush();
?>
