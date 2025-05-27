<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" 
    crossorigin="anonymous">
    <title><?= $title ?? '' ?></title>
    <?= $this->renderSection('style') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">MyBook</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link <?= ($active_nav ?? '') == 'index' ? 'active' : '' ?>" aria-current="page" href="<?= base_url('index');?>">Daftar Buku</a>
                <a class="nav-link <?= ($active_nav ?? '') == 'detail' ? 'active' : '' ?>" href="<?= base_url('detail');?>">Detail Buku</a>
                <a class="nav-link <?= ($active_nav ?? '') == 'tambah' ? 'active' : '' ?>" href="<?= base_url('buat');?>">Tambah Buku</a>
                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
            </div>
        </div>
    </div>
    </nav>

    <?= $this->renderSection('content')?>

</body>