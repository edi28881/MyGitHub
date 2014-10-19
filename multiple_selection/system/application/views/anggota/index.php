<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
tr
{
height:16px;
}
table
{
border:none;
margin:5px;
font-size:10.0pt;
font-weight:400;
font-style:normal;
text-decoration:none;
font-family:Arial;
}
td
{
border:none;
}
.b_kiri
{
font-weight:700;
text-align:left;
}
.b_kanan
{
font-weight:700;
text-align:left;
border: 1pt solid;
}
.k_kiri
{
text-align:left;
border: 1pt solid;
}
.k_kanan
{
text-align:right;
}
.k_sp
{
text-align:center;
}
.b_sp
{
text-align:center;
font-weight:700;
}
.photo
{
text-align:center;
font-weight:700;
border: 2pt solid;
}
fieldset {
border:2px solid green;
background:#;
          }

</style>
<style type="text/css">
#backgroundPopup{
	display:none;
	position:fixed;
	_position:absolute;
	height:100%; width:100%;
	top:0; left:0;
	background:#000;
	z-index:100;
	}
#container_form {
    top:0; left:0;
	z-index:12;
	}
.container_data {
    top:0; left:0;
	z-index:15;
	}
#contactForm {
    top:0; left:0;
	height:600px;width:800px;
	
	border:1px solid #929191;
	
	}

</style>

<script type='text/javascript'>
    
    $(function(){
        $('div[name=container_form]').show('slow');
		<?php foreach($anggota->result() as $i => $row):?>
		chain_select_a<?=$i+1?>() ;
        <?php endforeach; ?>
		
		$("#container_form input").attr("disabled",true);
		$("#container_form select").attr("disabled",true);
		
		$('a[name=simpan]').hide();
		$('a[name=edit]').show();
		$('a[name=close]').hide();
		
		$('div[name=delete1]').hide();
		$('#hiderow').hide('slow');
    });
	 function view_anggota()
	{
        load_no_loading('anggota/index/'+Math.random(),'#content');
        $('div[name=container_form]').show('slow');
        <?php foreach($anggota->result() as $i => $row):?>
		chain_select_a<?=$i+1?>() ;
        <?php endforeach; ?>
		$("#container_form input").attr("disabled",true);
		$("#container_form select").attr("disabled",true);
		$('a[name=simpan]').hide();
		$('a[name=edit_photo]').hide();
		$('a[name=edit]').show();
		$('a[name=close]').hide();
	}
	<?php foreach($anggota->result() as $i => $row):?>
    function chain_select_a<?=$i+1?>(){
    $("#line_<?=$row->user_id?>_prov_id").change(function(){
	            
                var selectValues = $("#line_<?=$row->user_id?>_prov_id").val();
				
                if (selectValues == 0){
                    var msg = "Kab / Region :<br><select name=\"line_<?=$row->user_id?>_kab_id\" disabled><option value=\"0\">Pilih Negara Dahulu</option></select>";
                    $('#line_<?=$row->user_id?>_kab_id').html(msg);
                }else{
                    var prov_id = {prov_id:$("#line_<?=$row->user_id?>_prov_id").val()};
                    $('#line_<?=$row->user_id?>_kab_id').attr("disabled",false);
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('anggota/select_kota') ?> ",
                            data: prov_id ,
                            success: function(msg){
                                $('#line_<?=$row->user_id?>_kab_id').html(msg);
								chain_select_b<?=$i+1?>();
                            }
                    });
                }
        });
    }	
	function chain_select_b<?=$i+1?>(){
    $('body').delegate("#line_<?=$row->user_id?>_kab_id","change", function() {
                var selectValues = $("#line_<?=$row->user_id?>_kab_id").val();
                if (selectValues == 0){
                    var msg = "Kota / Kabupaten :<br><select name=\"line_<?=$row->user_id?>_kec_id\" disabled><option value=\"0\">Pilih Propinsi Dahulu</option></select>";
                    $('#line_<?=$row->user_id?>_kec_id').html(msg);
                }else{
                    var kab_id = {kab_id:$("#line_<?=$row->user_id?>_kab_id").val()};
                    $('#line_<?=$row->user_id?>_kec_id').attr("disabled",false);
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('anggota/select_kecamatan')?>",
                            data: kab_id,
                            success: function(msg){
                                $('#line_<?=$row->user_id?>_kec_id').html(msg);
                            }
                    });
                }
        });

    }
 	<?php endforeach; ?>
	
