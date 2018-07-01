<?php

$file = fopen("categorie.txt","r");
$i = 1;
$t = 1;
while (!feof($file))
{     
	$buffer = fgets($file);
	if(strpos($buffer,"=>")){
	   
	   $z = $i;
	   $famille = explode("=>",$buffer)[1];
	   echo "INSERT INTO famille(id,actif,libelle,num_ordre) VALUES ('".$i."','1','".$famille."','".$i."');</br>"; 
       $i++;  	   
	}else{
	   echo "INSERT INTO categorie(id,actif,libelle,famille_id,num_ordre) VALUES('".$t."','1','".$buffer."','".$z."','".$t."');</br>";
	   $t++;
	}   
}
fclose($file);