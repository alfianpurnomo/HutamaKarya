<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Dashboard Class
 * 		default home location
 * 		
 * @author alfian purnomo <alfian.pacul@gmail.com>
 * 
 * @version 3.0
 * 
 * @category Controller
 * 
 */
class Dashboard extends CI_Controller 
{

    function __construct() 
    {
        parent::__construct();
        #$this->load->model('Dashboard_model');
        $this->class_path_name = $this->router->fetch_class();
    }
    /**
     * Index Page for this controller.
     * 
     */
    public function index() 
    {
        
        $this->data['page_title'] = 'Dashboard';
        
    }

    
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */
