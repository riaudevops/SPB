<style type="text/css">
    .tg {
        border-collapse: collapse;
        border-spacing: 0;
    }

    .tg td {
        font-family: Arial, sans-serif;
        font-size: 14px;
        padding: 10px 5px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black;
    }

    .tg th {
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: normal;
        padding: 10px 5px;
        border-style: solid;
        border-width: 1px;
        overflow: hidden;
        word-break: normal;
        border-color: black;
    }

    .tg .tg-z9od {
        font-size: 12px;
        text-align: center;
        vertical-align: top
    }

    .tg .tg-ir4y {
        font-weight: bold;
        font-size: 12px;
        text-align: center;
        vertical-align: top
    }

    .tg .tg-rg0h {
        font-size: 12px;
        text-align: center;
        vertical-align: top
    }
</style>
<b style="font-size: 20px">Sistem Peminjam Buku Online</b>
<p>Laporan Peminjam Buku sampai tanggal <?= date('d-m-Y') ?></p>
<table class="tg" style="undefined;table-layout: fixed; width: 878px">
    <colgroup>
        <col style="width: 10px">
        <col style="width: 201px">
        <col style="width: 227px">
        <col style="width: 141px">
        <col style="width: 141px">
        <col style="width: 141px">
    </colgroup>
    <tr>
        <th class="tg-ir4y">No</th>
        <th class="tg-ir4y">Nama Peminjam</th>
        <th class="tg-ir4y">Buku Dipinjam</th>
        <th class="tg-ir4y">Tanggal Dipinjam</th>
        <th class="tg-ir4y">Tanggal Dikembalikan</th>
        <th class="tg-ir4y">Denda</th>
    </tr>
    <?php $i = 1;
    foreach ($peminjaman as $p) : ?>
        <tr>
            <td class="tg-z9od"><?= $i ?></td>
            <td class="tg-z9od"><?= $p['name'] ?></td>
            <td class="tg-z9od"><?= $p['judul'] ?></td>
            <td class="tg-rg0h"><?= tgl_indo($p['tanggal_peminjaman']) ?></td>
            <td class="tg-rg0h"><?= tgl_indo($p['tanggal_pengembalian']) ?></td>
            <td class="tg-rg0h"><?php  ?>Rp. <?= $p['denda'] ?></td>
        </tr>
    <?php $i++;
    endforeach ?>
</table>