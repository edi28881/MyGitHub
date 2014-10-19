<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
Class Anggotamodel extends Model
{
	function Anggotamodel()
	{
		parent::Model();
	}
 function get_all()
	{
        //$user_id = $this->session->userdata('user_id');
        return $this->db->query('select * from anggota left join provinsi on anggota.prov_id = provinsi.prov_id
        						left join kabupaten on anggota.kab_id = kabupaten.kab_id
        						left join kecamatan on anggota.kec_id = kecamatan.kec_id 
								ORDER BY user_id asc
								
								');
	}
	
 function getProvinsiList(){
		$result = array();
		$this->db->select('*');
		$this->db->from('provinsi');
		$this->db->order_by('provinsi','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Provinsi-';
            $result[$row->prov_id]= $row->provinsi;
        }

        return $result;
	}

	function getKotaList(){
		$prov_id = $this->input->post('prov_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kabupaten');
		$this->db->where('prov_id',$prov_id);
		$this->db->order_by('kabupaten','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kota / Kabupaten-';
            $result[$row->kab_id]= $row->kabupaten;
        }

        return $result;
	}

	function getKecamatanList(){
		$kab_id = $this->input->post('kab_id');
		$result = array();
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->where('kab_id',$kab_id);
		$this->db->order_by('kecamatan','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Kecamatan-';
            $result[$row->kec_id]= $row->kecamatan;
        }
        return $result;
	}
	
	function get_user_id()
	{
		$this->db->select('MAX(user_id) as user_id');
		$this->db->from('anggota');
		$res = $this->db->get();
		if($res->num_rows()==0) return 0;
		$row = $res->row();
		return ($row->user_id+1);
	}
	function simpan_anggota_masal($data,$user_id)
	{
		$user_id = $data['user_id'];
		if($user_id=='')
		{
			$user_id = $this->get_user_id();
			$data['user_id'] = $user_id;
			$this->db->insert('anggota',$data);
		}
		else
		{
				$nomor = $data['user_id'];
				$this->db->where('user_id',$user_id);
				$this->db->update('anggota',$data);
		}
		return $user_id;
	}
	function hapus_anggota($user_id)
	{
		$this->db->where('user_id',$user_id);
		$this->db->delete('anggota');
	}

}
