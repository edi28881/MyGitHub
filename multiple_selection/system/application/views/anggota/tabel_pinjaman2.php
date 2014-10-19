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
 </script>        
<table id="tabel_pinjaman" class='grid'>
    <tr>
		<th width='20%'>Nama Anggota</th>
		<th width='30%'>Departemen </th>
        <th width='8%'>Jenis</th>
		<th width='5%'>Stat</th>
		<th width='10%'>Pinjaman</th>
		<th width='10%'>Angsuran</th>
		<th width='10%'>Tenor</th>
        <th width='15%'>Pencairan</th>
        <th align="center" width='70px'>View</th>
    </tr>
    <?php foreach($pinjaman->result() as $i => $row):
	$nom  = $row->nominal_disetujui;
	$nom1 = $row->total_angsuran;
	$nom2 = $row->nominal_pengajuan;
	$nom3 = $row->nominal_disetujui;
    ?>
        <tr <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";} ?> >
            <td>
				<input type='hidden' class='nomor_<?=$row->id_pinjaman;?>' value='<?=$row->nomor;?>' />
				<input type='hidden' class='nak_<?=$row->id_pinjaman;?>' value='<?=$row->nak;?>' />
				<input type='hidden' class='nama_anggota_<?=$row->id_pinjaman;?>' value='<?=$row->nama_anggota;?>' />
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
                <?php echo $row->nama_anggota;?>
            </td>
            <td><?php echo $row->cabang;?></td>
            <td><?php echo $row->nama;?></td>
			<td><?php echo $row->status_id;?></td>
			<td align = 'right'><?php if($nom==0){$ang = $nom2;} else{$ang=$nom;} echo $this->fungsi->pecah($ang);?></td>
			<td align = 'right' ><?php echo $this->fungsi->pecah($nom1);?></td>
            <td><?php  if($row->tenor_disetujui==0){ echo $row->tenor_diajukan;} else { echo $row->tenor_disetujui;} ?></td>
            <td><?php echo $this->fungsi->date_to_bulan($row->tanggal_pencairan);?></td>
            <td><a class='link1 blue98' href='javascript:void(0)' onclick='detil(<?php echo $row->id_pinjaman;?>)' >Det</a>
			<?php
			 if($row->id_status==4)
			 {echo " | <a class='link1 blue98' href='javascript:void(0)' onclick='angsur(".$row->nak.")' >Ang</a>";
			 } else {
			 echo "";}
			?>
			</td>
        </tr> 
		<?php
		$total[]= array();
	$total[]= $row->nominal_disetujui;
		endforeach; 
        ?>	 
        <?php 
    if($pinjaman->num_rows()==0)
    {
        ?>
        <tr>
            <td colspan='9' align='center'><span class='dark77'>Data tidak tersedia</span></td>
        </tr>
        <?php
    } 
    else
    {
		?>
		<tr>
        <th>Total</th>
		<th></th>
		<th></th>
		<th></th>
		<th> <?php $total=array_sum($total); echo $this->fungsi->pecah($total); ?> 
        </th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
         <tr>
	 <?php
    }	
    ?>
</table>
</br>
</hr>
</br>
