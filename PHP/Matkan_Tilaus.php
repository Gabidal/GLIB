

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
</head>
<body>
</body>

</html>
<?php

    $source_country = isset($_POST['source_country']) ? $_POST['source_country'] : '';
    $dest_country = isset($_POST['dest_country']) ? $_POST['dest_country'] : '';
    $Parent_Count = isset($_POST['Parent_Count']) ? $_POST['Parent_Count'] : '';
    $Child_count = isset($_POST['Child_count']) ? $_POST['Child_count'] : '';
    $date_of_departure = new DateTime(isset($_POST['date_of_departure']) ? $_POST['date_of_departure'] : '');
    $return_date = new DateTime(isset($_POST['return_date']) ? $_POST['return_date'] : '');
    $Mail_address =  isset($_POST['value']) ? $_POST['value'] : '';

    $content = "Lento lippu varattu: ". $date_of_departure->format('d.m.Y'). lentomies(). "\nPaluu päivä: ". $return_date->format('d.m.Y'). lentomies().  "\nLähtö maa:". $source_country. "\nPäämäärä:". $dest_country. "\nAikuisten määrä:". $Parent_Count. "\nLasten määrä: ". $Child_count;

    //nopea testi että saako kaikki variablet oikeat arvot :D
    //echo $source_country. $dest_country. $Parent_Count. $Child_count. $date_of_departure. $return_date

    //tähän tulee sähköpostin osoitteenotto
    //joku jolla on hyvä tyyli maku tuu tekee tästä parempaa :D.

    echo $content;

    mail($Mail_address, "Lento lipunne olkaa hyvä!", $content);
    echo "<p class=\"glass-text\">Lippu lähetetty osoitteeseen: </p>". "<p class=\"glass-text\"> $Mail_address </p>";

    echo "</form>";


    function lentomies(){
        return " ". rand(7, 22). ":". rand(0, 3) * 15;
    }

?>