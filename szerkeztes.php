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
    $ujSuly = $_POST['suly'] ?? '';
    $ujNem = $_POST['nem'] ?? '';
    $ujKinezet = $_POST['kinezet'] ?? '';

    $macskak->setNev($ujNev);
    $macskak->setSzuletesi_nap(new DateTime($ujSzuletesi_nap));
    $macskak->setSuly((int)$ujSuly);
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
    <script src='main.js'></script>

</head>
<body>
    
<?php if(!$sikeres){?>
    <div class="container">
        <form method="POST">
        <form method="post">
        <div class="jumBa p-5  text-white text-center">
            <h1>Macskák</h1>
            <p>Macska szerkesztése</p>
        </div>
            <div class="container hatter">
                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Név:</p>
                    <div class="col-4"><input type="text" name="nev" value="<?php echo $macskak->getNev()?>" minlength="2" required></input></div>
                    <div class="hibauzenet" id="hibaNev"><?php echo $nevHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>


                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Születésnap:</p>
                    <div class="col-4"><input type="date" name="szuletesi_nap" value="<?php echo $macskak->getSzuletesi_nap()->format('Y-m-d')?>" required></input></div>
                    <div class="hibauzenet" id="hibaSzuletesi_nap"><?php echo $szuletesi_napHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Nem:</p>
                    <div class="col-4"><input type="text" name="nem" value="<?php echo $macskak->getNem()?>" required></input></div>
                    <div class="hibauzenet"  id="hibaNem"><?php echo $nemHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Súly:</p>
                    <div class="col-4"><input type="number" name="suly" value="<?php echo $macskak->getSuly()?>" required></input></div>
                    <div class="hibauzenet" id="hibaSuly"><?php echo $sulyHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row">
                    <div class="col-2"></div>
                    <p class="col-4">Kinézet:</p>
                    <div class="col-4"><input type="text" name="kinezet" value="<?php echo $macskak->getKinezet()?>"  minlength="3" required></input></div>
                    <div class="hibauzenet" id="hibaKinezet"><?php echo $kinezetHibaUzenet; ?></div>
                    <div class="col-2"></div>
                </div>

                <div class="row ">
                    <div class="col-2"></div>
                    <div class="col-4 "><button class="btn  btn-light btn-outline-secondary hozzaad col-12" type="submit">Szerkeszt</button></div>
                    <a href="index.php?" class="btn  btn-light btn-outline-secondary col-4">Vissza az oldalra</a>
                    <div class="col-2"></div>
                </div>
            </div>

        <?php } else { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="alert alert-success text-center">
                        <strong>Siker!</strong> Az adatok módosítva lettek! <a href="index.php?" class="alert-link">Visza az oldalra</a>.
                    </div>
                    <img src="barbi.png" alt="barbara" class="barbi img-responsive">
                </div>
            </div>
        <?php } ?>
    </div>
</body>
</html>