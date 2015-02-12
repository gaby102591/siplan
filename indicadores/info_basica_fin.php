<?php
$mysqli->query("SET NAMES utf8");
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
indpro.fin_observaciones as observaciones
FROM proyectos pr
inner join dependencias dep on(pr.id_dependencia = dep.id_dependencia)
inner join sectores sc on(dep.id_sector = sc.id_sector)
inner join indicadores_proyecto as indpro on (pr.id_proyecto=indpro.id_proyecto)
WHERE pr.id_proyecto = ".$idproyecto;
$ex_consulta = $mysqli->query($consulta);
$res_consulta = $ex_consulta->fetch_assoc();
?>
<ul class="nav nav-tabs">
  <li role="presentation" id="basica" class="active"><a href="#">Información Básica</a></li>
  <li role="presentation" id="numerica"><a href="main.php?token=17e62166fc8586dfa4d1bc0e1742c08b&idproyecto=94&info=2&tipoind=1">Información Númerica</a></li>
  <li role="presentation" id="grafica"><a href="main.php?token=17e62166fc8586dfa4d1bc0e1742c08b&idproyecto=94&info=3&tipoind=1">Gráficos</a></li>
</ul>
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
<br>
<div class="panel panel-default">
<div class="panel-heading"><strong>Observaciones</strong></div>
<div class="panel-body">
<?php echo $res_consulta['observaciones']; ?>
</div>
</form>
