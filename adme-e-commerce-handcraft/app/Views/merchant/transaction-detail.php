<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Data table</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#"><span>table</span></a></li>
                    <li class="active"><span>data-table</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Transaksi</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Nama Pembeli</label>
                                <input type="text" class="form-control" value="<?= get_user($transaksi['id_user'])['nama_lengkap'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Transaction ID</label>
                                <input type="text" class="form-control" value="<?= $transaksi['transaction_id'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Order ID</label>
                                <input type="text" class="form-control" value="<?= $transaksi['order_id'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Jumlah Bayar</label>
                                <input type="text" class="form-control" value="Rp. <?= format_rupiah($transaksi['gross_amount'])  ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Jenis Pembayaran</label>
                                <input type="text" class="form-control" value="<?= $transaksi['payment_type'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Waktu Transaksi</label>
                                <input type="text" class="form-control" value="<?= $transaksi['transaction_time'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label class="control-label mb-10 text-left">Status Transaksi</label>
                                <input type="text" class="form-control" value="<?= $transaksi['transaction_status'] ?>" disabled>
                            </div>
                            <?php if($transaksi['payment_type'] == "bank_transfer") {?>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">VA Number</label>
                                    <input type="text" class="form-control" value="<?= $transaksi['va_number'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">Bank</label>
                                    <input type="text" class="form-control" value="<?= $transaksi['bank'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="control-label mb-10 text-left">PDF URL</label>
                                    <input type="text" class="form-control" value="<?= $transaksi['pdf_url'] ?>" disabled>
                                </div>
                            <?php } ?>

                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datable_2" class="table table-hover display  pb-30">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Foto</th>
                                                <th>Jenis Produk</th>
                                                <th>Nama Produk</th>
                                                <th>Jumlah Beli</th>
                                                <th>Harga</th>
                                                <th>Total</th>
                                                <th>Tanggal Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td>
                                                    <img class="img-responsive img-circle" src="<?= base_url('assets/img/produk/') ?>/<?= get_product($value->id_produk)['foto'] ?>" alt="avatar">
                                                </td>
                                                <td><?= get_type_product($value->id_jenis_produk)['nama_jenis_produk'] ?></td>
                                                <td><?= $value->nama_produk ?></td>
                                                <td><?= $value->jumlah_beli ?></td>
                                                <td>Rp. <?= format_rupiah($value->harga) ?></td>
                                                <td>Rp. <?= format_rupiah($value->harga*$value->jumlah_beli) ?></td>
                                                <td><?= $value->created_at ?></td>
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


    <!-- Modal Delete Category-->
    <form action="<?= route_to('merchant_category_delete') ?>" method="post">
        <?= csrf_field() ?>
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Feedback</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4>Apakah Kamu Ingin Menghapus Feedback Ini?</h4>

                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_transaction" class="transactionID">
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

        $('.btn-delete').click(function (e) {
            e.preventDefault();
            const id = $(this).data('id');
            console.log(id);
            $('.transactionID').val(id);
            $('#deleteModal').modal('show');
        });
    });
</script>
<?= $this->endSection() ?>