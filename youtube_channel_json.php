<?php
require "./config/database.php";

$get_all_channels = "SELECT * FROM youtube_channels";
$channels = $mysqli->query( $get_all_channels );

$all_data = [];

if ( $channels ) {
    $channel_list = $channels->fetch_all(MYSQLI_ASSOC);
    foreach ($channel_list as $key => $channel) {
        $all_data[$channel['id']] = $channel;
        
        $get_all_videos = "SELECT * FROM youtube_channel_videos WHERE channel_id =".$channel['id'];
        $videos = $mysqli->query( $get_all_videos );
        $all_data[$channel['id']]['videos'] = $videos->fetch_all(MYSQLI_ASSOC);
    }
}

echo json_encode($all_data);

?>