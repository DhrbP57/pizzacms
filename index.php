<?php

session_start();
    
    if(isset($_POST['imie']))
    {
      //udana walidacja. TAK
      $wszystko_ok=true;
      
      //Sprawdź poprawność imienia
      $imie = $_POST['imie'];

      //sprawdzenie długości imienia
      if((strlen($imie)<3) || (strlen($imie)>20))
      {
          $wszystko_ok=false;
          $_SESSION['e_imie'] = "Podaj prawdziwe imie!";
      }

      //Sprawdź poprawność nazwiska
      $nazwisko = $_POST['nazwisko'];

      //sprawdzenie długości nazwiska
      if((strlen($nazwisko)<3) || (strlen($nazwisko)>20))
      {
          $wszystko_ok=false;
          $_SESSION['e_nazwisko'] = "Podaj prawdziwe nazwisko!";
      }
      //Sprawdź poprawność miejscowosci
      $miejscowosc = $_POST['miejscowosc'];

      //sprawdzenie długości miejscowosci
      if((strlen($miejscowosc)<3) || (strlen($miejscowosc)>20))
      {
          $wszystko_ok=false;
          $_SESSION['e_miejscowosc'] = "Podaj nazwe miejscowosci!";
      }
      //Sprawdź poprawność nr domu
      $nr_domu = $_POST['nr_domu'];

      //sprawdzenie nr domu
      if($nr_domu<1)
      {
          $wszystko_ok=false;
          $_SESSION['e_nr_domu'] = "Podaj nr domu!";
      }

      //sprawdzenie czy zaznaczony zaplata
      if(!isset($_POST['zaplata']))
      {
          $wszystko_ok=false;
          $_SESSION['e_zaplata'] = "Musisz wybrać rodzaj płatności";
      }

      //sprawdzenie czy zaznaczony
      if(!isset($_POST['regulamin']))
      {
          $wszystko_ok=false;
          $_SESSION['e_regulamin'] = "Musisz zaakceptować regulamin";
      }

      //Zapamiętaj wprowadzone dane
      $_SESSION['fr_imie'] = $imie;
      $_SESSION['fr_nazwisko'] = $nazwisko;
      $_SESSION['fr_miejscowosc'] = $miejscowosc;
      $_SESSION['fr_nr_domu'] = $nr_domu;
      if(isset($_POST['zaplata'])) $_SESSION['fr_zaplata'] = true;
      if(isset($_POST['regulamin'])) $_SESSION['fr_regulamin'] = true;

      $_SESSION['fr_quantity1'] = $_POST['quantity1'];
      $_SESSION['fr_quantity2'] = $_POST['quantity2'];
      $_SESSION['fr_quantity3'] = $_POST['quantity3'];

      //nie chodzi
      $_SESSION['fr_option3'] = $_POST['miesna-cena'];


      //WALIDACJA UDANA PRZEŚLIJ DO BAZY!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
      if($wszystko_ok==true)
      {

        $metoda_platnosci=$_POST['zaplata'];

        //zbiera wielkość cene pizzy
        $bogacz_cena = $_POST['bogacz-cena'];
        $hawajska_cena = $_POST['hawajska-cena'];
        $miesna_cena = $_POST['miesna-cena'];

    //ilość
        $quantity1 = $_POST['quantity1'];
        $quantity2 = $_POST['quantity2'];
        $quantity3 = $_POST['quantity3'];  
        $quantity = $quantity1 + $quantity2 + $quantity3;

        //oblicza kwote zamówienia
        $cena_hawajska = $hawajska_cena*$quantity1;
        $cena_bogacza = $bogacz_cena*$quantity2;
        $cena_miesna = $miesna_cena*$quantity3;
        $cena_zamowienia = $cena_hawajska + $cena_bogacza + $cena_miesna;

        //zamienia cene pizzy na jej wielkość
        if($hawajska_cena == 18){$hawajska_cena="mala";}
        if($hawajska_cena == 21){$hawajska_cena="srednia";}
        if($hawajska_cena == 25){$hawajska_cena="duza";}

        if($bogacz_cena == 24){$bogacz_cena="mala";}
        if($bogacz_cena == 27){$bogacz_cena="srednia";}
        if($bogacz_cena == 29){$bogacz_cena="duza";}

        if($miesna_cena == 19){$miesna_cena="mala";}
        if($miesna_cena == 22){$miesna_cena="srednia";}
        if($miesna_cena == 25){$miesna_cena="duza";}


    //dodawanie do bazy danych
    
        $p=mysqli_connect('localhost','root','','pizzacms2');

        //do polskich znaków
        mysqli_query($p, "SET NAMES 'UTF8'");

   
/*
      $zap1=mysqli_query($p,"INSERT INTO `zamowienia` ( `Imie`, `Nazwisko`, `Miejscowosc`, `nr_domu`,`metoda_platnosci`, `ilosc`, `hawajska`, `h_wielkosc`, `bogacz`, `b_wielkosc`, `miesna`, `m_wielkosc`, `cena_zam`, `data`) VALUES ('$imie', '$nazwisko', '$miejscowosc', '$nr_domu', '$metoda_platnosci','$quantity', '$quantity1','$hawajska_cena', '$quantity2', '$bogacz_cena', '$quantity3', '$miesna_cena', '$cena_zamowienia', NOW());"); */
      $zap1=mysqli_query($p,"INSERT INTO `klienci` ( `imie`, `nazwisko`, `miejscowosc`, `nr_domu`) VALUES ('$imie', '$nazwisko', '$miejscowosc', '$nr_domu');"); 

      $zap2=mysqli_query($p,"INSERT INTO `wartosc` ( `hawajska`, `h_wielkosc`, `bogacz`, `b_wielkosc`, `miesna`, `m_wielkosc`, `ilosc`, `cena`, `data`) VALUES ( '$quantity1','$hawajska_cena', '$quantity2', '$bogacz_cena', '$quantity3', '$miesna_cena', '$quantity','$cena_zamowienia', NOW());"); 

      $zap3=mysqli_query($p,"INSERT INTO `zamowienia` ( `id_pracownicy`, `id_kierowcy`, `metoda_platnosci`, `data`) VALUES ( '1', '1', '$metoda_platnosci', NOW());"); 
        
    


        mysqli_close($p);  
        header('Location: finish.php'); exit();
      }

    }

