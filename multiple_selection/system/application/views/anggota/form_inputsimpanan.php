   <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <!-- pindah ke index.php
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery-1.3.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery.autocomplete.js'></script>
   -->   	
<script type='text/javascript'>
    $(function(){
	    $('.date').calendar();
		setAutocompleteCari();
    }); 
	
	function setAutocomplete()
    {
	$('#nak').autocomplete('<?php echo base_url();?>/autocomplete/suggestions', { 
	   width: 300, 
       minChars: 1 ,
       mustMatch: true, 
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[1].substring(1); } 
	   }); 
	   $('#nak').result(function(event, data, formatted) { 
       if (data)
	   $('input[name=nama_anggota]').val(data[0]);
	   $('input[name=user]').val(data[1]);
	   $('input[name=nama_anggota]').attr("readonly", true);
	   })
    } 
    function setAutocompleteCari()
    {
    $('#cari_nak').autocomplete('<?php echo base_url();?>/autocomplete/suggestions', { 
	   width: 300, 
       minChars: 1 ,
       mustMatch: true, 
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[1].substring(1); } 
	   });
	   $('#cari_nak').result(function(event, data, formatted) { 
       if (data)
	   view_user() ;
	   })
    } 	
    function view_simpanan()
    {
        var jenissimpanan = $('select[name=jenissimpanan]').val();
        var tahun = $('select[name=tahun]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('simpanan_anggota2/index/'+jenissimpanan+'_'+tahun+'_'+anggota+'_'+Math.random(),'#content');
        $('input[name=jenissimpanan]').val(jenis_simpanan);
        var txt_jenissimpanan = $('select[name=jenissimpanan] :selected').text();
        $('.jenis').html(txt_jenissimpanan);
		$('div[name=container_form]').hide('fast');
    }
 <?php if($this->auth->cek('data_simpanan',true)):?>  
  function view_user()
    {
        var perpage = $('select[name=dataperpage]').val();
		var user = $('input[name=cari_nak]').val();
		var pt = $('select[name=pt]').val();
		if(user==''){user=0;}
		if(pt==''){pt=0;}
        load_no_loading('input_simpanan/index/'+user+'/'+pt+'/'+perpage,'#content');
		$('div[name=container_form]').hide('fast');
    }
  
  function simpan_transaksi()
    {
        var nak = $('input[name=nak]').val();
		var nama_anggota = $('input[name=nama_anggota]').val();
		var jenissimpanan = $('input[name=jenis]').val();
        var tanggal = $('input[name=tanggal_transaksi]').val();
        var keterangan = $('input[name=keterangan]').val();
        var nominal = $('input[name=nominal]').val();
        if(jenissimpanan=='-1'||tanggal==''||nominal==''||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
            
			send_form(document.form_transaksi,'simpanan_anggota2/simpan','#content');
			load_no_loading('simpanan_anggota2/index/0_0_'+nak+'_0_','#content');
			setTimeout(function(){view_simpanan()},2000);
        }
    }
  
    function edit(id)
    {
        $('div[name=container_form]').hide('fast');
        $('div[name=container_form]').show('slow');
        popup();
		$('input[name=id_simpanan]').val($('.nomor_'+id).val()).attr("readonly",true);
		$('input[name=nak]').val($('.nak_'+id).val()).attr("readonly",true);
		$('input[name=nama_anggota]').val($('.nama_anggota_'+id).val());
        $('select[name=jenis]').val($('.jenis_'+id).val());
        $('input[name=tanggal_transaksi]').val($('.tanggal_'+id).val());
        $('input[name=keterangan]').val($('.keterangan_'+id).val());
        $('input[name=nominal]').val($('.nominal_'+id).val());
        $('input[name=nomor]').val($('.nomor_'+id).val());
    }
    function reset_form()
    {
        $('input[name=tanggal_transaksi]').val('');
        $('input[name=keterangan]').val('');
        $('input[name=nominal]').val('');
        $('input[name=nomor]').val('');
    }
    
	function tambah()
    {
		popup();
        document.form_transaksi.reset();
        $('div[name=container_form]').show('slow');
		$('input[name=nak]').attr("readonly", false);
        $('input[name=nak]').focus();
        $('select[name=transaksi]').val('1');
		setAutocomplete();

    }
    <?php endif;?>
	function form_close()
    {
        $("#backgroundPopup").fadeOut("slow");
        $('div[name=container_form]').hide('slow');
    }
    function popup()
    {
    $("#backgroundPopup").css({"opacity": "0.6"});
    $("#backgroundPopup").fadeIn("slow");
    }
</script>
<style type="text/css">
#backgroundPopup{
	display:none;
	position:fixed;
	_position:absolute;
	height:2000px; width:100%;
	top:0; left:0;
	background:#000;
	z-index:11;
	}
