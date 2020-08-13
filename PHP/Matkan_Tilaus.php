<?php
    $source_country = isset($_POST['source_country']) ? $_POST['source_country'] : '';
    $dest_country = isset($_POST['dest_country']) ? $_POST['dest_country'] : '';
    $Parent_Count = isset($_POST['Parent_Count']) ? $_POST['Parent_Count'] : '';
    $Child_count = isset($_POST['Child_count']) ? $_POST['Child_count'] : '';
    $date_of_departure = isset($_POST['date_of_departure']) ? $_POST['date_of_departure'] : '';
    $return_date = isset($_POST['return_date']) ? $_POST['return_date'] : '';

    //nopea testi että saako kaikki variablet oikeat arvot :D
    //echo $source_country. $dest_country. $Parent_Count. $Child_count. $date_of_departure. $return_date

    //tähän tulee sähkö postin osoitteen otto
    //joku jolla on hyvä tyyli maku tuu tekee tästä parempaa :D.
    echo "<form method=\"post\" action=\"\">";
    echo "<input type=\"text\" name=\"value\" placeholder=\"Sähköpostinne\">";
    echo "<input type=\"submit\">";
    echo "</form>";

    $Mail_address =  isset($_POST['value']) ? $_POST['value'] : '';

    echo $Mail_address;
?>