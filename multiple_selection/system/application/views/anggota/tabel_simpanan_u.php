<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type='text/javascript'>
$('#tabel_simpanan_u tr').mouseover(function () {
         $(this).removeClass("grid");
         });
          $('#tabel_simpanan_u tr').mouseover(function () {
         $(this).addClass("highlight");
         });
         $('#tabel_simpanan_u tr').mouseout(function () {
         $(this).removeClass("highlight");
         });
    $('#tabel_simpanan_u tr').click(function () {
    $(this).find('td input:radio').attr('checked', true);
	$(this).addClass("highlight");
    $('#tabel_simpanan_u tr').removeClass("grid");
   });
</script> 
<table id="tabel_simpanan_u" class='grid'>
    <tr align='center'>
        <th width='5%'>No</th>
		<th width='8%'>No.Trans</th>
        <th width='12%'>Jenis</th>
        <th width='15%'>Nominal</th>
        <th width='15%'>Tanggal</th>
		<th width='15%'>Keterangan</th>
		<th width='10%'>Update per</th>
		<th width='10%'>Oleh</th>
        <th width='6%'>Aksi</th>
    </tr>
		<tr id="hiderow">
		    <td colspan="6"><a  id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>
			<td align='right' colspan="3"><a id='a_simpan' class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='simpan_simpanan_masal()' >Save All New Data</a></td>
		 </tr>
		 <tr class="item-row" bgcolor='grey'>
            <?php
			$line=count($simpanan->result())+1;
			echo '<input type="hidden" name="line['.$line.'][nomor]" value ="" class="nomor">';
			echo '<input type="hidden" name="line['.$line.'][nak]" value ='.$cur_anggota.' class="nak">';
			echo '<input type="hidden" name="line['.$line.'][user]" value ='.$cur_anggota.' class="user">';
            ?>
			<td style='color:red'><b><?=$line;?></b></td>
			<td style='color:red'></td>
			<td><?php echo $this->fungsi->build_select_common('line['.$line.'][jenis]',$jenissimpanan,'id','nama','class=jenis_js',$cur_jenissimpanan);?></td>
            <td><input align='right' class='nominal_js' value='' type='text' name='line[<?=$line;?>][nominal]' style='width:100px ; text-align:right;'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
            <td><input  id='tanggal_transaksi' name='line[<?=$line;?>][tanggal_transaksi]' type='text' class='date' value='<?=date('Y-m-d')?>' > </td>
			<td><input  type='text' style='width:100px' name='line[<?=$line;?>][keterangan]' value=''></td>
			<td style='font-size:75%;'> @ <?php echo date('Y-m-d');?>'  </td>
			<td style='font-size:75%;'><?php echo from_session('nama');?></td>
            <td>
			    </td>
           
	    </tr> 
		</hr>
		  <?php foreach($simpanan->result() as $i => $row):
		   $nom = $row->nominal;
			count($simpanan->result())
		  ?>
		
		 <tr name='row_transaksi'  id='row_transaksi_<?=$row->id_simpanan?>' <?php $genap=$i%2; if($genap==0) {echo "class='dark78'";} 
		  if($genap==1) {echo "style='background-color:white'";}?> >
		     
			 <input  id='nak_<?=$row->id_simpanan?>' disabled='true' class='nak'  type='hidden'  value='<?php echo $row->nak;?> '>
			<td><?=count($simpanan->result())-$i;?> </td>
			<td>
                <input id='nomor_<?=$row->id_simpanan?>' disabled='true' align='right' value='<?php echo $this->fungsi->complete($row->nomor,8);?>' style='width:50px'>
            </td>
			<td><?php echo $this->fungsi->build_select_common('jenis',$jenissimpanan,'id','nama','disabled class=jenis_'.$row->id_simpanan.'',$row->id);?></td>
            <td><input  id='nominal_<?=$row->id_simpanan?>' class='nominal_js' disabled='true' align='right' value='<?php echo $this->fungsi->pecah($nom);?>' type='text' style='width:100px ; text-align:right;'  onkeyup="formatNumber(this);" onchange="formatNumber(this);"/></td>
            <td><input  id='tanggal_transaksi_<?=$row->id_simpanan?>' disabled='true' type='text' class='date' value='<?php echo $row->tanggal_transaksi;?>' > </td>
			<td><input  id='keterangan_<?=$row->id_simpanan?>' disabled='true'  type='text' style='width:100px' value='<?php echo $row->keterangan;?> '></td>
			<td style='font-size:75%;'> @ <?php echo $row->tanggal_catat;?>'  </td>
			<td style='font-size:75%;'><?php echo $row->update_by;?></td>
            <td>
			   <a id='a_edit_<?=$row->id_simpanan?>' class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='edit_s(<?php echo $row->id_simpanan;?>);' >Edit</a>
			   <a id='a_simpan_<?=$row->id_simpanan?>' class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='simpan_s(<?php echo $row->id_simpanan;?>);' >Save</a></td>
			   </td>
       </form>
	   </tr> 
    <?php endforeach;
    if($simpanan->num_rows()==0)
    {
        ?>
        <tr>
            <td colspan='9' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    }    
    ?>
<tr><td colspan='7'> </td><td colspan='2'>
</td></tr> 
</table>
<div class='a_left'>
<?php
echo 'Data per Page : ';
echo $this->fungsi->build_select_common('dataperpage',$dataperpage,'perpage','perpage','onchange="view_simpanan()"',$cur_perpage);
?>
</br>
</hr>
</br>
<table style= "width:200px !important;" >
    <tr>
        <th width='50%'>Total Simpanan</th>
        <th>Nominal</th>
    </tr>
	<?php foreach($simpanan_total->result() as $i => $row):
	 $nom = $row->total_nominal;
    ?>
	 <tr>
        <td><?php echo $row->jenis;?></td>
        <td align="right"><?php echo $this->fungsi->pecah($nom);?></td>
    </tr>
	<?php endforeach;
    if($simpanan->num_rows()==0)
    {
        ?>
        <tr>
            <td colspan='6' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    }    
    ?>
</table>
