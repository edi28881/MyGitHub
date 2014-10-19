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
		$('.detail').hide('slow');
		$('.tenor').hide('slow');
		chain_select3();
		$('.a_center').hide();
	});     
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

function chain_select()
    {
    $("#gaji_pokok").change(function(){
                var selectValues = $("#gaji_pokok").val();
                if (selectValues == 0){
                    var msg = "kab / Region :<br><select name='nominal_simulasi' disabled><option value='0'>Isi Gaji Pokok Dahulu</option></select>";
                    $('#nominal_simulasi').html(msg);
                }else{
				    var g = $("#gaji_pokok").val().replace('/[^0-9\.]+/g',"")
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
					    }
					content += "</table>"
					
				$('#tabel_simulasi').children().remove().end().append(content);
        });
    }






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
			send_form(document.form_transaksi,'pinjaman_anggota/simpan_simulasi','#content');
			
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
	height:550px;width:2000px;
	background:#515151 ;
	border:1px solid #929191;
	padding:7px 12px;
	color:#fff;
	}
#tombol {
	float:left;
}
#pencarian {
	float:left;
}
</style>

<div class='title'>Simulasi Pinjaman Anggota</div>
<form method='post' action='' class="contactForm" name='form_transaksi'>
<div  id="pencarian">
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
        <table class='myform' id='masa'  name='masa' >
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
