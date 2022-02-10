<?php

function http_request($url){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    $output = curl_exec($ch); 
    curl_close($ch);      

    return $output;
}

function biodata($name, $dateOfBirth, $address) {
    echo "<h3>Bioadata</h3>";
    echo "<p> Name : ".$name."<p/>";
    echo "<p> Date Of Birth : ".$dateOfBirth."<p/>";
    echo "<p> Adress : ".$address."<p/>";
    echo "<hr/>";
}

function getAgeFromApi($date) {
    echo "<h3>Calculate Age</h3>";
    $dateOfBirth = $date;
    $today = date("Y-m-d");
    $diff = date_diff(date_create($dateOfBirth), date_create($today));
    echo 'Your age is '.$diff->format('%y');
    echo "<hr/>";
}

function countCharacterName($name) {
    echo "<h3>Count Character Name</h3>";
    $sourceCharacters = str_split($name);
    $targetString = $name;
    $occurrenceCount = array();

    foreach($sourceCharacters as $currentCharacter) {
        $occurrenceCount[$currentCharacter] = substr_count($targetString, $currentCharacter);
    }

    print_r($occurrenceCount);

    echo "<br /><br/>";
    echo "Total Character ".strlen($name);
    echo "<hr/>";
}

function bilanganPrima() {
    echo "<h3>Show Bilangan Prima</h3>";

    for ($i = 1; $i <= 100; $i++) {
        $a = 0;
        for($j = 1; $j <= $i; $j++) {
            if ($i % $j == 0) {
                $a++;
            }
        }

        if ($a == 2) {
            echo $i.' ';
        }
    }
}

$profile = http_request("http://localhost/buana_varia-test/api.php");
$profile = json_decode($profile, TRUE);

// show biodata
biodata($profile['name'], $profile['date-of_birth'], $profile['address']);

// calculate age from api
getAgeFromApi($profile['date-of_birth']);

// count character name from api
countCharacterName($profile['name']);

// show bilangan prima
bilanganPrima();
