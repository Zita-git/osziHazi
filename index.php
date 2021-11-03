<?php

require_once 'db.php';
require_once 'Macskak.php';

function visszatolt($szoveg){
    echo htmlspecialchars($szoveg, ENT_QUOTES);
}
$nevMezo= '';
$szuletesi_napMezo= '';
$sulyMezo= '';
$nemMezo= '';
$kinezetMezo= '';



$nevHiba = false;
$nevHibaUzenet = '';
$szuletesi_napHiba = false;
$szuletesi_napHibaUzenet = '';
$sulyHiba = false;
$sulyHibaUzenet = '';
$nemHiba = false;
$nemHibaUzenet = '';
$kinezetHiba = false;
$kinezetHibaUzenet = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nevMezo=$_POST['nev']??'';
    $szuletesi_napMezo=$_POST['szuletesi_nap']??'';
    $sulyMezo=$_POST['suly'] ?? '';
    $nemMezo=$_POST['nem'] ?? '';
    $kinezetMezo=$_POST['kinezet'] ?? '';


    $deleteId = $_POST['deleteId'] ?? '';

    if ($deleteId !== '') {
        Macskak::torol($deleteId);
    } else {
        
        $ujNev = $_POST['nev'] ?? '';
        if (empty($_POST['nev'])) {
            $nevHiba = true;
            $nevHibaUzenet = 'Addja meg a cica nevét!';
        }

        $ujSzuletesi_nap = $_POST['szuletesi_nap'] ?? '';
        if (empty($_POST['szuletesi_nap'])) {
            $szuletesi_napHiba = true;
            $szuletesi_napHibaUzenet = 'A cicának a születési dátuma fontos,<br>ha nem tudod pontosan akkor elég egy körülbelüli időpont is!';
        }

        $ujSuly = $_POST['suly'] ?? '';
        if (empty($_POST['suly'])) {
            $sulyHiba = true;
            $sulyHibaUzenet = 'A cica súlyát el felejtette megadni,<br>nem kell pontos adat!';
        }elseif (!is_numeric($_POST['suly'])) {
            $sulyHiba = true;
            $sulyHibaUzenet = 'A cica súlya szám formátumban kéretett!';
        }

        $ujNem = $_POST['nem'] ?? '';
        if (empty($_POST['nem'])) {
            $nemHiba = true;
            $nemHibaUzenet = 'A cicája nemét kérem adja meg! <br>(Ajánlatos a hátsó lábai közé nézni)';
        }

        $ujKinezet= $_POST['kinezet'] ?? 0;
        if (empty($_POST['kinezet'])) {
            $kinezetHiba = true;
            $kinezetHibaUzenet = 'A cica kinézetét kérem adjam meg!';
        }
        

        if (!$nevHiba && !$szuletesi_napHiba && !$sulyHiba && !$nemHiba && !$kinezetHiba) {
            $ujMacska = new Macskak($ujNev, new DateTime($ujSzuletesi_nap), $ujSuly, $ujNem, $ujKinezet);
            
            $ujMacska->uj();

            $nevMezo= '';
            $szuletesi_napMezo= '';
            $sulyMezo= '';
            $nemMezo= '';
            $kinezetMezo= '';
        }
    }
    
}

$macskak = Macskak::osszes();


?><!DOCTYPE html>
<html>
    <head>
        <title>Macskak</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
        <script src='main.js'></script>
    </head>
    <body>
    <div class="jumBa container p-5  text-white text-center">
        <h1>Macskák</h1>
        <p>Új macskák megadása</p>
    </div>
    <div class="container-fluid">
        <div class='container hatter'>
            <form method="POST">

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Név:</p>
                    <div class="col-4"><input type="text" id="nev" name="nev" placeholder="Garfield" value='<?php visszatolt($nevMezo) ?>' minlength="2" required></input></div>
                    <div class="hibauzenet" id="hibaNev" ><?php echo $nevHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Születésnap:</p>
                    <div class="col-4"><input type="date" id="szuletesi_nap" name="szuletesi_nap"  value='<?php visszatolt($szuletesi_napMezo) ?>' required></input></div>
                    <div class="hibauzenet" id="hibaSzuletesi_nap"><?php echo $szuletesi_napHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Nem:</p>
                    <div class="col-4"><input type="text" id="nem" name="nem" placeholder="házi macska" value='<?php visszatolt($nemMezo) ?>' required></input></div>
                    <div class="hibauzenet" id="hibaNem"><?php echo $nemHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Súly:</p>
                    <div class="col-4"><input type="number" id="suly" step=any name="suly" placeholder="25" value='<?php visszatolt($sulyMezo) ?>' required></input>kg</div>
                    <div class="hibauzenet" id="hibaSuly"><?php echo $sulyHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Kinézet:</p>
                    <div class="col-4"><input type="text" id="kinezet" name="kinezet" placeholder="vörös cirmos" value='<?php visszatolt($kinezetMezo) ?>' minlength="3" required></input></div>
                    <div class="hibauzenet" id="hibaKinezet"><?php echo $kinezetHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <div class="col-4 "><input class="btn  btn-light btn-outline-secondary" id="ujCica" type="submit" value="Új macska hozzáadása"></div>
                    <div class="col-4"></div>
                </div>

            </form>
        </div>
    </div >

    <div class="container">
        <div class="row">
            
            <?php
                foreach ($macskak as $macska) {
                    echo "<div class='card col-lg-3 col-4 col-md-6 col-sm-12' >";
                        echo "<h3 class='card-header '>";
                        echo $macska->getNev();
                        echo "</h3>";
                        echo "<div class='card-body'>";
                            echo "<p>" . $macska->getSzuletesi_nap()->format('Y-m-d') . "</p>";
                            echo "<p>" . $macska->getNem(). "</p>";
                            echo "<p>" . $macska->getSuly(). " kg</p>";
                            echo "<p>" . $macska->getKinezet() . "</p>";
                        echo "</div>";
                        echo "<form method='POST'>";
                            echo "<div class='card-footer '>";
                                echo "<input type='hidden' name='deleteId' value='" . $macska->getId() . "'>";
                                echo "<button class='btn btn-light btn-outline-secondary col-6' type='submit'>Törlés</button>";
                                echo "<a class='btn  btn-light btn-outline-secondary col-6' href='szerkeztes.php?id=" . $macska->getId() . "'>Szerkesztés</a>";
                            echo "</div>";
                        echo "</form>";
                    echo "</div>";
                    
       
                }
            ?>
            
        </div>
    </div >
    </body>
</html>