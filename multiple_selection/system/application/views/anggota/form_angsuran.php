   <?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
 <!-- pindah ke index.php
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>asset/javascript/jquery.autocomplete2.css" />
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery-1.3.2.min.js'></script>
     <script type='text/javascript' src='<?php echo base_url(); ?>asset/javascript/jquery.autocomplete.js'></script>
   -->  
   
<script type='text/javascript'>
    $(function(){
	    $('#tabel_simulasi').show('slow');
        $('.date').calendar();
		setAutocompleteCari();
		setAutocomplete();
		setAutocomplete2();
		$( "#tanggal_disetujui" ).datepicker();
		$( "#tanggal_pencairan" ).datepicker();
 	    $('table[name=angsuran]').show('slow');
	}); 
	
	function setAutocomplete()
    {
	$('#dicairkan_oleh').autocomplete('<?php echo base_url();?>/autocomplete/suggestions', { 
	   width: 300, 
       minChars: 1 ,
       matchContains: false, scrollHeight: 100,
	   formatItem: function formatItem(row) {return  row[1] + ' | ' + row[0] ; },
	   formatResult: function formatResult(row) { return row[0]; } 
	   });
    } 
	function setAutocomplete2()
    {
	$('#disetujui_oleh').autocomplete('<?php echo base_url();?>/autocomplete/suggestions', { 
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
    function refresh()
    {
     $('input[name=cari_nak]').val('');   
     view_pinjaman();
    }
    function view_pinjaman()
    {
        var statuspinjaman = $('select[name=statuspinjaman]').val();
		var jenispinjaman = $('select[name=jenispinjaman]').val();
		var perpage = $('select[name=dataperpage]').val();
        var tahun = $('select[name=tahun]').val();
		var pt = $('select[name=pt]').val();
        var anggota = $('input[name=cari_nak]').val();
        load_no_loading('angsuran_pinjaman/index/'+jenispinjaman+'_'+tahun+'_'+anggota+'_'+statuspinjaman+'_'+pt+'_'+perpage+'_'+Math.random(),'#content');
        $('input[name=jenispinjaman]').val(jenis_pinjaman);
        var txt_jenispinjaman = $('select[name=jenispinjaman] :selected').text();
        $('.jenis').html(txt_jenispinjaman);
		$('div[name=container_form]').hide('fast');
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
	function form_close1()
	{
	$('#tabel_simulasi').hide('slow');
	}
	
	
	function simpan_angsuran()
    {   
	send_form(document.form_angsuran,'angsuran_pinjaman/simpan_angsuran','#content');    
    }
   <?php if($this->auth->cek('data_pinjaman',true)):?>
    
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
	function sumOfColumns(tableID, columnIndex, hasHeader) {
	  var tot = 0;
	  $("#" + tableID + " tr" + (hasHeader ? ":gt(0)" : ""))
	  .children("td:nth-child(" + columnIndex + ")").find('input')
	  .each(function() {
		tot += parseInt($(this).val().replace(/[^0-9\.]+/g,""));
	  });
	  return tot;
	}
 function angsur(id)
{    
				var nak_h = $('.nak_'+id).val();
				var sudah_bayar = $('.sudah_bayar_'+id).val();
				var nama_h = $('.nama_anggota_'+id).val();
				var cabang_h = $('.cabang_'+id).val();
				var ppp = $('.nomor_'+id);
				var position = ppp.position();
				var ttop = position.top +100;
				$('#tabel_simulasi').css('top',ttop);
				var bg= $('.bunga_'+id).val();
				var a = $('.tenor_disetujui_'+id).val();
				var tp = $('.tanggal_disetujui_'+id).val();
				var dateParts = tp.split("-");
				var b = $('.nominal_disetujui_'+id).val().replace(/[^0-9\.]+/g,"");
				var bga = Math.round(b*bg/100/a/100)*100;
                var bgan = addCommas(bga.toString());
				var ap = Math.round(b/a/100)*100;
				var ap = Math.round(b/a/100)*100;
				var apn = addCommas(ap.toString());
				var ttl = bga+ap;
				var ttln = addCommas(ttl.toString());
				var pjm = b*(1+bg/100);
				var content = "<table  id='tableAng' border='10%' ><tr><th align='center' colspan='10'> <b> Input Angsuran </b><a style='float:right !important;'class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close1()'>[X]</a></th></tr>";
				content += "<tr align='center'><th colspan='10'> ID Pinjaman : <input name='id_h' value='"+id+"' style='width:50px;' disabled='true' type='text' > NAK: <input name='nak_h' disabled='true' value='"+nak_h+"' style='width:60px;' type='text' > Nama : <input name='nama_h' disabled='true' value='"+nama_h+"' style='width:150px;' type='text' > Departemen : <input name='cabang_h' disabled='true' value='"+cabang_h+"' style='width:150px;' type='text' > </th></tr>";
				content += "<tr align='center'><th width='10px'>No</th><th width='10px'>Ke</th><th>Angsuran Pokok</th><th  width='100px'>Ang.Bunga";
                content += '<input onkeyup="formatNumber(this);" onchange="formatNumber(this);" style="width:60px; text-align:right;"  id="angsuran_bunga_h"  type="text" ><input id="checkAll_2" type="checkbox" /></th>';
				content += "<th style='width:80px'>Total Angsuran</th><th style='width:80px'>Sisa</th><th>Tanggal JT</th><th width='50%'>Tanggal Bayar";
				content += '<input class="date" id="tanggal_bayar_h" type="text" value="0000-00-00"  autocomplete="off" style="width:100px" type="text"  >';
				content += "</th><th><input id='checkAll' type='checkbox' /></th>";
				content += "<th style='width:80px'>Keterangan</th></tr>";
                         if(a>0){
						 var date = new Date(dateParts[0], dateParts[1] - 1, dateParts[2].substr(0,2));
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
						 var yy=i%2;
						 if(yy==1)
						 { var cl='dark78' ;}
						 if(yy==0)
						 {var cl='dark79' ;}
						content += '<tr id=row_' + i + ' class='+ cl +'><td>'+  i + '</td><td><input name="line['+ i +'][id_angsuran]" value="0" type="hidden" ><input name="line['+ i +'][nomor]" value='+ id+'-'+i+' type="hidden" ><input name="line['+ i +'][id_pinjaman]" value='+ id +' type="hidden" ><input readonly="true" style="width:15px"  name="line['+ i +'][angsuran_ke]" value='+  i + ' type="text" ></td>';
						content += '<td align="right"><input  style="width:80px; text-align:right;" readonly="true"   name="line['+ i +'][angsuran_pokok]" value='+ apn +' readonly="true" type="text" ></td>';
						content += '<td align="right"><input  class="angsuran_bunga" onkeyup="formatNumber(this);" onchange="formatNumber(this);"  style="width:60px; text-align:right;"     name="line['+ i +'][angsuran_bunga]" value='+ bgan +'  type="text" >';
						content += '<input name="checkbox2_['+i+']" id="checkbox2_['+i+']" value="1" class="checkbox2" type="checkbox" />';
						content += '</td><td align="right">' + ttln +'</td>';
						content += '<td align="right">' + ssn +'</td><td><input  class="tanggal_jtempo" name="line['+ i +'][tanggal_jtempo]"  type="text" readonly="true" value="' + y2 + '-' + m2 + '-' + d2 +'" ></td>';
						content += '<td><input class="tanggal_bayar" name="line['+ i +'][tanggal_bayar]" type="text" value="0000-00-00"  autocomplete="off" style="width:100px" type="text"  ></td>';
						content += '<td><input class="checkbox1" name="checkbox_['+i+']" id="checkbox_['+i+']" value="1" class="checkbox" type="checkbox" /></td><td><input name="line['+ i +'][keterangan]"  type="text" ></td></tr>';
                            
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
						 lap = (b-(ap*(i-1)));
						 lbga = (b*bg/100-bga*(i-1));
						 lapn = addCommas(lap);
						 lbgan = addCommas(lbga);
						 var yy=a%2;
						 if(yy==1)
						 { var cl='dark78' ;}
						 if(yy==0)
						 {var cl='dark79' ;}
					content += '<tr class='+ cl +'><td>'+  a + '</td><td><input name="line['+ a +'][id_angsuran]" value="0" type="hidden" ><input name="line['+ a +'][nomor]" value='+ id+'-'+a+' type="hidden" ><input name="line['+ a +'][id_pinjaman]" value='+ id +' type="hidden" ><input readonly="true"  style="width:15px"  name="line['+ a +'][angsuran_ke]" value='+  a + ' type="text" ></td>';
					content += '<td align="right"><input onkeyup="formatNumber(this);" onchange="formatNumber(this);" style="width:80px; text-align:right;"  name="line['+ a +'][angsuran_pokok]" value='+ lapn +'  type="text" ></td>';
					content += '<td align="right"><input class="angsuran_bunga" onkeyup="formatNumber(this);" onchange="formatNumber(this);"  style="width:80px; text-align:right;"  name="line['+ a +'][angsuran_bunga]" value=' + bgan + '  type="text" ></td><td align="right">' + addCommas((b*bg/100-bga*(i-1))+(b-(ap*(i-1)))) +'</td><td align="right">' + 0 +'</td>';
					content += '<td><input name="line['+ a +'][tanggal_jtempo]"  type="text"   value=" ' + y3 + '-' + m3 + '-' + d3 +'" class="date"></td><td><input  name="line['+ a +'][tanggal_bayar]"  type="text"  value="0000-00-00" class="date"></td><td></td></td><td><input name="line['+ i +'][keterangan]"  type="text" ></td></tr>';
					
					content += "<tr class='lst'><th colspan='2' > Total </th> <th id='ttl_pk' align='right'></th><th id='ttl_bg' align='right'></th><th align='right'>"+(addCommas(parseInt((b*(1+bg/100)))))+"</th><th align='right'>"+(addCommas(parseInt((b*(1+bg/100)))))+"</th><th ></th><th align='right' colspan='3'><a name='simpan_angsuran' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_angsuran()'>[S] Simpan</a>  <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close1()'>[X] Close</a></th></tr>"
			   
                        }
					content += "</table>"
					
					
					
				$('#tabel_simulasi').show('slow');
				$('#tabel_simulasi').children().remove().end().append(content);
				var sdh = $('.sudah_bayar_'+id).val();
				for(i=1;i<=sdh;i++)
				{
				$('#row_'+i).remove();
				//$('#tableAng tr.lst').remove();
				}
				$('#ttl_pk').html(addCommas(sumOfColumns("tableAng", 3, true)));
				$('#ttl_bg').html(addCommas(sumOfColumns("tableAng", 4, true)));
                $('.date').calendar();
				 $('.tanggal_jtempo').calendar();
				  $('.tanggal_bayar').calendar();
				$('.checkbox').change(function()
				    {
								var $this = $(this);
								if ($this.is(':checked')) {
								$(this).closest('tr').find('.tanggal_bayar').val($(this).closest('tr').find('.tanggal_jtempo').val());
							    } else {
								$(this).closest('tr').find('.tanggal_bayar').val('0000-00-00');
					            }
					});
			    $('#checkAll').click(function()
                {
                $('.checkbox1').attr('checked',this.checked);
					var $rows = $("#tableAng").find("tr");
				    var ttlrow = $("#tableAng tr").length;
					  for (var row = 0; row < ttlrow-2; row++)					  
					  {
				      if ($(this).is(':checked')) {
					      var tgl_h = $('#tanggal_bayar_h').val();
						  //alert(tgl_h);
						  if ( tgl_h == '0000-00-00')
						  {
							$($rows[row]).find('.tanggal_bayar').val($($rows[row]).find('.tanggal_jtempo').val());
						  }
						  if (tgl_h !='0000-00-00')
						  {
							$($rows[row]).find('.tanggal_bayar').val(tgl_h);
						  }
					  } else {
							 $($rows[row]).find('.tanggal_bayar').val('0000-00-00');
					        }
					  }
					 
				});
				$('#checkAll_2').click(function()
                {
                $('.checkbox2').attr('checked',this.checked);
					var $rows = $("#tableAng").find("tr");
				    var ttlrow = $("#tableAng tr").length;
					  for (var row = 0; row < ttlrow-2; row++)					  
					  {
				      if ($(this).is(':checked')) {
							$($rows[row]).find('.angsuran_bunga').val($('#angsuran_bunga_h').val());
					  } else {
							 $($rows[row]).find('.angsuran_bunga').val(bgan);
					        }
					  }
					 
				});
				setTimeout(function(){sudah_bayar(id)},100);
        }
	function sudah_bayar(id)
	{
	var id = {id:id};
	$.ajax({
                           
						   //var nominal_simulasi = {nominal_simulasi:$("#nominal_simulasi").val()};                           
						   type: "POST",
                            //url : "<?php echo site_url('simulasi_pinjaman/select_tenor_simulasi') ?> ",
							url : "<?php echo site_url('angsuran_pinjaman/sudah_bayar') ?> ",
                            data: id,
                            success: function(msg){
							        msg =  JSON.parse(msg);
							        var $rows = $("#tableAng").find("tr");
									var ttlrow = $("#tableAng tr").length;
									  for (var row = 0; row < ttlrow-2; row++)					  
									  {
										for(var i =0;i < msg.length;i++)
										{
										  var item = msg[i];
										}
									    $($rows[row]).find('.tanggal_bayar').val(msg[row-1]);
										
									   }									   
                            }
                    }); 
	}
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
#tabel_simulasi
	{
	width: 800px;
	background-color:rgb(102, 153, 153);
    position: absolute;
    top: 0px;
    left: 100px;
	z-index:100;
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
<div class='title' >Daftar Pinjaman Anggota</div>
<div id='tombol' >
<hr>

</div>
<?php
echo ' PT : ';
echo $this->fungsi->build_select_common('pt',$pt,'pt_id','pt','onchange="view_pinjaman()"',$cur_pt);
?>
<div align='right'id="pencarian">
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
<?php echo $this->load->view('anggota/tabel_pinjaman_angsuran');?>
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
            echo $this->fungsi->build_select_common('status_pinjaman',$statuspinjaman,'id_status','status_pinjaman','',$cur_statuspinjaman);
            ?>
			</td>
			
        </tr>
    </table>
    </form>
	
    <div class='the_footer a_left'>
    <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>[X] Close</a>
	<a name='edit_pinjaman' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='edit()'>[√] Edit</a>
	<a name='simpan_pinjaman' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan()'>[S] Simpan</a>
	</div>
	</br>
	
    </div>
    </div>
    </div>

	<form method='post' action='' class="contactForm" name='form_angsuran'>
    <div id='tabel_simulasi' > </div>
	</form>
<div id="backgroundPopup"></div>