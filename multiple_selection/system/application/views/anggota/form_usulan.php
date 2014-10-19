   <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <!-- pindah ke index.php
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery-1.3.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery.autocomplete.js'></script>
   -->   	
<script type='text/javascript'>
    $(function(){
	    $('.date').calendar();
		$('table[name=masa]').hide('slow');
		setAutocompleteCari();
		setAutocomplete()
		setAutocomplete2()
		$('.detail').hide('slow');
		$('.tenor').hide('slow');
		chain_select3();
		$('.a_center').hide();
	});
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
    $('#nak').autocomplete('<?php echo base_url();?>/autocomplete/suggestions1', { 
	   width: 300, 
       minChars: 1 ,
       mustMatch: true, 
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[5].substring(1); } 
	   }); 
	   $('#nak').result(function(event, data, formatted) { 
       if (data)
	   $('input[name=nama_anggota]').val(data[0]);
	   $('input[name=nama_anggota]').attr("readonly", true);
	   $('table[name=masa]').show('slow');
	   $('input[name=tanggal_lhr]').val(data[2]);
	   $('input[name=masuk_pt]').val(data[3]);
	   $('input[name=masuk_kokab]').val(data[4]);
		function umur(lhr) {
		lhr = data[2] ;
		var skr = new Date();
		var t   = lhr.split(/[-]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=umur]').val(umur).attr("disabled", true);
		function msa(lhr) {
		lhr = data[3] ;
		var skr = new Date();
		var t   = lhr.split(/[-]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=masa_angg1]').val(msa).attr("disabled", true);
		$('input[name=umur]').val(umur).attr("disabled", true);
		function msa(lhr) {
		lhr = data[3] ;
		var skr = new Date();
		var t   = lhr.split(/[-]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) ;
		}
		$('input[name=masa_angg]').val(msa).attr("disabled", true);
		function msa1(lhr) {
		lhr = data[3] ;
		var skr = new Date();
		var t   = lhr.split(/[-]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=masa_angg1]').val(msa1).attr("disabled", true);
		function msk(lhr) {
		lhr = data[4] ;
		var skr = new Date();
		var t   = lhr.split(/[-]/)
		var nlhr = new Date(t[0], t[1]-1, t[2], 0, 0, 0)
		var hari = parseInt(skr - nlhr)/(24*3600*1000)
		return parseInt(hari/365) +' Tahun ' + parseInt(hari%365/30)+' Bulan';
		}
		$('input[name=masa_kerj]').val(msk).attr("disabled", true);
		$('.detail').hide('fast');
		$('.tenor').val(0).hide();
		$('.nominal_simulasi').val(0).hide();
		$('#gaji_pokok').val('');
		$('#tabel_simulasi').children().remove();
		$('.detail').show('slow');
		chain_select();
		chain_select2();
	   })
    } 
	
	function detil(id)
    {
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
		$('input[name=masa_kerj]').val(msa).attr("disabled", true);
    }

function chain_select()
    {
    $("#gaji_pokok").change(function(){
                var selectValues = $("#gaji_pokok").val();
                if (selectValues == 0){
                    var msg = "kab / Region :<br><select name=\"nominal_simulasi\" disabled><option value=\"0\">Isi Gaji Pokok Dahulu</option></select>";
                    $('#nominal_simulasi').html(msg);
                }else{
				    var g = $("#gaji_pokok").val().replace(/[^0-9\.]+/g,"")
                    var gaji_p = {gaji_pokok:g,masa_angg:$("#masa_angg").val()};
                    $('#nominal_simulasi').attr("disabled",false);
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('simulasi_pinjaman/select_nominal_simulasi') ?> ",
                            data: gaji_p,
                            success: function(msg){
                                $('#nominal_simulasi').html(msg);
								$('.tenor').show('slow');
								$('#tabel_simulasi').children().remove();
								$('.tenor').val(0).show();
		                        $('.nominal_simulasi').val(0).show();
								
                            }
                    });
                }
        });
    }

