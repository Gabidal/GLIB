<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
</head>
<body>
</body>

</html>
<?php

    $Variables = array();
    array_push($Variables, $_POST['source_country']);
    array_push($Variables, $_POST['dest_country']);
    array_push($Variables, $_POST['Parent_Count']);
    array_push($Variables, $_POST['Child_count']);
    array_push($Variables, $_POST['value']);

    $date_of_departure = new DateTime(isset($_POST['date_of_departure']) ? $_POST['date_of_departure'] : '');
    $return_date = new DateTime(isset($_POST['return_date']) ? $_POST['return_date'] : '');

    array_push($Variables, $return_date->Format('d.m.y'));
    array_push($Variables, $date_of_departure->Format('d.m.y'));

    file_put_contents("tiedot.txt", serialize($Variables));

    // Valmistele json tiedot käytettäviksi variableiksi:
    $json = file_get_contents('../JSON/Lennot.json');
    $jsonData = json_decode($json);

    //hel->sto:
    //hel->tic
    //tic->sto:
    //tic->mal
    //mal->sto
    function Sopivat_Lennot($source, $dest, $list){
        $result = array();
        foreach ($list as $current){
            if ($current->LähtöMaa == $source){
                foreach($current->PaluuMaa as $i){
                    if ($i == $dest){
                        array_push($result, $current);
                    }
                }
                foreach($list as $next){
                    //c = [a, b, c]
                    foreach($current->PaluuMaa as $i){
                        if ($next->LähtöMaa == $i){
                            foreach($next->PaluuMaa as $j){
                                if ($j == $dest){
                                    array_push($result, $current, $next);
                                }
                            }
                        }
                    }
                }
            }
        }
        return $result;
    }
    //HELP:

    $Lähtö_Ajat = array();
    foreach(Sopivat_Lennot($Variables[0], $Variables[1], $jsonData) as $i){
        foreach($i->LENNOT[0]->JUMBO as $j){
            array_push($Lähtö_Ajat, $j);
        }        
        foreach($i->LENNOT[0]->MID as $j){
            array_push($Lähtö_Ajat, $j);
        }
        foreach($i->LENNOT[0]->SMALL as $j){
            array_push($Lähtö_Ajat, $j);
        }
    }    
    $Paluu_Ajat = array();
    foreach(Sopivat_Lennot($Variables[1], $Variables[0], $jsonData) as $i){
        foreach($i->LENNOT[0]->JUMBO as $j){
            array_push($Paluu_Ajat, $j);
        }        
        foreach($i->LENNOT[0]->MID as $j){
            array_push($Paluu_Ajat, $j);
        }
        foreach($i->LENNOT[0]->SMALL as $j){
            array_push($Paluu_Ajat, $j);
        }
    }
    echo "<h1> Valitse aika:</h1>";
    echo "<form action=\"Matkan_Tilaus.php\" method=\"post\" class=\"forms\">";
    echo	"<br>";
    echo    "<h3> Lähtö aika</h3>";
	echo	"<br>";
    echo	"<select class=\"Selector\" name=\"Lähtö_Aika\">";
    foreach ($Lähtö_Ajat as $i){
        echo	"<option value =\"". $i. "\">". $i. "</option>";
    }
	echo "</select>	";
    echo	"<br>";
    echo    "<h3> Paluu aika</h3>";
	echo	"<br>";
    echo	"<select class=\"Selector\" name=\"Paluu_Aika\">";
    foreach ($Paluu_Ajat as $i){
        echo	"<option value =\"". $i. "\">". $i. "</option>";
    }
	echo "</select>	";
    echo "<input type=\"submit\" id=\"button\" value=\"VARAA\"/>";
    echo "</form>";

?>