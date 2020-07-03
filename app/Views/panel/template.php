<!DOCTYPE html>
<html lang="en">

<head>
    <?= view('panel/_partial/head') ?>
    <?= $this->renderSection('style') ?>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <?= view('panel/_partial/sidebar') ?>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <?= view('panel/_partial/navbar') ?>
            <?= $this->renderSection('content') ?>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?= view('panel/_partial/foot') ?>
    <?= $this->renderSection('script') ?>

</body>

</html>