function chain_select2()
    {
    $("#nominal_simulasi").change(function(){
                var selectValues = $("#nominal_simulasi").val();
                if (selectValues == 0){
                    var msg = "kab / Region :<br><select name=\"nominal_simulasi\" disabled><option value=\"0\">Pilih Besar Pinjaman Dahulu</option></select>";
                    $('#tenor_simulasi').html(msg);
					
                }else{
                    var nominal_simulasi = {nominal_simulasi:$("#nominal_simulasi").val()};
                    $('#tenor_simulasi').attr("disabled",false);
					
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('simulasi_pinjaman/select_tenor_simulasi') ?> ",
                            data: nominal_simulasi,
                            success: function(msg){
                                $('#tenor_simulasi').html(msg);
								$('#tabel_simulasi').children().remove();
                            }
							
                    });
                }
        });
    }
	
	function addCommas(nStr)
		{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + ',' + '$2');
			}
			return x1 + x2;
		}
	
	function chain_select3()
    {
    $("#tenor_simulasi").change(function(){
	            $('input[name=keterangan]').attr("disabled",false).attr('placeholder', 'Tulis komentar atau keterangan !');
                /*var bg = $("#tenor_simulasi").val();
				var a = document.getElementById('tenor_simulasi')[document.getElementById('tenor_simulasi').selectedIndex].innerHTML;
				*/
				var bg1 = document.getElementById('tenor_simulasi')[document.getElementById('tenor_simulasi').selectedIndex].innerHTML;
				var bg=bg1.substring(16,18);
				var a = $("#tenor_simulasi").val();
				var b = $("#nominal_simulasi").val(); 
				var bga = Math.round(b*bg/100/a/100)*100;
				var bgan = addCommas(bga.toString());
				var ap = Math.round(b/a/100)*100;
				var ap = Math.round(b/a/100)*100;
				var apn = addCommas(ap.toString());
				var ttl = bga+ap;
				var ttln = addCommas(ttl.toString());
				var pjm = b*(1+bg/100);
				var content = "<table class='grid'><tr><th width='10px'></th><th align='center' colspan='5'> <b> Tabel Simulasi Angsuran </b></th></tr><tr align='center'><th width='10px'>No</th><th>Tanggal</th><th>Angsuran Pokok</th><th>Angsuran Bunga</th><th>Total Angsuran</th><th>Sisa</th></tr>"
					     if(a>0){
						 var date = new Date();
						 var d = date.getDate();
						 var m = date.getMonth();
						 var y = date.getFullYear();
					     for(i=1; i<a; i++){
					     var edate = new Date(y, m + i, 25);
						 var d2 = edate.getDate();
						 var m2 = edate.getMonth()+1;
						 if (d2 < 10) {
								d2 = '0' + d2;
								}
						 if (m2 < 10) {
								m2 = '0' + m2;
								}
						 var y2 = edate.getFullYear();
						 var ss = parseInt(pjm - ttl * i) ;
						 var ssn = addCommas(ss.toString());
						content += '<tr><td>'+  i + '</td><td><input type="text" disabled="true" value=" ' + y2 + '-' + m2 + '-' + d2 +'" class="date"></td>';
						content += '<td align="right">'+ apn +'</td><td align="right">' + bgan + '</td><td align="right">' + ttln +'</td><td align="right">' + ssn +'</td></tr>';
					           }
					     var ldate = new Date(y, m + i, 25);
					     var d3 = ldate.getDate();
						 var m3 = ldate.getMonth()+1;
						 if (d3 < 10) {
								d3 = '0' + d3;
								}
						 if (m3 < 10) {
								m3 = '0' + m3;
								}
						 var y3 = ldate.getFullYear();
					content += '<tr><td>'+  a + '</td><td><input type="text" disabled="true"  value=" ' + y3 + '-' + m3 + '-' + d3 +'" class="date"></td>';
					content += '<td align="right">'+ (addCommas(b-(ap*(i-1)))) +'</td><td align="right">' + (addCommas(b*bg/100-bga*(i-1))) + '</td><td align="right">' + addCommas((b*bg/100-bga*(i-1))+(b-(ap*(i-1)))) +'</td><td align="right">' + 0 +'</td></tr>';
					content += "<tr><th colspan='2' > Total </th> <th align='right'>"+ addCommas(b) +"</th><th align='right'>"+addCommas(b*bg/100)+"</th><th align='right'>"+(addCommas(parseInt((b*(1+bg/100)))))+"</th><th align='right'>"+(addCommas(parseInt((b*(1+bg/100)))))+"</th></tr>"
					content += '<input type="hidden" name="total_bunga" value="'+(b*bg/100)+'" >';
					content += '<input type="hidden" name="bunga" value="'+bg+'" >';
					content += '<input type="hidden" name="angsuran_pokok" value="'+ap+'" >';
					content += '<input type="hidden" name="angsuran_bunga" value="'+bga+'" >';
					content += '<input type="hidden" name="total_angsuran" value="'+ttl+'" >';
					content += '<input type="hidden" name="angsuran_pokok_last" value="'+(b-(ap*(i-1)))+'" >';
					content += '<input type="hidden" name="angsuran_bunga_last" value="'+(b*bg/100-bga*(i-1))+'" >';
					content += '<input type="hidden" name="total_angsuran_last" value="'+((b*bg/100-bga*(i-1))+(b-(ap*(i-1))))+'" >';
					
					}
					content += "</table>"
					
				$('#tabel_simulasi').children().remove().end().append(content);
        });
    }



