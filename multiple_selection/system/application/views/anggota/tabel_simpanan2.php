<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<table class='grid'>
    <tr>
        <th width='5%'>No</th>
		<th width='10%'>No.Trans</th>
		<th width='10%'>No.Anggota</th>
		<th width='20%'>Nama Anggota</th>
		<th width='20%'>Departemen/Area </th>
        <th width='5%'>Jenis</th>
        <th>Nominal</th>
        <th width='15%'>Tanggal</th>
        <th width='5%'>Aksi</th>
    </tr>
    <?php foreach($simpanan->result() as $i => $row):
	$nom = $row->nominal;
    ?>
        <tr <?php $genap=$i%2; if($genap==1) {echo "class='dark78'";} ?> >
            <td><?=$i+1;?> </td>
			<td>
				<input type='hidden' class='nomor_<?=$row->id_simpanan;?>' value='<?=$row->nomor;?>' />
				<input type='hidden' class='nak_<?=$row->id_simpanan;?>' value='<?=$row->nak;?>' />
				<input type='hidden' class='nama_anggota_<?=$row->id_simpanan;?>' value='<?php 
			$sql = "SELECT nama_anggota from anggota WHERE nak =".$row->nak;
					$query = $this->db->query($sql);
					foreach ($query->result() as $row2)
							{
							    echo $nama_anggota=$row2->nama_anggota;
							}
			 ?>' />
				<input type='hidden' class='jenis_<?=$row->id_simpanan;?>' value='<?=$row->id;?>' />
                <input type='hidden' class='tanggal_<?=$row->id_simpanan;?>' value='<?=$row->tanggal_transaksi;?>' />
                <input type='hidden' class='keterangan_<?=$row->id_simpanan;?>' value='<?=$row->keterangan;?>' />
                <input type='hidden' class='nominal_<?=$row->id_simpanan;?>' value='<?=$this->fungsi->pecah($nom,',');?>' />
                <?php echo $this->fungsi->complete($row->nomor,8);?>
            </td>
            <td><?php echo $row->nak;?></td>
            <td>
			<?php 
			$sql = "SELECT nama_anggota from anggota WHERE nak =".$row->nak;
					$query = $this->db->query($sql);
					foreach ($query->result() as $row2)
							{
							    echo $nama_anggota=$row2->nama_anggota;
								
							}
							
			 ?>
			</td>
			<td>
			<?php 
			$sql = "SELECT cabang.cabang from anggota left join cabang on cabang.cab_id=anggota.cab_id WHERE nak =".$row->nak;
					$query = $this->db->query($sql);
					foreach ($query->result() as $row2)
							{
							    echo $cabang=$row2->cabang;
							}
			 ?>
 			</td>
			<td><?php echo $row->nama;?></td>
            <td align='right'><?php echo $this->fungsi->pecah($nom);?></td>
            <td><?php echo $this->fungsi->date_to_tanggal2($row->tanggal_transaksi);?></td>
            <td><a class='link1 blue98' href='javascript:void(0)' onclick='edit(<?php echo $row->id_simpanan;?>)' >Edit</a></td>
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
<a class='button buttonwhite smallbtn' href='javascript:void(0)' <?php if($this->auth->cek('input_data',true)):?> onclick='tambah_u(<?php echo $row->id_simpanan;?>) <?php endif;?> '>Tambah</a>
</td></tr> 
</table>
<div class='a_left'>
<?php
echo 'Data per Page : ';
echo $this->fungsi->build_select_common('dataperpage',$dataperpage,'perpage','perpage','onchange="view_simpanan()"',$cur_perpage);
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
