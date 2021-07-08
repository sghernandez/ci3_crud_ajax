<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

   function __construct() { 
		parent::__construct();
   }
   
   
    public function isUnique($value, $params)
    {        
        $CI =& get_instance();
        $CI->load->database();
 
        $CI->form_validation->set_message('isUnique', '%s debe ser único.');
        list($table, $field, $primaryField, $id) = explode(".", $params, 4);
        
        $query = $CI->db->select($field)
            ->where($field, $value)
            ->where("$primaryField !=", $id)
            ->limit(1)
            ->get($table)
            ->result();

        return count($query) ? FALSE : TRUE;
    }
   
   
}   