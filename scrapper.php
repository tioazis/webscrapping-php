<?php
 
//fungsi untuk melakukan login
function login($url,$data){

    //nanti akan buat file cookie, pastikan diberikan hak akses untuk create file
    $fp = fopen("cookie.txt", "w");
    fclose($fp);
    $login = curl_init();

    curl_setopt($login, CURLOPT_COOKIEJAR, "cookie.txt");
    curl_setopt($login, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($login, CURLOPT_TIMEOUT, 40000);
    curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($login, CURLOPT_URL, $url);
    curl_setopt($login, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($login, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($login, CURLOPT_POST, TRUE);
    curl_setopt($login, CURLOPT_POSTFIELDS, $data);

    ob_start();
    return curl_exec ($login);
    ob_end_clean();
    curl_close ($login);
    unset($login);    
}                  
 
//fungsi untuk ngeambil laman web
function grab_page($site){
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 40);
    curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
    curl_setopt($ch, CURLOPT_URL, $site);

    ob_start();
    
    return curl_exec ($ch);
    ob_end_clean();
    curl_close ($ch);
}
 
//fungsi untuk melakukan post dengan data
function post_data($site,$data){
    $datapost = curl_init();
    $headers = array("Expect:");

    curl_setopt($datapost, CURLOPT_URL, $site);
    curl_setopt($datapost, CURLOPT_TIMEOUT, 40000);
    curl_setopt($datapost, CURLOPT_HEADER, TRUE);
    curl_setopt($datapost, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($datapost, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($datapost, CURLOPT_POST, TRUE);
    curl_setopt($datapost, CURLOPT_POSTFIELDS, $data);
    curl_setopt($datapost, CURLOPT_COOKIEFILE, "cookie.txt");

    ob_start();

    return curl_exec ($datapost);
    ob_end_clean();
    curl_close ($datapost);
    unset($datapost);    
}

//fungsi untuk menyeleksi bagian html yang akan diambil
function selector($output, $st, $en){    
    $start = strpos($output, $st);
    $end = strpos($output, $en, $start);
    $length = $end-$start;
    $output = substr($output, $start, $length);

    return $output;
}

//buat ngecek doang curl terinstall apa engga
function _isCurl(){
    return function_exists('curl_version');
}
 
?>



    