<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="bcss/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>
<body>
    <section class="adminphp">
    <div class="header">
    <h1>
        PHP KIEROWCA
    </h1>

 <!--PHP-->   
    <?php


$servername = "localhost";
$username = "root"; 
$password = "";
$dbname = "pizzacms2";

// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
$p=mysqli_connect('localhost','root','','pizzacms2');
// Check connection
if ($p->connect_error) {
    die("Connection failed: " . $p->connect_error);
} 

$sql = "SELECT `zamowienia`.`id_zamowienia`, `klienci`.`nazwisko`, `klienci`.`miejscowosc`, `klienci`.`nr_domu`, `wartosc`.`hawajska`, `wartosc`.`h_wielkosc`, `wartosc`.`bogacz`, `wartosc`.`b_wielkosc`, `wartosc`.`miesna`, `wartosc`.`m_wielkosc`, `wartosc`.`cena` FROM `zamowienia` INNER JOIN `wartosc` ON `zamowienia`.`id_zamowienia` = `wartosc`.`id_zamowienia` INNER JOIN `klienci` ON `zamowienia`.`id_zamowienia`=`klienci`.`id_zamowienia` ORDER BY `id_zamowienia` DESC LIMIT 5";

//echo $sql;
$result = mysqli_query($p,$sql);

if (mysqli_num_rows($result)) {
    // output data of each row
   while($row = $result->fetch_assoc()) 
    {
 
        echo "
        <section class='section-admin'>
            <div class='admin'>
                <table>
                <tr>
                    <td> <b> id_zam. : </b>" . $row["id_zamowienia"]." </td>
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
                    <td>Suma zam: " . $row["cena"]."zł </td>
                    </br>
                </tr>
                
                </table>
            </div>
        </section>";
    }
} else {
    echo "0 results";
}
$p->close();
?>
<div class="clear"></div>

</section>
</body>
</html>