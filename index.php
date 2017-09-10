<?php
/**
 * Code by Tran Nguyen Thanh Dan - https://www.facebook.com/dan.trannguyenthanh
 * Code được chia sẻ miễn phí tại J2TEAM Community - https://www.facebook.com/groups/j2team.community
 * 
 **/

error_reporting(0);

function gettoken()
{
	$acc = array(
	array("zid.kaiaozonpecazinih447","gaochanhkieu.vn"),
	array("gocmobile.pro","gocmobile123")
	);
	
	$dem = count($acc);
	$ngaunhien = rand(0,$dem-1);
	$user = $acc[$ngaunhien][0];
	$pass = md5($acc[$ngaunhien][1]);
	
	$linklist = 'http://api.mp3.zing.vn/api/mobile/auth/usertoken?requestdata={"user":"'.$user.'","pwd":"'.$pass.'"}';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$page = curl_exec($ch);
	curl_close($ch);

	$infotoken = json_decode($page);
	$token = $infotoken->token;

    return $token;
}

function getlink($idbaihat)
{

	$linklist = 'http://api.mp3.zing.vn/api/mobile/song/getsonginfo?requestdata={"id":"'.$idbaihat.'"}';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $linklist);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$page = curl_exec($ch);
	curl_close($ch);

	$data = json_decode($page);
	// echo "string";
	return $data;
}

function chuyenlink($url)
{
    $token = gettoken();

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '?fromvn=true&requestdata={"token":"'.$token.'"}');

    $page = curl_exec($ch);

    return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

    curl_close($ch);
}

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Demo</title>
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="audioplayerengine/initaudioplayer-1.css">
    

    
  </head>

  <body>

    <div class="container">
		
		<div class="panel panel-primary" style="margin-top: 20px;">
		  <div class="panel-heading">Demo Get Link Zing MP3</div>
		  <div class="panel-body">
		    <form class="form-horizontal" action="" method="POST">
				<fieldset>
				<div class="form-group">
				  <div class="col-md-10">
				  <input id="url" name="url"  class="form-control input-md" placeholder="Nhập link bài hát của Zing MP3. Link có dạng: http://mp3.zing.vn/bai-hat/Ghen-Khac-Hung-ERIK-MIN/ZW7FC0I7.html" type="text">
				  </div>
				  <div class="col-md-2">
				    <button id="submit" name="submit" value="submit" class="btn btn-primary" onclick="guidulieu();">Get link</button>
				  </div>
				</div>
				</fieldset>
				</form>
<script type="text/javascript">
function guidulieu()
{
  	document.getElementById("url").submit();
}
</script>

			
			<div class="row">
				<div class="col-md-12" style="text-align: center;">
					<?php 
					if(isset($_POST['url']))
					{
						$url      = $_POST['url'];
						$temp     = explode("/", $url);
						$idbaihat = str_replace(".html","",$temp[count($temp)-1]);
						if ($idbaihat != "") 
						{
							$token = gettoken();
							if ($token != "") 
							{
								$data = getlink($idbaihat);
								$linkplay     = chuyenlink($data->source->{"lossless"});
								$link128      = str_replace("+", " ", chuyenlink($data->link_download->{"128"}));
								$link320      = str_replace("+", " ", chuyenlink($data->link_download->{"320"}));
								$linklossless = str_replace("+", " ", chuyenlink($data->link_download->{"lossless"}));
								$thumbnail    = 'http://zmp3-photo-td.zadn.vn/'.$data->thumbnail;
								$tenbaihat    = $data->title;
								$casy         = $data->artist;
								$luotnghe     = $data->total_play;
								$album        = $data->album;
								if($tenbaihat != "")
								{
									$tenfile = "$tenbaihat - $casy";
									$msg.= '<div style="margin:12px auto;">
										<div id="amazingaudioplayer-1" style="display:block;position:relative;width:300px;height:300px;margin:0px auto 0px;">
											<ul class="amazingaudioplayer-audios" style="display:none;">
												<li data-artist="" data-title="'.$tenbaihat.' - '.$casy.'" data-album="" data-info="" data-image="'.$thumbnail.'" data-duration="0">
													<div class="amazingaudioplayer-source" data-src="'.$linkplay.'" data-type="audio/mpeg" />
												</li>
											</ul>
										</div>
									</div>';

									$msg.= ' <a target="_banks" href="'.$link128.'"><button type="button" class="btn btn-success"><i class="fa fa-cloud-download"></i> 128 Kbps</button></a> ';

									$msg.= ' <a target="_banks" href="'.$link320.'"><button type="button" class="btn btn-success"><i class="fa fa-cloud-download"></i> 320 Kbps</button></a> ';

									$msg.= ' <a target="_banks" href="'.$linklossless.'"><button type="button" class="btn btn-success"><i class="fa fa-cloud-download"></i> Lossless</button></a> ';

									echo $msg;
								}
								else
								{
									echo "Lỗi cmnr: Không thể get bài này!!";
								}
							}
							else
							{
								echo "Lỗi cmnr: tạo token!";
							}
						}
						else
						{
							echo "Lỗi cmnr: Không tìm thấy ID bài hát! Link phải có dạng: http://mp3.zing.vn/bai-hat/Ghen-Khac-Hung-ERIK-MIN/ZW7FC0I7.html";
						}
						
					}
?>
				</div>
			</div>
			
			</div>
			
		</div>
	<footer class="footer">
		<a href="https://facebook.com/groups/j2team.community"><p>J2TeaM Community &copy; 2017</p></a>
	</footer>
</div> <!-- /container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="audioplayerengine/amazingaudioplayer.js"></script>
<script src="audioplayerengine/initaudioplayer-1.js"></script>
	
	


	</body>
</html>