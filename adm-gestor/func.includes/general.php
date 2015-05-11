<?php
class General {

    var $db;
	function General($db) {
		$this->db = $db;
	}
	
	//selecciona datos segun la consulta, la idea es mandar una consulta con las siguientes caracteristicas
	// select * from xxxx where idxx=1 o select * from xxxx
	// lista todos los datos relacionados
	// TRAE MAS DE UN REGISTRO
	function listar_registros($sql) 
	{
		$recordSet = $this->db->Execute($sql); 
	
		if (!$recordSet) 
		{
		 	print $this->db->ErrorMsg();  
		}else
		{
      	  $i=0;
		  while (!$recordSet->EOF) 
		  { 
            $resultado[$i] = $recordSet->fields; 
            $recordSet->MoveNext(); 
			$i++;
		  }
		}
	  return $resultado;
	}

	
	//inserta un registro en la BD, debo mandar como parametro
	//los registros que vienen del formulario, el nombre de la tabla donde se insertan
	//los registros y el ID de la tabla
	function insertar_registro($registros, $tabla, $idtabla) 
	{
		$sql = "SELECT * FROM " . $tabla . " WHERE " . $idtabla . " = -1";  
		$rs = $this->db->Execute($sql); 
		$insertSQL = $this->db->GetInsertSQL($rs, $registros); 
		$emp = $this->db->Execute($insertSQL); 

		if (!$emp)  
		{
	        print $this->db->ErrorMsg(); 
	    }else
		{
			return $this->db->Insert_ID();
		}
	}

	
	//selecciona un registro de una tabla, debo mandar como parametro
	//el nombre de la tabla, el ID de la tabla y el ID a seleccionar
	function seleccionar_registro ($tabla, $idtabla, $id) 
	{
		$sql = "SELECT * FROM " . $tabla . " WHERE " . $idtabla . "=" . $id;
		$recordSet = $this->db->Execute($sql); 
		
		if (!$recordSet) 
		{
		 	print $this->db->ErrorMsg();  
		}else
		{
			$resultado = $recordSet->fields;
	 	}
	  	
		return $resultado;
	}



	//actualiza un registro deseado, debo mandar como parametro
	//los registros que vienen desde el formulario, el nombre de la tabla,
	//el ID de la tabla y el ID a actualizar
	function actualizar_registro($registros, $tabla, $idtabla, $id) 
	{
		$sql = "SELECT * FROM " . $tabla . " WHERE " . $idtabla . " = " . $id;
		$rs = $this->db->Execute($sql);
	
		if(!$rs)
		{
			return $this->db->ErrorMsg;
		}else
		{
			$updateSQL = $this->db->GetUpdateSQL($rs, $registros);
			$rsUpdate = $this->db->Execute($updateSQL);
			if(!rsUpdate) 
			{
				return $this->db->ErrorMsg;
			}else 
			{
				return true;
			}
		 }
		$this->rs->Close();
	 }

	
	// Función para paginar.
	function paginado($cantidadRegistros, $tamanoRegistrosPagina, $pagina) {		  
		if(empty($pagina)) { 
			$pagina = 1; 
			$inicio = 1; 
			$final = $tamanoRegistrosPagina; 
		} else { 
			$pagina = $pagina; 
		} 

		// Calculo del limite inferior.
		$limitInf = ($pagina - 1) * $tamanoRegistrosPagina; 

		// Calculo del numero de paginas.
		$numeroPaginas = ceil($cantidadRegistros/$tamanoRegistrosPagina); 

		if(empty($pagina)) { 
			$pagina=1; 
		    $inicio=1; 
		    $final = $tamanoRegistrosPagina;
		} else { 
			$seccionActual = intval(($pagina - 1) / $tamanoRegistrosPagina); 
		    $inicio = ($seccionActual * $tamanoRegistrosPagina) + 1; 

		    if($pagina < $numeroPaginas) { 
				$final = $inicio + $tamanoRegistrosPagina - 1; 
		    } else { 
		    	$final = $numeroPaginas; 
		    } 

		    if ($final > $numeroPaginas) { 
		    	$final = $numeroPaginas; 
		    } 
		} 

		$resultadoPaginado = array();
		$resultadoPaginado['pagina'] = $pagina;
		$resultadoPaginado['numeroPaginas'] = $numeroPaginas;
		$resultadoPaginado['inicio'] = $inicio;
		$resultadoPaginado['final'] = $final;
		$resultadoPaginado['limitInf'] = $limitInf;
		
		return $resultadoPaginado;

	}
	
	// Función para seleccionar con límites.
	function seleccionLimites($tabla, $seleccion, $opcion, $limite, $offset) {
	
		$sql = "SELECT $seleccion FROM $tabla $opcion";

		$rs = $this->db->SelectLimit($sql, $limite, $offset);

		if(!$rs) {
		
			$this->error($this->db->ErrorMsg());
			
		} else {
			$i=0;
			
			while(!$rs->EOF) {
				
				$result[$i] = $rs->fields;
				
				$rs->MoveNext();
				

				$i++;
				
			}

			return $result;			
		}		
		$this->db->Close();
	}
	// Función para seleccionar con límites.
	function seleccionLimitesSQL($sql, $limite, $offset) {

		$rs = $this->db->SelectLimit($sql, $limite, $offset);

		if(!$rs) {
		
			$this->error($this->db->ErrorMsg());
			
		} else {
			$i=0;
			
			while(!$rs->EOF) {
				
				$result[$i] = $rs->fields;
				
				$rs->MoveNext();
				

				$i++;
				
			}

			return $result;			
		}		
		$this->db->Close();
	}

	//actualiza un registro deseado, debo mandar como parametro
	//los registros que vienen desde el formulario, el nombre de la tabla,
	//el ID de la tabla y el ID a actualizar
	function eliminar_registro($tabla, $idtabla, $id) 
	{
		$sql = "DELETE FROM " . $tabla . " WHERE " . $idtabla . " = " . $id;
		$rs = $this->db->Execute($sql);
	
		if(!$rs)
		{
			return $this->db->ErrorMsg;
		}else
		{
			$updateSQL = $this->db->GetUpdateSQL($rs, $registros);
			$rsUpdate = $this->db->Execute($updateSQL);
			if(!rsUpdate) 
			{
				return $this->db->ErrorMsg;
			}else 
			{
				return true;
			}
		 }
		$this->rs->Close();
	 }
	

}

?>