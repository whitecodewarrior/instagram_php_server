 <?php
// /?username=user1&password=123QWEqwe&caption=iamworking&file=test.jpg&type=photo
require("vendor/autoload.php");

//$path = $_SERVER['PATH_INFO'];
$type = $_GET["type"];
$username = $_GET["username"];
$password = $_GET["password"];
$file = $_GET["file"];
$file = "../" . $file;
$caption = $_GET["caption"];


if ($type == 'video')
{
	uploadVideo($username, $password, $file, $caption);
}
else if ($type == 'photo')
{
	uploadPhoto($username, $password, $file, $caption);
}
else if ($type == 'auth')
{
	checkAuth($username, $password);
}
else
{
	echo "unknown type";
}
exit();

//


function checkAuth($username, $password) {
	$instagram = new \InstagramAPI\Instagram();
	$i = new \InstagramAPI\Instagram($username, $password, false);
	try {
	    $i->login();
	    echo 'ok';
	} catch (Exception $e) {
	    echo $e->getMessage();
	    exit();
	}
}


function uploadVideo($username, $password, $video, $caption) {
	$instagram = new \InstagramAPI\Instagram();
	$i = new \InstagramAPI\Instagram($username, $password, false);
	try {
	    $i->login();
	} catch (Exception $e) {
	    echo $e->getMessage();
	    exit();
	}
	try {
	    $i->uploadVideo($video, $caption);
	    echo 'ok';
	} catch (Exception $e) {
	    echo $e->getMessage();
	}
}


function uploadPhoto($username, $password, $photo, $caption) {
	$i = new \InstagramAPI\Instagram($username, $password, false);
	try {
	    $i->login();
	} catch (Exception $e) {
	    echo $e->getMessage();
	    exit();
	}
	try {
	    $i->uploadPhoto($photo, $caption);
	     echo 'ok';
	} catch (Exception $e) {
	    echo $e->getMessage();
	}
}
 ?>