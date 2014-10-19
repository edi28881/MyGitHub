   <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <!-- pindah ke index.php
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery-1.3.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery.autocomplete.js'></script>
   -->   	
<script type='text/javascript'>
    $(function(){
	   // $('.date').calendar();
		setAutocompleteCari();
	$('#umur').val(umur($('#tanggal_lhr').val()));
	$('#masa_kerj').val(umur($('#masuk_pt').val()));
	$('#masa_angg').val(umur($('#masuk_kokab').val()));
	}); 
	function umur(lhr) {
		//lhr = $('.tanggal_lhr_'+id).val() ;
		var skr = new Date();
		var t   = lhr.split(/[- :]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
	}
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
	   var anggota = $('input[name=cari_nak]').val();
	   load_no_loading('user_dashboard/index/'+anggota+'','#content');
	   })
    } 
    function view_anggota()
	{
	    var anggota = $('input[name=cari_nak]').val();
        load_no_loading('anggota/view/'+anggota,'#content');
		$('.date').calendar();
        $('div[name=container_form]').show('slow');
        chain_select();
        chain_select_2();
		$("#container_form input").attr("disabled",true);
		$("#container_form select").attr("disabled",true);
		$('a[name=simpan]').hide();
		$('a[name=edit_photo]').hide();
		$('a[name=edit]').show();
		$('a[name=close]').hide();
		setAutocompleteCari();
	}
	
    function view_simpanan()
    {
        var jenissimpanan = $('select[name=jenissimpanan]').val();
        var tahun = $('select[name=tahun]').val();
		var bulan = $('select[name=bulan]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('simpanan_anggota2/index/'+jenissimpanan+'_'+tahun+'_'+bulan+'_'+anggota+'_0','#content');
        $('input[name=jenissimpanan]').val(jenis_simpanan);
        var txt_jenissimpanan = $('select[name=jenissimpanan] :selected').text();
        $('.jenis').html(txt_jenissimpanan);
		$('div[name=container_form]').hide('fast');
    }
	function view_pinjaman()
    {
        var statuspinjaman = $('select[name=statuspinjaman]').val();
		var jenispinjaman = $('select[name=jenispinjaman]').val();
        var tahun = $('select[name=tahun]').val();
		var bulan = $('select[name=tahun]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('pinjaman_anggota/index/'+jenispinjaman+'_'+tahun+'_'+anggota+'_'+statuspinjaman+'_0','#content');
        $('input[name=jenispinjaman]').val(jenis_pinjaman);
        var txt_jenispinjaman = $('select[name=jenispinjaman] :selected').text();
        $('.jenis').html(txt_jenispinjaman);
		$('div[name=container_form]').hide('fast');
    }
 <?php if($this->auth->cek('data_simpanan',true)):?>  
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

<div align='center' style='font-size:15px !important;' class='title'> Dashboard Anggota Koperasi</div>
<?php if($this->auth->cek('data_simpanan',true)):?>     
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
 <?php endif;?>
<div name='tabel_transaksi' class='tabel_transaksi'>
<?php echo $this->load->view('anggota/tabel_dashboard');?>
</div>
<div id="backgroundPopup"></div>
