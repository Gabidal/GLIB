

<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../CSS/style.css"/>
</head>
<body>
        <h1> Lippu on lähetetty sähköpostiinne. </h1>
        <h2> Voit palata takaisin </h2>
</body>

</html>
<?php
    $LA = isset($_POST['Lähtö_Aika']) ? $_POST['Lähtö_Aika'] : '';
    $PA= isset($_POST['Paluu_Aika']) ? $_POST['Paluu_Aika'] : '';
    $gmail = isset($_POST['value']) ? $_POST['value'] : '';

    $Variables = unserialize(file_get_contents("tiedot.txt"));

    $content = "Lähtö Päivä: ". $Variables[6]. " ".$LA.  "\nPaluu päivä: ". $Variables[5]. " ". $PA. "\nLähtö maa:". $Variables[0]. "\nPäämäärä:". $Variables[1]. "\nAikuisten määrä:". $Variables[2]. "\nLasten määrä: ". $Variables[3];
    //echo $content;
    mail($gmail, "Lento lipunne olkaa hyvä!", $content);
    //echo "<p class=\"glass-text\">Lippu lähetetty osoitteeseen: </p>". "<p class=\"glass-text\"> $Mail_address </p>";
    
?>