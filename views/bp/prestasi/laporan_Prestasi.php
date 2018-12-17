 
<?php
 
$this->load->view('kopsurat');
 
?>
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

    </table>
    <?php
    $nis = $value["nis"];
    $join = array(
        'siswa' => 'siswa.nis = prestasi.nis',
    );
    $condition = array('prestasi.nis' => $nis);
    $list_prestasi = $this->prestasi->selectTableWithJoin($condition, $join)->result_array();
    ?>

    <table class="nonesiswa">
        <tr>
            <td width="20%">Laporan Prestasi Siswa</td>
        </tr>
    </table>

    <table class="table">
        <thead>
            <tr>
                <th>Kategori Prestasi</th>
                <th>Keterangan</th>
                <th>Reward</th>
                <th>Tanggal</th>
                <th>Bukti Sertifikat</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($list_prestasi as $key => $value) {
                $fileGambar = $value["foto"];
                $urlGambar = ($value["foto"]) ? $urlprestasi . '' . $fileGambar : $no_image;
                ?>
                <tr>
                    <td class="center"><?php echo $value['kategori_prestasi']; ?></td>

                    <td class="center"><?php echo $value['keterangan']; ?></td>
                    <td class="center"><?php echo $value['apresiasi']; ?></td>
                    <td class="center"><?php echo $value['tanggal']; ?></td>
                    <td class="center"> 
                        <img src="<?php echo $urlGambar; ?>" class="img-responsive" alt="<?php echo $value["foto"]; ?>" style="width: 120px;"> 

                    </td>

                </tr>
            <?php } ?>

        </tbody>
    </table>

<?php } ?>