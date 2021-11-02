<?php

$sikeresSzerkesztes=false;

require_once 'db.php';
require_once 'Macskak.php';

$macskaId = $_GET['id'] ?? null;

if ($macskaId === null) {
    header('Location: index.php');
    exit();
}

$macskak = Macskak::getById($macskaId);


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

$sikeres=false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ujNev = $_POST['nev'] ?? '';
    $ujSzuletesi_nap = $_POST['szuletesi_nap'] ?? '';
    $ujSuly = $_POST['suly'] ?? 0;
    $ujNem = $_POST['nem'] ?? '';
    $ujKinezet = $_POST['kinezet'] ?? '';

    $macskak->setNev($ujNev);
    $macskak->setSzuletesi_nap(new DateTime($ujSzuletesi_nap));
    $macskak->setSuly($ujSuly);
    $macskak->setNem($ujNem);
    $macskak->setKinezet($ujKinezet);

    $macskak->mentes();


    $nevMezo=$_POST['nev']??'';
    $szuletesi_napMezo=$_POST['szuletesi_nap']??'';
    $sulyMezo=$_POST['suly'] ?? 0;
    $nemMezo=$_POST['nem'] ?? '';
    $kinezetMezo=$_POST['kinezet'] ?? '';

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

        if(!$nevHiba && !$szuletesi_napHiba && !$sulyHiba && !$nemHiba && !$kinezetHiba){
            $sikeres=true;
        }
    }
    
?><!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Macskák szerkesztése</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>

</head>
<body>
    
<div class=" p-5  text-white text-center">
        <h1>Macskák</h1>
        <p>Macska szerkesztése</p>
    </div>
<?php if(!$sikeres){?>
    <div class="adatok container">
        <form method="POST">

            <div class="row">
                <p class="col-4">Név:</p>
                <div class="col-8"><input type="text"  name="nev" placeholder="Garfield" value='<?php  $macskak->getNev();  ?>'></input></div>
                <div class="hibauzenet"><?php echo $nevHibaUzenet; ?></div>
            </div>

            <div class="row">
                <p class="col-4">Születésnap:</p>
                <div class="col-8"><input type="date" name="szuletesi_nap"  value='<?php  $macskak-> getSzuletesi_nap();  ?>'></input></div>
                <div class="hibauzenet"><?php echo $szuletesi_napHibaUzenet; ?></div>
            </div>

            <div class="row">
                <p class="col-4">nem:</p>
                <div class="col-8"><input type="text" name="nem" placeholder="házi macska" value='<?php   $macskak-> getNem();   ?>'></input></div>
                <div class="hibauzenet"><?php echo $nemHibaUzenet; ?></div>
            </div>

            <div class="row">
                <p class="col-4">Súly:</p>
                <div class="col-8"><input type="number" step=any name="suly" placeholder="25" value='<?php   $macskak-> getSuly();   ?>'></input>kg</div>
                <div class="hibauzenet"><?php echo $sulyHibaUzenet; ?></div>
            </div>

            <div class="row">
                <p class="col-4">Kinézet:</p>
                <div class="col-8"><input type="text" name="kinezet" placeholder="vörös cirmos" value='<?php   $macskak-> getKinezet();   ?>'></input></div>
                <div class="hibauzenet"><?php echo $kinezetHibaUzenet; ?></div>
            </div>

            <div class="row ">
                <div class="col-4 "><input class="hozzaad" type="submit" value="Szerkeszt"></div>
                <a class='linkform col-8' href='index.php?'>Vissza az oldalra</a>
            </div>

        </form>

        <?php } else { ?>
        <h1 class='success'>Az adatok sikeresen modosítva lettek!</h1>
        <a class='linkform col-4' href='index.php?'>Vissza az oldalra</a>
        <?php } ?>
    </div>
</body>
</html>