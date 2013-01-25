<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/1999/PR-xhtml1-19991210/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="es_ES.UTF-8">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=8" />
  <link rel="home" href="http://www.spahost.es/" />
  <title>Seur Get Status Info</title>
  <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style type="text/css">
          html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f5f5f5;
      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      .container {
        width: auto;
        max-width: 680px;
      }
      .container .credit {
        margin: 20px 0;
      }
    h9 { font-family: 'Cedarville Cursive', cursive; font-weight: 400; font-size: 30px; line-height: 100px}
    .flecha { position: absolute; right: 29%; top: 60px; width:10%; }
    .sep { margin-bottom: 100px;}
  </style>
</head>
<!-- Termina la cabecera -->
<body>
   <!-- Part 1: Wrap all page content here -->
    <div id="wrap">

      <!-- Begin page content -->
      <div class="container">
        <div class="page-header">
          <h1><a href="/seur.php">Seur Get Status v0.1</a> <small>Para todos! Y gratis!</small></h1>
        </div>

<?php

$page_loc = $_REQUEST[localizador];

if (!$page_loc) {
?>

        <form class="form-search pull-right" action="seur.php?localizador" method="REQUEST">
          <input type="text" name="localizador" class="search-query span2" placeholder="Buscar Localizador">
          <button type="submit" class="btn">Buscar</button>
        </form>
        <p class="lead">Introduce tu numero de localizador en el cuadro de la derecha. Cuidado... nadie es perfecto, asi que no aseguro nada! Suerte!</p>
      </div>
      <div id="push"></div>
    </div>

<?php
} else {

ini_set("user_agent","Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
ini_set("accept_language","es-ES,es;q=0.8");
ini_set("max_execution_time", 50);
$web_seur = 'http://www.seur.es/seguimiento-online.do?segOnlineIdentificador='.$page_loc;
$acachear = file_get_contents($web_seur);
// Datos del envio/recogida
preg_match_all("#<td class=\"(.*)\">(.*)</td>#i", $acachear, $datos);
// Datos de progreso
preg_match_all("#<div class=\"descripcion\">(.*)</div>#", $acachear, $prog_desc);
preg_match_all("#<div class=\"hora\">(.*)</div>#", $acachear, $prog_hora);


echo '
<div class="row">
<div class="span3">
<h5>Localizador:</h5> <h6>'.$datos[0][1].'</h6><br>
<h5>Servicio:</h5> <h6>'.$datos[0][3].'</h6><br>
<h5>Alta de solicitud:</h5> <h6>'.$datos[0][5].'</h6><br>
<h5>Bultos:</h5> <h6>'.$datos[0][7].'</h6><br>
<h5>Kilos:</h5> <h6>'.$datos[0][9].'</h6><br>
<h5>Remite:</h5> <h6>'.$datos[0][11].'</h6><br>
<h5>Destino:</h5> <h6>'.$datos[0][13].'</h6><br>
<h5>Fecha de Recogida:</h5> <h6>'.$datos[0][15].'</h6><br>
</div>

<div class="span3">
<h5>'.$prog_desc[0][0].'</h5> <h6>'.$prog_hora[0][0].'</h6>
<h5>'.$prog_desc[0][1].'</h5> <h6>'.$prog_hora[0][1].'</h6>

</div>
</div>';


?>

      </div>

      <div id="push"></div>
    </div>



<?php  
}
?>

    <div id="footer">
      <div class="container">
        <p class="muted credit"><a href="https://github.com/SpaHost/seur-get-status"> Seur-Get-Status v0.1</a> By <a href="http://www.spahost.es">SpaHost</a>.</p>
      </div>
    </div>