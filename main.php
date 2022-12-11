<?php
    include_once 'database.php';
    include_once 'youtube_database.php';

$search = $_POST['name'];
$API_key    = '';

$maxResults = 10;
$videoList = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&q='.urlencode($search).'&maxResults='.$maxResults.'&key='.$API_key));


// include database and object files

// get database connection
$database = new Database();
$db = $database->getConnection();
// prepare youtube object
$youtube = new Youtube($db);

// iterate each youtube and store in database table.
foreach($videoList->items as $item){

    if(isset($item->id->videoId)){

            // converting string to date
        $time = strtotime($item->snippet->publishedAt);
        $newformat = date('M d, Y h:i:s',$time);

        $youtube->channel_id=$item->snippet->channelId;
        $youtube->channel_name=$item->snippet->channelTitle;
        $youtube->description=$item->snippet->title;
        $youtube->published_time=$newformat;
        $youtube->video_id=$item->id->videoId;
        $youtube->thumbnail_url=$item->snippet->thumbnails->high->url;

           // create the tweet
            if($youtube->create()){

    }
    }
}

// prepare youtube object
$yt = new Youtube($db);

// query videos
$stmt = $yt->read();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    $response = "";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $url = "https://www.youtube.com/embed/";
        $url .= $video_id;
        $response .= "<div class='proj-box-format'><iframe src='";
        $response .= $url;
        $response .="' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen align='middle' seamless></iframe></div>";
    }
    echo $response;
}
else{
    echo json_encode(array());
}
?>