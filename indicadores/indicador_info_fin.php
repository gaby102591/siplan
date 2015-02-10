<?php
$mysqli = new mysqli("localhost", "root", "tr15t4n14", "siplan2015");
if ($mysqli->connect_errno) {
  echo "Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
if(isset($_GET['idproyecto'])){
    $idproyecto = $_GET['idproyecto'];
}else{
    $idproyecto=0;
}
$consulta = "SELECT
sc.id_sector as num_sector,
sc.sector as sector,
dep.id_dependencia as num_dep,
dep.nombre as dependencia,
pr.no_proyecto as num_proyecto,
pr.nombre as proyecto,
indpro.fin_objetivo as objetivo,
indpro.nombre_fin as nombre,
indpro.metodo_fin as metodo,
indpro.fin_calculado as calculado,
indpro.fin_resultado as resultado,
indpro.fin_observaciones as observaciones
FROM proyectos pr
inner join dependencias dep on(pr.id_dependencia = dep.id_dependencia)
inner join sectores sc on(dep.id_sector = sc.id_sector)
inner join indicadores_proyecto as indpro on (pr.id_proyecto=indpro.id_proyecto)
WHERE pr.id_proyecto = ".$idproyecto;
$ex_consulta = $mysqli->query($consulta);
$res_consulta = $ex_consulta->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Información del Indicador</title>
  <!-- Bootstrap Core CSS -->
  <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- MetisMenu CSS -->
  <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
  <!-- Timeline CSS -->
  <link href="dist/css/timeline.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="dist/css/sb-admin-2.css" rel="stylesheet">
  <!-- Morris Charts CSS -->
  <link href="bower_components/morrisjs/morris.css" rel="stylesheet">
  <!-- Custom Fonts -->
  <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>
  <div id="wrapper" style="padding-left:3%;padding-right:3%;">
<h2 class="page-header">Información del Indicador - Indicadores FIN</h2>
    <div class="row">
      <div class="col-lg-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Información del Indicador
          </div>

          <!-- /.panel-heading -->
          <div class="panel-body">
            <div class="dataTable_wrapper">

              <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Imprimir</button>
              <button type="button" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Exportar</button>
              <p>&nbsp;</p>
             <form>
               <div class="input-group">
                   <span class="input-group-addon" id="sizing-addon2"><b>Sector</b></span>
  <input type="text" class="form-control" aria-describedby="sizing-addon2" value="<?php echo $res_consulta['num_sector']." ".$res_consulta['sector']; ?>" readonly>
</div><br>
                 <div class="input-group">
                     <span class="input-group-addon" id="sizing-addon2"><b>Dependencia</b></span>
  <input type="text" class="form-control" aria-describedby="sizing-addon2" value="<?php echo $res_consulta['num_dep']." ".$res_consulta['dependencia']; ?>" readonly >
</div><br>

                 <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2">Proyecto</span>
  <input type="text" class="form-control" aria-describedby="sizing-addon2" value="<?php echo $res_consulta['num_proyecto']." ".$res_consulta['proyecto']; ?>" readonly>
</div><br>

    <div class="panel panel-default">
  <div class="panel-heading"><strong>Objetivos</strong></div>
  <div class="panel-body">
    <?php echo $res_consulta['objetivo']; ?>
  </div>
</div>

                 <div class="panel panel-default">
  <div class="panel-heading"><strong>Nombre del Indicador</strong></div>
  <div class="panel-body">
    <?php echo $res_consulta['nombre']; ?>
  </div>
</div>

                                  <div class="panel panel-default">
  <div class="panel-heading"><strong>M&eacute;todo de C&aacute;lculo</strong></div>
  <div class="panel-body">
    <?php echo $res_consulta['metodo']; ?>
  </div>
</div>

                 <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2">Cálculo al 31 de diciembre de 2014</span>
  <input type="text" class="form-control" aria-describedby="sizing-addon2" value=" <?php echo $res_consulta['calculado']; ?>">
</div><br>

                 <div class="input-group">
  <span class="input-group-addon" id="sizing-addon2">Resultado</span>
  <input type="text" class="form-control" aria-describedby="sizing-addon2" value=" <?php echo $res_consulta['resultado']; ?>">
</div><br>

                                      <div class="panel panel-default">
  <div class="panel-heading"><strong>Observaciones</strong></div>
  <div class="panel-body">
     <?php echo $res_consulta['observaciones']; ?>
  </div>
</div>
             </form>
            </div>
          </div>
        </div>
        </div></div>



    </div>

  </body>

  </html>
