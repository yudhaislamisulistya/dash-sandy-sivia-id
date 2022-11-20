<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Data Jasa</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#"><span>table</span></a></li>
                    <li class="active"><span>Service</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger" role="alert">
                        <h4>Periksa Masukkan</h4>
                        </hr />
                        <?php echo session()->getFlashdata('error'); ?>
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
                            <h6 class="panel-title txt-dark">Jenis Produk</h6>
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
                                                <th>Foto</th>
                                                <th>Nama Jasa</th>
                                                <th>Deskripsi</th>
                                                <th>Tanggal Buat</th>
                                                <th>Tanggal Ubah</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td>
                                                    <img height="100px" class="img-rounded"
                                                        src="<?= base_url('assets/img/jasa/') ?>/<?= get_service($value->id_jasa)['foto'] ?>"
                                                        alt="avatar">
                                                </td>
                                                </td>
                                                <td><?= $value->nama_jasa ?></td>
                                                <td><?= $value->deskripsi ?></td>
                                                <td><?= $value->created_at ?></td>
                                                <td><?= $value->updated_at ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_jasa;?>"
                                                        data-nama-jasa="<?= $value->nama_jasa;?>"
                                                        data-foto="<?= $value->foto;?>"
                                                        data-deskripsi="<?= $value->deskripsi;?>"">Edit</a>
                                                        <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_jasa;?>">Delete</a>
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

    <!-- Modal Add Service-->
    <form action="<?= route_to('merchant_service_save') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Jasa</label>
                            <input type="text" class="form-control" name="nama_jasa" placeholder="Nama Jasa">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Upload Foto Produk</h6>
                                </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="mt-40">
                                    <input name="file" type="file" id="input-file-now-custom-2" class="dropify" data-height="500" />
                                </div>
                            </div>
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
    <!-- End Modal Add Service-->

    <!-- Modal Update Service-->
    <form action="<?= route_to('merchant_service_update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field()?>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Jasa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama Jasa</label>
                            <input type="text" class="form-control nama_jasa" name="nama_jasa" placeholder="Nama Jasa">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea class="form-control deskripsi" name="deskripsi" placeholder="Deskripsi"></textarea>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Upload Foto Produk</h6>
                                </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="mt-40">
                                    <input name="file" type="file" id="input-file-now-custom-2" class="dropify" data-height="500" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jasa" class="id_jasa">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Update Service-->


    <!-- Modal Delete Service-->
    <form action="<?= route_to('merchant_service_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Produk Ini?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_jasa" class="jasaID">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Delete Service-->

</div>
<!-- /Main Content -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    $(document).ready(function () {
        $('.btn-edit').on('click', function () {
            const id = $(this).data('id');
            const nama_jasa = $(this).data('nama-jasa');
            const foto = $(this).data('foto');
            const deskripsi = $(this).data('deskripsi')
            $('.id_jasa').val(id);
            $('.nama_jasa').val(nama_jasa);
            $('.foto').val(foto);
            $('.deskripsi').val(deskripsi);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log(id);
            $('.jasaID').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>