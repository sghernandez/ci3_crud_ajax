<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
        
    
  public function validate_user()
  {          
    $id = $this->input->post('id');
    
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|isUnique[USER.EMAIL.ID.'.$id.']');
    $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]');
    $this->form_validation->set_rules('apellido', 'Apellidos', 'required|min_length[3]');
    $this->form_validation->set_rules('edad', 'Edad', 'required|integer');
    $this->form_validation->set_rules('genero', 'Género', 'required');
    $this->form_validation->set_rules('telefono', 'Teléfono', 'required|integer|min_length[7]|max_length[10]');
       
    if($this->form_validation->run() === TRUE)
    {        
       $data = [
            'FIRSTNAME' => $this->input->post('nombre'),
            'LASTNAME' => $this->input->post('apellido'),
            'EMAIL' => $this->input->post('email'),
            'GENDER' =>$this->input->post('genero'),
            'TELEPHONE'=> $this->input->post('telefono'),
            'AGE'=> $this->input->post('edad'),
       ];	  
        
       if($id) { $this->db->where('ID', $id)->update('USER', $data); }
       else { $this->db->insert('USER', $data);}
        
       $result['info'] = 'Datos guardados correctamente.';    
    }
    else { $result = get_errors(); }
       
    return $result;
       
  }    
   
   
  function get_all_users($order_by=FALSE) 
  {          
    $sort_columns = ['FIRSTNAME', 'LASTNAME', 'EMAIL', 'AGE', 'ID'];
    datatables_search($sort_columns, @$_POST['columns'][0]['search']['value'], 1);
    
    if ($order_by) {
        datatables_limit('FIRSTNAME', @$sort_columns[$_POST['order'][0]['column']]);
        return $this->db->get('USER')->result();
    }

    return $this->db->get('USER')->num_rows();
  }
  

}
