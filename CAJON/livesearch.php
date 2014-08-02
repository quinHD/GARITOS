<?php
  //get the q parameter from URL
  $q=$_GET["q"];

  //lookup all links from the xml file if length of q>0
  if (strlen($q)>0) 
  {
    $hint="";
    //Conectamos al SGDB
    if(!($iden = mysql_connect("localhost","root","root")))
      die ("No se ha podido conectar");

    //Conectamos a la base de datos
    if(!mysql_select_db("garitos",$iden))
      die ("No se ha encontrado la base de datos");

    $sentencia = "SELECT caracteristica FROM t_caracteristica WHERE caracteristica like '".$q."%'";

    
    $resultado = mysql_query($sentencia,$iden);

    
    //Si existe el usuario introducido lo cargamos
    if(mysql_num_rows($resultado)>0)
    { 
      while($fila = mysql_fetch_assoc($resultado))
      {
        $caract = $fila['caracteristica'];
        $hint = $hint.'<span class="resultadoLivSearch" onclick="addCaract(';
        $hint = $hint."'".$caract."'";
        $hint = $hint.')">';
        $hint = $hint.$caract;
        $hint = $hint."</span></br>";
      }
    }
  }

  // Set output to "no suggestion" if no hint were found
  // or to the correct values
  if ($hint=="") {
    $response="sin sugerencias";
  } else {
    $response=$hint;
  }

  //output the response
  echo $response;
?>