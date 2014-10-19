<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth {

	var $CI = null;

	function Auth()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	function do_login($login = NULL)
	{
	     	// A few safety checks
	    	// Our array has to be set

	    	if(!isset($login))
		        return FALSE;

	    	//Our array has to have 2 values
	     	//No more, no less!
	    	if(count($login) != 2)
			return FALSE;

	     	$username = $login['username'];
	     	$password = $login['password'];

		$this->CI->db->from('user');
		$this->CI->db->where('user_username', $username);
		$this->CI->db->where("user_password=MD5('$password')");
		$query = $this->CI->db->get();

	     	foreach ($query->result() as $row)
        	{
        	$user_id = $row->user_id;
			$username = $row->user_username;
			$namafull = $row->user_name;
			$avatar = $row->avatar;
			$count = $row->user_logincount;
			$level = $row->user_level;
			$count++;
        	}

	     	if ($query->num_rows() == 1)
	     	{
	       	 	$newdata = array(
	       	 	            'user_id'	=> $user_id,
                            'username'  => $username,
                            'nama'  	=> $namafull,
                            'avatar'  	=> $avatar,
                            'logged_in' => TRUE,
                            'login_ke' 	=> $count,
							'level'	=> $level
               		);
			// Our user exists, set session.
			$this->CI->session->set_userdata($newdata);
			// update counter login
			$this->CI->db->where('user_id',$user_id);
			$this->CI->db->update('user',array('user_logincount'=>$count,'user_loggedin'=>'1'));
			//$this->CI->db->update('user',array());
			return TRUE;
		}
		else
		{
			// No existing user.
			return FALSE;
		}
	}

	 /**
         *
         * This function restricts users from certain pages.
         * use restrict(TRUE) if a user can't access a page when logged in
         *
         * @access	public
         * @param	boolean	wether the page is viewable when logged in
         * @return	void
         */
    	function restrict($logged_out = FALSE)
    	{
		// If the user is logged in and he's trying to access a page
		// he's not allowed to see when logged in,
		// redirect him to the index!
		if ($logged_out && is_logged_in())
		{
		      echo $this->CI->fungsi->warning('Maaf, sepertinya Anda sudah login...',site_url());
		      die();
		}

		// If the user isn' logged in and he's trying to access a page
		// he's not allowed to see when logged out,
		// redirect him to the login page!
		if ( ! $logged_out && !is_logged_in())
		{
		      echo $this->CI->fungsi->warning('Anda diharuskan untuk Login bila ingin mengakses halaman ini.',site_url());
		      die();
		}
	}
	function logout()
	{
		$this->CI->session->sess_destroy();
		$user_id = $this->CI->session->userdata('user_id');
		$this->CI->db->where('user_id',$user_id);
		$this->CI->db->update('user',array('user_loggedin'=>'0'));
		return TRUE;
	}
	function cek($id,$ret=false)
	{
		$menu = array(
            'data_anggota'=>'+admin+bendahara+ketua+pengurus',
            'data_transaksi'=>'+admin+bendahara+ketua+pengurus',
			'data_simpanan'=>'+admin+bendahara+ketua+pengurus',
			'data_pinjaman'=>'+admin+bendahara+ketua+pengurus',
			'data_master'=>'+admin',
			'manajemen_user'=>'+admin',
			'input_data'=>'+bendahara+admin+ketua+pengurus',
			'page_editor'=>'+admin+pengurus+ketua+pengurus',
			'simulasi'=>'+admin+bendahara+ketua+pengurus',
			'edit_profil'=>'+admin+pengurus+ketua+pengurus',
			'admin_menu'=>'+admin+pengurus+ketua+pengurus'
		);
		$allowed = explode('+',$menu[$id]);
		if(!in_array(from_session('level'),$allowed))
		{
			if($ret) return false;
			echo $this->CI->fungsi->warning('Anda tidak diijinkan mengakses halaman ini.',site_url());
			die();
		}
		else
		{
			if($ret) return true;
		}
	}
	function setChaptcha()
	{
		$this->CI->config->load('config');
		$this->CI->load->helper('string');
		$this->CI->load->plugin('captcha');
		$captcha_url = $this->CI->config->item('captcha_url');
		$captcha_path = $this->CI->config->item('captcha_path');
		$vals = array(
			'img_path'      	=> $captcha_path,
			'img_url'       	=> $captcha_url,
			'expiration'    	=> 3600,// one hour
			'font_path'	 	=> './system/fonts/georgia.ttf',
			'img_width'	 	=> '140',
			'img_height' 		=> 30,
			'word'			=> random_string('numeric', 6),
        	);
		$cap = create_captcha($vals);
		$capdb = array(
			'captcha_id'      	=> '',
			'captcha_time'    	=> $cap['time'],
			'ip_address'      	=> $this->CI->input->ip_address(),
			'word'            	=> $cap['word']
		);
		$query = $this->CI->db->insert_string('captcha', $capdb);
		$this->CI->db->query($query);
		$data['cap'] = $cap;
		return $data;
	}

}
// End of library class
// Location: system/application/libraries/Auth.php
