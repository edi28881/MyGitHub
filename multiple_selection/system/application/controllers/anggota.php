<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anggota extends Controller {
 function Anggota()
	{
		parent::Controller();
		$this->load->library('auth');
		$this->load->model(array('anggotamodel'));
		//$this->auth->restrict();
	}
	function index()
	{
        //$user_id ='00061325';
		//$data['option_pt'] = $this->anggotamodel->getPtList();
        $data['anggota'] = $this->anggotamodel->get_all();
		$data['option_provinsi'] = $this->anggotamodel->getProvinsiList();
		$this->load->view('anggota/index',$data);

	}
    function select_kota(){
            if('IS_AJAX') {
        	$data['option_kabupaten'] = $this->anggotamodel->getKotaList();
		    $this->load->view('anggota/select_kota_list',$data);
            }

	}
	function select_kecamatan(){
            if('IS_AJAX') {
        	$data['option_kecamatan'] = $this->anggotamodel->getKecamatanList();
		    $this->load->view('anggota/select_kecamatan_list',$data);
            }
	}
	function select_cabang(){
            if('IS_AJAX') {
        	$data['option_cabang'] = $this->anggotamodel->getCabangList();
		    $this->load->view('anggota/select_cabang_list',$data);
            }

	}
	function hapus_anggota(){
            if('IS_AJAX') {
        	$user_id= $this->input->post('user_id');
			$this->anggotamodel->hapus_anggota($user_id);
            }

	}
	function simpan_anggota_masal()
	{
		$data = array();
		$data = $this->fungsi->accept_data(array_keys($_POST));
		foreach($data as $data)
		{
		foreach($data as $data)
		{
		$user_id = $data['user_id'];
		$data['tanggal_catat']= date('Y-m-d');
		//$data['update_by']= from_session('nama');
		$data['update_by']= 'gue';
		$data['ip_sender']= $this->input->ip_address();
		//echo '<pre>';
		//print_r($data);
		//echo '</pre>';
		$this->anggotamodel->simpan_anggota_masal($data,$user_id);
		}
		//echo ("<script type='text/javascript'> alert('data berhasil disimpan'); </script>" );
		$this->index();
        }
	}
}

/* End of file user.php */
/* Location: ./system/application/controllers/anggota.php */
