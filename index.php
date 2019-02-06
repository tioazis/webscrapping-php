<?php 
require 'scrapper.php';
require 'database.php';



// login into osase
login('http://10.2.4.209/site/login','LoginForm[username]=830127&LoginForm[password]=Shaka777');

//variabel
$web = 'http://example.com'; //set your web here
$st = '<table id="exam" class="table table-bordered table-striped table-hover" style="width:100%; margin-top: 10px;">'; //start
$en = '</table>'; //end
$html = grab_page($web); //get html text full

//selector table only
$table1  = selector($html, $st, $en);

function tregSelector($table,$start,$end){
    $part = selector($table,$start,$end);
    return $part;
}

function tregExtract($part){
    $results = [];

    //extract tahap 2
        $partition1 = explode('a href=',$part);
        $extractResult1 = '';
        foreach($partition1 as $dat){    
            $datt = explode('>', $dat);
            $extractResult1 .= "$datt[2] <br>";
            
        }

        // echo $extractResult1;
        // echo '<br>';
    //

    //extract tahap 3
        $partition2 = explode('</span ', $extractResult1);
        $extractResult2 = '';
        foreach($partition2 as $dat){    
            $datt = explode('>', $dat);
            $extractResult2 .= "$datt[1]";    
            array_push($results,(int)$datt[1]); //append all extractResult2
        }
    //

    return ($results);
}

//selector per treg
    $treg1_part = tregSelector($table1,'TREG 1','</tr>');
    $treg2_part = tregSelector($table1,'TREG 2','</tr>');
    $treg3_part = tregSelector($table1,'TREG 3','</tr>');
    $treg4_part = tregSelector($table1,'TREG 4','</tr>');
    $treg5_part = tregSelector($table1,'TREG 5','</tr>');
    $treg6_part = tregSelector($table1,'TREG 6','</tr>');
    $treg7_part = tregSelector($table1,'TREG 7','</tr>');
//

//update to database
    echo updateCriticalOne(1,tregExtract($treg1_part));
    echo updateCriticalOne(2,tregExtract($treg2_part));
    echo updateCriticalOne(3,tregExtract($treg3_part));
    echo updateCriticalOne(4,tregExtract($treg4_part));
    echo updateCriticalOne(5,tregExtract($treg5_part));
    echo updateCriticalOne(6,tregExtract($treg6_part));
    echo updateCriticalOne(7,tregExtract($treg7_part));
//
?>