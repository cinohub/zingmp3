<?php
/**
* 
*/
header('Content-Type: text/html; charset=utf-8');
class Response {
  private $data;
  private $code;
  private $msg;
  public function __construct($ErrorName, $ErrorCode, $ErrorMSG){
    $this->data = $ErrorName;
    $this->code = $ErrorCode;
    $this->msg = $ErrorMSG;
  }
  public function getCode(){
    return $this->code;
  }
  public function getData(){
    return $this->data;
  }
  public function getMsg(){
    return $this->msg;
  }
  public function toJSON(){
    $json = array(
      'data' => $this->getData(),
      'code' => $this->getCode(),
      'msg' => $this->getMsg(),
      );
    
    return json_encode($json, JSON_UNESCAPED_UNICODE);
  }
}

function getLinkZing($url)
{
 $link128 = "http://htstar.design/mp3zing.php?q=128&link=".$url;
 $link320 = "http://htstar.design/mp3zing.php?q=320&link=".$url;
 $linklossless = "http://htstar.design/mp3zing.php?q=lossless&link=".$url;
 $jsonData = array(
  'link128' =>$link128,
  'link320' =>$link320,
  'linklossless' =>$linklossless
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLinkNCT($url)
{
	$url = str_replace("http://nhaccuatui.com/", "https://www.nhaccuatui.com/", urldecode($url));
 $link128 = "https://starlabs.ml/ALL_In_One_plugins/nctgetlink.php?q=128&link=".$url;
 $link320 = "https://starlabs.ml/ALL_In_One_plugins/nctgetlink.php?q=320&link=".$url;
 $linklossless = "https://starlabs.ml/ALL_In_One_plugins/nctgetlink.php?q=lossless&link=".$url;
 $jsonData = array(
  'link128' =>$link128,
  'link320' =>$link320,
  'linklossless' =>$linklossless
  );
 $response = new Response($jsonData,200,"success");
 $strRespose = "{
  \"messages\": [
    {
      \"attachment\": {
        \"type\": \"template\",
        \"payload\": {
          \"template_type\": \"button\",
          \"text\": \"Hello!\",
          \"buttons\": [        
            {
              \"type\": \"web_url\",
              \"url\": \"%s\",
              \"title\": \"Visit Website\"
            }
           
          ]
        }
      }
    }
  ]
}";
 return sprintf($strRespose, $url);
}

function getLinkFshare($url)
{
 $linkFshare = str_replace("fshare.vn", "getlinkfshare.com", $url);
 $linkMAXSPEED = "http://bfeu.tk/getfshare.php?link=".$url;
 $jsonData = array(
  'linkGETLINKFSHARE' =>$linkFshare,
  'linkMaxSpeed' =>$linkMAXSPEED
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLinkJAV($url)
{
 $linkvip = "http://starlabs.ml/getjav.php?link=".$url;
 $jsonData = array(
  'linkvip' =>$linkvip
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLinkTailieuvn($url)
{
 $linkvip = "https://linksvip.net/?link=".$url;
 $jsonData = array(
  'linkvip' =>$linkvip
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLinkHoctot123($url)
{
 $linkvip = "http://bfeu.tk/getlinkhoctot123/xuly.php?url=".$url;
 $jsonData = array(
  'linkvip' =>$linkvip
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLink4share($url)
{
 $linkvip = "https://linksvip.net/?link=".$url;
 $jsonData = array(
  'linkvip' =>$linkvip
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
function getLinkDrive($url)
{
 $linkvip = "http://starlabs.ml/getdrivepdf.php?link=".$url;
 $jsonData = array(
  'linkvip' =>$linkvip
  );
 $response = new Response($jsonData,200,"success");
 return $response;
}
if(isset($_GET['submit']))
{
  $response;
  $url      = $_GET['submit'];
  if(!empty($url) && filter_var($url, FILTER_VALIDATE_URL)){
    $host =  parse_url($url,PHP_URL_HOST);
    // echo $host;
    if($host === 'mp3.zing.vn'){
      $response = getLinkZing($url);
    }else if($host === 'www.nhaccuatui.com'){
     $response = getLinkNCT($url);
   }else if($host === 'www.fshare.vn'){
     $response = getLinkFshare($url);
   }else if($host === 'javhd.com'){
     $response = getLinkJAV($url);
   }else if($host === 'tailieu.vn'){
     $response = getLinkTailieuvn($url);
   }else if($host === 'hoctot123.com'){
     $response = getLinkHoctot123($url);
   }else if($host === 'up.4share.vn'){
     $response = getLink4share($url);
   }else if($host === 'drive.google.com'){
     $response = getLinkDrive($url);
   }else{
    $response = new Response(null,400,"Chưa hỗ trợ get link tại hostname này!");
  }
}else{
  $response = new Response(null,404,"URL không hợp lệ");
}
echo $response;
}

