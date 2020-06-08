<?php
include 'Hegyek.php';
function beolvas(){
    $tomb=array();
    try{
        $file= file_get_contents("hegyekMo.txt") ;
        $sorok= explode("\n", $file);
        array_shift($sorok);//első sor törlése
        for ($i=0;$i<count($sorok);$i++){
            if(!empty($sorok[$i])){//üres sorok kizárása
                $split= explode(";",$sorok[$i]);
                $hegy=new Hegyek($split[0], $split[1], $split[2]);
                $tomb[]=$hegy;
            }
        }
    } catch (Exception $ex) {
        die("Hiba a fájl beolvasásánál. ".$ex);
    }
    return $tomb;
}

$a=beolvas();

//3. feladat: 
echo'3. feladat: Hegycsúcsok száma: '.count($a)." db <br>";
//4. feladat: 
$osszMag=0;
foreach ($a as $item){
    $osszMag+=$item->getMagassag();
}
echo '4. feladat: Hegycsúcsok átlagos magassága: '. str_replace(".",",",$osszMag/count($a)).'<br>';
//5. feladat: 
echo '5. feladat: A legmagasabb hegycsúcs adatai: <br>';
$max=0;
$maxI=null;
foreach ($a as $item){
    if($item->getMagassag()>$max){
        $max=$item->getMagassag();
        $maxI=$item;
    }
}
$behuzas="&nbsp&nbsp&nbsp&nbsp&nbsp";
echo $behuzas."Név: ".$maxI->getHegyNev()."<br>";
echo $behuzas."Hegység: ".$maxI->getHegyseg()."<br>";
echo $behuzas."Magasság: ".$maxI->getMagassag()." m <br>";

echo"6. feladat: Kérek egy magasságot: ";
echo '<form method="POST" action="#">'
        . '<input type="text" name="szam" >'
        . '<input type="submit" value="Küldés" >'
    . '</form>';

if(isset($_POST['szam'])&&!empty($_POST['szam'])){
    $beker=$_POST['szam'];
    $valasz="Nincs ".$beker."-nél nagyobb hegycsúcs a Börzsönyben. <br>";
    foreach ($a as $item ) {
        if($item->getMagassag()>$beker){
            $valasz="Van ".$beker."-nél nagyobb hegycsúcs a Börzsönyben. <br>";
            break;
        }
    }
    
    echo $behuzas.$valasz;
}

//7. feladat: 
$szamlalo=0;
foreach ($a as $item){
    if(($item->getMagassag()*3.280839895)>3000){
        $szamlalo++;
    }
}
echo'7. feladat: 3000 lábnál magasabb hegycsúcsok száma: '.$szamlalo.'<br>';

//8. feladat: 
echo '8. feladat: Hegység statisztika <br>';
$newArray=array();
foreach ($a as $item){
    $newArray[]=$item->getHegyseg(); //üres tömbbe a hegységeket beleteszem.
}

$newArray= array_count_values($newArray);//értékek szerint csoportosítok. 

                    //hát nem volt feladat a sorbarendezés, de kelleni fog később, hát megcsináltam.
                    $newAssArray=array();
                    foreach ($newArray as $key=>$value){
                        $newAssArray[$key]=$value;
                    }
                    
/*    sort() - sort arrays in ascending order//SORT (asc)
    rsort() - sort arrays in descending order//Reverse SORT
    asort() - sort associative arrays in ascending order, according to the value //Associative SORT (asc)
    ksort() - sort associative arrays in ascending order, according to the key //Key SORT (asc)
    arsort() - sort associative arrays in descending order, according to the value //Associative Reverse SORT
    krsort() - sort associative arrays in descending order, according to the key//Key Reverse SORT
*/
                    arsort($newAssArray);//sort associative arrays in descending order, according to the value //Associative Reverse SORT
                    
foreach ($newAssArray as $key=>$value){
    echo $behuzas.$key." - ".$value." db <br> ";
}

//9. feladat:
$fajlba="Hegycsúcs neve;Magasság láb\n";

foreach ($a as $item){
    if($item->getHegyseg()=="Bükk-vidék"){
        $fajlba.=$item->getHegyNev().";". number_format($item->getMagassag()*3.280839895,1,".","")."\n";
    }
}

$myFile= fopen("bukk-videk.txt", "w");
fwrite($myFile, $fajlba);
echo "9. feladat: bukk-videk.txt";