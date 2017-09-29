<?php
if(isset($_POST['submit']))
{
    $url      = $_POST['submit'];
    $temp     = explode("/", $url);
    $idbaihat = str_replace(".html","",$temp[count($temp)-1]);
    if ($idbaihat != "") 
    {
      
           $linklist = 'http://api.mp3.zing.vn/api/mobile/song/getsonginfo?requestdata={"id":"'.$idbaihat.'"}';

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $linklist);
           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
           curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
           curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           // curl_setopt($ch, CURLOPT_PROXY, "222.255.122.58:3128");
           $page = curl_exec($ch);
           curl_close($ch);

           $data = json_decode($page);
    // echo chuyenlink($data->link_download->{"lossless"});
           echo $page;
    }
    else
    {
        echo "Lỗi : Không tìm thấy ID bài hát! Link phải có dạng: http://mp3.zing.vn/bai-hat/Ghen-Khac-Hung-ERIK-MIN/ZW7FC0I7.html";
    }
}

