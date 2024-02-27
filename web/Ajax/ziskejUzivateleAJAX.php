<!DOCTYPE html>
<html lang="cs">
<head>
    <title>Ziskani uzivatele</title>
</head>
<body>

<?php

/**
 * Získání uživatel z databáze za použití AJAXU
 */

$q = intval($_GET['q']);
$idpp = intval($_GET['idpp']);

$con = mysqli_connect('localhost','root','');
if (!$con) {
    die('Nelze se připojit: ' . mysqli_error($con));
}

mysqli_select_db($con,"web");
$sql="SELECT * FROM uzivatel WHERE id ='".$q."'";
$result = mysqli_query($con,$sql);

echo
"<div class='grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 ml-2 mr-2 border-2 border-emerald-200 bg-emerald-300'>
    <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>Jméno</div>
    <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>Příjmení</div>
    <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>E-mail</div>
    <div class='grid-cols-1 text-center border-b-2 border-emerald-100'>ID Právo</div>
    <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>Město</div>
</div>";

$idUziv = 0;
while($row = mysqli_fetch_array($result)){
    $idUziv = $row['id'];
    echo
    "<div class='grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 flex-wrap ml-2 mr-2 border-2 border-emerald-200 bg-emerald-300'>
        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>".$row['jmeno']."</div>
        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>".$row['prijmeni']."</div>
        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>".$row['email']."</div>
        <div class='grid-cols-1 text-center border-b-2 border-emerald-100'>".$row['id_pravo']."</div>
        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>".$row['mesto']."</div>
    </div>";
}

echo
"<div class='ml-2 '>
    <select name='pravo' onchange='zmenPravo($idUziv,this.value,$idpp)'>
        <option>Zvolte právo pro změnu:</option>";
            if($idpp == 1){
                echo
                "<option value='2'>Admin</option>";
            }
echo
       "<option value='3'>Dodavatel</option>
        <option value='4'>Konzument</option>
    </select>
</div>";
mysqli_close($con);
?>
</body>
</html>