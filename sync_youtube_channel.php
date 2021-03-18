<?php
require "./config/database.php";

$my_key = "AIzaSyCpqCwc1AK0ixUs31pGdrWUs6VkoWhot5I";
$channel_name = 'NBA';
$channels_base_url  = "https://www.googleapis.com/youtube/v3/channels?part=snippet&part=brandingSettings";
$channel_videos_url = "https://www.googleapis.com/youtube/v3/activities?part=contentDetails&part=snippet";

$sql = "SELECT * FROM youtube_channels WHERE `name` = '".$channel_name."'";
$res = $mysqli->query( $sql );

if ($res->num_rows == 0) {
    $channel_info_url = $channels_base_url."&forUsername=".$channel_name."&key=".$my_key;
    $channel_info = json_decode( file_get_contents( $channel_info_url ) );
    $channel_info = $channel_info->items[0];
    
    $save_channel = $mysqli->prepare( "INSERT INTO youtube_channels (`profile_picture`, `banner`, `name`, `description`) VALUES ( ?, ?, ?, ? )"  );
    $save_channel->bind_param("ssss", $profile_picture, $banner, $name, $description );

    $profile_picture    = $channel_info->snippet->thumbnails->default->url;
    $banner             = $channel_info->brandingSettings->image->bannerExternalUrl;
    $name               = $channel_info->snippet->title;
    $description        = $channel_info->snippet->description;
    
    if ( $save_channel->execute() === TRUE ) {
        $save_id = $save_channel->insert_id;
        $videos_info_url = $channel_videos_url."&channelId=".$channel_info->id."&maxResults=100&key=".$my_key;
        $videos_info = json_decode( file_get_contents( $videos_info_url ) );
        $videos_info = $videos_info->items;

        foreach ($videos_info as $key => $video) {
            $save_videos = $mysqli->prepare( "INSERT INTO youtube_channel_videos (`video_link`, `title`, `description`, `thumbnail`, `channel_id`) VALUES ( ?, ? , ?, ?, ? )"  );
            $save_videos->bind_param("ssssi", $link, $title, $description, $thumbnail, $channel_id);

            $link = 'https://www.youtube.com/watch?v='.$video->contentDetails->upload->videoId;
            $title = $video->snippet->title;
            $description = $video->snippet->description;
            $thumbnail = $video->snippet->thumbnails->high->url;
            $channel_id = $save_id;
            $save_videos->execute();
        }
        
    } else {
        echo "Error: ". $mysqli->error;
    }
}
echo "Sync Done ";
?>