?>



<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <!--FONT GOOGLE-->
    <link href='http://fonts.googleapis.com/css?family=Autour+One&subset=latin,latin-ext' rel='stylesheet' type='text/css'>


    <link rel="stylesheet" href="bcss/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!--<link rel="stylesheet" href="css/mobile.css">-->


    <style>
        .error
        {
            color: red;
        }

    </style>
</head>
<body onload="count()">

    <div class="main-container">

    <!--HEADER-NAVBAR-->    
        <section class="section-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="big-foto">
                        <img src="img/logo.png">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="menu">
                        <ul>
                            <li>
                                <a href="#">Start</a>
                            </li>
                            <li class="underline">
                                <a href="#">Menu</a>
                            </li>
                            <li>
                                <a href="#">Kontakt</a>
                            </li>
                        </ul>  
                        </div> 
                    </div>
                </div>
            </div>
        </section>

<form method="post">
    <!--PRODUCTS-->
        <section class="section-products">
            <div class="container">
                <h2>PIZZE:</h2>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inscription">
                                <h3>Hawajska</h3>
                                <ul>
                                    <li>Kurczak</li>
                                    <li>Ser</li>
                                    <li>pomidorowy sos</li>
                                    <li>ANANAS</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pizza-foto">
                                <img src="img/pizza.png">
                                <h4>Cena: <div class="price price1" id="price1">18zł.</div></h4>
                                <select class="option1 form-control" id="option1" name="hawajska-cena" onchange="count()">
                                    <option selected hidden value="0">-WIELKOŚĆ-</option>
                                    <option value="18">mała</option>
                                    <option value="21">średnia</option>
                                    <option value="25">duża</option>
                                </select>
                                <input type="number" class="form-control" id="quantity1" name="quantity1" onchange="count()" min="0" value="<?php
                                    if(isset($_SESSION['fr_quantity1']))
                                    {
                                        echo $_SESSION['fr_quantity1'];
                                        unset($_SESSION['fr_quantity1']);
                                    }
                                ?>">
                                <h3>
                                    Ilość
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--next product-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inscription">
                                <h3>Bogacz</h3>
                                <ul>
                                    <li>Kurczak drogi</li>
                                    <li>Szynka droga</li>
                                    <li>pomidorowy sos bardzo drogi</li>
                                    <li>WSZYSTKO CO NAJDROŻSZE</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pizza-foto">
                                <img src="img/pizza.png">
                                <h4>Cena:<div class="price price2" id="price2">24zł.</div></h4>
                                <select class="option2 form-control" id="option2" name="bogacz-cena" onchange="count()">
                                    <option selected hidden value="0">-WIELKOŚĆ-</option>
                                    <option value="24">mała</option>
                                    <option value="27">średnia</option>
                                    <option value="29">duża</option>
                                </select>
                                <input type="number" class="form-control" id="quantity2" name="quantity2" onchange="count()" min="0" value="<?php
                                    if(isset($_SESSION['fr_quantity2']))
                                    {
                                        echo $_SESSION['fr_quantity2'];
                                        unset($_SESSION['fr_quantity2']);
                                    }
                                ?>">
                                <h3>
                                    Ilość
                                </h3>
                            </div>
                        </div>
                    </div>
                    <!--next product-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="inscription">
                                <h3>Mięsna</h3>
                                <ul>
                                    <li>Kurczak</li>
                                    <li>Szynka</li>
                                    <li>Mięso kebab</li>
                                    <li>Baranina</li>
                                    <li>MIELONY</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pizza-foto">
                                <img src="img/pizza.png">
                                <h4>Cena: <div class="price price3" id="price3" >19zł.</div></h4>
                                <select class="option3 form-control" id="option3" name="miesna-cena" onchange="count()" value="<?php
                                    if(isset($_SESSION['fr_option3']))
                                    {
                                        echo $_SESSION['fr_option3'];
                                        unset($_SESSION['fr_option3']);
                                    }
                                ?>">
                                    <option selected hidden value="0">-WIELKOŚĆ-</option>
                                    <option class="little" value="19">mała</option>
                                    <option class="middle" value="22">średnia</option>
                                    <option class="big" value="25">duża</option>
                                </select>
                                <input type="number" class="quantity3 form-control" id="quantity3" name="quantity3" onchange="count()" min="0" value="<?php
                                    if(isset($_SESSION['fr_quantity3']))
                                    {
                                        echo $_SESSION['fr_quantity3'];
                                        unset($_SESSION['fr_quantity3']);
                                    }
                                ?>">
                                <h3>
                                    Ilość
                                </h3>
                                
                            </div>
                        </div>
                    </div>
               
            </div>

        </section>

        <hr>
    <!--ORDER-->
        <section class="section-order">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                    </div>               
                        
                    
                    <div class="col-md-3">
                        <div id="sum" class="sum">
                            SUMA: 0zł
                        </div>
                        <div class="col-md-3">
                            <button type="button" onclick="next()" id="next-form" class="next-form btn btn-success">DALEJ</button> 
                        </div>
                        <!--JS-->
                    </div>
                </div>
            </div>
        </section>


    <!--FORM-->
        <section class="section-form">
            <div class="container">
                <!--STEP1-->
                <div class="row">
                    <div class="step" id="step">
                        <div class="col-12">
                            <h3>Krok 1: dane</h3 >
                        </div>
                            <!--IMIE-->
                            <div class="col-md-6">
                                <p>imie: </p>
                                <input type="text" name="imie" maxlenght="15" value="<?php
                                    if(isset($_SESSION['fr_imie']))
                                    {
                                        echo $_SESSION['fr_imie'];
                                        unset($_SESSION['fr_imie']);
                                    }
                                ?>" >
                                <?php //wyrzuca błąd
                                if(isset($_SESSION['e_imie']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_imie'].'</div';
                                    unset($_SESSION['e_imie']);
                                }
                                ?>
                            </div>

                            <!--Nazwisko-->
                            <div class="col-md-6">
                                <p>nazwisko: </p>
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="nazwisko" maxlenght="15" value="<?php
                                    if(isset($_SESSION['fr_nazwisko']))
                                    {
                                        echo $_SESSION['fr_nazwisko'];
                                        unset($_SESSION['fr_nazwisko']);
                                    }
                                ?>">


                                <?php //wyrzuca błąd
                                if(isset($_SESSION['e_nazwisko']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_nazwisko'].'</div';
                                    unset($_SESSION['e_nazwisko']);
                                }
                                ?>
                            </div>                       
                <!--STEP2-->
                        <div class="col-12">
                            <h3>Krok 2: adres</h3 >
                        </div>
                            <!--Miejscowosc-->
                            <div class="col-md-6">
                                <p>miejscowość: </p>
                                <input type="text" name="miejscowosc" maxlenght="20" value="<?php
                                    if(isset($_SESSION['fr_miejscowosc']))
                                    {
                                        echo $_SESSION['fr_miejscowosc'];
                                        unset($_SESSION['fr_miejscowowsc']);
                                    }
                                ?>">
                                <?php //wyrzuca błąd
                                if(isset($_SESSION['e_miejscowosc']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_miejscowosc'].'</div';
                                    unset($_SESSION['e_miejscowosc']);
                                }
                                ?>
                            </div>
                            <!--nR domu-->
                            <div class="col-md-6">
                                <p>nr domu: </p>
                            </div>
                            <div class="col-md-6">
                                <input type="number" name="nr_domu" min="1" maxlenght="5" value="<?php
                                    if(isset($_SESSION['fr_nr_domu']))
                                    {
                                        echo $_SESSION['fr_nr_domu'];
                                        unset($_SESSION['fr_nr_domu']);
                                    }
                                ?>">
                                <?php
                                if(isset($_SESSION['e_nr_domu']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_nr_domu'].'</div';
                                    unset($_SESSION['e_nr_domu']);
                                }
                                ?>
                            </div>
                <!--STEP3-->
                        <div class="col-12">
                            <h3>Krok 3: metoda płatności</h3 >
                        </div>
                            <div class="col-md-6">
                                <label>       
                                    <p>gotówką przy odbiorze: </p>
                                    <input type="radio" name="zaplata" value="gotowka" <?php 
                                        if(isset($_SESSION['fr_zaplata']))
                                        {
                                            echo "checked";
                                            unset($_SESSION['fr_zaplata']);
                                        }
                                    ?>>  
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label>
                                    <p>katą przy odbiorze: </p>
                                    <input type="radio" name="zaplata" value="karta" <?php 
                                        if(isset($_SESSION['fr_zaplata']))
                                        {
                                            echo "checked";
                                            unset($_SESSION['fr_zaplata']);
                                        }
                                    ?>>
                                </label>
                            </div>
                            <?php
                                if(isset($_SESSION['e_zaplata']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_zaplata'].'</div';
                                    unset($_SESSION['e_zaplata']);
                                }
                                ?>
                            <label>
                                <div class="col-md-6">
                                    <input type="checkbox" name="regulamin" <?php 
                                        if(isset($_SESSION['fr_regulamin']))
                                        {
                                            echo "checked";
                                            unset($_SESSION['fr_regulamin']);
                                        }
                                    ?>>
                                    oświadczam że zapoznałem się z regulaminem
                                </div>
                            </label>
                            <?php
                                if(isset($_SESSION['e_regulamin']))
                                {
                                    echo '<div class="error">'.$_SESSION['e_regulamin'].'</div';
                                    unset($_SESSION['e_regulamin']);
                                }
                                ?>
                        <div class="col-12">
                            <input type="submit" value="ZAMAWIAM" class="btn btn-success"> 
                        </div>
                    </div> 
                </div>             
            </div>
        </section>
        
    
    <!--FOOTER-->
        <section class="section-footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="copy">
                            Wszelkie prawa zastrzeżone &copy; 2019.
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="name">
                            Potocki Dawid 
                        </div>
                    </div>
                </div>
            </div>
        </section>


</form>
    </div class="main-container">
   


    <!--JAVA SCRIPT-->
    <script type="text/javascript">
        
        
        //wybranie wielkości pizzy nr3
        const selectElement3 = document.querySelector('.option3');

        selectElement3.addEventListener('change', (event) => {
        const result = document.querySelector('.price.price3');
        result.textContent = `${event.target.value}zł.`;
        });
        //wybranie wielkości pizzy nr2
        const selectElement2 = document.querySelector('.option2');

        selectElement2.addEventListener('change', (event) => {
        const result = document.querySelector('.price.price2');
        result.textContent = `${event.target.value}zł.`;
        });

        //wybranie wielkości pizzy nr1
        const selectElement1 = document.querySelector('.option1');

        selectElement1.addEventListener('change', (event) => {
        const result = document.querySelector('.price.price1');
        result.textContent = `${event.target.value}zł.`;
        });


        
        function count()
        {
            var quantity1 = document.getElementById("quantity1").value;
            var quantity2 = document.getElementById("quantity2").value;
            var quantity3 = document.getElementById("quantity3").value;

            //bierze cene w zależności od wielkości pizzy
            var size1 = document.getElementById("option1").value;
            var size2 = document.getElementById("option2").value;
            var size3 = document.getElementById("option3").value;

            if(quantity1 < 0){quantity1=0};
            if(quantity2 < 0){quantity2=0};
            if(quantity3 < 0){quantity3=0};

            quantity3 = Math.ceil(quantity3);
            quantity2 = Math.ceil(quantity2);
            quantity1 = Math.ceil(quantity1);


            var sum = quantity1*size1 + quantity2*size2 + quantity3*size3;
            document.getElementById("sum").innerHTML = 'SUMA: ' + sum +'zł';

            if(sum>0)
            {
                document.getElementById("next-form").classList.add("next-button");
            }
            if(sum==0)
            {
                document.getElementById("next-form").classList.remove("next-button");
                document.getElementById("step").classList.remove("step-see");
            }
        }


        //pokazuje formularz
        function next()
        {
            document.getElementById("step").classList.add("step-see");
        }


    </script>
</body>
</html>