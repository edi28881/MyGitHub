<fieldset style='position:absolute;  right:10px; z-index:10; width:900px;'  background='red'>
<legend><h3>DATA KELUARGA ANGGOTA</h3></legend>
<div name='container_form2' id='container_form2' style='position:relative;  background-color:red; z-index:100; width:890px;' >
<div id="contactForm2"  style='position:relative;  background-color:grey;  z-index:100; width:890px;'  >
        	<div class="loader"></div>
			<div class="bar"></div>
<table id='keluarga' class='grid'>
<tr align='center' class='item-row'><th width='2.5%'>No</th>
					<th>Nama</th>
					<th width='8%'>JK</th>
					<th width='8%'>Hubungan</th>
                     <th width='13%'>Tgl Lahir</th>
					 <th width='15%'>Pekerjaan</th>
					 <th width='15%'>Pendidikan</th>
					 <th width='12%px'>NIK / NIS</th></tr>
<?php foreach($anggota_keluarga->result() as $i => $row):?>
<tr class='item-row'>
	<td><div name='delete1' class='delete-wpr'><a class='delete1' onclick='hapus_keluarga(<?=$row->nomor?>)' href='javascript:;' title='Remove row'>X</a></div>
	<b><?=$i+1?></b>
	</td>
	<td>
		<input type=hidden name='line[<?=$i?>][nomor]'  value='<?=$row->nomor?>' />
		<input class='nak1' type=hidden name='line[<?=$i?>][nak]'  value='<?php if(empty($row->nak)) {echo $nak;} else {echo $row->nak;}?>' />
		<input type=text name='line[<?=$i?>][nama]' style='width:230px'  value='<?=$row->nama?>' />
		
	</td>
	<td> <?php
		 $options = array(
					  'Pria'  => 'Pria',
					  'Wanita'  => 'Wanita',
					);
		echo form_dropdown('line['.$i.'][jk]', $options, $row->jk.'');
		?>
	</td>
	<td> <?php
		echo form_dropdown('line['.$i.'][hubungan]', $options_hubungan,$row->hubungan.'');
		?>
	</td>
	<td>
		<input type='text' value='<?=$row->tanggal_lhr?>' 
        class='date' name='line[<?=$i?>][tanggal_lhr]' autocomplete='off' style='width:100px' />
	</td>
	<td>
		<input type=text name='line[<?=$i?>][pekerjaan]' style='width:120px'  value='<?=$row->pekerjaan?>' />
	</td>
	<td>
	<input type=text name='line[<?=$i?>][pendidikan]' style='width:120px'  value='<?=$row->pendidikan?>' />
	</td>
	<td>
	<input type=text name='line[<?=$i?>][nik]' style='width:90px'  value='<?=$row->nik?>' />
	</td>
</tr>
<?php endforeach;?>
<tr id="hiderow">
		    <th colspan="6"><a  id="addrow" href="javascript:;" title="Add a row">Add a row</a></th>
			<th align='right' colspan="2"></th>
</tr>
<tr height='5px'>
  <th colspan="8">
   <div class='the_footer a_left'>
    <a name='close_k' class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close_keluarga()'>[X] Close</a>
	<a name='edit_k' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='edit_keluarga()'>[√] Edit</a>
	<a name='simpan_k' class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_keluarga_masal()'>[S] Simpan</a>
	</div>
 
  </th>
</tr>
</table>
</div>
</div>
</fieldset>