<?php $a = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20); ?>
<?php foreach($a as $a):?>
function chain_select_x<?=$a?>(){
    $("#line_<?=$a?>_prov_id").change(function(){
	            
                var selectValues = $("#line_<?=$a?>_prov_id").val();
				
                if (selectValues == 0){
                    var msg = "Kab / Region :<br><select name=\"line_<?=$a?>_kab_id\" disabled><option value=\"0\">Pilih Negara Dahulu</option></select>";
                    $('#line_<?=$a?>_kab_id').html(msg);
                }else{
                    var prov_id = {prov_id:$("#line_<?=$a?>_prov_id").val()};
                    $('#line_<?=$a?>_kab_id').attr("disabled",false);
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('anggota/select_kota') ?> ",
                            data: prov_id ,
                            success: function(msg){
                                $('#line_<?=$a?>_kab_id').html(msg);
								chain_select_y<?=$a?>();
                            }
                    });
                }
        });
    }	
	function chain_select_y<?=$a?>(){
    $('body').delegate("#line_<?=$a?>_kab_id","change", function() {
                var selectValues = $("#line_<?=$a?>_kab_id").val();
                if (selectValues == 0){
                    var msg = "Kota / Kabupaten :<br><select name=\"line_<?=$a?>_kec_id\" disabled><option value=\"0\">Pilih Propinsi Dahulu</option></select>";
                    $('#line_<?=$a?>_kec_id').html(msg);
                }else{
                    var kab_id = {kab_id:$("#line_<?=$a?>_kab_id").val()};
                    $('#line_<?=$a?>_kec_id').attr("disabled",false);
                    $.ajax({
                            type: "POST",
                            url : "<?php echo site_url('anggota/select_kecamatan')?>",
                            data: kab_id,
                            success: function(msg){
                                $('#line_<?=$a?>_kec_id').html(msg);
                            }
                    });
                }
        });

    }
