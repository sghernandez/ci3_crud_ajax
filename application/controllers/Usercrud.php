<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usercrud extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->model('users_model', 'user');	
    }
	
        
  /* carga el listado de usuario */  
  function index()
  {      
	 $data = [
         'title' => 'Listado de Usuarios',
         'view' => 'users/users_view',
		 'users' => $this->user->get_all_users(), 
         'datatables' => (form_hidden('datatables_ruta', 'usercrud/users_list'). form_hidden('datatables_targets', '-1, -2'))          
    ];
      
    if ($this->input->is_ajax_request()) {
       return $this->load->view($data['view'], $data);
    }      

	 return $this->load->view('template/layout', $data);	
   }
   
   
/*
  -------------------------------------------------------------------
  Nombre: users_list
  -------------------------------------------------------------------
  Descripción:
  devuelve los registros de los usuarios para ser cargados mediante datatables
  -------------------------------------------------------------------
  Entradas: $_POST
  -------------------------------------------------------------------
  Salida: arreglo en formato json
  -------------------------------------------------------------------
 */
   public function users_list() 
   {
      $data = [];
      foreach ($this->user->get_all_users(TRUE) as $r) 
      {
        $fn_edit = "carga_modal('" .'usercrud/add?id=' . $r->ID . "')";
        $fn_delete = "carga_modal('" .'usercrud/delete?id=' . $r->ID . "')";
        // $fn_delete = "if(confirm('Desea borrar el usuario?')) { ruta('" .'usercrud/add?id=' . $r->ID . "'); }";

        $fila = [];
        $fila[] = "<div align='center'>$r->FIRSTNAME</div>";
        $fila[] = "<div align='center'>$r->LASTNAME</div>";
        $fila[] = "<div align='center'>$r->EMAIL</div>";
        $fila[] = "<div align='center'>$r->AGE</div>";
        $fila[] = '<div align="center"><span onclick="' . $fn_edit . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></span></div>';
        $fila[] = '<div align="center"><span onclick="' . $fn_delete . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></span></div>';
        
        $data[] = $fila;
     }

     $total = $this->user->get_all_users();
     
     $salida = [
       'draw' => $_POST['draw'],
       'recordsTotal' => $total,
       'recordsFiltered' => $total,
        'data' => $data
      ];

      echo json_encode($salida);
            
    }
    

     /* Formulario para agregar/editar un usuario */
	 function add()
     {         
        $id = intval($this->input->post('id') ? : $this->input->get('id'));
        
        if($this->input->post('send')) 
        { 
           $result = $this->user->validate_user();
           echo json_encode ($result, JSON_UNESCAPED_SLASHES);
           return;            
        }
        
        $title = ($id ? 'Editar' : 'Nuevo'). ' Usuario';
        $data = ['user' => $id ? $this->db->limit(1)->where('ID', $id)->get('USER')->row() : ''];
        $view = $this->load->view('users/form_user', $data, TRUE);		

        echo json_encode(compact('view', 'title'));
	}    
    
    
     /* Borra un usuario */
	 function delete()
     {
        if (! $this->input->is_ajax_request()) { exit; }  
        $id = $this->input->get('id');
        
        if($this->input->post('send')) 
        { 
           $this->db->where('ID', $this->input->post('id'))->delete('USER');               
           $result['info'] = 'Usuario borrado correctamente.';
           echo json_encode ($result, JSON_UNESCAPED_SLASHES);
           return;               
        }        
        
        $title = 'Borrar Usuario';
        $view = $this->load->view('users/form_delete', ['id' => $id], TRUE);		

        echo json_encode(compact('view', 'title'));        
	}     
	 
}
