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
$im = imagecreatefrompng(dirname(__FILE__)."/bg.png");
$white = imagecolorallocate($im, 245, 245, 245);
$font = dirname(__FILE__).'/DroidSansMono.ttf';

$imgx = 0;
$imgy = 0;

$textx = 136;
$texty = 5;
$textskip = 32;

if (strlen($track)>50) {
	$track = substr($track, 0, 50);
}

if (strlen($artist)>48) {
	$artist = substr($artist, 0, 48);
}

if (strlen($album)>50) {
	$album = substr($album, 0, 50);
}

$track = wordwrap($track, 25);
$artist = wordwrap($artist, 24);
$album = wordwrap($album, 25);

$tlines = explode("\n", $track);
$alines = explode("\n", $artist);
$blines = explode("\n", $album);

if (count($tlines)>2) {
	$track = $tlines[0]."\n".substr($tlines[1].' '.$tlines[2],31).'...';
}

if (count($alines)>2) {
	$artist = $alines[0]."\n".substr($alines[1].' '.$alines[2],30).'...';
}

if (count($blines)>2) {
	$album = $blines[0]."\n".substr($blines[1].' '.$blines[2],31).'...';
}

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
imagepng($im,dirname(__FILE__)."/$username.png");
imagedestroy($im);
?>