<?php endforeach; ?>	
	function simpan_anggota_masal()
    {
	send_form(document.form_anggota1,'anggota/simpan_anggota_masal','#content');  
	//setTimeout(function(){view_anggota()},1000);
	
	}
    function edit_anggota()
    {
         
		 $('div[name=container_form]').hide('fast');
         $('div[name=container_form]').show('slow');
		 $('#hiderow').show('slow');
         popup();
         <?php foreach($anggota->result() as $i => $row):?>
		chain_select_a<?=$i+1?>() ;
        <?php endforeach; ?>
		$("#container_form input").attr("disabled",false);
		$("#container_form select").attr("disabled",false);
		$('a[name=simpan]').show();
		$('a[name=edit]').hide();
		$('a[name=close]').show();
		$('div[name=delete1]').show();
		
    }
	$("#addrow").click(function(){
	       
			var i = $(this).closest('tr').index();
			var i=i-2;
			content = '<tr class="item-row">';
			content += "<td><div name='delete1' class='delete-wpr'><a class='delete1' onclick='hapus_anggota("+i+")' href='javascript:;' title='Remove row'>X</a></div>";
			content += '        <b>'+ i +'</b>';
			content += '        </td>';
			content += '  <td class=b_kiri> ';
			content += '  <input type=hidden name="line['+i+'][user_id]"  value="" /><input type=text name="line['+i+'][nama_anggota]" style="width:100px"  value="" /></td>';
			content += '  <td class=b_kiri>';
			content += '<select name="line['+i+'][prov_id]" id="line_'+i+'_prov_id">';
			content += '<option value="0">-Pilih Provinsi-</option>';
			content += '<option value="17">Bali</option>';
			content += '<option value="16">Banten</option>';
			content += '<option value="7">Bengkulu</option>';
			content += '<option value="14">DI Yogyakarta</option>';
			content += '<option value="11">DKI Jakarta</option>';
			content += '<option value="28">Gorontalo</option>';
			content += '<option value="32">Irian Jaya Barat</option>';
			content += '<option value="5">Jambi</option>';
			content += '<option value="12">Jawa Barat</option>';
			content += '<option value="13">Jawa Tengah</option>';
			content += '<option value="15">Jawa Timur</option>';
			content += '<option value="20">Kalimantan Barat</option>';
			content += '<option value="22">Kalimantan Selatan</option>';
			content += '<option value="21">Kalimantan Tengah</option>';
			content += '<option value="23">Kalimantan Timur</option>';
			content += '<option value="9">Kep. Bangka Belitung</option>';
			content += '<option value="10">Kep. Riau</option>';
			content += '<option value="8">Lampung</option>';
			content += '<option value="29">Maluku</option>';
			content += '<option value="30">Maluku Utara</option>';
			content += '<option value="1">Nanggroe Aceh Darussalaam</option>';
			content += '<option value="18">Nusa Tenggara Barat</option>';
			content += '<option value="19">Nusa Tenggara Timur</option>';
			content += '<option value="31">Papua</option>';
			content += '<option value="4">Riau</option>';
			content += '<option value="26">Sulawesi Selatan</option>';
			content += '<option value="25">Sulawesi Tengah</option>';
			content += '<option value="27">Sulawesi Tenggara</option>';
			content += '<option value="24">Sulawesi Utara</option>';
			content += '<option value="3">Sumatra Barat</option>';
			content += '<option value="6">Sumatra Selatan</option>';
			content += '<option value="2">Sumatra Utara</option>';
			content += '</select></td>';
			content += '  <td class=b_kiri>';
			content += '   <select name="line['+i+'][kab_id]" id="line_'+i+'_kab_id">';
			content += '<option value="0">Pilih Provinsi Dahulu</option>';
			content += '<option value="" selected="selected"></option>';
			content += '</select></td>';
			content += '  <td class=b_kiri>';
			content += '    <select name="line['+i+'][kec_id]" id="line_'+i+'_kec_id">';
			content += '<option value="0">Pilih Kabupaten Dahulu</option>';
			content += '<option value="" selected="selected"></option>';
			content += '</select></td>';
			content += '  <td class=b_kiri>';
			content += '   <input type=text name="line['+i+'][alamat_jalan]" style="width:150px; font-size:10px;" value=""/></td>';
			content += '</tr>';
        
		    $(".item-row:last").after(content);
		     <?php $a = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20); ?>
        <?php foreach($a as $a):?>
		chain_select_x<?=$a?>() ;
		<?php endforeach; ?>
		    if ($('#anggota tr:last').index()  > 0) $(".delete").show();
		    if ($('#anggota tr:last').index() > 23) $("#addrow").hide();
	  });
	  $(".delete").live('click',function(){
		$(this).parents('.item-row').remove();
		if ($('#anggota tr:last').index()  < 1) $(".delete").hide();
		if ($('#anggota tr:last').index()  <=23) $("#addrow").show();
	  });
	function hapus_anggota(nomor)
	{
	r=confirm('Apakah data id ='+ nomor +' akan dihapus ?');
	if (r==true)
	  {
	  var string = "user_id="+nomor;
	  $.ajax({
			type	: "POST",
			url 	: "<?php echo site_url('anggota/hapus_anggota') ?> ",
			data	: string,
			//cache	: false,
			success	: function(data){
                               //alert('Info '+data);
							  setTimeout(function(){view_anggota()},1000); 
                            },
			error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error: ' + errorThrown + ' ' + textStatus + ' ' + jqXHR);
            }
							
		});	
	  }
	else
	  {
	  view_anggota();
	  }
	}
    function form_close()
    {
        $("#backgroundPopup").fadeOut("slow");
		$('fieldset').fadeIn('slow');
        $('div[name=container_form]').hide('slow');
		setTimeout(function(){view_anggota()},1000);	
    }
    function popup()
    {
    $("#backgroundPopup").css({"opacity": "0.6"});
    $("#backgroundPopup").fadeIn("slow");
    }
	
