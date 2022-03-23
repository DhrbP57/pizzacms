<?php
    session_start();

    if(!isset($_SESSION['fr_imie']))
    {
        header('Location: index.php'); exit();
    }
    
    //usuwanie zmiennych pamiętających wartości wpisane do formularza
    if(isset($_SESSION['fr_imie'])) unset($_SESSION['fr_imie']);
    if(isset($_SESSION['fr_nazwisko'])) unset($_SESSION['fr_nazwisko']);
    if(isset($_SESSION['fr_miejscowosc'])) unset($_SESSION['fr_miejscowosc']);
    if(isset($_SESSION['fr_nr_domu'])) unset($_SESSION['fr_nr_domu']);
    if(isset($_SESSION['fr_zaplata'])) unset($_SESSION['fr_zaplata']);
    if(isset($_SESSION['fr_regulamin'])) unset($_SESSION['fr_regulamin']);
    if(isset($_SESSION['fr_quantity1'])) unset($_SESSION['fr_quantity1']);
    if(isset($_SESSION['fr_quantity2'])) unset($_SESSION['fr_quantity2']);
    if(isset($_SESSION['fr_quantity3'])) unset($_SESSION['fr_quantity3']);

    //usuwanie błędów rejestracji
    if(isset($_SESSION['e_imie'])) unset($_SESSION['e_imie']);
    if(isset($_SESSION['e_nazwisko'])) unset($_SESSION['e_nazwisko']);
    if(isset($_SESSION['e_miejscowosc'])) unset($_SESSION['e_miejscowosc']);
    if(isset($_SESSION['e_nr_domu'])) unset($_SESSION['e_nr_domu']);
    if(isset($_SESSION['e_zaplata'])) unset($_SESSION['e_zaplata']);
    if(isset($_SESSION['e_regulamin'])) unset($_SESSION['e_regulamin']);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bcss/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body >
    
        
  
    <section class="section-thanks">
        <div class="container">
            <div class="col-12">
                <h3>Dziękujemy <b></b> za zamówienie naszej pizzy</h3>
                <p>Zamówienie zostanie wysłane na adres   i dostarczone za (tutaj timer)</p>
                <a href="index.php"> Powrót do strony głównej </a> 
            </div>
        </div>
    </section>



</body>
</html>