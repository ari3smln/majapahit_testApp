<?= $this->extend('panel/template') ?>
<?= $this->section('style') ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/vendor/DataTables/media/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>/vendor/DataTables/media/css/dataTables.bootstrap.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-3">
            <h2>Users</h2>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-2">
            <button id="btn-tambah" type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
        </div>
    </div>
    <table class="table table-striped data">
        <thead>
            <tr>
                <th width="5%">#</th>
                <th width="20%">Nama User</th>
                <th width="20%">Username</th>
                <th width="20%">Level</th>
                <th width="5%"></th>
                <th width="5%"></th>
            </tr>
        </thead>
        <tbody id="response"></tbody>
    </table>
</div>

<!-- Modal Add Product-->
<form class="form_input">
    <input type="hidden" name="method" id="method" value="POST">
    <input type="hidden" name="idUser" id="idUser">
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Users</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div style="display: none;" class="alert alert-danger text-left alert-dismissible fade show" id="alert" role="alert">
                        <strong>Validasi Form :</strong><br>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div id="pesanForm"></div>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_user" name="nama_user" placeholder="Nama Lengkap">
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="password" class="form-control" name="password">
                        <input type="hidden" id="passwordOld" class="form-control" name="passwordOld">
                    </div>

                    <div class="form-group">
                        <label>Level</label>
                        <select name="level" id="level" class="form-control">
                            <option value=""></option>
                            <option value="1">Super Admin</option>
                            <option value="2">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="tombol-simpan" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Delete Product-->
<form class="formDelete">
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4 id="responseDelete">Are you sure want to delete this Data ?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userId" class="userID">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" id="formDeleteBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- End Modal Delete Product-->
<!-- End Modal Add Product-->
<?= $this->endSection() ?>

<?= $this->section('script') ?>

<script type="text/javascript" src="<?php echo base_url() ?>/vendor/DataTables/media/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>/vendor/bootstrap-sweetalert/sweetalert.min2.js"></script>

<script>
    var loadResponse = '<tr><td colspan="5" class="text-center">Loading Response...<td></tr>';
    $(document).ready(function() {
        loadTable();

        $('#btn-tambah').click(function() {
            clearForm();
            $('#method').val("POST");

        })

        $(document).on("click", ".btn-edit", function() {
            $('#alert').css("display", "none");
            $('#method').val("PUT");

            // get data from button edit
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            const username = $(this).data('username');
            const level = $(this).data('level');
            const password = $(this).data('ps');
            // console.log(nama);
            // Set data to Form Edit
            $('#idUser').val(id);
            $('#nama_user').val(nama);
            $('#username').val(username);
            $('#level').val(level).trigger('change');
            $('#passwordOld').val(password);
            // Call Modal Edit
            $('#addModal').modal('show');
        });
    });

    // get Delete Product
    $(document).on("click", ".btn-delete", function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.userID').val(id);
        // Call Modal Edit
        $('#deleteModal').modal('show');
    });

    // delete action
    $("#formDeleteBtn").on('click', function(event) {

        id = $('.userID').val();

        $.ajax({
            url: "<?php echo site_url("rest/users/delete"); ?>/" + id,
            method: "DELETE",
            beforeSend: function() {
                $('#responseDelete').html("Loading...");
            },
            success: function(data) {
                swal({
                    title: "Berhasil  !!!",
                    text: "Data Berhasil di Hapus.",
                    icon: "success",
                    button: false,
                    timer: 3000
                });
                loadTable();
                $('#deleteModal').modal('hide');

            }
        });
    });

    function loadTable() {
        $.ajax({
            url: "<?php echo site_url("rest/users/data"); ?>",
            method: "POST",
            beforeSend: function() {
                $('#response').html(loadResponse);
            },
            success: function(data) {
                var row = '<tr>';
                // console.log(data.data[0]);
                $.each(data.data, function(index) {
                    no = index + 1;
                    nama_user = data.data[index].nama_user;
                    level = data.data[index].level == 1 ? "Super Admin" : "Admin";
                    username = data.data[index].username;
                    id = data.data[index].id;

                    row += '<tr><td>' + no + '</td><td>' + nama_user + '</td><td>' + username + '</td><td>' + level + '</td><td><a href="#" title="Edit Data" class="btn btn-warning btn-sm btn-edit"  data-nama="' + nama_user + '" data-id="' + id + '" data-username="' + username + '" data-level="' + data.data[index].level + '" data-ps="' + data.data[index].password + '" ><i class="fa  fa-pencil-square-o"></i> </a></td><td><a title="Hapus Data" class="btn btn-danger btn-sm btn-delete" data-id="' + id + '" href="#"><i class="fa  fa-trash"></i> </a></td></tr>';
                });
                setTimeout(function() {
                    $('#response').html(row + '</tr>');
                }, 1500);

            }
        });


    }

    $("#tombol-simpan").click(function(event) {

        var method = $('#method').val();
        var nama_userTxt = $('#nama_user').val();
        var usernameTxt = $('#username').val();
        var levelTxt = $('#level').val();
        var passwordTxt = $('#password').val();
        msgSave = '';
        if (method == "POST") {
            msgSave = "Simpan";
            APP_URL = "<?php echo site_url("rest/users/create"); ?>";
        } else {
            var id = $('#idUser').val();
            msgSave = "Ubah";
            APP_URL = "<?php echo site_url("rest/users/update/"); ?>" + id;
        }

        if (passwordTxt == null || passwordTxt == '') {
            passwordTxt = $('#passwordOld').val();
        }
        $.ajax({
            url: APP_URL,
            method: "POST",
            dataType: 'JSON',
            data: {
                nama_user: nama_userTxt,
                username: usernameTxt,
                level: levelTxt,
                password: passwordTxt
            },
            beforeSend: function() {
                $('#tombol-simpan').prop('disabled', true);
                $('#tombol-simpan').text('Loading...');

            },
            success: function(data) {
                $('#tombol-simpan').prop('disabled', false);
                $('#tombol-simpan').text('Save');

                if (data.status == 200) {
                    // reset form
                    clearForm();

                    swal({
                        title: "Berhasil " + msgSave + " !!!",
                        text: "Data Berhasil di " + msgSave + " !!!",
                        icon: "success",
                        button: false,
                        timer: 3000
                    });
                    loadTable();
                    $('.modal').modal('hide');
                    $('#pesanForm').html(pesan);


                } else {

                    if (data.data.nama_user != undefined) {
                        pesan = data.data.nama_user;
                        $("#nama_user").focus();
                    } else if (data.data.username != undefined) {
                        pesan = data.data.username;
                        $("#username").focus();

                    } else if (data.data.password != undefined) {
                        pesan = data.data.password;
                        $("#password").focus();

                    } else if (data.data.level != undefined) {
                        pesan = data.data.level;
                        $("#level").focus();

                    }
                    $('#alert').css('display', 'block');
                    $('#pesanForm').html(pesan);
                    return true;
                }


            }
        });
    });

    function clearForm() {
        $('#nama_user').val("");
        $('#username').val("");
        $('#level').val("");
        $('#password').val("");
    }

    $('.data').DataTable();
</script>
<?= $this->endSection() ?>