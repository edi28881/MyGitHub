<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table class='grid'>
    <tr>
		<th width='20%'>''</th>
		<th width='30%'>Pinjaman</th>
        <th width='10%'>Bunga</th>
		<th width='10%'>Total</th>
        <th width='40px'>View</th>
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
                <?php echo $row->nama_anggota;?>
            </td>
            <td><?php echo $row->cabang;?></td>
            <td><?php echo $row->nama;?></td>
			<td align = 'right'><?php echo $this->fungsi->pecah($nom);?></td>
			<td align = 'right' ><?php echo $this->fungsi->pecah($nom1);?></td>
            <td><?php echo $row->tenor;?></td>
            <td><?php echo $this->fungsi->date_to_bulan($row->tanggal_pencairan);?></td>
            <td><a class='link1 blue98' href='javascript:void(0)' onMouseOver='detil(<?php echo $row->id_pinjaman;?>)' >Det</a></td>
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
            <td colspan='6' align='center'><span class='dark77'>Data tidak tersedia</span></td>
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
<div class='a_center'>
    <?php
    $str = '';
    $br = '';
    if(!isset($no_prev))
    {
        $br = '<br />';
        $str .= $prev;
    }
    if(!isset($no_next))
    {
        $br = '<br />';
        if(!isset($no_prev))
        {
            $str .= ' - ';
        }
        $str .= $next;
    }
    echo $br.$str;
    ?>
</div>
</br>
</hr>
</br>
