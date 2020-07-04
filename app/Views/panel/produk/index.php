<?= $this->extend('panel/template') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="row mt-3 mb-3">
        <div class="col-md-3">
            <h2>Produk</h2>
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
                <th width="10%">Kode</th>
                <th width="25%">Nama Produk</th>
                <th width="15%">Harga</th>
                <th width="10%">Stok</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Form Produk</h5>
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
                        <label>Kode Produk</label>
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" value="<?php echo $kode; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Nama Produk">
                    </div>
                    <div class="form-group">
                        <label>Harga</label>
                        <input type="text" class="form-control" id="harga_produk" name="harga_produk" placeholder="Hanya Angka: 10000">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi Produk</label>
                        <textarea name="deskripsi_produk" id="deskripsi_produk" rows="5" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label>Stok</label>
                        <input type="text" class="form-control" id="stok_produk" name="stok_produk" placeholder="Hanya Angka : 1000">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <h4 id="responseDelete">Are you sure want to delete this Data ?</h4>

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="userId" class="produkID">
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
    var loadResponse = '<tr><td colspan="6" class="text-center">Loading Response...<td></tr>';
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
            const kode_produk = $(this).data('kode_produk');
            const nama_produk = $(this).data('nama_produk');
            const deskripsi_produk = $(this).data('deskripsi_produk');
            const harga_produk = $(this).data('harga_produk');
            const stok_produk = $(this).data('stok_produk');
            // console.log(nama);
            // Set data to Form Edit
            $('#kode_produk').val(kode_produk);
            $('#harga_produk').val(harga_produk);
            $('#stok_produk').val(stok_produk);
            $('#deskripsi_produk').val(deskripsi_produk);
            $('#nama_produk').val(nama_produk);

            // Call Modal Edit
            $('#addModal').modal('show');
        });
    });

    // get Delete Product
    $(document).on("click", ".btn-delete", function() {
        // get data from button edit
        const id = $(this).data('id');
        // Set data to Form Edit
        $('.produkID').val(id);
        // Call Modal Edit
        $('#deleteModal').modal('show');
    });

    // delete action
    $("#formDeleteBtn").on('click', function(event) {

        id = $('.produkID').val();

        $.ajax({
            url: "<?php echo site_url("rest/produk/delete"); ?>/" + id,
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
            url: "<?php echo site_url("rest/produk/data"); ?>",
            method: "GET",
            beforeSend: function() {
                $('#response').html(loadResponse);
            },
            success: function(data) {
                var row = '<tr>';
                // console.log(data.data[0]);
                $.each(data.data, function(index) {
                    no = index + 1;

                    kode_produk = data.data[index].kode_produk;
                    nama_produk = data.data[index].nama_produk;
                    deskripsi_produk = data.data[index].deskripsi_produk;
                    harga_produk = data.data[index].harga_produk;
                    stok_produk = data.data[index].stok_produk;

                    row += '<tr><td>' + no + '</td><td>' + kode_produk + '</td><td>' + nama_produk + '</td><td>' + harga_produk + '</td><td>' + stok_produk + '</td><td><a href="#" title="Edit Data" class="btn btn-warning btn-sm btn-edit"  data-kode_produk="' + kode_produk + '" data-nama_produk="' + nama_produk + '" data-deskripsi_produk="' + deskripsi_produk + '" data-harga_produk="' + harga_produk + '" data-stok_produk="' + stok_produk + '" ><i class="fa  fa-pencil-square-o"></i> </a></td><td><a title="Hapus Data" class="btn btn-danger btn-sm btn-delete" data-id ="' + kode_produk + '" href="#"><i class="fa  fa-trash"></i> </a></td></tr>';
                });
                setTimeout(function() {
                    $('#response').html(row + '</tr>');
                }, 1500);

            }
        });


    }

    $("#tombol-simpan").click(function(event) {

        var method = $('#method').val();
        var kode_produkTxt = $('#kode_produk').val();
        var nama_produkTxt = $('#nama_produk').val();
        var harga_produkTxt = $('#harga_produk').val();
        var deskripsi_produkTxt = $('#deskripsi_produk').val();
        var stok_produkTxt = $('#stok_produk').val();

        msgSave = '';
        if (method == "POST") {
            msgSave = "Simpan";
            APP_URL = "<?php echo site_url("rest/produk/create"); ?>";
        } else {
            msgSave = "Ubah";
            APP_URL = "<?php echo site_url("rest/produk/update"); ?>";
        }


        $.ajax({
            url: APP_URL,
            method: "POST",
            dataType: 'JSON',
            data: {
                kode_produk: kode_produkTxt,
                nama_produk: nama_produkTxt,
                harga_produk: harga_produkTxt,
                deskripsi_produk: deskripsi_produkTxt,
                stok_produk: stok_produkTxt,
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

                    if (data.data.nama_produk != undefined) {
                        pesan = data.data.nama_produk;
                        $("#nama_produk").focus();
                    } else if (data.data.harga_produk != undefined) {
                        pesan = data.data.harga_produk;
                        $("#harga_produk").focus();

                    } else if (data.data.deskripsi_produk != undefined) {
                        pesan = data.data.deskripsi_produk;
                        $("#deskripsi_produk").focus();

                    } else if (data.data.stok_produk != undefined) {
                        pesan = data.data.stok_produk;
                        $("#stok_produk").focus();

                    }
                    $('#alert').css('display', 'block');
                    $('#pesanForm').html(pesan);
                    return true;
                }


            }
        });
    });

    function clearForm() {
        $('#nama_produk').val("");
        $('#stok_produk').val("");
        $('#harga_produk').val("");
        $('#deskripsi_produk').val("");
    }
</script>
<?= $this->endSection() ?>