<?= $this->extend('panel/template') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <h4 class="mt-4">Selamat Datang, <?php echo session("nama_lengkap") ?></h4>
    <div class="row text-center">
        <div class="col">
            <div class="counter bg-primary text-light">
                <i class="fa fa-user fa-2x"></i>
                <h2 class="timer count-title count-number"><?php echo $userData; ?></h2>
                <p class="count-text ">Users</p>
            </div>
        </div>
        <div class="col">
            <div class="counter bg-success text-light">
                <i class="fa fa-archive fa-2x"></i>
                <h2 class="timer count-title count-number"><?php echo $prodData; ?></h2>
                <p class="count-text ">Produk</p>
            </div>
        </div>
        <div class="col">
            <div class="counter bg-warning text-light">
                <i class="fa fa-exchange fa-2x"></i>
                <h2 class="timer count-title count-number"><?php echo $transData; ?></h2>
                <p class="count-text ">Transaksi</p>
            </div>
        </div>
        <div class="col">
            <div class="counter bg-info text-light">
                <i class="fa fa-flag fa-2x"></i>
                <h2 class="timer count-title count-number"><?php echo $hadData; ?></h2>
                <p class="count-text ">Hadiah</p>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>