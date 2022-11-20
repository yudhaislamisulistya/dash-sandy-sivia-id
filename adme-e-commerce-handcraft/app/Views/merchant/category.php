<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Data Jenis Produk atau Kategori</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#"><span>table</span></a></li>
                    <li class="active"><span>Category</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <?php if(isset($validation)) : ?>
                <div class=col-12>
                    <div class="alert alert-danger alert-dismissable alert-style-1">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="zmdi zmdi-block"></i><?= $validation->listErrors() ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php if(session()->getFlashData('status') == "success"){ ?>
                <div class="alert alert-success alert-dismissable alert-style-1">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="zmdi zmdi-check"></i>Proses Berhasil
                </div>
                <?php }else if(session()->getFlashData('status') == "failed"){ ?>
                <div class="alert alert-info alert-dismissable alert-style-1">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <i class="zmdi zmdi-info-outline"></i>Proses Gagal
                </div>
                <?php }?>
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Jenis Produk / Kategori</h6>
                        </div>
                        <div class="clearfix"></div>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addModal">Add
                            New</button>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datable_2" class="table table-hover display  pb-30">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama</th>
                                                <th>Tanggal Buat</th>
                                                <th>Tanggal Ubah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $value->kode_jenis_produk ?></td>
                                                <td><?= $value->nama_jenis_produk ?></td>
                                                <td><?= $value->created_at ?></td>
                                                <td><?= $value->updated_at ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_jenis_produk;?>"
                                                        data-kode-jenis-produk="<?= $value->kode_jenis_produk;?>"
                                                        data-nama-jenis-produk="<?= $value->nama_jenis_produk;?>"">Edit</a>
                                                        <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_jenis_produk;?>">Delete</a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>

    <!-- Footer -->
    <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
            <div class="col-sm-12">
                <p>2022 &copy; Chrisandy Saputele</p>
            </div>
        </div>
    </footer>
    <!-- /Footer -->

 <!-- Modal Add Category-->
    <form action="<?= route_to('merchant_category_save') ?>" method="post">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jenis Produk atau Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode Produk</label>
                            <input type="text" class="form-control" name="kode_jenis_produk"
                                placeholder="Kode Jenis Produk">
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_jenis_produk"
                                placeholder="Nama Jenis Produk">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Add Category-->

    <!-- Modal Edit Product-->
    <form action="<?= route_to('merchant_category_update') ?>" method="post">
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Jenis Produk / Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Kode</label>
                            <input type="text" class="form-control kode_jenis_produk" name="kode_jenis_produk"
                                placeholder="Product Name">
                        </div>

                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control nama_jenis_produk" name="nama_jenis_produk"
                                placeholder="Product Price">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jenis_produk" class="id_jenis_produk">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Edit Product-->

    <!-- Modal Delete Category-->
    <form action="<?= route_to('merchant_category_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Jenis Produk/Kategori</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Jenis Produk atau Kategori Ini?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jenis_produk" class="jenisProdukID">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Category-->

</div>
<!-- /Main Content -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click',function(){
            const id = $(this).data('id');
            const kode = $(this).data('kode-jenis-produk');
            const nama = $(this).data('nama-jenis-produk');
            $('.id_jenis_produk').val(id);
            $('.kode_jenis_produk').val(kode);
            $('.nama_jenis_produk').val(nama);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log(id);
            $('.jenisProdukID').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>