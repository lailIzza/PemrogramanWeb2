
<?= $this->extend('layout/layout')?>

<?= $this->section('content')?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h2 class="mt-2">Detail Buku</h2>
                <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="/asset/gambar/<?= $buku['sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title"><?= $buku['judul']; ?></h5>
                        <p class="card-text"><b>Penulis : </b><?= $buku['penulis']; ?></p>
                        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>

                        <a href="/edit/<?= $buku['slug']; ?>" class="btn btn-warning">Ubah</a>
                        <form action="/hapus/<?= $buku['id']; ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                        <!-- <a href="" class="btn btn-danger">Hapus</a> -->
                        <br><br>
                        <a href="/">Kembali ke Daftar Buku</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection()?>