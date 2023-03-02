<?php
session_start();
include '../../koneksi.php';
$aksi = $_GET['aksi'];

if ($aksi == 'tambah') {
    $id_departemen = $_POST['id_departemen'];
    $tgl_diminta = $_POST['tgl_diminta'];
    $status_karyawan = $_POST['status_karyawan'];
    $jumlah_karyawan_pria = $_POST['jumlah_karyawan_pria'];
    $jumlah_karyawan_wanita = $_POST['jumlah_karyawan_wanita'];
    $posisi = $_POST['posisi'];
    $tgl_bergabung = $_POST['tgl_bergabung'];
    $pendidikan = $_POST['pendidikan'];
    $pengalaman = $_POST['pengalaman'];
    $pelatihan = $_POST['pelatihan'];
    $keahlian = $_POST['keahlian'];
    $kualifikasi_lain = $_POST['kualifikasi_lain'];
    $diminta_oleh = $_POST['diminta_oleh'];
    $disetujui_oleh = $_POST['disetujui_oleh'];
    $diketahui_oleh = $_POST['diketahui_oleh'];
    $ringkasan_tugas = $_POST['ringkasan_tugas'];
    $tgl_rekrutmen = $_POST['tgl_rekrutmen'];
    $ptkbd = $_POST['ptkbd'];
    $pewawancara = $_POST['pewawancara'];

    $pendidikan = implode(',', $pendidikan);

    // echo $id_departemen . '<br>';
    // echo $tgl_diminta . '<br>';
    // echo $status_karyawan . '<br>';
    // echo $jumlah_karyawan_pria . '<br>';
    // echo $jumlah_karyawan_wanita . '<br>';
    // echo $posisi . '<br>';
    // echo $tgl_bergabung . '<br>';
    // echo $pendidikan . '<br>';
    // echo $pengalaman . '<br>';
    // echo $pelatihan . '<br>';
    // echo $keahlian . '<br>';
    // echo $kualifikasi_lain . '<br>';
    // echo $diminta_oleh . '<br>';
    // echo $disetujui_oleh . '<br>';
    // echo $diketahui_oleh . '<br>';
    // echo $ringkasan_tugas . '<br>';
    // echo $tgl_rekrutmen . '<br>';
    // echo $ptkbd . '<br>';
    // echo $pewawancara . '<br>';

    if (
        !$id_departemen or !$tgl_diminta or !$status_karyawan or !$jumlah_karyawan_pria or !$jumlah_karyawan_wanita or !$posisi or !$tgl_bergabung or !$pendidikan or !$pengalaman or !$pelatihan or !$keahlian or !$kualifikasi_lain or !$diminta_oleh or !$disetujui_oleh or !$diketahui_oleh or !$ringkasan_tugas or !$tgl_rekrutmen or !$ptkbd or !$pewawancara
    ) {
        header('location:../index.php?halaman=tambah-permintaan-karyawan');
    }

    $tgl_diminta = str_replace('/', '-', $tgl_diminta);
    $tgl_diminta = date('Y-m-d', strtotime($tgl_diminta));

    $tgl_bergabung = str_replace('/', '-', $tgl_bergabung);
    $tgl_bergabung = date('Y-m-d', strtotime($tgl_bergabung));

    $tgl_rekrutmen = str_replace('/', '-', $tgl_rekrutmen);
    $tgl_rekrutmen = date('Y-m-d', strtotime($tgl_rekrutmen));



    $query = mysqli_query($koneksi, "INSERT INTO permintaan_karyawan(id_departemen, tgl_diminta, status_karyawan, jumlah_karyawan_pria, jumlah_karyawan_wanita, posisi, tgl_bergabung, pendidikan, pengalaman, pelatihan, keahlian, kualifikasi_lain, diminta_oleh, disetujui_oleh, diketahui_oleh, ringkasan_tugas, tgl_rekrutmen, ptkbd, pewawancara) VALUES('$id_departemen', '$tgl_diminta', '$status_karyawan', '$jumlah_karyawan_pria', '$jumlah_karyawan_wanita', '$posisi', '$tgl_bergabung', '$pendidikan', '$pengalaman', '$pelatihan', '$keahlian', '$kualifikasi_lain', '$diminta_oleh', '$disetujui_oleh',
    '$diketahui_oleh', '$ringkasan_tugas', '$tgl_rekrutmen', '$ptkbd', '$pewawancara')");

    if ($query) {
        header('location:../index.php?halaman=permintaan-karyawan');
    } else {
        echo mysqli_error($koneksi);
        header('location:../index.php?halaman=tambah-permintaan-karyawan');
    }
}