</script>
<body>
<form  method='post' action='' class="contactForm" name='form_anggota1'>
<fieldset bacground='blue'>
<legend><h3>DATA ANGGOTA</h3></legend>
<div name='container_form' id='container_form'  >
<div id="contactForm" >
        	<div class="loader"></div>
			<div class="bar"></div>
<table id='anggota'  name='anggota' class='grid'  style='width:800px; font-size:11px;'>
<tr>
  <th style='border-right:solid 1px;' width='10' rowspan='2'>No</th>
  <th style='border-right:solid  1px;'width='100'rowspan='2'>Nama</th>
  <th  style='border-bottom:none;' align='center' colspan= 4' >Alamat</th>
</tr>
<tr>
  <th width='150' class=k_kiri>Provinsi</th>
  <th width='200' class=k_kiri>Kabupaten</th>
  <th width='150' class=k_kiri>Kecamatan</th>
  <th width='200' class=k_kiri>Jalan</th>
</tr>

<?php foreach($anggota->result() as $i => $row):?>
<script type='text/javascript'>

</script>
<tr class='item-row'>
<td><div name='delete1' class='delete-wpr'><a class='delete1' onclick='hapus_anggota(<?=$row->user_id?>)' href='javascript:;' title='Remove row'>X</a></div>
	<b><?=$i+1?></b>
	</td>
  <td class=b_kiri> <input type=hidden name='line[<?=$row->user_id?>][user_id]'   value='<?php echo $row->user_id;?>' />
  <input type=text name='line[<?=$row->user_id?>][nama_anggota]' style='width:100px'  value='<?php echo $row->nama_anggota;?>' /></td>
  <td class=b_kiri>
   <?php echo form_dropdown("line[". $row->user_id ."][prov_id]",$option_provinsi,$row->prov_id,"id='line_". $row->user_id ."_prov_id'"); ?></td>
  <td class=b_kiri>
   <?php
 	echo form_dropdown("line[". $row->user_id ."][kab_id]",array('0'=>'Pilih Provinsi Dahulu',
 	                                   $row->kab_id => $row->kabupaten)
 	                   ,$row->kab_id,"id='line_". $row->user_id ."_kab_id'" );
    ?></td>
  <td class=b_kiri>
    <?php
   echo form_dropdown("line[". $row->user_id ."][kec_id]",array('0'=>'Pilih Kabupaten Dahulu',$row->kec_id => $row->kecamatan)
   										,$row->kec_id,"id='line_". $row->user_id ."_kec_id'","style='width:180px'" )
    ?></td>
  <td class=b_kiri>
   <input type=text name='line[<?=$row->user_id?>][alamat_jalan]' style='width:150px; font-size:10px;' value='<?php echo $row->alamat_jalan;?>'/></td>

</tr>
<?php endforeach; ?>
<td colspan="6"><hr/></td>
</tr>
<tr id="hiderow">
		    <th colspan="3"><a  id="addrow" href="javascript:;" title="Add a row">Add a row</a></th><th align='right' colspan="3"></th>
</tr>
<tr>
  <td colspan="6">
   <div class='the_footer a_left'>
    <a name='close' class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>[X] Close</a>
	<a name='edit' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='edit_anggota()'>[E] Edit</a>
	<a name='simpan' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_anggota_masal()'>[S] Simpan</a>
	</div>
 
  </td>
</tr>
</table>

</div>
</div>
</fieldset>
</form>
</body>
