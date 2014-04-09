<?PHP
$username = 'brandonanzaldi';
$apikey = 'example';
$api = file_get_contents("http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&limit=2&user=$username&api_key=$apikey&format=json");
$lfm = json_decode($api, TRUE);
$ls = $lfm["recenttracks"]["track"][0];
$artist = $ls["artist"]["#text"];
$track = $ls["name"];
$album = $ls["album"]["#text"];
$img = $ls["image"][2]["#text"];
echo dirname(__FILE__);
$im = imagecreatefrompng(dirname(__FILE__)."/bg.png");
$white = imagecolorallocate($im, 245, 245, 245);
$font = dirname(__FILE__).'/DroidSansMono.ttf';

$imgx = 0;
$imgy = 0;

$textx = 136;
$texty = 5;
$textskip = 32;

$track = wordwrap($track, 25);
$artist = wordwrap($artist, 24);
$album = wordwrap($album, 25);

$tline = "Track: $track";
$aline = "Artist: $artist";
$bline = "Album: $album";

$ext = substr($img, -4);
if ($ext === ".jpg") {
        $aim = imagecreatefromjpeg($img);
} else if ($ext === ".png") {
        $aim = imagecreatefrompng($img);
} else {
        $aim = imagecreatefrompng(dirname(__FILE__).'/lfm.png');
}


imagecopy($im, $aim, $imgx, $imgy, 0, 0, 126, 126);
// TODO: Fix JPEG transcoding so it doesn't get screwed.
imagettftext($im, 10, 0, $textx, $textskip, $white, $font, $tline);
imagettftext($im, 10, 0, $textx, $textskip*2, $white, $font, $aline);
imagettftext($im, 10, 0, $textx, $textskip*3, $white, $font, $bline);
imagepng($im,dirname(__FILE__).'/brandonanzaldi.png');
imagedestroy($im);
?>
