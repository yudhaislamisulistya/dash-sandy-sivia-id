<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Data Transaksi</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index.html">Dashboard</a></li>
                    <li><a href="#"><span>table</span></a></li>
                    <li class="active"><span>Transaction</span></li>
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
                            <h6 class="panel-title txt-dark">Transaksi</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="datable_2" class="table table-hover display  pb-30">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pengguna</th>
                                                <th>Transaction ID</th>
                                                <th>Jenis Pembayaran</th>
                                                <th>Item</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Tanggal Transaksi</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data as $key => $value) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= get_user($value->id_user)['nama_lengkap'] ?></td>
                                                <td><?= $value->transaction_id ?></td>
                                                <td><?= $value->payment_type ?></td>
                                                <td><?= count(get_purcheses_by_id_transction($value->transaction_id)) ?></td>
                                                <td><?= format_rupiah($value->gross_amount) ?></td>
                                                <td>
                                                    <?php
                                                    
                                                    $status = '';
                                                    if($value->transaction_status == "pending"){
                                                        $status = "<span class='badge badge-warning'>Pending (Menunggu Pembayaran)</span>";
                                                    }else if($value->transaction_status == "settlement"){
                                                        $status = "<span class='badge badge-success'>Success (Berhasil)</span>";
                                                    }else if($value->transaction_status == "cancel"){
                                                        $status = "<span class='badge badge-danger'>Cancel (Pembayaran Dibatalkan)</span>";
                                                    }else if($value->transaction_status == "expire"){
                                                        $status = "<span class='badge badge-warning'>Expired (Waktu Pembayaran Berakhir)</span>";
                                                    }else{
                                                        $status = "<span>Alasan lain...</span>";
                                                    }
                                                    echo $status;

                                                    ?>

                                                </td>
                                                </td>
                                                <td><?= $value->created_at ?></td>
                                                <td>
                                                    <a href="<?= route_to('merchant_transaction_detail', $value->id_transaksi) ?>" class="btn btn-primary btn-sm btn-delete">Detail</a>
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


</div>
<!-- /Main Content -->
<?= $this->endSection() ?>
