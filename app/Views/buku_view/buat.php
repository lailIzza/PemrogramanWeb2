
<?= $this->extend('layout/layout')?>

<?= $this->section('content')?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah data Buku</h2>

            <!-- validasi -->
            <?php if (isset($validation)) : ?>
            <?php endif; ?>

            <form action="<?= base_url('/simpan'); ?>" method="post">
                <?= csrf_field(); ?>
                <div class="mb-3 row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="judul" class="form-control <?=($validation->hasError('judul')) ? 'is-invalid': ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
                    <div class="col-sm-10">
                        <input type="penulis"  class="form-control <?=($validation->hasError('penulis')) ? 'is-invalid': ''; ?>" id="penulis" name="penulis" value="<?= old('penulis'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('penulis'); ?>
                        </div>
                    </div>
                </div>
                 <div class="mb-3 row">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="penerbit" class="form-control <?=($validation->hasError('penerbit')) ? 'is-invalid': ''; ?>" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>" >
                        <div class="invalid-feedback">
                            <?= $validation->getError('penerbit'); ?>
                        </div>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-10">
                        <input type="sampul" class="form-control" id="sampul" name="sampul" value="<?= old('sampul'); ?>">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Tambah Data</button>

            </form>
        </div>
    </div>
</div>
<?= $this->endSection()?>