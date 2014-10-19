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
		total_simpanan_wajib();
		total_sumber_dana();
	});    
  function total_simpanan_wajib()
  {
   var a = $('#jumlah_anggota').val();
   var b = $('#simp_wajib').val().replace(/\,/g, '');
   var c = a*b;
   $('#total_simp_wajib').val(addCommas(c));
   total_sumber_dana();
  } 
  function total_sumber_dana()
  {
   var a =  +$('#total_simp_wajib').val().replace(/\,/g, '');
   var b =  +$('#total_ang').val().replace(/\,/g, '');
   var c =  +$('#dana_lain').val().replace(/\,/g, '');
   $('#sumber_dana').val(addCommas(a + b + c));
   total_usulan();
  } 
  $('.checkbox').change(function()
				    {
								var $this = $(this);
								if ($this.is(':checked')) {
								$(this).closest('tr').find('.nominal_disetujui').val($(this).closest('tr').find('.nominal_pengajuan').val());
							    } else {
								$(this).closest('tr').find('.nominal_disetujui').val('0');
					            }
								total_usulan(); 
					            total_pengeluaran();
					});
  $('#checkAll').click(function()
                {
                $('input:checkbox').attr('checked',this.checked);
					var $rows = $("#tableUsulan").find("tr");
				    var ttlrow = $("#tableUsulan tr").length;
					  for (var row = 0; row < ttlrow-1; row++)					  
					  {
				      if ($(this).is(':checked')) {
					  $($rows[row]).find('.nominal_disetujui').val($($rows[row]).find('.nominal_pengajuan').val());
					  } else {
							 $($rows[row]).find('.nominal_disetujui').val('0');
					        }
					  }
					total_usulan(); 
					total_pengeluaran();
				});
 function total_usulan()
          {
		    var total = 0;
			$( '.nominal_disetujui' ).each( function(){
			  total += parseFloat( $( this ).val().replace(/\,/g, '') ) || 0;
			});
		     $('.total_disetujui').val(addCommas(total));
			 total_pengeluaran()
		  }
 function total_pengeluaran()
  {
   var a =  +$('#pengeluaran_lain').val().replace(/\,/g, '');
   var b =  +$('#total_disetujui').val().replace(/\,/g, '');
   $('#total_pengeluaran').val(addCommas(a + b));
   sisa();
  } 
  
  function sisa()
  {
   var a =  +$('#sumber_dana').val().replace(/\,/g, '');
   var b =  +$('#total_pengeluaran').val().replace(/\,/g, '');
   $('#sisa').val(addCommas(a - b));
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
		function addTitik(nStr)
		{
			nStr += '';
			x = nStr.split('.');
			x1 = x[0];
			x2 = x.length > 1 ? '.' + x[1] : '';
			var rgx = /(\d+)(\d{3})/;
			while (rgx.test(x1)) {
				x1 = x1.replace(rgx, '$1' + '.' + '$2');
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
tr
	{mso-height-source:auto;}
col
	{mso-width-source:auto;}
br
	{mso-data-placement:same-cell;}
.style16
	{mso-number-format:"_\(* \#\,\#\#0\.00_\)\;_\(* \\\(\#\,\#\#0\.00\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	mso-style-name:Comma;
	mso-style-id:3;}
.style0
	{mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	white-space:nowrap;
	mso-rotate:0;
	mso-background-source:auto;
	mso-pattern:auto;
	color:black;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	border:none;
	mso-protection:locked visible;
	mso-style-name:Normal;
	mso-style-id:0;}
td
	{mso-style-parent:style0;
	padding-top:1px;
	padding-right:1px;
	padding-left:1px;
	mso-ignore:padding;
	color:#9A2EFE;
	font-size:11.0pt;
	font-weight:400;
	font-style:normal;
	text-decoration:none;
	font-family:Calibri, sans-serif;
	mso-font-charset:0;
	mso-number-format:General;
	text-align:general;
	vertical-align:bottom;
	border:none;
	mso-background-source:auto;
	mso-pattern:auto;
	mso-protection:locked visible;
	white-space:nowrap;
	mso-rotate:0;}
.xl65
	{mso-style-parent:style0;
	text-align:center;
	border:.5pt solid windowtext;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl66
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	border:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl67
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl68
	{mso-style-parent:style0;
	color:red;}
.xl69
	{mso-style-parent:style16;
	color:red;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:left;}
.xl70
	{mso-style-parent:style16;
	color:red;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;}
.xl71
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:left;
	border:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl72
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl73
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl74
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl75
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl76
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:left;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl77
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border:.5pt solid windowtext;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl78
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl79
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl80
	{mso-style-parent:style0;
	border:.5pt solid windowtext;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl81
	{mso-style-parent:style0;
	border:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl82
	{mso-style-parent:style0;
	font-weight:700;
	border:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl83
	{mso-style-parent:style0;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl84
	{mso-style-parent:style0;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl85
	{mso-style-parent:style0;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl86
	{mso-style-parent:style0;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl87
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl88
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl89
	{mso-style-parent:style0;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#BFBFBF;
	mso-pattern:black none;}
.xl90
	{mso-style-parent:style16;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:left;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#F2F2F2;
	mso-pattern:black none;}
.xl91
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#FFC000;
	mso-pattern:black none;}
.xl92
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#FFC000;
	mso-pattern:black none;}
.xl93
	{mso-style-parent:style0;
	font-weight:700;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#FFC000;
	mso-pattern:black none;}
.xl94
	{mso-style-parent:style0;
	font-weight:700;
	text-align:left;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl95
	{mso-style-parent:style0;
	font-weight:700;
	text-align:left;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl96
	{mso-style-parent:style0;
	font-weight:700;
	text-align:left;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#D9D9D9;
	mso-pattern:black none;}
.xl97
	{mso-style-parent:style0;
	font-size:14.0pt;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;}
.xl98
	{mso-style-parent:style0;
	font-size:14.0pt;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;}
.xl99
	{mso-style-parent:style0;
	font-size:14.0pt;
	font-weight:700;
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;}
.xl100
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#C00000;
	mso-pattern:black none;}
.xl101
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#C00000;
	mso-pattern:black none;}
.xl102
	{mso-style-parent:style0;
	font-weight:700;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#C00000;
	mso-pattern:black none;}
.xl103
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:.5pt solid windowtext;
	background:#00B0F0;
	mso-pattern:black none;}
.xl104
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B0F0;
	mso-pattern:black none;}
.xl105
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B0F0;
	mso-pattern:black none;}
.xl106
	{mso-style-parent:style0;
	font-weight:700;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	text-align:center;
	border-top:.5pt solid windowtext;
	border-right:none;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B0F0;
	mso-pattern:black none;}
.xl107
	{mso-style-parent:style0;
	font-weight:700;
	mso-number-format:"_\(* \#\,\#\#0_\)\;_\(* \\\(\#\,\#\#0\\\)\;_\(* \0022-\0022??_\)\;_\(\@_\)";
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#00B0F0;
	mso-pattern:black none;}
.xl108
	{mso-style-parent:style0;
	font-weight:700;
	border-top:.5pt solid windowtext;
	border-right:.5pt solid windowtext;
	border-bottom:.5pt solid windowtext;
	border-left:none;
	background:#FFC000;
	mso-pattern:black none;}

</style>
</br>
<table bgcolor='#4B610B' border=0 cellpadding=0 cellspacing=0 width=781 style='border-collapse:
 collapse;table-layout:fixed;width:587pt'>
 <col width=64 span=4 style='width:48pt'>
 <col width=52 style='mso-width-source:userset;mso-width-alt:1901;width:39pt'>
 <col width=129 style='mso-width-source:userset;mso-width-alt:4717;width:97pt'>
 <col width=42 style='mso-width-source:userset;mso-width-alt:1536;width:32pt'>
 <col width=133 style='mso-width-source:userset;mso-width-alt:4864;width:100pt'>
 <col width=135 style='mso-width-source:userset;mso-width-alt:4937;width:101pt'>
 <col width=34 style='mso-width-source:userset;mso-width-alt:1243;width:26pt'>
 <tr height=25 style='height:18.75pt'>
  <td colspan=10 height=25 class=xl97 width=747 style='border-right:.5pt solid black;
  height:18.75pt;width:561pt'>Simulasi Pencairan Dana Pinjaman</td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl103 colspan=2 style='height:15.0pt;mso-ignore:colspan'>Sumber
  Dana</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl105>&nbsp;</td>
  <td></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 style='mso-ignore:colspan'>1. Simpanan Wajib Anggota bulan ini:</td>
  <td colspan=5 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=2 class=xl67>Jumlah Anggota</td>
  <td colspan=2 class=xl67 style='border-left:none'>Iuran</td>
  <td class=xl72 style='border-left:none'>&nbsp;</td>
  <td class=xl87>&nbsp;</td>
  <td class=xl73>Total</td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=2 class=xl66>
   <?php foreach($jumlah_anggota->result() as $i => $row):?>
	<input style='text-align:right;'  type='text'  id='jumlah_anggota'  onchange='total_simpanan_wajib(); formatNumber(this);' value='<?php echo $row->jumlah_anggota; ?>' autocomplete='off' style='width:120px' />
   <?php endforeach; ?>
  </td>
  <td colspan=2 class=xl66 style='border-left:none'>
	<input style='text-align:right;'  type='text'  id='simp_wajib'    onchange='total_simpanan_wajib(); formatNumber(this);' value='100,000' autocomplete='off' style='width:120px' />
  </td>
  <td class=xl74 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl88 style='border-top:none'>&nbsp;</td>
  <td class=xl75 style='border-top:none'>
	<input style='text-align:right; font-weight:bold; background-color:yellow; width:120px;' disabled='true'  type='text'  id='total_simp_wajib' value='' autocomplete='off' style='' />
  </td> 
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=5 style='mso-ignore:colspan'>2. Angsuran Pinjaman Jatuh Tempo
  Bulan ini :</td>
  <td colspan=4 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=2 class=xl67>Angsuran Pokok</td>
  <td colspan=2 class=xl67 style='border-left:none'>Angsuran Bunga</td>
  <td class=xl72 style='border-left:none'>&nbsp;</td>
  <td class=xl87>&nbsp;</td>
  <td class=xl73>Total</td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <?php foreach($total_angsuran->result() as $i => $row):?>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=2 class=xl66>
     <input style='text-align:right;'  type='text'  disabled='true' id='ang_pokok'    value='<?php echo $this->fungsi->pecah($row->ang_pokok,','); ?>' autocomplete='off' style='width:120px' />
	 </td>
  <td colspan=2 class=xl66 style='border-left:none'>
    <input style='text-align:right;'  type='text'  disabled='true' id='ang_bunga'    value='<?php echo $this->fungsi->pecah($row->ang_bunga,','); ?>' autocomplete='off' style='width:120px' />
	</td>
  <td class=xl74 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl88 style='border-top:none'>&nbsp;</td>
  <td class=xl75 style='border-top:none'>
	  <input style='text-align:right; font-weight:bold; background-color:yellow; width:120px;'  type='text' disabled='true'  id='total_ang'   value='<?php echo $this->fungsi->pecah($row->total_ang,','); ?>' autocomplete='off'  />
	  </td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <?php endforeach; ?>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=2 style='mso-ignore:colspan'>3. Dana Lain :</td>
  <td colspan=7 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 class=xl77>Keterangan</td>
  <td class=xl78 style='border-left:none'>&nbsp;</td>
  <td class=xl89>&nbsp;</td>
  <td class=xl79>Total</td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 class=xl71>
      <input  type='text'  id='keterangan_dana_lain'   value='' autocomplete='off' style='width:150px' />
	  </td>
  <td class=xl76 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl90 style='border-top:none'>&nbsp;</td>
  <td class=xl75 style='border-top:none'>
     <input style='text-align:right;'  type='text' onchange='total_sumber_dana(); formatNumber(this);'  id='dana_lain'   value='' autocomplete='off' style='width:120px' /></td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr class=xl68 height=20 style='height:15.0pt'>
  <td height=20 class=xl68 style='height:15.0pt'></td>
  <td class=xl69></td>
  <td class=xl69></td>
  <td class=xl69></td>
  <td class=xl69></td>
  <td class=xl69></td>
  <td class=xl69></td>
  <td class=xl70></td>
  <td class=xl68></td>
  <td class=xl68></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl103 colspan=2 style='height:15.0pt;mso-ignore:colspan'>Total
  Sumber Dana</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl104>&nbsp;</td>
  <td class=xl106>&nbsp;</td>
  <td class=xl107> 
   <input style='text-align:right; font-weight:bold; background-color:yellow; width:120px;' type='text'   disabled='true'  id='sumber_dana'   value='' autocomplete='off'  />
   </td>
  <td></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl91 colspan=2 style='height:15.0pt;mso-ignore:colspan'>Pengeluaran</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl108>&nbsp;</td>
  <td></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=3 style='mso-ignore:colspan'>1. Pengeluaran Selain Anggota</td>
  <td colspan=6 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 class=xl77>Keterangan</td>
  <td class=xl78 style='border-left:none'>&nbsp;</td>
  <td class=xl89>&nbsp;</td>
  <td class=xl79>Total</td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 class=xl71><span style='mso-spacerun:yes'>
  <input  type='text'  id='keterangan_pengeeluaran_lain'   value='' autocomplete='off' style='width:150px' />
  </td>
  <td class=xl76 style='border-top:none;border-left:none'>&nbsp;</td>
  <td class=xl90 style='border-top:none'>&nbsp;</td>
  <td class=xl75 style='border-top:none'>
   <input style='text-align:right;' type='text' onchange=' formatNumber(this); total_pengeluaran(); '  id='pengeluaran_lain'   value='' autocomplete='off' style='width:120px' /></td>
  </td>
  <td colspan=2 style='mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 style='height:15.0pt'></td>
  <td colspan=4 style='mso-ignore:colspan'>2. Pengeluaran Pinjaman Anggota</td>
  <td colspan=5 style='mso-ignore:colspan'></td>
 </tr>
 <td></td>
 <td colspan='8'>
	<table  id='tableUsulan' border='5%' >
		 <tr height=20 style='height:15.0pt'>
		  <td height=20 style='height:15.0pt'></td>
		  <td class=xl80>NAK</td>
		  <td colspan=2 class=xl83 style='border-right:.5pt solid black;border-left:
		  none'>Nama</td>
		  <td class=xl65 style='border-left:none'>Jns</td>
		  <td class=xl65 style='border-left:none'>Tanggal Pengajuan</td>
		  <td class=xl65 style='border-left:none'>Tnr</td>
		  <td class=xl65 style='border-left:none'>Nominal Usulan</td>
		  <td class=xl80 style='border-left:none'>Nominal Disetujui</td>
		  <td class=xl80 align=right style='border-left:none'><input id='checkAll' type='checkbox' /></td>
		 </tr>
        
		 <?php foreach($pinjaman->result() as $i => $row):
		 $total[]= array();
		 $total[]= $row->nominal_pengajuan; ?>
		 <tr height=20 style='height:15.0pt'>
		  <td height=20 style='height:15.0pt'></td>
		  <td class=xl81 align=right style='border-top:none'><?php echo $row->nak; ?></td>
		  <td colspan='2' class=xl85 style='border-top:none;border-left:none'><?php echo $row->nama_anggota; ?></td>
		  <td class=xl86 style='border-top:none'><?php echo $row->jenis; ?></td>
		  <td class=xl81 style='border-top:none;border-left:none'><?php echo $row->tanggal_pengajuan; ?></td>
		  <td class=xl81 style='border-top:none;border-left:none'><?php echo $row->tenor_diajukan; ?></td>
		  <td align='right' class=xl81 style='border-top:none;border-left:none'>
		    <input style='text-align:right;' class='nominal_pengajuan' id='nominal_pengajuan' type='text'   value="<?php echo $this->fungsi->pecah($row->nominal_pengajuan,','); ?>" style='width:120px' /></td>
		  </td>
		  <td align='right' class=xl81 style='border-top:none;border-left:none'>
			<input style='text-align:right;' class='nominal_disetujui' id='nominal_disetujui[<?php echo $i; ?>]'	type='text'  onchange=' total_usulan(); formatNumber(this);'   value='0' autocomplete='off' style='width:120px' /></td>
		  </td>
		  <td class=xl81 align=right style='border-top:none;border-left:none'>
		    <input  id="checkbox_['<?=$i;?>']" value='1' class='checkbox' type='checkbox' /></td>
		 </tr>
		 <?php endforeach; ?>
 
		 <tr height=20 style='height:15.0pt'>
		  <td height=20 style='height:15.0pt'></td>
		  <td colspan=6 class=xl94 style='border-right:.5pt solid black'>Total</td>
		  <td align='right' class=xl67 style='border-top:none;border-left:none'><?php echo $this->fungsi->pecah(array_sum($total),','); ?> </td>
		  <td align='right' class=xl67 style='border-top:none;border-left:none'>
				<input disabled='true' style='text-align:right;' class='total_disetujui'  type='text'  id='total_disetujui'   value=''  style='width:120px' /></td>
		  </td>
		  <td class=xl82 style='border-top:none;border-left:none'>&nbsp;</td>
		  </table>
 </td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl91 colspan=2 style='height:15.0pt;mso-ignore:colspan'>Total
  Pengeluaran</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl92>&nbsp;</td>
  <td class=xl93>
  <input style='text-align:right; font-weight:bold; background-color:yellow; width:120px;' disabled='true' type='text' id='total_pengeluaran'   value='' autocomplete='off'  /></td>
  </td>
  <td></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 colspan=10 style='height:15.0pt;mso-ignore:colspan'></td>
 </tr>
 <tr height=20 style='height:15.0pt'>
  <td height=20 class=xl100 style='height:15.0pt'>Sisa</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>
  <td class=xl101>&nbsp;</td>  
  <td class=xl102>
    <input style='text-align:right; font-weight:bold; background-color:yellow; width:120px;' disabled='true' type='text' id='sisa'   value='' autocomplete='off'  />
	</td>
  <td></td>
 </tr>
 <![if supportMisalignedColumns]>
 <tr height=0 style='display:none'>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=64 style='width:48pt'></td>
  <td width=52 style='width:39pt'></td>
  <td width=129 style='width:97pt'></td>
  <td width=42 style='width:32pt'></td>
  <td width=133 style='width:100pt'></td>
  <td width=135 style='width:101pt'></td>
  <td width=34 style='width:26pt'></td>
 </tr>
 <![endif]>
</table>

<div id="backgroundPopup"></div>