if ($aksi == 'ubah') {

    $id = $_GET['id'];

    $id_departemen = $_POST['id_departemen'];
    $tgl_diminta = $_POST['tgl_diminta'];
    $status_karyawan = $_POST['status_karyawan'];
    $jumlah_karyawan_pria = $_POST['jumlah_karyawan_pria'];
    $jumlah_karyawan_wanita = $_POST['jumlah_karyawan_wanita'];
    $posisi = $_POST['posisi'];
    $tgl_bergabung = $_POST['tgl_bergabung'];
    $pendidikan = $_POST['pendidikan'];
    $pengalaman = $_POST['pengalaman'];
    $pelatihan = $_POST['pelatihan'];
    $keahlian = $_POST['keahlian'];
    $kualifikasi_lain = $_POST['kualifikasi_lain'];
    $diminta_oleh = $_POST['diminta_oleh'];
    $disetujui_oleh = $_POST['disetujui_oleh'];
    $diketahui_oleh = $_POST['diketahui_oleh'];
    $ringkasan_tugas = $_POST['ringkasan_tugas'];
    $tgl_rekrutmen = $_POST['tgl_rekrutmen'];
    $ptkbd = $_POST['ptkbd'];
    $pewawancara = $_POST['pewawancara'];

    $pendidikan = implode(',', $pendidikan);

    echo $id_departemen . '<br>';
    echo $tgl_diminta . '<br>';
    echo $status_karyawan . '<br>';
    echo $jumlah_karyawan_pria . '<br>';
    echo $jumlah_karyawan_wanita . '<br>';
    echo $posisi . '<br>';
    echo $tgl_bergabung . '<br>';
    echo $pendidikan . '<br>';
    echo $pengalaman . '<br>';
    echo $pelatihan . '<br>';
    echo $keahlian . '<br>';
    echo $kualifikasi_lain . '<br>';
    echo $diminta_oleh . '<br>';
    echo $disetujui_oleh . '<br>';
    echo $diketahui_oleh . '<br>';
    echo $ringkasan_tugas . '<br>';
    echo $tgl_rekrutmen . '<br>';
    echo $ptkbd . '<br>';
    echo $pewawancara . '<br>';

    if (
        !$id_departemen or !$tgl_diminta or !$status_karyawan or !$jumlah_karyawan_pria or !$jumlah_karyawan_wanita or !$posisi or !$tgl_bergabung or !$pendidikan or !$pengalaman or !$pelatihan or !$keahlian or !$kualifikasi_lain or !$diminta_oleh or !$disetujui_oleh or !$diketahui_oleh or !$ringkasan_tugas or !$tgl_rekrutmen or !$ptkbd or !$pewawancara
    ) {
        header('location:../index.php?halaman=ubah-permintaan-karyawan&id=' . $id);
    }

    $tgl_diminta = str_replace('/', '-', $tgl_diminta);
    $tgl_diminta = date('Y-m-d', strtotime($tgl_diminta));

    $tgl_bergabung = str_replace('/', '-', $tgl_bergabung);
    $tgl_bergabung = date('Y-m-d', strtotime($tgl_bergabung));

    $tgl_rekrutmen = str_replace('/', '-', $tgl_rekrutmen);
    $tgl_rekrutmen = date('Y-m-d', strtotime($tgl_rekrutmen));

    $query = mysqli_query($koneksi, "UPDATE permintaan_karyawan SET 
    id_departemen='$id_departemen',
    tgl_diminta='$tgl_diminta',
    status_karyawan='$status_karyawan',
    jumlah_karyawan_pria='$jumlah_karyawan_pria',
    jumlah_karyawan_wanita='$jumlah_karyawan_wanita',
    posisi='$posisi',
    tgl_bergabung='$tgl_bergabung',
    pendidikan='$pendidikan',
    pengalaman='$pengalaman',
    pelatihan='$pelatihan',
    keahlian='$keahlian',
    kualifikasi_lain='$kualifikasi_lain',
    diminta_oleh='$diminta_oleh',
    disetujui_oleh='$disetujui_oleh',
    diketahui_oleh='$diketahui_oleh',
    ringkasan_tugas='$ringkasan_tugas',
    tgl_rekrutmen='$tgl_rekrutmen',
    ptkbd='$ptkbd',
    pewawancara='$pewawancara'
    WHERE id_permintaan_karyawan='$id'");

    if ($query) {
        $_SESSION['toast_type'] == 'success';
        $_SESSION['toast_message'] == 'Tambah data permintaan karyawan berhasil';
        header('location:../index.php?halaman=permintaan-karyawan');
    } else {
        echo mysqli_error($koneksi);
    }
}

if ($aksi == 'hapus') {
    $id = $_GET['id'];

    $query = mysqli_query($koneksi, "DELETE FROM permintaan_karyawan WHERE id_permintaan_karyawan='$id'");

    if ($query) {
        header('location:../index.php?halaman=permintaan-karyawan');
    }
}

if ($aksi == 'konfirmasi') {
    $id = $_GET['id'];
    $persetujuan = $_POST['persetujuan'];

    $query = mysqli_query($koneksi, "UPDATE permintaan_karyawan SET status_permintaan='$persetujuan' WHERE id_permintaan_karyawan='$id'");

    if ($query) {
        header('location:../index.php?halaman=permintaan-karyawan');
    } else {
        echo mysqli_error($koneksi);
    }
}
