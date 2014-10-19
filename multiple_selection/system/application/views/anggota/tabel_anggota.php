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
input
{
font-size:10pt;
border:none;
display:none;
background:#FFFFC0;
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
	z-index:11;
	}
#container_form {
	position:absolute;
	z-index:1;
	}
.container_data {
	margin:0px auto;
	position:relative;
	z-index:12;
	}
#contactForm {
	height:720px;width:700px;
	background:#515151 ;
	border:1px solid #929191;
	padding:7px 12px;
	color:#fff;
	}
</style>
<script type='text/javascript'>
    $(function(){
        $('.date').calendar();
        $('input[name=nama_anggota]').focus();
        $('div[name=container_form]').hide('slow');
    });
    function simpan_transaksi()
    {
        var tanggal = $('input[name=tanggal_transaksi]').val();
        var keterangan = $('input[name=keterangan]').val();
        var nominal = $('input[name=nominal]').val();
        if(tanggal==''||keterangan==''||nominal=='')
        {
            alert('Isilah form dengan lengkap');
        }
        else
        {
            send_form(document.form_transaksi,'transaksi/simpan','#content');
        }
    }
    function edit_anggota()
    {
         $('div[name=container_form]').hide('fast');
         $('div[name=container_form]').show('slow');
         popup();
        $('input[name=tanggal_transaksi]').val($('.tanggal_'+id).val());
        $('input[name=nama_anggota]').val($('td[name=nama_anggota]').val());
        $('input[name=nominal]').val($('.nominal_'+id).val());
        $('input[name=nomor]').val($('.nomor_'+id).val());
    }
    function reset_form()
    {
        $('input[name=tanggal_transaksi]').val('');
        $('input[name=keterangan]').val('');
        $('input[name=nominal]').val('');
        $('input[name=nomor]').val('');
    }
    function form_close()
    {
        $("#backgroundPopup").fadeOut("slow");
        $('div[name=container_form]').hide('slow');
    }
    function popup()
    {
    $("#backgroundPopup").css({"opacity": "0.6"});
    $("#backgroundPopup").fadeIn("slow");
    }
</script>
<fieldset>
<legend> DATA ANGGOTA </legend>
<table  border="1" width="470px">
<?php foreach($anggota->result() as $i => $row):?>
<tr>
  <td class=photo rowspan="7" width="150px">
  <img width=150px height=160px src=<?php echo base_url();?>userdata/avatar/<?php echo $row->avatar;?> />
  </td>
  <td width="10px"></td>
  <td width="150px" class="b_kiri">Nomor Induk</td>
  <td width="10px"></td>
  <td width="150px"></td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Karyawan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $row->nik;?>' />
  <strong><?php echo $row->nik;?></strong>
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Koperasi</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $row->nak;?>' />
  <strong><?php echo $row->nak;?></td></strong>
</tr>
<tr>
  <td></td>
  <td class="b_kiri">Tanggal</td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Lahir</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $this->fungsi->date_to_tanggal2($row->tgl_lhr);?>' />
  <strong><?php echo $this->fungsi->date_to_tanggal2($row->tgl_lhr);?></strong>
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Masuk Kerja</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $this->fungsi->date_to_tanggal2($row->masuk_pt);?>' />
  <strong><?php echo $this->fungsi->date_to_tanggal2($row->masuk_pt);?></strong>
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Masuk Kop</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $this->fungsi->date_to_tanggal2($row->masuk_kokab);?>' />
  <strong><?php echo $this->fungsi->date_to_tanggal2($row->masuk_kokab);?></strong>
  </td>
</tr>
<tr>
  <td colspan="5"></td>
</tr>
<tr>
  <td class=b_kiri>Nama Lengkap</td>
  <td class=b_sp>:</td>
  <td name='nama_anggota' class=b_kanan colspan=3>
  <?php echo $row->nama_anggota;?>
  </td>
</tr>
<tr>
  <td class=b_kiri>Jenis Kelamin</td>
  <td class=b_sp>:</td>
  <td class=b_kanan colspan=2>
  <input type=text width=460px value=' <?php echo $row->jk;?>' />
  <strong><?php echo $row->jk;?></strong>
  </td>
  <td></td>
</tr>
<tr>
  <td class=b_kiri>Status Pernikahan</td>
  <td class=b_sp>:</td>
  <td class=b_kanan colspan=3>
  <input type=text width=460px value=' <?php echo $row->status;?>' />
  <strong><?php echo $row->status;?></strong>
  </td>
</tr>
<tr>
  <td class=b_kiri>Alamat</td>
  <td></td>
  <td colspan=3></td>