<?php if($this->auth->cek('data_pinjaman',true)):?>
function edit()
    {
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
		$('input[name=tenor_disetujui]').attr("readonly", false);
		$('input[name=keterangan]').attr("disabled", false);
		$('a[name=edit_pinjaman]').hide();
		$('a[name=simpan_pinjaman]').show();
    }
<?php endif; ?> 
    function view_pinjaman()
    {
        var statuspinjaman = $('select[name=statuspinjaman]').val();
		var jenispinjaman = $('select[name=jenispinjaman]').val();
        var tahun = $('select[name=tahun]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('pinjaman_anggota/index/'+jenispinjaman+'_'+tahun+'_'+anggota+'_'+statuspinjaman+'_'+Math.random(),'#content');
        $('input[name=jenispinjaman]').val(jenis_pinjaman);
        var txt_jenispinjaman = $('select[name=jenispinjaman] :selected').text();
        $('.jenis').html(txt_jenispinjaman);
		$('div[name=container_form]').hide('fast');
    }
    function simpan_simulasi()
    {
        var nak = $('input[name=nak]').val();
        var nominal_pengajuan = $('select[name=nominal_simulasi]').val();
		var tenor_diajukan = $('select[name=tenor_simulasi]').val();
        if(nominal_pengajuan==0||tenor_diajukan==0||nak=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
			send_form(document.form_simulasi,'simulasi_pinjaman/simpan_simulasi','#content');
			
        }
    }
  
	function form_close()
    {
        $("#backgroundPopup").fadeOut("slow");
        $('div[name=container_form]').hide('slow');
    }
    function popup()
    {
    $("#backgroundPopup").css({"opacity": "0.6"});
    $("#backgroundPopup").fadeIn("slow");
	alert('oke');
    } 
	function popip()
    {
    $(".footer").hide();
	alert('oke');
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
<div class='title'>Flow Usulan Pinjaman</div>
<?php echo $this->load->view('anggota/tabel_flow_pinjaman');?>
<div class='tabel_transaksi'>
<div class='title'>Daftar Usulan Pinjaman</div>
<?php echo $this->load->view('anggota/tabel_pinjaman2');?>
</div>

<div class='title'>Form Usulan Pinjaman Anggota</div>
<form  method='post' action='' class="contactForm" name='form_simulasi'>
<div style='float:left !important' id="pencarian">
<!-- input type='text' id=cari' name='cari' size='50' maxlength='50' placeholder='Masukkan Nomor Anggota.....' onChange='view_transaksi()' /> -->
		<?php 
		    if(empty($nak)){ $nak= '';}
		    echo ' Nomor Anggota : ';
		    $autocomplete = array('name' => 'nak',
				'id' => 'nak',
				'type' => 'text',
				'size' => '20',
				'maxlength' => '20',
				'value' =>'',
				'placeholder' => 'Masukkan Nama Anggota.....'
			);	
		    echo form_input($autocomplete ); 
			?>
			</br>
		Nama Anggota&nbsp :
		<input size="50" type="text" name="nama_anggota" disabled="true" />
		</br>
        <table  class='myform' id='masa'  name='masa' >
         	<tr> 
				<td>Usia</td> <td>Masa Kerja</td> <td>Masa Anggota</td>
				</tr>
				<tr> 
					<td><input disabled='true' type='text' class='date' name='tanggal_lhr' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date' name='masuk_pt' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date' name='masuk_kokab' autocomplete='off' style='width:100px' /></td> 
				</tr>
				<tr> 
					<td><input disabled='true' type='text'  name='umur' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text'  name='masa_angg1' autocomplete='off' style='width:100px' />
					    <input  disabled='true' type='hidden'  value='' name='masa_angg' id='masa_angg' />
					    </td> 
					<td><input disabled='true' type='text'  name='masa_kerj' autocomplete='off' style='width:100px' /></td> 
				</tr>
		</table>
<div class='detail'>
<?php
echo ' Jenis Pinjaman &nbsp: ';
echo $this->fungsi->build_select_common('jenispinjaman',$jenispinjaman,'id','nama','disabled',1);
echo "<input type='hidden' id='jenis'  name='jenis'  value='1'  />";
echo '</br>';
echo '<div class="gaji_pokok">';
echo ' Gaji Pokok&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp : ';
echo "<input type='text' id='gaji_pokok'  name='gaji_pokok'   onchange='formatNumber(this); chain_select();'  placeholder='Masukkan Gaji Pokok.....'  />";
echo ' Rupiah';
echo '</div>';
echo '<div class="nominal_simulasi">';
echo 'Besar Pinjaman : ';
echo form_dropdown("nominal_simulasi",array('0'=>'Isi Gaji Dahulu',
 	                                   '' => '')
 	                   ,'Isi Gaji Dahulu',"id='nominal_simulasi'" );
echo ' Rupiah';
echo '</div>';
echo '<div class="tenor">';
echo ' Masa Angsuran : ';
echo form_dropdown("tenor_simulasi",array('0'=>'Isi Rupiah Dahulu','' => '') ,'Isi Rupiah Dahulu', "id='tenor_simulasi'" );
echo '</br>';
echo '</div>';
?>
</div>
<div id='tabel_simulasi' > </div>
</br>
Keterangan&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: <input disabled='true' type='text' name='keterangan' style='width:400px' />
</br>
<div class='footer'>
	<a name='simpan_usulan' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_simulasi()'>[S] Simpan</a>
</div>
<?php
        echo form_hidden('tanggal_pengajuan',date('Y-m-d'));
		echo form_hidden('update_by',from_session('nama'));
		echo form_hidden('diajukan_oleh',from_session('nama'));
		echo form_hidden('status_id',1);
        echo form_hidden('tanggal_catat',date('Y-m-d'));
		$ip = $this->input->ip_address();
		echo form_hidden('ip_sender',$ip);
 ?>
</form>
</br>
</div>
<div id="backgroundPopup"></div>


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
			<input size="20" type="text" name="nak" readonly="true" />
			</td>
			<td colspan='3' rowspan='3'> 
                <table class='myform' >
				<tr> 
				<td>Usia</td> <td>Masa Kerja</td> <td>Masa Anggota</td>
				</tr>
				<tr> 
					<td><input disabled='true' type='text' class='date' name='tanggal_lhr' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date' name='masuk_pt' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' class='date' name='masuk_kokab' autocomplete='off' style='width:100px' /></td> 
				</tr>
				<tr> 
					<td><input disabled='true' type='text'  name='umur' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text'  name='masa_angg' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text'  name='masa_kerj' autocomplete='off' style='width:100px' /></td> 
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
			 if(empty($cur_jenispinjaman)){ $cur_jenispinjaman= '0';}
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
				<td>Tenor</td><td>:</td><td> <input type='text' name='tenor_diajukan' style='width:100px'  readonly='true'  /> </td>
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
				<td>Tenor</td><td>:</td><td> <input type='text' name='tenor_disetujui' style='width:100px'  readonly='true'  /> </td>
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
			if(empty($cur_statuspinjaman)){ $cur_statuspinjaman= '1';}
			if(empty($statuspinjaman)){ $statuspinjaman= '1';}
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
