<?php
echo "<a href = 'rpts/c74_xls.php' target='_blank'>Descargar c74 XLS</a><br>
<br><h3>Archivo c74</h3><br>
<table width='100%' border='1' cellspacing='0' cellpadding='0'>";
$oficios = $conexion->query("select id_oficio from oficio_aprobacion where estatus_sefin = 0 and tipo = 0");
while($r_of = $oficios->fetch_assoc()){

	$id_oficio = $r_of['id_oficio'];
    unset($r_of);
	$detalle_oficio = $conexion->query("SELECT id_poa02,id_proyecto FROM detalle_oficio WHERE id_oficio = ".$id_oficio);

	while($d_of = $detalle_oficio->fetch_assoc()){
		$id_proy = $d_of["id_proyecto"];
		$consulta_poa02 = $conexion->query("select obra,consxdep from obras where id_obra = ".$d_of["id_poa02"]);
	    $r_obras = $consulta_poa02->fetch_assoc();
	    $obra = $r_obras["obra"];
	    $consxdep = $r_obras["consxdep"];
		unset($r_obras);
		$consulta_poa02->free();
        $consulta_poa02_origen = $conexion->query("SELECT * FROM poa02_origen where id_poa02 =".$obra,$siplan_data_conn) or die (mysql_error());
		while($r_origen = $consulta_poa02_origen->fetch_assoc()){
			$consulta_proyecto = $conexion->query("SELECT id_dependencia,no_proyecto from proyectos WHERE id_proyecto = ".$id_proy);
			$rpro = $consulta_proyecto->fetch_assoc();
			$idep = $rpro["id_dependencia"];
			$noproy = $rpro["no_proyecto"];
			unset($rpro);
			$consulta_proyecto->free();
			$consulta_dep = $conexion->query("SELECT id_dependencia,id_sector FROM dependencias where id_dependencia = ".$idep);
			$r_dep = $consulta_dep->fetch_assoc();
			$id_dep = $r_dep["id_dependencia"];
			$id_sector = $r_dep["id_sector"];
			unset ($r_dep);
			$consulta_dep->free();
			echo "<tr>";
			echo "<td>$id_sector</td>";
			echo "<td>$id_dep</td>";
			$poa_proyecto = $r_origen["s06c_proyec"];
			$poa_partid = $r_origen["s07c_partid"];
			$poa_origen = $r_origen["s08c_origen"];
			$poa_compon = $r_origen["s11c_compon"];
			$poa_accion = $r_origen["s25c_accion"];
		    $cons_edo_fin = $conexion->query("SELECT
		    s03c_objeti as obj,s04c_progra as pro,s05c_subpro as subpro
		    FROM estados_financieros WHERE
		    s01c_sector = '$id_sector' AND
		    s02c_depend = '$id_dep' AND
		    S06c_proyec = '$poa_proyecto' AND
		    s07c_partid = '$poa_partid' AND
		    s08c_origen = '$poa_origen' AND
		    s11c_compon = '$poa_compon' AND
		    s25c_accion = '$poa_accion'
		    ");

		$r_edofin =$cons_edo_fin->fetch_assoc();

	     echo "<td>".$r_edofin["obj"]."</td>";
	     echo "<td>".$r_edofin["pro"]."</td>";
	     echo "<td>".$r_edofin["subpro"]."</td>";
	     echo "<td>".$noproy."</td>";
	      echo "<td>".$poa_compon."</td>";
	       echo "<td>".$poa_accion."</td>";
		  echo "<td>$consxdep</td>";
		echo "<td>".$r_origen["monto"]."</td>";
		echo "<td>".$poa_partid."</td>";
		echo "<td>".$poa_origen."</td>
        <td>".date('d/m/y')."</td>
              <td>698</td>
              <td>&nbsp;</td>
              <td>698</td>
              <td>&nbsp;</td>";

			echo "</tr>";
                        unset($r_edofin);
                       $cons_edo_fin->free();
		}
                unset($r_origen);
               $consulta_poa02_origen->free();
	}
        unset($d_of);
        $detalle_oficio->free();
}
$oficios->free();
echo "</table>";
?>