</tr>
<tr>
  <td class=k_kanan>Jalan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_jalan;?>'/>
  <strong> <?php echo $row->alamat_jalan;?> </strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Provinsi</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_prov;?>' />
  <strong><?php echo $row->alamat_prov;?></strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Kabupaten/Kota</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kab;?>' />
  <strong><?php echo $row->alamat_kab;?></strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Kecamatan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kec;?>' />
  <strong><?php echo $row->alamat_kec;?></strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Kelurahan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kel;?>' />
  <strong><?php echo $row->alamat_kel;?></strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Email</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->email;?>' />
  <strong><?php echo $row->email;?></strong>
  </td>
</tr>
<tr>
  <td class=k_kanan>Telpon</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->telpon;?>' />
  <strong><?php echo $row->telpon;?></strong>
  </td>
</tr>
<tr>
  <td colspan="5">
  <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='edit_anggota()'>Edit</a>
  </td>
</tr>
<?php endforeach;?>
</table>
</fieldset>

<div  name='container_form' id='container_form' >
<div id="contactForm">
        	<div class="loader"></div>
			<div class="bar"></div>
<div class='title'>Input Data Anggota</div>
<form method='post' action='' class="contactForm" name='form_anggota1'>
<table  style='width:100%'>
<tr>
  <td class=photo rowspan="7" width="150px">
  <img width=150px height=160px src=<?php echo base_url();?>userdata/avatar/<?php echo $row->avatar;?> />
  </td>
  <td width="10px"></td>
  <td width="150px" class="b_kiri">Nomor Induk</td>
  <td width="10px"></td>
  <td width="150px"></td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Karyawan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <strong><?php echo $row->nik;?></strong>
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Koperasi</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <strong><?php echo $row->nak;?></td></strong>
</tr>
<tr>
  <td></td>
  <td class="b_kiri">Tanggal</td>
  <td></td>
  <td></td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Lahir</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type='text' value='<?php echo date('Y-m-d');?>' class='date' name='tanggal_transaksi' autocomplete='off' style='width:100px' />
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Masuk Kerja</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $this->fungsi->date_to_tanggal2($row->masuk_pt);?>' />
  <?php echo $this->fungsi->date_to_tanggal2($row->masuk_pt);?>
  </td>
</tr>
<tr>
  <td></td>
  <td class=k_kanan>Masuk Kop</td>
  <td class=k_sp>:</td>
  <td class=k_kiri>
  <input type=text width=150px value=' <?php echo $this->fungsi->date_to_tanggal2($row->masuk_kokab);?>' />
  </td>
</tr>
<tr>
  <td colspan="5"></td>
</tr>
<tr>
  <td class=b_kiri>Nama Lengkap</td>
  <td class=b_sp>:</td>
  <td class=b_kanan colspan=3>
  <input type=text name='nama_anggota' style='width:600px'  />
  </td>
</tr>
<tr>
  <td class=b_kiri>Jenis Kelamin</td>
  <td class=b_sp>:</td>
  <td class=b_kanan colspan=2>
  <input type=text width=460px value=' <?php echo $row->jk;?>' />
  </td>
  <td></td>
</tr>
<tr>
  <td class=b_kiri>Status Pernikahan</td>
  <td class=b_sp>:</td>
  <td class=b_kanan colspan=3>
  <input type=text width=460px value=' <?php echo $row->status;?>' />
  </td>
</tr>
<tr>
  <td class=b_kiri>Alamat</td>
  <td></td>
  <td colspan=3></td>
</tr>
<tr>
  <td class=k_kanan>Jalan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_jalan;?>'/>
  </td>
</tr>
<tr>
  <td class=k_kanan>Provinsi</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_prov;?>' />
  </td>
</tr>
<tr>
  <td class=k_kanan>Kabupaten/Kota</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kab;?>' />
  </td>
</tr>
<tr>
  <td class=k_kanan>Kecamatan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kec;?>' />
  </td>
</tr>
<tr>
  <td class=k_kanan>Kelurahan</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->alamat_kel;?>' />
  </td>
</tr>
<tr>
  <td class=k_kanan>Email</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->email;?>' />
  </td>
</tr>
<tr>
  <td class=k_kanan>Telpon</td>
  <td class=k_sp>:</td>
  <td class=k_kiri colspan=3>
  <input type=text width=460px value=' <?php echo $row->telpon;?>' />
  </td>
</tr>
<tr>
  <td colspan="5">
  </td>
</tr>
</form>
    <div class='the_footer a_left'>
        <a class='button buttonblue smallbtn' href='javascript:void(0)' onclick='simpan_transaksi()'>Simpan</a>
        <a class='button buttonwhite smallbtn' href='javascript:void(0)' onclick='reset_form()'>Kosongkan Form</a>
    <a class='button buttonwhite smallbtn'  href='javascript:void(0)' onclick='form_close()'>Cancel</a></div>
    </div>
    </div>
    </div>
    
