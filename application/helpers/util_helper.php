<?php
    
/*
  -------------------------------------------------------------------
  Nombre: get
  -------------------------------------------------------------------
  Descripción:
  devuelve el valor get con filtrado xss
  -------------------------------------------------------------------
  Versión y Fecha :  0.1 22 Agosto 2017
  -------------------------------------------------------------------
  Entradas: $key: clave del get
  -------------------------------------------------------------------
  Salida: string
  -------------------------------------------------------------------
 */

function get($key) {
    $ci = & get_instance();
    return @$ci->input->get(trim($key), TRUE);
}

/*
  -------------------------------------------------------------------
  Nombre: datatables_limit
  -------------------------------------------------------------------
  Descripción:
  genera el limite de la consulta y la ordenación para los listados de
  datatables
  -------------------------------------------------------------------
  Entradas:
  $default: nombre de la columna(campo tabla) con el orden al cargar el listado
  $col: columna por la cual se ordena desde el lado del cliente
  -------------------------------------------------------------------
  Salida: vacio; ejecuta una parte de la consulta
  -------------------------------------------------------------------
 */

function datatables_limit($defult, $col)
{
    $ci = & get_instance();
    $ci->db->limit(intval($ci->input->post('length')), $ci->input->post('start'));

    if ($col) {
        $dir = strtoupper(@$_POST['order'][0]['dir']);
        $order = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';

        $ci->db->order_by($col, $order);
    }
    else {
        $ci->db->order_by($defult);
    }
}


/*
  -------------------------------------------------------------------
  Nombre: datatables_search
  -------------------------------------------------------------------
  Descripción:
  ejecuta la busqueda para los listados de datatables
  -------------------------------------------------------------------
  Entradas:
  $sort_columns: arreglo que contine los campos de la tabla
  $search: valor a buscar
  $unset: opcional; si se envia se excluirá de las busqueda los últimos
  valores inidicados: ej. si "$unset" trae como valor: 1,
  entonces la última posición del arreglo se excluirá de la busqueda.
  -------------------------------------------------------------------
  Salida: vacio; ejecuta una parte de la consulta
  -------------------------------------------------------------------
 */

function datatables_search($sort_columns, $search, $unset = 0)
{
    $ci = & get_instance();
    $exclude = $unset ? array_slice($sort_columns, -$unset) : [];

    $i = 0;
    if ($search = trim($search))
    {  //  $ci->db->group_start();
        foreach ($sort_columns as $item)
        {
            if (! in_array($item, $exclude)) {
                if ($i == 0) $ci->db->like($item, $search);
                else $ci->db->or_like($item, $search);
                $i++;
            }
        }
      // $ci->db->group_end();
    }
}    
    
 
/* Retorna los errores del formulario para desplegarlos
   en el formulario a través de ajax */
function get_errors() 
{      
   $results['errors'] = TRUE;
   foreach ($_POST as $key => $post){            
      $results['error_'. $key] = strip_tags(form_error("$key"));
   }

   return $results;
}