<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type='text/javascript'>
$('#checkAll_Jenis').click(function()
                {
                $('input.checkbox_jenis').attr('checked',this.checked);
					var $rows = $("#table_simp").find("tr");
				    var ttlrow = $("#table_simp tr").length;
					  for (var row = 0; row < ttlrow-2; row++)					  
					  {
				      if ($(this).is(':checked')) {
					  $($rows[row]).find('.jenis').val($('#jenis_h').val());
					  //document.getElementById('jenis_h')[document.getElementById('jenis_h').selectedIndex].innerHTML;
					  } else {
							 $($rows[row]).find('.jenis').val('0000-00-00');
					        }
					  }
					 
				});
$('#checkAll_Tanggal').click(function()
                {
                $('input.checkbox_tanggal').attr('checked',this.checked);
					var $rows = $("#table_simp").find("tr");
				    var ttlrow = $("#table_simp tr").length;
					  for (var row = 0; row < ttlrow; row++)					  
					  {
				      if ($(this).is(':checked')) {
					  
					  $($rows[row]).find('.date').val($('#tanggal_h').val());
					  } else {
							 $($rows[row]).find('.date').val('0000-00-00');
					        }
					  }
					 
				});
$('#checkAll_Nominal').click(function()
                {
                $('input.checkbox_nominal').attr('checked',this.checked);
					var $rows = $("#table_simp").find("tr");
				    var ttlrow = $("#table_simp tr").length;
					  for (var row = 0; row < ttlrow; row++)					  
					  {
				      if ($(this).is(':checked')) {
					  
					  $($rows[row]).find('.nominal').val($('#nominal_h').val());
					  } else {
							 $($rows[row]).find('.nominal').val('0');
					        }
					  }
					 
				});
function simpan_simpanan_masal()
    {   
	send_form(document.form_simpanan_masal,'input_simpanan/simpan_simpanan_masal','#content');    
    }
</script>			
<table id='table_simp' class='grid'>
       <tr align='center'>
	    <th width='10' rowspan='2'>No</th>
        <th width='50' rowspan='2'>NAK</th>
		<th width='100' rowspan='2'>Nama</th>
        <!--<th rowspan='2'>Departemen</th>-->
		<th width='110'>Jenis</th>
        <th width='140'>Tanggal</th>
        <th width='120'>Nominal</th>
		<th width='120' rowspan='2'>Keterangan</th>
    </tr>
     <tr>
	    <th> <?php echo $this->fungsi->build_select_common('jenis_h',$jenissimpanan,'id','nama','id="jenis_h"','2'); ?> 
		     <input id='checkAll_Jenis' type='checkbox' />
		    </th>
		<th> <input type='text' value='<?php echo date('Y-m-d');?>'  class='date' id='tanggal_h' autocomplete='off' style='width:100px' />
		     <input id='checkAll_Tanggal' type='checkbox' />
		</th>
        <th> 
		     <input type='text' id='nominal_h' style='width:80px'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/>
	         <input id='checkAll_Nominal' type='checkbox' /> 
		</th>
		
    </tr>
<form method='post' action='' class="contactForm" name='form_simpanan_masal'>	
    <?php foreach($user->result() as $i => $row):?>
    <tr <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";}if($genap==0){echo "class='dark79'";} ?> >
	    <td><?php echo (($page-1)*$cur_perpage)+$i+1;?></td>
        <td>
            <input type='hidden' name="line[<?=$i;?>][nomor]" value='' />
			<input type='hidden' name="line[<?=$i;?>][user]" value='<?=$row->user_username;?>' />
			<input type='hidden' name="line[<?=$i;?>][nak]" value='<?=$row->nak;?>' />
			
            <?php echo $row->nak;?>
        </td>
        <td><?php echo $row->user_name;?></td>
		<td><?php echo $this->fungsi->build_select_common("line[$i][jenis]",$jenissimpanan,'id','nama','class="jenis"','2'); ?>
		<input name="line[<?=$i;?>][check1]" class="checkbox_jenis" value="1" class="checkbox" type="checkbox" />
		</td>
        <td><input name="line[<?=$i;?>][tanggal_transaksi]" type='text' value='<?php echo date('Y-m-d');?>'  class='date'  autocomplete='off' style='width:100px' />
        <input name="line[<?=$i;?>][check2]" class="checkbox_tanggal" value="1" class="checkbox" type="checkbox" />
		</td>
		<td><input type='text' name="line[<?=$i;?>][nominal]" class='nominal' style='width:80px'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/>
		<input name="line[<?=$i;?>][check3]" class="checkbox_nominal" value="1" class="checkbox" type="checkbox" />
		</td>
		<td><input type='text' name="line[<?=$i;?>][keterangan]" style='width:100px' /></td>
    </tr>
	<?php  endforeach;?>
	<tr>
	<td colspan='10'>
	<div class='the_footer a_right'>
	<a name='simpan_simpanan' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_simpanan_masal()'>[S] Simpan</a>
	<div>
	</td>
	</tr>
    
</table>
</form>

