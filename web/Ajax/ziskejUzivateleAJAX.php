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
"<div class='grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 m-2 border-2 border-emerald-200 bg-emerald-300'>
    <div class='grid-cols-1 text-center'>Jméno</div>
    <div class='grid-cols-1 text-center'>Příjmení</div>
    <div class='grid-cols-1 text-center'>E-mail</div>
    <div class='grid-cols-1 text-center'>ID Právo</div>
    <div class='grid-cols-1 text-center'>Město</div>
</div>";

//echo "<div class='container'><div class='table-responsive'><table class='table table-hover table-warning'>
//<tr>
//<th>ID</th>
//<th>Jméno</th>
//<th>Příjmení</th>
//<th>E-mail</th>
//<th>ID Právo</th>
//<th>Město</th>
//</tr>";
$idUziv = 0;
while($row = mysqli_fetch_array($result)){
    $idUziv = $row['id'];
    echo
    "<div class='grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 flex-wrap m-2 border-2 border-emerald-200 bg-emerald-300'>
        <div class='grid-cols-1 text-center'>".$row['jmeno']."</div>
        <div class='grid-cols-1 text-center'>".$row['prijmeni']."</div>
        <div class='grid-cols-1 text-center'>".$row['email']."</div>
        <div class='grid-cols-1 text-center'>".$row['id_pravo']."</div>
        <div class='grid-cols-1 text-center'>".$row['mesto']."</div>
    </div>";
}


echo "<tr>
            <td colspan='6'>
                <select name='pravo' onchange='zmenPravo($idUziv,this.value,$idpp)'>
                    <option><b>Zvolte právo pro změnu:</b></option>";
        if($idpp == 1){
            echo   "<option value='2'>Admin</option>";
        }
            echo   "<option value='3'>Dodavatel</option>
                    <option value='4'>Konzument</option>
                </select>
            </td>
         </tr>";
echo "</table></div></div>";
mysqli_close($con);
?>
</body>
</html>