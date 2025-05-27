<?= $this->section('style') ?>
<link rel="stylesheet" href="<?= base_url('asset/css/beranda.css') ?>">
<?= $this->endSection() ?>

<?= $this->extend('layout/layout')?>

<?= $this->section('content')?>
    <div class="container">
        <div class="col">
            <br>
            <a href="/buat" class="btn btn-primary mt3">Tambah Data Buku</a>

            <?php if(session()->getFlashdata('pesan')) :?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif ?>

            <h1 class="mt2">Daftar buku</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($buku as $b) :?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/asset/gambar/<?= $b['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $b['judul'];?></td>
                            <td><a href="/detail/<?= $b['slug']; ?>" class="btn btn-success">Details</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

<?= $this->endSection()?>