#container_form {
    display:none;
	position:fixed;
	z-index:1;
	top: 25%;
    left: 30%;
	}
.container_data {
	margin:0px auto;
	position:relative;
	z-index:12;
	}
#contactForm {
	height:320px;width:700px;
	background:#515151 ;
	border:1px solid #929191;
	padding:7px 12px;
	color:#fff;
	}
#tombol {
	float:left;
}
#pencarian {
	float:right;
}
</style>
    
<div class='title'>Input Simpanan Anggota</div>
<div id='tombol' >
<hr>

</div>
<?php
echo ' PT : ';
echo $this->fungsi->build_select_common('pt',$pt,'pt_id','pt','onchange="view_user()"',$cur_pt);
?>
<div align='right'id="pencarian">
		<?php 
		if(empty($cur_anggota))
		{$cur_anggota=from_session('user_name');}
		$cari = array('name' => 'cari_nak',
				'id' => 'cari_nak',
				'type' => 'text',
				'size' => '50',
				'maxlength' => '50',
				'value' => $cur_anggota,
				'placeholder' => 'Masukkan Nama Anggota.....',
				
			);	
        echo 'Pencarian Anggota : ' ; 
		echo form_input($cari);
		?>
        
</div>

<div name='tabel_transaksi' class='tabel_transaksi'>
<?php echo $this->load->view('anggota/tabel_inputsimpanan');?>
<div class='a_left'>
<?php
echo 'Data per Page : ';
echo $this->fungsi->build_select_common('dataperpage',$dataperpage,'perpage','perpage','onchange="view_user()"',$cur_perpage);
?>
</div>
<div class='a_center'>
    <?php
	echo 'Page '.$page.' of '.$pages;
    $str = '';
    $br = '';
    if(!isset($no_prev))
    {
        $br = '<br />';
        $str .= $first_page.$prev;
    }
    if(!isset($no_next))
    {
        $br = '<br />';
        if(!isset($no_prev))
        {
            $str .= ' - ';
        }
        $str .= $next.$last_page;
    }
    echo $br.$str;
    ?>
</div>

</div>
<div name="container_data" class="container_data">

<div  name='container_form' id='container_form' >
      <div id="contactForm">
        	<div class="loader"></div>
			<div class="bar"></div>
     <div class='title'>Input Simpanan</div>
    <form method='post' action='' class="contactForm" name='form_transaksi'>
	
    <?php
        echo form_hidden('update_by',from_session('nama'));
        echo form_hidden('tanggal_catat',date('Y-m-d'));
		$ip = $this->input->ip_address();
		echo form_hidden('ip_sender',$ip);
    ?>
    <table class='myform' style='width:100%'>
		 <tr>
            <td class='a_right' valign='top'>No.Transaksi</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'>
			<input size="10" type="text" name="nomor" readonly="true" />
			</td>
        </tr>
		 <tr>
            <td class='a_right' valign='top'>No.Anggota</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'>
			<?php 
		    $autocomplete = array('name' => 'nak',
				'id' => 'nak',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'value' =>'',
				'placeholder' => 'Masukkan Nomor Anggota.....'
			);	
		    echo form_input($autocomplete ); 
		    ?>
			
			</td>
        </tr>
		<tr>
            <td class='a_right' valign='top'>NamaAnggota</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'>
            <input size="50" type="text" name="nama_anggota" disabled="true" />
            </td>
			
        </tr>
		<tr>
            <td class='a_right' valign='top'>Jenis</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'>
            <?php
            echo $this->fungsi->build_select_common('jenis',$jenissimpanan,'id','nama','',$cur_jenissimpanan);
            ?>
            </td>
			
        </tr>
        <tr>
            <td class='a_right' valign='top'>Tanggal</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' value='<?php echo date('Y-m-d');?>' class='date' name='tanggal_transaksi' autocomplete='off' style='width:100px' /></td>
		</tr>
        <tr>
            <td class='a_right' valign='top'>Keterangan</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' name='keterangan' style='width:600px' /></td>
			
        </tr>
        <tr>
            <td class='a_right' valign='top'>Nominal</td>
            <td valign='top'>:</td>
            <td class='a_left' valign='top'><input type='text' name='nominal' style='width:120px'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
       
		</tr>
    </table>
    </form>
    <div class='the_footer a_left'>
        <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_transaksi()'>Simpan</a>
        <a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='reset_form()'>Kosongkan Form</a>
    <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>Cancel</a></div>
    </div>
    </div>
    </div>
<div id="backgroundPopup"></div>
