<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Controller {

	function Home()
	{
		parent::Controller();
		$this->load->library('auth');
		//$this->load->model(array('trmodel','usermodel'));
	}
	function index()
	{
		$this->load->view('home/index','123');
	}
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */
