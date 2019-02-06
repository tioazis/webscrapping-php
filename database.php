<?php 
    require 'config.php';
    //$conn = mysqli_connect("10.32.221.186","root","","scraposase"); //server telkom

    function query($query){
        global $conn;
        
        $result = mysqli_query($conn, $query);
        $rows  = [];
        
        while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
        }

        return $rows;
    }

    function updateCriticalOne(int $treg,array $data){
        global $conn;

        $main_ok = $data[4];
        $main_nok = $data[5];
        $main_ttl = $data[6];
        $primary_ok = $data[7];
        $primary_nok = $data[8];
        $primary_ttl = $data[9];
        $aon_ok = $data[10];
        $aon_nok = $data[11];
        $aon_ttl = $data[12];

        $query = "UPDATE critical_one SET 
                main_ok = '$main_ok',
                main_nok = '$main_nok',
                main_ttl = '$main_ttl',
                primary_ok = '$primary_ok',
                primary_nok = '$primary_nok',
                primary_ttl = '$primary_ttl',
                aon_ok = '$aon_ok',
                aon_nok = '$aon_nok',
                aon_ttl = '$aon_ttl'
            WHERE treg = $treg
        ";

        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);        
    }






?>