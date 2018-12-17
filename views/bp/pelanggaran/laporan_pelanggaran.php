<?php
$this->load->view('kopsurat');
?>
 

<legend>Data Siswa</legend>
<?php foreach ($dataSiswa as $value) {
    ?>

    <table class="nonesiswa">
        <tr>
            <td width="20%">Nis</td>

            <td><?php echo $value["nis"]; ?></td>
        </tr>
        <tr>
            <td>Nama</td>

            <td><?php echo $value["namasiswa"]; ?></td>
        </tr>
        <tr>
            <td>Kelas</td>

            <td><?php echo $list_jurusan[$value["jurusan"]]; ?></td>
        </tr>
<!--        <tr>
            <td>Kelas</td>

            <td><?php echo $value["kelas"]; ?></td>
        </tr>-->
        <tr>
            <td>Total Poin </td>

            <td><?php echo $value["total_poin"]; ?></td>
        </tr>
    </table>




    <?php
    $nis = $value["nis"];
    $condition = array('pelanggaran_siswa.nis' => $nis);
    $join = array(
        'siswa' => 'siswa.nis = pelanggaran_siswa.nis',
        'aspek' => 'aspek.id_aspek = pelanggaran_siswa.id_aspek',
        'pelanggaran' => 'pelanggaran.idpelanggaran = pelanggaran_siswa.idpelanggaran'
    );
    $list_pelanggaran_siswa = $this->pelanggaran_siswa->selectTableWithJoin($condition, $join)->result_array();
    ?>

    <table class="nonesiswa">
        <tr>
            <td width="20%">Laporan Pelanggaran Siswa</td>
        </tr>
    </table>

    <table class="table table-bordered table-striped table-hover data-table">
        <thead>
            <tr>
                <th>Aspek Pelanggaran</th>
                <th>Jenis Pelanggaran</th>
                <th>Sanksi</th>
                <th>Poin</th>
                <th>Tanggal</th>

            </tr>
        </thead>
        <tbody>
    <?php foreach ($list_pelanggaran_siswa as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['nama_aspek']; ?></td>
                    <td><?php echo $value['jenis_pelanggaran']; ?></td>
                    <td><?php echo $value['sanksi_pelanggaran']; ?></td>
                    <td><?php echo $value['poin_pel']; ?></td>
                    <td class="center"><?php echo $value['tgl_pelanggaran']; ?></td>

                </tr>
    <?php } ?>
        </tbody>
    </table>
<?php
}?>