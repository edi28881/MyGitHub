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
		$('#umur').val(umur($('#tanggal_lhr').val()));
		$('#masa_kerj').val(umur($('#masuk_pt').val()));
		$('#masa_angg').val(umur($('#masuk_kokab').val()));
		$('a[id^="a_edit_"]').show();
		$('a[id^="a_simpan_"]').hide();
		$(".item-row:first").find('.nomor').val($(".dark78:first").find('.nomor').val());
		$(".item-row:first").find('.nak').val($(".dark78:first").find('.nak').val());
		$(".item-row:first").find('.user').val($(".dark78:first").find('.nak').val());
		$(".item-row:first").find('.jenis_js').val($(".dark78:first").find('select[name=jenis]').val());
		$(".item-row:first").find('.nominal_js').val($(".dark78:first").find('.nominal_js').val());
		$(".item-row:first").find('.date').val(bulan_depan($(".dark78:first").find('.date').val()));
		$('#a_simpan').hide('slow');
		$('.item-row').hide('slow');
    }); 
	function bulan_depan(tp)
	{
		 var dateParts = tp.split("-");
		 var date = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0,2));
		 var d = date.getDate();
		 var m = date.getMonth();
		 var y = date.getFullYear();
		 var edate = new Date(y, m + 1, 25);
		 var d2 = edate.getDate();
		 var m2 = edate.getMonth()+1;
		 if (d2 < 10) {
				d2 = '0' + d2;
				}
		 if (m2 < 10) {
				m2 = '0' + m2;
				}
		 var y2 = edate.getFullYear();
		 return  new String(''+ y2 + '-' + m2 + '-' + d2 +'');
	}
	$(".delete").live('click',function(){
		$(this).parents('.item-row').remove();
		if ($(".delete").length < 1) $(".delete").hide();
		if ($(".delete").length <=12) $("#addrow").show();
	  });
	$("#addrow").click(function(){
	        $('#a_simpan').show('slow');
			$('.item-row').show('slow');
	        var a = $(".item-row:first").find('b').text();
		    var a = +Number(a)+1;
			var content = "<tr class='item-row' bgcolor='grey'><td style='color:red'><div class='delete-wpr'><a class='delete' href='javascript:;' title='Remove row'>X</a></div><b>"+ a +"</b></td><td></td>";
			content += "<input  	name='line["+ a +"][nomor]' type='hidden' class='nomor'  value=''>";
			content += "<input     	name='line["+ a +"][nak]'   type='hidden' class='nak'  value=''>";
			content += "<input     	name='line["+ a +"][user]'   type='hidden' class='user'  value=''>";
			content += "<td><select name='line["+ a +"][jenis]' class='jenis_js' <option value='0'>- pilih -</option><option value='1'>Pokok</option><option  value='2'>Wajib</option><option value='3'>Sukarela</option></select></td>";
            content += "<td><input  name='line["+ a +"][nominal]' align='right' value='' type='text' class='nominal_js'  style='width:100px ; text-align:right;'  onkeyup='formatNumber(this);' onchange='formatNumber(this);'/></td>";
            content += "<td><input  name='line["+ a +"][tanggal_transaksi]' type='text' class='date' value='' > </td>";
			content += "<td><input  name='line["+ a +"][keterangan]' type='text' style='width:100px'  value=''></td>";
			content += "<td style='font-size:75%;'>  </td>";
			content += "<td style='font-size:75%;'></td>";
            content += "<td></td></tr>";
		    $(".item-row:first").before(content);
			$(".item-row:first").find('.jenis_js').val($(".dark78:first").find('select[name=jenis]').val());
			$(".item-row:first").find('.nominal_js').val($(".dark78:first").find('.nominal_js').val());
			$(".item-row:first").find('.nak').val($(".dark78:first").find('.nak').val());
			$(".item-row:first").find('.user').val($(".dark78:first").find('.nak').val());
			$('.date').calendar();
			var bi = $(".item-row:first").next('tr').find('.date').val();
			//alert(bi);
			$(".item-row:first").find('.date').val(bulan_depan(bi));
		    if ($(".delete").length > 0) $(".delete").show();
		if ($(".delete").length > 12) $("#addrow").hide();
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
	   view_simpanan() ;
	   })
    } 	
    function view_simpanan()
    {
        var jenissimpanan = $('select[name=jenissimpanan]').val();
        var tahun = $('select[name=tahun]').val();
		var bulan = $('select[name=bulan]').val();
        var anggota = $('input[name=cari_nak]').val();
		var perpage = $('select[name=dataperpage]').val();
        load_no_loading('input_simpanan/per_user/'+jenissimpanan+'_'+tahun+'_'+bulan+'_'+anggota+'_'+perpage+'_'+Math.random(),'#content');
        $('input[name=jenissimpanan]').val(jenis_simpanan);
        var txt_jenissimpanan = $('select[name=jenissimpanan] :selected').text();
        $('.jenis').html(txt_jenissimpanan);
		$('div[name=container_form]').hide('fast');
		$('div[name=tabel_transaksi]').show('slow');
    }
 <?php if($this->auth->cek('data_simpanan',true)):?>  
  function simpan_transaksi()
    {
        var nak = $('input[name=nak]').val();
		var nama_anggota = $('input[name=nama_anggota]').val();
		var jenis = $('select[name=jenis]').val();
		var jenissimpanan = $('select[name=jenissimpanan]').val();
        var tanggal = $('input[name=tanggal_transaksi]').val();
        var keterangan = $('input[name=keterangan]').val();
        var nominal = $('input[name=nominal]').val();
		var tahun = $('select[name=tahun]').val();
		var bulan = $('select[name=bulan]').val();
        var anggota = $('input[name=cari_nak]').val();
		var perpage = $('select[name=dataperpage]').val();
        if(jenis=='-1'||tanggal==''||nominal==''||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
            
			send_form(document.form_transaksi,'input_simpanan/simpan_simpanan_masal','#content');
			//load_no_loading('simpanan_anggota2/index/0_0_'+nak+'_0_','#content');
			setTimeout(function(){load_no_loading('input_simpanan/per_user/'+jenissimpanan+'_'+tahun+'_'+bulan+'_'+anggota+'_'+perpage+'_'+Math.random(),'#content')},10);
        }
    }
    function simpan_transaksi_u()
    {
        var nak = $('input[name=nak]').val();
		var nama_anggota = $('input[name=nama_anggota]').val();
		var jenis = $('input[name=jenis]').val();
		var jenissimpanan = $('select[name=jenissimpanan]').val();
        var tanggal = $('input[name=tanggal_transaksi]').val();
        var keterangan = $('input[name=keterangan]').val();
        var nominal = $('input[name=nominal]').val();
		var tahun = $('select[name=tahun]').val();
		var bulan = $('select[name=bulan]').val();
        var anggota = $('input[name=cari_nak]').val();
		var perpage = $('select[name=dataperpage]').val();
        if(jenis=='-1'||tanggal==''||nominal==''||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
            
			send_form(document.form_transaksi_u,'input_simpanan/simpan_simpanan_masal','#content');
			//load_no_loading('simpanan_anggota2/index/0_0_'+nak+'_0_','#content');
			setTimeout(function(){load_no_loading('input_simpanan/per_user/'+jenissimpanan+'_'+tahun+'_'+bulan+'_'+anggota+'_'+perpage+'_'+Math.random(),'#content')},100);
        }
    }
	function simpan_s(id)
    {
		
		var nomor = $('#nomor_'+id).val();
		var nak = $('#nak_'+id).val();
		var jenis = $('.jenis_'+id).val();
        var tanggal_transaksi = $('#tanggal_transaksi_'+id).val();
        var keterangan = $('#keterangan_'+id).val();
        var nominal = $('#nominal_'+id).val();
		
		var string = "nomor="+nomor+"&jenis="+jenis+"&nak="+nak+"&nominal="+nominal+"&tanggal_transaksi="+tanggal_transaksi+"&keterangan="+keterangan;
			
		 if(jenis=='-1'||tanggal_transaksi==''||nominal==''||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
		//alert(string);
		$.ajax({
			type	: "POST",
			url 	: "<?php echo site_url('input_simpanan/simpan_simpanan_ajax') ?> ",
			data	: string,
			//cache	: false,
			success	: function(data){
                               //alert('Info '+data);
							   $('#a_edit_'+id).show();
		                       $('#a_simpan_'+id).hide();
							   $('#row_transaksi_'+id).css('background-color','green');
							   $('#row_transaksi_'+id).css('color','red');
							   $('#row_transaksi_'+id).closest('tr').find('input').attr("disabled",true);
		                       $('#row_transaksi_'+id).closest('tr').find('select').attr("disabled",true);
                            },
			error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + errorThrown + ' ' + textStatus + ' ' + jqXHR);
            }
							
		});	
    }
	function simpan_simpanan_masal()
    {   
	send_form(document.form_transaksi_u,'input_simpanan/simpan_simpanan_masal','#content');    
    setTimeout(function(){load_no_loading('input_simpanan/per_user/0_0_0_0_0_'+Math.random(),'#content')},2000);
	$('#a_simpan').hide('slow');
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
	function edit_s(id)
    {
		$('#row_transaksi_'+id).closest('tr').find('input').attr("disabled",false);
		$('#row_transaksi_'+id).closest('tr').find('select').attr("disabled",false);
		$('#row_transaksi_'+id).css('background-color','grey');
		$('#a_edit_'+id).hide();
		$('#a_simpan_'+id).show();
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
        $('select[name=jenis]').val('1');
		setAutocomplete();

    }
	function tambah_u(id)
    {
		popup();
        document.form_transaksi.reset();
        $('div[name=container_form]').show('slow');
		$('input[name=nak]').attr("readonly", false);
        $('input[name=nak]').val($('.nak_'+id).val());
		$('input[name=nama_anggota]').val($('.nama_anggota_'+id).val());
        $('select[name=jenis]').val($('.jenis_'+id).val());
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
<div align='left' id="pencarian">
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
<table><tr><td><?php include_once 'tabel_data_anggota.php'; ?></td></tr></table>
<div class='title'>Input Simpanan Anggota</div>
<div id='tombol' >
<?php
echo ' Jenis : ';
echo $this->fungsi->build_select_common('jenissimpanan',$jenissimpanan,'id','nama','onchange="view_simpanan()"',$cur_jenissimpanan);
echo ' Tahun : ';
echo $this->fungsi->build_select_year('tahun','onchange="view_simpanan()"',$cur_tahun);
echo ' Bulan : ';
echo $this->fungsi->build_select_month('bulan','onchange="view_simpanan()"',$cur_bulan);
?>
</div>
<form method='post' action='' name='form_transaksi_u'>
<div name='tabel_transaksi' class='tabel_transaksi'>
</form>
<?php  echo $this->load->view('anggota/tabel_simpanan_u');?>
</div>
<div name="container_data" class="container_data">

<div  name='container_form' id='container_form' >
      <div id="contactForm">
        	<div class="loader"></div>
			<div class="bar"></div>
     <div class='title'>Input Simpanan</div>
    <div class='the_footer a_left'>
        <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_transaksi()'>Simpan</a>
        <a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='reset_form()'>Kosongkan Form</a>
    <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>Cancel</a></div>
    </div>
    </div>
    </div>
<div id="backgroundPopup"></div>
