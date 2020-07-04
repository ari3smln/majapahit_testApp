<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Majapahit </title>
    <link href="vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="assets/css/styleLogin.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="assets/font-awesome-4.7.0/css/font-awesome.css">
</head>

<body>
    <div class="container">
        <div class="card card-login mx-auto text-center bg-dark">
            <div class="card-header mx-auto bg-dark">

                <span><i class="text-warning fa fa-lock fa-4x w-75"></i></span><br>
                <span class="logo_title mt-5"> <span>Panel</span> Majapahit </span>
            </div>
            <div class="card-body">
                <?php echo form_open('login', array('class' => 'form')) ?>
                <span class="pesan pesan-username text-warning">Username tidak boleh kosong !!!</span>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username">
                </div>
                <span class="pesan pesan-password text-warning">Password tidak boleh kosong !!!</span>
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-key"></i></span>
                    </div>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="btn" value="Login" class="btn btn-outline-danger float-right login_btn">
                </div>
                <?php echo form_close() ?>
            </div>
            <?php if (!empty(session()->getFlashdata('gagalLogin'))) { ?>
                <div class="alert alert-danger text-center alert-dismissible fade show" role="alert">
                    <strong>Verifikasi Keamanan !!!</strong><br> <?php echo session()->getFlashdata('gagalLogin') ?>.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
        </div>
    </div>
    <script src="vendors/jquery/jquery.min.js"></script>
    <script src="vendors/bootstrap/js/bootstrap.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            $('.form').submit(function() {
                // alert("test");
                var username = $('#username').val().length;
                var password = $('#password').val().length;

                if (username == 0) {
                    $(".pesan-username").css('display', 'block');
                    return false;
                } else if (username >= 0) {
                    $(".pesan-username").css('display', 'none');
                }

                if (password == 0) {
                    $(".pesan-password").css('display', 'block');
                    return false;
                } else if (username >= 0) {
                    $(".pesan-username").css('display', 'none');
                }
            });
        });
    </script>
</body>

</html>