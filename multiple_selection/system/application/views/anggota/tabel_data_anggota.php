<fieldset width='400px' background='blue'>
<legend><div class='title'><a href='javascript:void(0);' onclick='view_anggota(); switch_tab(clear);'>DATA ANGGOTA</a></div></legend>
<table class='myform' style='width:100%'>
 <?php foreach($anggota->result() as $i => $row): ?>
	     <tr>
            <td class='a_right' valign='top'>ID Koperasi</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="20" value='<?php echo $row->nak;?>'  type="text" name="nomor" disabled="true" />
            </td>
			</td>
			<td colspan='3' rowspan='3'> 
                <table class='myform' >
				<tr> 
				<td>Usia</td> <td>Masa Kerja</td> <td>Masa Anggota</td>
				</tr>
				<tr> 
					<td><input disabled='true' value='<?php echo $row->tanggal_lhr;?>' type='text' class='date' id='tanggal_lhr' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' value='<?php echo $row->masuk_pt;?>' type='text' class='date' id='masuk_pt' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' value='<?php echo $row->masuk_kokab;?>' type='text' class='date' id='masuk_kokab' autocomplete='off' style='width:100px' /></td> 
				</tr>
				<tr> 
					<td><input disabled='true' type='text' value=''  id='umur' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' value=''  id='masa_kerj' autocomplete='off' style='width:100px' /></td> 
					<td><input disabled='true' type='text' value=''  id='masa_angg' autocomplete='off' style='width:100px' /></td> 
				</tr>
				</table>
			</td>
        </tr>
		 <tr>
            <td class='a_right' valign='top'>ID Karyawan</td>
            <td valign='top'>:</td>
            <td colspan='2' class='a_left' valign='top'>
			<input size="20" value='<?php echo $row->nik;?>' type="text" name="nak" disabled="true" />
        </tr>
		<tr>
            <td class='a_right' valign='top'>Nomor KTP</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="30" value='<?php echo $row->noidentitas;?>' type="text" name="nomor" disabled="true" />
            </td>
        </tr>
		<tr>
            <td class='a_right' valign='top'>NamaAnggota</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="30" value='<?php echo $row->nama_anggota;?>' type="text" name="nama_anggota" disabled="true" />
            </td>
        </tr>
		 </tr>
		<tr>
            <td class='a_right' valign='top'>Departemen</td>
            <td valign='top'>:</td>
            <td colspan='2'  class='a_left' valign='top'>
            <input size="30" value='<?php echo $row->cabang;?>' type="text" name="nama_anggota" disabled="true" />
            </td>
        </tr>
		<?php endforeach; ?>
    </table>
</fieldset>