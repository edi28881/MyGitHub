<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
</br>
<table>
<tr><td>
<?php include_once 'tabel_data_anggota.php'; ?>
</tr>
<tr><td>
<fieldset width='400px' background='blue'>
<legend><div class='title'><a href='javascript:void(0);' onclick='view_simpanan(); switch_tab(clear);'>DATA SIMPANAN</a></div></legend>
<table  class='grid'>
    <tr align='center'>
        <th width='50'>Jenis</th>
        <th width='100'>Nominal</th>
        <th width='50'>Kali</th>
		<th width='100'>Mulai</th>
		<th width='100'>Akhir</th>
        <th width='100'>Total Simpanan</th>
    </tr>
    <?php foreach($simpanan->result() as $i => $row):
	$nom = $row->nominal;
    ?>
        <tr <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";} ?> >
			<td><?php echo $row->jenis;?></td>
            <td align='right'><?php echo $this->fungsi->pecah($nom);?></td>
			<td align='center'><?php echo $row->kali;?></th>
			<td align='center'><input disabled='true' type='text' class='date' value='<?php echo $row->awal;?> '></th>
			<td align='center'><input disabled='true' type='text' class='date' value='<?php echo $row->akhir;?> '></th>
            <td align='right'><?php echo $this->fungsi->pecah($row->total_simpanan);?></td>
        </tr>    
    <?php endforeach; ?>
	 <?php foreach($simpanan_total->result() as $i => $row): ?>
	<tr >
			<th colspan='5'> Total </th>
            <th align='right'><?php echo $this->fungsi->pecah($row->total_simpanan);?> </th>
        </tr> 
    <?php endforeach; ?>		
	<?php
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
</fieldset>
</tr>
<tr></td><td>
<fieldset bacground='blue'>
<legend><div class='title'><a href='javascript:void(0);' onclick='view_pinjaman(); switch_tab(clear);'>DATA PINJAMAN</a></div></legend>
<table width='320' class='grid'>
    <tr align='center'>
	    <th width='40'>ID</th>
        <th width='40'>Jenis</th>
		<th width='30'>Status</th>
        <th width='80'>Total Pinjaman</th>
		<th width='80'>Total Bunga</th>
        <th width='30'>Tenor</th>
        <th width='30'>Bayar</th>
		<th width='30'>Sisa</th>
		<th width='80'>Sisa Pokok</th>
		<th width='80'>Sisa Bunga</th>
    </tr>
    <?php foreach($pinjaman->result() as $i => $row):
    ?>
        <tr <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";} ?> >
		    <td><?php echo $row->idp;?></td>
			<td align='center'><?php echo $row->nama;?></td>
			<td align='center'><?php echo $row->status_id;?></td>
            <td align='right'><?php echo $this->fungsi->pecah($row->nominal_disetujui);?></td>
			<td align='right'><?php echo $this->fungsi->pecah($row->total_bunga);?></td>
			<td align='center'><?php echo $row->tenor_disetujui;?></th>
            <td align='center'><?php $byr=$row->bayar; if($byr==''){$byr=0;} echo $byr;?></td>
			<td align='center'><?php echo ($row->tenor_disetujui - $byr );?></th>
			<td align='right'><?php echo $this->fungsi->pecah($row->nominal_disetujui - $row->bayar_pokok);?></td>
			<td align='right'><?php echo $this->fungsi->pecah($row->total_bunga - $row->bayar_bunga);?></td>
        </tr>    
    <?php endforeach; ?>		
	<?php
    if($pinjaman->num_rows()==0)
    {
        ?>
        <tr>
			<td colspan='10' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    }    
    ?>
</table>
</fieldset>
</td></tr></table>
</br>
</hr>
</br>