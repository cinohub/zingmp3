<!---code by Tiêu Vanh-->
<!DOCTYPE html>
<html lang="en">

<head>
		<meta charset="utf-8">

	<title>GET links</title>

	<meta name="description" content="desc" />
	<meta name="keywords" content="keys" />
	<meta name="robots" content="index, follow" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="distribution" content="Global" />
<meta name="revisit-after" content="1 days" />
<meta http-equiv="REFRESH" content="1800" />
	<link href="https://doicard.vn/upload/public/logo_1461817203_1465177915.png" rel="shortcut icon" type="image/x-icon"/>

	<!-- Add custom CSS here -->
	<link rel="stylesheet" href="https://doicard.vn/public/site/css/css.css">

	<!-- End custom CSS here -->

	<!-- Core Js -->
	<script src="https://doicard.vn/public/js/jquery/jquery.min.js"></script>
	<script src="https://doicard.vn/public/js/angular/angular.min.js"></script>
	<script src="https://doicard.vn/public/js/angular/angular-ng-modules/angular-ng-modules.js"></script>
	<style>
	.form-error{color:red;}
	.form-control{min-width:200px;max-width:350px;}
	.form-group{margin:10px 0px;}
	.btn-primary{border:none;padding:7px 20px;background:#d15050;color:#fff;cursor:pointer}
	.param_custom .control-label, .param_custom .col-sm-9{display:inline-block}
	.alert-info{
	 background:#e9f1d9;
		padding:20px;
	}
	.alert-info .close{display:none;}
	</style>

	</head>

<body>

<div class="page-container">

	<div class="container">
		<div class="block-s2">

			<div class="row">
				<div class="col-md-9">
				      <!-- Message -->
                                            
                                    
					
	    
    <div class="box-content-home box-home" style="margin-top:0px">
                           <div class="content">
             <div class="row">
                    
		<form method="post" accept-charset="UTF-8" class="form-horizontal form_action" action="#">
		<div name="card_error" class="nNote nWarning hideit"></div>	
		
	<div class="form-group param_custom">
	
		<label class="col-sm-3 control-label" for="_7fa95c1da1dddcc4018e97dbcb349996">
		
			GET LINK FSHARE & 4share .V..V			
					</label>
		
		
		<div class="col-sm-9">
		
							
				<b style="color:red"></b>				
						
			
			<div class="clearfix"></div>

			<div name="type_error" class="form-error"></div>

						
		</div>

	</div>

	
		

	</div>

	
		
	<div class="form-group param_text">
	
		<label class="col-sm-3 control-label" for="_cf437d74bb9d4e253da698e8b2da79e2">
		
			link:			
			<span class="req">*</span>		</label>
		
		
		<div class="col-sm-9">
		
							<input type="text" class="form-control" placeholder="bỏ link vào đây" id="_cf437d74bb9d4e253da698e8b2da79e2" name="url" />				
				
						
			
			<div class="clearfix"></div>

			<div name="code_error" class="form-error"></div>

						
		</div>


	</div>

	
	
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<input class="btn btn-primary" type="submit" value="Thực hiện" />		</div>
	</div>
<?php
/* Code By Tiêu Vanh*/
$link = "link=".$_POST['url']."&pass=undefined&hash=&captcha=";
$URL = 'https://linksvip.net/GetLinkFs';
# Hàm mình tham khảo trên GitHub: https://gist.github.com/jrivero/5598138 .
function file_get_contents_curl($url, $retries=5, $post)
{
    $cookie = file_get_contents("cookie.txt");
    $ua = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36';
    if (extension_loaded('curl') === true)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url); // The URL to fetch. This can also be set when initializing a session with curl_init().
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
        #curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // The number of seconds to wait while trying to connect.
        #curl_setopt($ch, CURLOPT_USERAGENT, $ua); // The contents of the "User-Agent: " header to be used in a HTTP request.
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE); // To fail silently if the HTTP code returned is greater than or equal to 400.
        #curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE); // To follow any "Location: " header that the server sends as part of the HTTP header.
        #curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE); // To automatically set the Referer: field in requests where it follows a Location: redirect.
        #curl_setopt($ch, CURLOPT_TIMEOUT, 10); // The maximum number of seconds to allow cURL functions to execute.
        #curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // The maximum number of redirects
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Host: linksvip.net',
    'Accept: application/json, text/javascript, */*; q=0.01',
    'Origin: https://linksvip.net',
    'X-Requested-With: XMLHttpRequest',
    'User-Agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36',
    'Content-Type: application/x-www-form-urlencoded; charset=UTF-8',
    'DNT: 1',
    'Referer: https://linksvip.net/',
    'Cookie: ' . $cookie// Đây là tài khoản Public
    ));  #Tạo HTTP Header tùy chỉnh
        $result = curl_exec($ch);
        curl_close($ch);
    }
    else
    {
        $result = file_get_contents($url);
    }        
    if (empty($result) === true)
    {
        $result = false;
       if ($retries >= 1)
        {
            sleep(1);
            return file_get_contents_curl($url, --$retries);
        }
    }    
    return $result;
}
  $result = preg_replace( '/[^[:print:]\r\n]/', '',file_get_contents_curl($URL, 5, $link));
  $echo = json_decode($result,TRUE);
  if ($echo['trangthai'] == 1) {
      $rep  = array(
      'messages' => array(
          0 => array(
            'text' => 'Link của bạn đã sẵn sàng để download. <3'
          ),
          1 => array(
            'text' => '*Tên file:* '.$echo['filename']
          ),
          2 => array (
              'text' => '*Download:* '.$echo['linkvip']
          ),
      )
  );
  } elseif ($echo['trangthai'] == 0) {
          $rep  = array(
      'messages' => array(
          0 => array(
            'text' => $echo['loi']
          ),
      )
  );
  }
//  echo json_encode($rep);
if(isset($echo['linkvip'])){
echo 'Link của bạn đã sẵn sàng để download. <3 <br>';
echo 'Tên file:* '.$echo['filename'].'<br>';
echo '<script>window.location = "'.$echo['linkvip'].'";</script>';
echo 'Download:* '.$echo['linkvip'].'';
}
?>
		</form>
		 
             </div>
         </div>
                      </div>
    
    

				</div>
			</div>

		</div>
	</div>

</div>


</body>

</html>
