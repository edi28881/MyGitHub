   <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <!-- pindah ke index.php
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery-1.3.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery.autocomplete.js'></script>
   -->   	
<script type='text/javascript'>
    $(function(){
	    //$('.date').calendar();
		setAutocompleteCari();
		setAutocomplete();
		setAutocomplete2();
		$( "#tanggal_disetujui" ).datepicker();
		$( "#tanggal_pencairan" ).datepicker();
		umur(lhr);
		
	}); 
	function setAutocomplete3()
    {
	$('#nak').autocomplete('<?php echo base_url();?>/autocomplete/suggestions1', { 
	   width: 300, 
       minChars: 1 ,
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[1]; } 
	   });
	   $('#nak').result(function(event, data, formatted) { 
       if (data)
	   $('input[name=nama_anggota]').val(data[0]);
	   $('input[name=tanggal_lhr]').val(data[2]);
	   $('input[name=masuk_pt]').val(data[3]);
	   $('input[name=masuk_kokab]').val(data[4]);
	    $('#umur').val(umur($('#masuk_pt').val()));
		$('#masa_kerj').val(umur($('#masuk_pt').val()));
		$('#masa_angg').val(umur($('#masuk_kokab').val()));
	   })
    }
	 function umur(lhr) {
		//lhr = $('.tanggal_lhr_'+id).val() ;
		var skr = new Date();
		var t   = lhr.split(/[-:]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
	}
	function setAutocomplete()
    {
	$('#dicairkan_oleh').autocomplete('<?php echo base_url();?>/autocomplete/suggestions_pengurus', { 
	   width: 300, 
       minChars: 1 ,
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[0]; } 
	   });
    } 
	function setAutocomplete2()
    {
	$('#disetujui_oleh').autocomplete('<?php echo base_url();?>/autocomplete/suggestions_pengurus', { 
	   width: 300, 
       minChars: 1 ,
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[0]; } 
	   });
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
	   view_pinjaman() ;
	   })
    } 
   	
    function view_pinjaman()
    {
        var statuspinjaman = $('select[name=statuspinjaman]').val();
		var jenispinjaman = $('select[name=jenispinjaman]').val();
		var perpage = $('select[name=dataperpage]').val();
        var tahun = $('select[name=tahun]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('pinjaman_anggota/index/'+jenispinjaman+'_'+tahun+'_'+anggota+'_'+statuspinjaman+'_'+perpage+'','#content');
        $('input[name=jenispinjaman]').val(jenis_pinjaman);
        var txt_jenispinjaman = $('select[name=jenispinjaman] :selected').text();
        $('.jenis').html(txt_jenispinjaman);
		$('div[name=container_form]').hide('fast');
    }
    
    function detil(id)
    {
		$('.date').calendar();
		$('div[name=container_form]').hide('fast');
        $('div[name=container_form]').show('slow');
		$('input[name=nak]').val($('.nak_'+id).val());
		$('input[name=nama_anggota]').val($('.nama_anggota_'+id).val());
        $('select[name=jenis]').val($('.jenis_'+id).val()).attr("disabled", true);
		$('input[name=nomor]').val($('.nomor_'+id).val());
        $('input[name=tanggal_pengajuan]').val($('.tanggal_pengajuan_'+id).val()).attr("disabled", true);
		$('input[name=tanggal_disetujui]').val($('.tanggal_disetujui_'+id).val()).attr("disabled", true);
		$('input[name=tanggal_pencairan]').val($('.tanggal_pencairan_'+id).val()).attr("disabled", true);
		$('input[name=nominal_pengajuan]').val($('.nominal_pengajuan_'+id).val()).attr("disabled", true);
		$('input[name=nominal_disetujui]').val($('.nominal_disetujui_'+id).val()).attr("disabled", true);
		$('input[name=nominal_pencairan]').val($('.nominal_'+id).val()).attr("disabled", true);
		$('input[name=disetujui_oleh]').val($('.disetujui_oleh_'+id).val()).attr("disabled", true);
		$('input[name=dicairkan_oleh]').val($('.dicairkan_oleh_'+id).val()).attr("disabled", true);
        $('input[name=keterangan]').val($('.keterangan_'+id).val()).attr("disabled", true);;
		$('select[name=status_pinjaman]').val($('.status_pinjaman_'+id).val()).attr("disabled", true);
        $('input[name=nomor]').val($('.nomor_'+id).val());
		$('a[name=edit_pinjaman]').show();
		$('a[name=simpan_pinjaman]').hide();
		$('input[name=tanggal_lhr]').val($('.tanggal_lhr_'+id).val()).attr("disabled", true);
		$('input[name=tenor_diajukan]').val($('.tenor_diajukan_'+id).val()).attr("disabled", true);
		$('input[name=tenor_disetujui]').val($('.tenor_disetujui_'+id).val()).attr("disabled", true);
		function umur(lhr) {
		lhr = $('.tanggal_lhr_'+id).val() ;
		var skr = new Date();
		var t   = lhr.split(/[- :]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=umur]').val(umur).attr("disabled", true);
		$('input[name=masuk_kokab]').val($('.masuk_kokab_'+id).val()).attr("disabled", true);
		function msa(lhr) {
		lhr = $('.masuk_kokab_'+id).val() ;
		var skr = new Date();
		var t   = lhr.split(/[- :]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=masa_angg]').val(msa).attr("disabled", true);
		$('input[name=masuk_pt]').val($('.masuk_pt_'+id).val()).attr("disabled", true);
		function msk(lhr) {
		lhr = $('.masuk_pt_'+id).val() ;
		var skr = new Date();
		var t   = lhr.split(/[- :]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=masa_kerj]').val(msk).attr("disabled", true);
    }
	<?php if($this->auth->cek('data_pinjaman',true)):?>
	function angsur(nak)
	{
	load_no_loading('angsuran_pinjaman/index/0_0_'+nak+'_0_'+Math.random(),'#content');
	}
	function simpan()
    {
        var nak = $('input[name=nak]').val();
		var nama_anggota = $('input[name=nama_anggota]').val();
		var jenispinjaman = $('input[name=jenis]').val();
        var tanggal = $('input[name=tanggal_transaksi]').val();
        var keterangan = $('input[name=keterangan]').val();
        var nominal = $('input[name=nominal]').val();
        if(jenispinjaman=='-1'||tanggal==''||nominal==''||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {   
			send_form(document.form_transaksi,'pinjaman_anggota/simpan','#content');
			setTimeout(function(){load_no_loading('pinjaman_anggota/index/0_0_'+nak+'_0_','#content')},2000);
        }
    }
	
	function edit()
    {
        $('.date').calendar();
		$('select[name=jenis]').attr("disabled", false);
		$('select[name=status_pinjaman]').attr("disabled", false);
        $('input[name=tanggal_pengajuan]').attr("disabled", false);
		$('input[name=tanggal_disetujui]').attr("disabled", false);
		$('input[name=tanggal_pencairan]').attr("disabled", false);
		$('input[name=disetujui_oleh]').attr("disabled", false);
		$('input[name=dicairkan_oleh]').attr("disabled", false);
		$('input[name=nominal_pengajuan]').attr("disabled", false);
		$('input[name=nominal_disetujui]').attr("disabled", false);
		$('input[name=nominal_pencairan]').attr("disabled", false);
		$('input[name=tenor_diajukan]').attr("disabled", false);
		$('input[name=tenor_disetujui]').attr("disabled", false);
		$('input[name=keterangan]').attr("disabled", false);
		$('a[name=edit_pinjaman]').hide();
		$('a[name=simpan_pinjaman]').show();
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
        $('select[name=jenis]').attr("disabled", false);
		$('input[name=nak]').attr("readonly", false);
		$('select[name=status_pinjaman]').attr("disabled", false);
        $('input[name=tanggal_pengajuan]').attr("disabled", false);
		$('input[name=tanggal_disetujui]').attr("disabled", false);
		$('input[name=tanggal_pencairan]').attr("disabled", false);
		$('input[name=disetujui_oleh]').attr("disabled", false);
		$('input[name=dicairkan_oleh]').attr("disabled", false);
		$('input[name=nominal_pengajuan]').attr("disabled", false);
		$('input[name=nominal_disetujui]').attr("disabled", false);
		$('input[name=nominal_pencairan]').attr("disabled", false);
		$('input[name=tenor_diajukan]').attr("disabled", false);
		$('input[name=tenor_disetujui]').attr("disabled", false);
		$('input[name=keterangan]').attr("disabled", false);
		$('a[name=edit_pinjaman]').hide();
		$('a[name=simpan_pinjaman]').show();
		setAutocomplete3();
		$('.date').calendar();

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
	top: 2%;
    left: 30%;
	}
.container_data {
	margin:0px auto;
	position:relative;
	z-index:12;
	}
#contactForm {
	height:550px;width:700px;
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
<div class='title'>Daftar Pinjaman Anggota</div>
<div id='tombol' >
<a class='button buttonwhite smallbtn' href='javascript:void(0)' <?php if($this->auth->cek('input_data',true)):?> onclick='tambah() <?php endif;?> '>Tambah</a>
<a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='view_pinjaman()'>Refresh</a>
<hr>
<?php
echo ' Status : ';
echo $this->fungsi->build_select_common('statuspinjaman',$statuspinjaman,'id_status','status_pinjaman','onchange="view_pinjaman()"',$cur_statuspinjaman);
echo ' Jenis : ';
echo $this->fungsi->build_select_common('jenispinjaman',$jenispinjaman,'id','nama','onchange="view_pinjaman()"',$cur_jenispinjaman);
echo ' Tahun : ';
echo $this->fungsi->build_select_year('tahun','onchange="view_pinjaman()"',$cur_tahun);
?>
</div>

<div align='right'id="pencarian">
<!-- input type='text' id=cari' name='cari' size='50' maxlength='50' placeholder='Masukkan Nomor Anggota.....' onChange='view_transaksi()' /> -->
		<?php 
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

<div class='tabel_transaksi'>
<?php echo $this->load->view('anggota/tabel_pinjaman2');?>
<div class='a_left'>
<?php
echo 'Data per Page : ';
echo $this->fungsi->build_select_common('dataperpage',$dataperpage,'perpage','perpage','onchange="view_pinjaman()"',$cur_perpage);
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
<div name='container_form' id='container_form' >
     <div id="contactForm">
        	<div class="loader"></div>
			<div class="bar"></div>
     <div class='title'>Detail Pinjaman <a style='float:right !important;'class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>[X]</a></div>
    <form method='post' action='' class="contactForm" name='form_transaksi'>
	<?php
        echo form_hidden('update_by',from_session('nama'));
        echo form_hidden('tanggal_catat',date('Y-m-d'));
		$ip = $this->input->ip_address();
		echo form_hidden('ip_sender',$ip);
    ?>
    <table class='myform' style='width:100%'>
	     <tr>
            <td class='a_right' valign='top'>No.Pinjaman </td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="30" type="text" name="nomor" readonly="true" />
            </td>
        </tr>
		 <tr>
            <td class='a_right' valign='top'>No.Anggota</td>
            <td valign='top'>:</td>
            <td colspan='2' class='a_left' valign='top'>
			<input size="20" type="text" id="nak" name="nak" readonly="true" />
			</td>
			<td colspan='3' rowspan='3'> 
                <table class='myform' >
				<tr> 
				<td>Usia</td> <td>Masa Kerja</td> <td>Masa Anggota</td>
				</tr>
				<tr> 
					<td><input disabled='true' type='text' class='date' id='tanggal_lhr' name='tanggal_lhr' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date'  id='masuk_pt' name='masuk_pt' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date' id='masuk_kokab'  name='masuk_kokab' autocomplete='off' style='width:100px' /></td> 
				</tr>
				<tr> 
					<td><input disabled='true' type='text' id='umur'  name='umur' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' id='masa_kerj' name='masa_kerj' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' id='masa_angg' name='masa_angg' autocomplete='off' style='width:100px' /></td> 
				</tr>
				</table>
			</td>
        </tr>
		<tr>
            <td class='a_right' valign='top'>NamaAnggota</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="30" type="text" name="nama_anggota" disabled="true" />
            </td>
        </tr>
		<tr>
            <td class='a_right' valign='top'>Jenis</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <?php
            echo $this->fungsi->build_select_common('jenis',$jenispinjaman,'id','nama','',$cur_jenispinjaman);
            ?>
            </td>
			
        </tr>
		<tr>
            <td ></td>
            <td class='title' colspan='6'> Flow Pinjaman</td>
        </tr>
        <tr>
            <td class='a_right' valign='top'></td>
            <td valign='top'></td>
            <td> 
				<table bgcolor='red'>
				<tr><td align='center' colspan='3'>Diajukan</td></tr>
				<tr>
				<td>Tanggal</td><td>:</td><td><input type='text' value='<?php echo date('Y-m-d');?>'  class='date' name='tanggal_pengajuan' autocomplete='off' style='width:100px' /></td>
				<tr>
				<td>Nominal</td><td>:</td><td><input onkeyup="formatNumber(this);" onchange="formatNumber(this);" type='text' name='nominal_pengajuan' style='width:100px'  disabled='true'  /> </td>
				</tr>
				<tr>
				<td>Tenor</td><td>:</td><td> <input type='text' name='tenor_diajukan' style='width:100px'    /> </td>
				</tr>
				<tr>
				<td align ='right'>Oleh</td><td>:</td><td> 
				<input  style='width:100px'  type="text" name="diajukan_oleh" readonly="true" />
				</td>
				</tr>
				</table>
			</td>
			 <td ><h1>=></h1></td>
			 <td>
				<table bgcolor='blue'>
				<tr><td  align='center' colspan='3'>Disetujui</td></tr>
				<tr>
				<td>Tanggal</td><td>:</td><td><input type='text' value='<?php echo date('Y-m-d');?>'  class='date' name='tanggal_disetujui' autocomplete='off' style='width:100px' /></td>
				<tr>
				<td>Nominal</td><td>:</td><td><input onkeyup="formatNumber(this);" onchange="formatNumber(this);" type='text' name='nominal_disetujui' style='width:100px'  disabled='true'  />  </td>
				</tr>
				<tr>
				<td>Tenor</td><td>:</td><td> <input type='text' name='tenor_disetujui' style='width:100px'    /> </td>
				</tr>
				<tr>
				<td align ='right'>Oleh</td><td>:</td><td>
					<?php 
					$cari = array('name' => 'disetujui_oleh',
							'id' => 'disetujui_oleh',
							'type' => 'text',
							'size' => '10',
							'maxlength' => '30',
							'style'=>'width:100px',
							'value' => ''
						);
					echo form_input($cari);
					?>
			    </td>
				</tr>
				</table>
			</td>
			<td ><h1>=></h1></td>
			<td> 
				<table bgcolor='green'>
				<tr><td  align='center' colspan='3'>Pencairan</td></tr>
				<tr>
				<td>Tanggal</td><td>:</td><td><input type='text' value='<?php echo date('Y-m-d');?>'  class='date' name='tanggal_pencairan' autocomplete='off' style='width:100px' /></td>
				<tr>
				<td>Nominal</td><td>:</td><td><input onkeyup="formatNumber(this);" onchange="formatNumber(this);" type='text' name='nominal_pencairan' style='width:100px'  disabled='true'  /> </td>
				</tr>
				
				<tr>
				<td align ='right'>Oleh</td><td>:</td><td> 
				<?php 
					$cari = array('name' => 'dicairkan_oleh',
							'id' => 'dicairkan_oleh',
							'type' => 'text',
							'size' => '10',
							'maxlength' => '30',
							'style'=>'width:100px',
							'value' => ''
						);
					echo form_input($cari);
					?>
				</td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
            <td ></td>
            <td class='title' colspan='6'></td>
        </tr>
        <tr>
            <td class='a_right' valign='top'>Keterangan</td>
            <td valign='top'>:</td>
            <td colspan='5'  class='a_left' valign='top'><input type='text' name='keterangan' style='width:600px' /></td>
			
        </tr>
		 <tr>
            <td class='a_right' valign='top'>Status</td>
            <td valign='top'>:</td>
            <td colspan='5'  class='a_left' valign='top'>
			<?php
            echo $this->fungsi->build_select_common('status_pinjaman',$statuspinjaman,'id_status','status_pinjaman','',$cur_statuspinjaman);
            ?>
			</td>
			
        </tr>
    </table>
    </form>
	
    <div class='the_footer a_left'>
    <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>[X] Close</a>
	<?php if($this->auth->cek('data_pinjaman',true)):?>
	<a name='edit_pinjaman' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='edit()'>[√] Edit</a>
	<a name='simpan_pinjaman' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan()'>[S] Simpan</a>
	<?php endif; ?>
	</div>
	
	</br>
    </div>
    </div>
    </div>
<div id="backgroundPopup"></div>
