<?php


$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pizzacms1";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$p=mysqli_connect('localhost','root','','pizzacms1');
// Check connection
if ($p->connect_error) {
    die("Connection failed: " . $p->connect_error);
} 


$sql = "SELECT `zamowienia`.`id_zamowienia`, `klienci`.`nazwisko`, `klienci`.`miejscowosc`, `klienci`.`nr_domu`, `wartosc`.`hawajska`, `wartosc`.`h_wielkosc`, `wartosc`.`bogacz`, `wartosc`.`b_wielkosc`, `wartosc`.`miesna`, `wartosc`.`m_wielkosc`, `wartosc`.`cena` FROM `zamowienia` INNER JOIN `wartosc` ON `zamowienia`.`id_wartosc` = `wartosc`.`id_wartosc` INNER JOIN `klienci` ON `zamowienia`.`id_klienta`=`klienci`.`id_klienta` ORDER BY `id_zamowienia` DESC LIMIT 5";

//echo $sql;
$result = mysqli_query($p,$sql);

if (mysqli_num_rows($result)) {
    // output data of each row
   while($row = $result->fetch_assoc()) 
    {
        echo "
        <table>
        <tr>
            <td> id_zam. : " . $row["id_zamowienia"]." </td>
        </tr>
        <tr>
            <td>Nazwisko : " . $row["nazwisko"]." </td>
        </tr>
        <tr>
            <td>miejscowość : " . $row["miejscowosc"]." </td>
            <td>nr domu " . $row["nr_domu"]." </td>
        </tr>
        <tr>
            <td>haw_il : " . $row["hawajska"]." </td>
            <td>h_rozmiar : " . $row["h_wielkosc"]." </td>
        </tr>
        <tr>
            <td>bog_il : " . $row["bogacz"]." </td>
            <td>b_rozmiar: " . $row["b_wielkosc"]." </td>
        </tr>
        <tr>
            <td> mie_il: " . $row["miesna"]." </td>
            <td>m_rozmiar: " . $row["m_wielkosc"]." </td>
        </tr>
        <tr>
            <td>data_zam: " . $row["cena"]." </td>
              </br>
        </tr>
        
        </table>";
    }
} else {
    echo "0 results";
}
$p->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    PHP ADMIN
</body>
</html>