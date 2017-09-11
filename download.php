<?php
if(isset($_POST['submit']))
{
 $link = $_POST['submit'];
 $token = gettoken();
 if ($token != "") 
 {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $link);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 1);
    // curl_setopt($ch, CURLOPT_PROXY, "222.255.122.58:3128");
    curl_setopt($ch, CURLOPT_POSTFIELDS, '?fromvn=true&requestdata={"token":"'.$token.'"}');
    $page = curl_exec($ch);
    $result =   curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
    echo json_encode($result);
    curl_close($ch);
}else{
    echo "error token";
}
}

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
// curl_setopt($ch, CURLOPT_PROXY, "222.255.122.58:3128");
    $page = curl_exec($ch);
    curl_close($ch);

    $infotoken = json_decode($page);
    $token = $infotoken->token;

    return $token;
}
