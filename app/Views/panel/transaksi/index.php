<?= $this->extend('panel/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-3">
            <h2>Transaks</h2>
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
                <th width="15%">Kode</th>
                <th width="25%">Nama Hadiah</th>
                <th width="15%">Poin</th>
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
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Hadiah</h5>
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
                        <label>Kode Hadiah</label>
                        <input type="text" class="form-control" id="kode_hadiah" name="kode_hadiah" value="<?php echo $kodeHadiah; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Hadiah</label>
                        <input type="text" class="form-control" id="nama_hadiah" name="nama_hadiah" placeholder="Nama Hadiah">
                    </div>
                    <div class="form-group">
                        <label>Poin</label>
                        <input type="text" class="form-control" id="poin" name="poin" placeholder="Hanya Angka: 5">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Hadiah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4 id="responseDelete">Are you sure want to delete this Data ?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userId" class="hadiahID">
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

<script src="<?php echo base_url() ?>/vendors/bootstrap-sweetalert/sweetalert.min2.js"></script>

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
            const kode_hadiah = $(this).data('kode_hadiah');
            const nama_hadiah = $(this).data('nama_hadiah');
            const poin = $(this).data('poin');
            // console.log(nama);
            // Set data to Form Edit
            $('#kode_hadiah').val(kode_hadiah);
            $('#poin').val(poin);
            $('#nama_hadiah').val(nama_hadiah);

            // Call Modal Edit
            $('#addModal').modal('show');
        });
    });

    // get Delete Product
    $(document).on("click", ".btn-delete", function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.hadiahID').val(id);
        // Call Modal Edit
        $('#deleteModal').modal('show');
    });

    // delete action
    $("#formDeleteBtn").on('click', function(event) {

        id = $('.hadiahID').val();

        $.ajax({
            url: "<?php echo site_url("rest/hadiah/delete"); ?>/" + id,
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
            url: "<?php echo site_url("rest/hadiah/data"); ?>",
            method: "GET",
            beforeSend: function() {
                $('#response').html(loadResponse);
            },
            success: function(data) {
                var row = '<tr>';
                // console.log(data.data[0]);
                $.each(data.data, function(index) {
                    no = index + 1;

                    kode_hadiah = data.data[index].kode_hadiah;
                    nama_hadiah = data.data[index].nama_hadiah;
                    poin = data.data[index].poin;

                    row += '<tr><td>' + no + '</td><td>' + kode_hadiah + '</td><td>' + nama_hadiah + '</td><td>' + poin + '</td><td><a href="#" title="Edit Data" class="btn btn-warning btn-sm btn-edit"  data-kode_hadiah="' + kode_hadiah + '" data-nama_hadiah="' + nama_hadiah + '"  data-poin="' + poin + '"  ><i class="fa  fa-pencil-square-o"></i> </a></td><td><a title="Hapus Data" class="btn btn-danger btn-sm btn-delete" data-id ="' + kode_hadiah + '" href="#"><i class="fa  fa-trash"></i> </a></td></tr>';
                });
                setTimeout(function() {
                    $('#response').html(row + '</tr>');
                }, 1500);

            }
        });


    }

    $("#tombol-simpan").click(function(event) {

        var method = $('#method').val();
        var kode_hadiahTxt = $('#kode_hadiah').val();
        var nama_hadiahTxt = $('#nama_hadiah').val();
        var poinTxt = $('#poin').val();

        msgSave = '';
        if (method == "POST") {
            msgSave = "Simpan";
            APP_URL = "<?php echo site_url("rest/hadiah/create"); ?>";
        } else {
            msgSave = "Ubah";
            APP_URL = "<?php echo site_url("rest/hadiah/update"); ?>";
        }


        $.ajax({
            url: APP_URL,
            method: "POST",
            dataType: 'JSON',
            data: {
                kode_hadiah: kode_hadiahTxt,
                nama_hadiah: nama_hadiahTxt,
                poin: poinTxt
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


                } else {

                    if (data.data.nama_hadiah != undefined) {
                        pesan = data.data.nama_hadiah;
                        $("#nama_hadiah").focus();
                    } else if (data.data.poin != undefined) {
                        pesan = data.data.poin;
                        $("#poin").focus();

                    }
                    $('#alert').css('display', 'block');
                    $('#pesanForm').html(pesan);
                    return true;
                }


            }
        });
    });

    function clearForm() {
        $('#nama_hadiah').val("");
        $('#stok_hadiah').val("");
        $('#poin').val("");
    }
</script>
<?= $this->endSection() ?>