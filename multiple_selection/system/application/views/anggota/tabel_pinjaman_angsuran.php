<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type='text/javascript'>
$('#tabel_pinjaman tr').mouseover(function () {
         $(this).removeClass("grid");
         });
          $('#tabel_pinjaman tr').mouseover(function () {
         $(this).addClass("highlight");
         });
         $('#tabel_pinjaman tr').mouseout(function () {
         $(this).removeClass("highlight");
         });
    $('#tabel_pinjaman tr').click(function () {
    $(this).find('td input:radio').attr('checked', true);
	$(this).addClass("highlight");
    $('#tabel_pinjaman tr').removeClass("grid");
   });
</script> 
 <form>    
<table id="tabel_pinjaman" class='grid'>
    <tr>
		<th width='20%'>ID Pinjaman</th>
        <th width='20%'>Nama Anggota</th>
		<!--<th width='20%'>Departemen </th>-->
        <th width='10%'>Jenis</th>
		<th width='15%'>Pinjaman</th>
		<th width='7%'>Tenor</th>
		<th width='7%'>Bayar</th>
		<th width='7%'>Sisa</th>
        <th width='15%'>Pencairan</th>
        <th width='20px'>View</th>
		<th width='20px'> Ang </br> sur </th>
    </tr>
    <?php foreach($pinjaman->result() as $i => $row):
	$nom  = $row->nominal_disetujui;
	$nom1 = $row->total_angsuran;
	$nom2 = $row->nominal_pengajuan;
	$nom3 = $row->nominal_disetujui;
    ?>
        <tr  <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";} else {echo "class='dark77'";}  ?> > 
            <td> <input type="radio" name="size" value="<?=$row->id_pinjaman;?>"/> <?php echo $row->id_pinjaman;?> </td>
            <td>
				<input type='hidden' class='nomor_<?=$row->id_pinjaman;?>' value='<?=$row->nomor;?>' />
				<input type='hidden' class='nak_<?=$row->id_pinjaman;?>' value='<?=$row->nak;?>' />
				<input type='hidden' class='nama_anggota_<?=$row->id_pinjaman;?>' value='<?=$row->nama_anggota;?>' />
				<input type='hidden' class='cabang_<?=$row->id_pinjaman;?>' value='<?=$row->cabang;?>' />
				<input type='hidden' class='jenis_<?=$row->id_pinjaman;?>' value='<?=$row->id;?>' />
                <input type='hidden' class='tanggal_pengajuan_<?=$row->id_pinjaman;?>' value='<?=$row->tanggal_pengajuan;?>' />
				<input type='hidden' class='tanggal_disetujui_<?=$row->id_pinjaman;?>' value='<?=$row->tanggal_disetujui;?>' />
				<input type='hidden' class='tanggal_pencairan_<?=$row->id_pinjaman;?>' value='<?=$row->tanggal_pencairan;?>' />
                <input type='hidden' class='nominal_<?=$row->id_pinjaman;?>' value='<?=$this->fungsi->pecah($nom,',');?>' />
				<input type='hidden' class='nominal_pengajuan_<?=$row->id_pinjaman;?>' value='<?=$this->fungsi->pecah($nom2,',');?>' />
				<input type='hidden' class='nominal_disetujui_<?=$row->id_pinjaman;?>' value='<?=$this->fungsi->pecah($nom3,',');?>' />
				<input type='hidden' class='diajukan_oleh_<?=$row->id_pinjaman;?>' value='<?=$row->diajukan_oleh;?>' />
				<input type='hidden' class='disetujui_oleh_<?=$row->id_pinjaman;?>' value='<?=$row->disetujui_oleh;?>' />
				<input type='hidden' class='dicairkan_oleh_<?=$row->id_pinjaman;?>' value='<?=$row->dicairkan_oleh;?>' />
				<input type='hidden' class='keterangan_<?=$row->id_pinjaman;?>' value='<?=$row->keterangan;?>' />
				<input type='hidden' class='status_pinjaman_<?=$row->id_pinjaman;?>' value='<?=$row->id_status;?>' />
				<input type='hidden' class='tanggal_lhr_<?=$row->id_pinjaman;?>' value='<?=$row->tanggal_lhr;?>' />
				<input type='hidden' class='masuk_kokab_<?=$row->id_pinjaman;?>' value='<?=$row->masuk_kokab;?>' />
				<input type='hidden' class='masuk_pt_<?=$row->id_pinjaman;?>' value='<?=$row->masuk_pt;?>' />
				<input type='hidden' class='tenor_diajukan_<?=$row->id_pinjaman;?>' value='<?=$row->tenor_diajukan;?>' />
				<input type='hidden' class='tenor_disetujui_<?=$row->id_pinjaman;?>' value='<?=$row->tenor_disetujui;?>' />
                <input type='hidden' class='bunga_<?=$row->id_pinjaman;?>' value='<?=$row->bunga;?>' />
				<input type='hidden' class='sudah_bayar_<?=$row->id_pinjaman;?>' value='<?=$row->bayar;?>' />
                <?php echo $row->nama_anggota;?>
            </td>
            <!-- <td><?php echo $row->cabang;?></td> -->
            <td><?php echo $row->nama;?></td>
			<td align = 'right'><?php if($nom==0){$ang = $nom2;} else{$ang=$nom;} echo $this->fungsi->pecah($ang);?></td>
            <td><?php echo $row->tenor_disetujui; ?></td>
			<td><?php if($row->bayar) {echo $row->bayar;} else {echo '0';}?></td>
			<td <?php $sisa= ($row->tenor_disetujui - $row->bayar); if ($sisa >0){echo "style='color:red'";}  ?> > <?php echo $sisa;?></td>
            <td><?php echo $this->fungsi->date_to_bulan($row->tanggal_pencairan);?></td>
            <td><a class='link1 blue98' href='javascript:void(0)' onclick='detil(<?php echo $row->id_pinjaman;?>)' >Det</a></td>
			<td><a class='link1 blue98' href='javascript:void(0)' onclick='angsur(<?php echo $row->id_pinjaman;?>)'>Ang</a></td>
        </tr> 
		<?php
	endforeach; 
    if($pinjaman->num_rows()==0)
    {
        ?>
        <tr>
            <td colspan='7' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    } 
    else 
	{
    }	
    ?>
</table>
</form>