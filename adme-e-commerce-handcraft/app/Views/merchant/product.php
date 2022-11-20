<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Data Produk</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#"><span>table</span></a></li>
                    <li class="active"><span>Product</span></li>
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
                                                <th>Jenis Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Harga</th>
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
                                                        src="<?= base_url('assets/img/produk/') ?>/<?= get_product($value->id_produk)['foto'] ?>"
                                                        alt="avatar">
                                                </td>
                                                <td><?= get_type_product($value->id_jenis_produk)['nama_jenis_produk'] ?>
                                                </td>
                                                <td><?= $value->nama_produk ?></td>
                                                <td>Rp. <?= format_rupiah($value->harga) ?></td>
                                                <td><?= $value->created_at ?></td>
                                                <td><?= $value->updated_at ?></td>
                                                <td>
                                                    <a href="#" class="btn btn-info btn-sm btn-edit"
                                                        data-id="<?= $value->id_produk;?>"
                                                        data-id-jenis-produk="<?= $value->id_jenis_produk;?>"
                                                        data-nama-produk="<?= $value->nama_produk;?>"
                                                        data-jumlah-produk-satuan="<?= $value->jumlah_produk_satuan;?>"
                                                        data-foto="<?= $value->foto;?>"
                                                        data-harga="<?= $value->harga;?>"
                                                        data-deskripsi="<?= $value->deskripsi;?>"">Edit</a>
                                                        <a href=" #" class="btn btn-danger btn-sm btn-delete"
                                                        data-id="<?= $value->id_produk;?>">Delete</a>
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
    <form action="<?= route_to('merchant_product_save') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field()?>
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Janis Produk/Kategori</label>
                            <select name="id_jenis_produk" class="form-control">
                                <?php foreach (get_type_products() as $key => $value) { ?>
                                <option value="<?= $value->id_jenis_produk ?>"><?= $value->nama_jenis_produk ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Produk Satuan</label>
                            <input type="text" class="form-control" name="jumlah_produk_satuan"
                                placeholder="Jumlah Produk Satuan">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control" name="harga" placeholder="Harga">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" placeholder="deskripsi">
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
    <!-- End Modal Add Category-->

    <!-- Modal Update Category-->
    <form action="<?= route_to('merchant_product_update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field()?>
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ubah Produk</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Janis Produk/Kategori</label>
                            <select name="id_jenis_produk" class="form-control id_jenis_produk">
                                <?php foreach (get_type_products() as $key => $value) { ?>
                                <option value="<?= $value->id_jenis_produk ?>"><?= $value->nama_jenis_produk ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" class="form-control nama_produk" name="nama_produk" placeholder="Nama Produk">
                        </div>
                        <div class="form-group">
                            <label>Jumlah Produk Satuan</label>
                            <input type="text" class="form-control jumlah_produk_satuan" name="jumlah_produk_satuan"
                                placeholder="Jumlah Produk Satuan">
                        </div>
                        <div class="form-group">
                            <label>Harga</label>
                            <input type="text" class="form-control harga" name="harga" placeholder="Harga">
                        </div>
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <input type="text" class="form-control deskripsi" name="deskripsi" placeholder="deskripsi">
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
                        <input type="hidden" name="id_produk" class="id_produk">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- End Modal Update Category-->


    <!-- Modal Delete Category-->
    <form action="<?= route_to('merchant_product_delete') ?>" method="post">
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
                        <input type="hidden" name="id_produk" class="produkID">
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
        $('.btn-edit').on('click', function () {
            const id = $(this).data('id');
            const id_jenis_produk = $(this).data('id-jenis-produk');
            const nama_produk = $(this).data('nama-produk');
            const jumlah_produk_satuan = $(this).data('jumlah-produk-satuan');
            const foto = $(this).data('foto');
            const harga = $(this).data('harga')
            const deskripsi = $(this).data('deskripsi')
            $('.id_produk').val(id);
            $('.id_jenis_produk').val(id_jenis_produk);
            $('.nama_produk').val(nama_produk);
            $('.jumlah_produk_satuan').val(jumlah_produk_satuan);
            $('.foto').val(foto);
            $('.harga').val(harga);
            $('.deskripsi').val(deskripsi);
            $('#editModal').modal('show');
        });

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log(id);
            $('.produkID').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>