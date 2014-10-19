<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title><?php echo $this->config->item('site_name');?></title>
    <meta http-equiv="pragma" content="no-chace" Cache-Control="max-age=5, must-revalidate" Expires ="Sat, 26 Jul 1997 05:00:00 GMT" />
	
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/jquery.lightbox.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/popup_form.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>asset/javascript/jquery.autocomplete.js"></script>
	
    <script type='text/javascript'>
        var site = "<?php echo site_url()?>";
        var loading_image_large = "<?php echo base_url();?>asset/images/loading_large.gif";
        var loading_image_small = "<?php echo base_url();?>asset/images/loading.gif";
    </script>
    <script type="text/javascript" src="<?php echo base_url();?>asset/javascript/app.js" ></script>
  
    <link href="<?php echo base_url();?>asset/theme/style.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>asset/theme/icons.css" rel="stylesheet" type="text/css" />
    <link rel="shorcut icon" href="<?=base_url()?>asset/images/favicon.ico" />
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
    
	
 <div id='header'> </div>
            <div id='tabs' class='tabs'>
                <a class='current_tab' onclick='load("anggota/index/"+Math.random(),"#content");switch_tab(this);'>Anggota</a>
				<a class='current_tab' onclick='load("anggota/index/"+Math.random(),"#content");switch_tab(this);'>News</a>
				<a class='current_tab' onclick='load("anggota/index/"+Math.random(),"#content");switch_tab(this);'>Saldo</a>
 </div>
 </div>
<div id="sidebar" >
			<ul>
               <li>
					<h2>User Login</h2>
					<p>Silahkan Login Dahulu </p>
				</li>
				<li>
				    <script type='text/javascript'>
					$(function(){
					 $('#expand1').hide();
					 $('#colap1').show();
					 $('#menu_1').hide('slow');
					 $('#expand2').hide();
					 $('#colap2').show();
					 $('#menu_2').hide('slow');
					});
					function menu_1_expand()
						{
							 $('#expand1').show();
							 $('#colap1').hide();
							 $('#menu_1').show('slow');
						}
					function menu_1_colap()
						{
							 $('#expand1').hide();
							 $('#colap1').show();
							 $('#menu_1').hide('slow');
						}
						function menu_2_expand()
						{
							 $('#expand2').show();
							 $('#colap2').hide();
							 $('#menu_2').show('slow');
						}
					function menu_2_colap()
						{
							 $('#expand2').hide();
							 $('#colap2').show();
							 $('#menu_2').hide('slow');
						}
					
					</script>
					<div class='menu'><span onclick='menu_1_expand();'  id='colap1' class="tree-collapsed"></span>
									  <span onclick='menu_1_colap();' id='expand1' class="tree-expanded"></span>
									  Menu Anggota</div>
					<ul id='menu_1'>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Simpanan</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Pinjaman</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Usulan Pinjaman</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Simulasi Pinjaman</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Laporan</a></li>	
					</ul>
				</li>
				<li>
					<div class='menu'><span onclick='menu_2_expand();'  id='colap2' class="tree-collapsed"></span>
									  <span onclick='menu_2_colap();' id='expand2' class="tree-expanded"></span>
									  Menu Admin</div>
					<ul id='menu_2'>
                        <li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Beranda User</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Input Angsuran</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Input Simpanan</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Input Simpanan per User</a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Simulasi Pencairan Dana </a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear); alert("Persetujuan Pinjaman dilakukan setelah melakukan Simulasi Pencairan, klik Det untuk melakukan persetujuan");'>Persetujuan Pinjaman </a></li>
						<li><a href='javascript:void(0);' onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Profil Anggota</a></li>
						<li><a href="javascript:void(0);" onclick='load("anggota/index/"+Math.random(),"#content"); switch_tab(clear);'>Upload News</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- end #sidebar -->
    <div id='container'>
        <div id='content'>
            <?php
			echo "<script>load_no_loading('anggota/index/'+Math.random(),'#content'); </script>";
            ?>
        </div>
    </div>
       <div id='footer'>
            <div class='left_footer'>Multiple Chain &copy; <?php echo date('Y');?> by Edi</div>
            <div class='right_footer'>Script powered by <a class='link1 blue98' href='http://codeigniter.com' target='_blank'>Codeigniter</a> and <a class='link1 blue98' href='http://jquery.com' target='_blank'>jQuery</a>  <a class='link1 blue98' href='http://localhost/phpmyadmin/index.php?db=kokab' target='_blank'>[-]</a></div>
        </div>
</body>
</html>
