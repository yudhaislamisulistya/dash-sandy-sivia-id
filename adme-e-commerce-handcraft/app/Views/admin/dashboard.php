<?= $this->extend('layouts/page-layout') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="page-wrapper">
	<div class="container-fluid pt-25">

		<!-- Row -->
		<div class="row">
		<div class="col-lg-8 col-md-6 col-xs-12">
				<div class="panel panel-default card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">List Transaksi</h6>
						</div>
						<div class="pull-right">
							<a href="<?= route_to('merchant_transaction_index') ?>" class="pull-left btn btn-primary btn-xs mr-15">view all</a>
							<a href="#" class="pull-left inline-block refresh mr-15">
								<i class="zmdi zmdi-replay"></i>
							</a>
							<a href="#" class="pull-left inline-block full-screen mr-15">
								<i class="zmdi zmdi-fullscreen"></i>
							</a>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body row pa-0">
							<div class="table-wrap">
								<div class="table-responsive">
									<table id="datable_2" class="table table-hover display  pb-30">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Transaction ID</th>
                                                <th>Jenis Pembayaran</th>
                                                <th>Item</th>
                                                <th>Total</th>
                                                <th>Status</th>
                                                <th>Tanggal Transaksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach (get_transaction_5() as $key => $value) { ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
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
			<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
				<div class="panel panel-default card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Top 5 Produk</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body row">
							<div class="col-sm-6 pa-0">
								<canvas id="top_5_product" height="164"></canvas>
							</div>
							<div class="col-sm-6 pr-0 pt-25">
								<div class="label-chatrs">
									<?php for ($i=0; $i < count(get_top_5_product()); $i++) { 
									
										$warna = "";
										if($i == 0){
											$warna = "bg-yellow";
										}else if($i == 1){
											$warna = "bg-green";
										}else if($i == 2){
											$warna = "bg-blue";
										}else if($i == 3){
											$warna = "bg-red";
										}else if($i == 4){
											$warna = "bg-pink";
										}
									
									?>

									<div class="mb-5">
										<span class="clabels inline-block <?= $warna ?> mr-5"></span>
										<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><?= get_top_5_product()[$i]->nama_produk ?></span>
									</div>
										
									<?php } ?>

								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default card-view sm-data-box-3">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Rating Status Transaksi</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body">
							<div class="col-sm-6 pa-0">
								<span id="rating_status_transaksi" class="easypiechart" data-percent="<?= count(get_transaction_status('settlement')) / count(get_transaction_status('')) * 100 ?>">
									<span class="percent block txt-dark weight-500"></span>
								</span>
							</div>
							<div class="col-sm-6 pr-0">
								<ul class="flex-stat mb-15">
									<li class="text-left block no-float full-width mb-15">
										<span class="block text-success">Berhasil</span>
										<span class="block txt-dark weight-500  font-18">
											<span
												class="counter-anim"><?= count(get_transaction_status('settlement')) / count(get_transaction_status('')) * 100 ?></span>%</span>
											</span>
										<div class="clearfix"></div>
									</li>
									<li class="text-left block no-float full-width mb-15">
										<span class="block text-warning">Pending</span>
										<span class="block txt-dark weight-500  font-18">
											<span
												class="counter-anim"><?= count(get_transaction_status('pending')) / count(get_transaction_status('')) * 100 ?></span>%</span>
											</span>
										<div class="clearfix"></div>
									</li>
									<?php 
										$sub_total = 0;
										foreach (get_transaction_status('settlement') as $key => $value) {
											$sub_total += $value->gross_amount;
										}
									
									?>
									<li class="text-left block no-float full-width">
										<span class="block text-secondary">Pendapatan</span>
										<span class="block txt-dark weight-500  font-18">
											<span>Rp. </span><span class="counter-anim"><?= format_rupiah($sub_total) ?></span>
										<div class="clearfix"></div>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Row -->

		<!-- Row -->
		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view panel-refresh">
					<div class="refresh-container">
						<div class="la-anim-1"></div>
					</div>
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Pendapatan Berdasarkan Kategori</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body row">
							<div class="col-sm-6 pa-0">
								<canvas id="pendapatan_berdasarkan_kategori" height="185"></canvas>
							</div>
							<div class="col-sm-6 pr-0 pt-30">
								<div class="label-chatrs">
								<?php for ($i=0; $i < count(get_income_by_category()); $i++) { 
									
									$warna = "";
									if($i == 0){
										$warna = "bg-yellow";
									}else if($i == 1){
										$warna = "bg-green";
									}else if($i == 2){
										$warna = "bg-blue";
									}else if($i == 3){
										$warna = "bg-red";
									}else if($i == 4){
										$warna = "bg-pink";
									}
								
								?>

								<div class="mb-5">
									<span class="clabels inline-block <?= $warna ?> mr-5"></span>
									<span class="clabels-text font-12 inline-block txt-dark capitalize-font"><?= get_income_by_category()[$i]->nama_jenis_produk ?></span>
								</div>
									
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-default card-view pt-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-white">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
											<span class="txt-dark block counter"><span
													class="counter-anim"><?= count(get_user_by_status(1)) ?></span></span>
											<span class="block"><span
													class="weight-500 uppercase-font txt-grey font-13">Pengguna</span><i
													class="zmdi txt-danger font-21 ml-5 vertical-align-middle"></i></span>
										</div>
										<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
											<div id="sparkline_4"
												style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default card-view pt-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-white">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
											<span class="txt-dark block counter"><span>Rp. </span><span class="counter-anim"><?= format_rupiah($sub_total) ?></span>
											<span class="block"><span
													class="weight-500 uppercase-font txt-grey font-13">Pendapatan</span><i
													class="zmdi txt-success font-21 ml-5 vertical-align-middle"></i></span>
										</div>
										<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
											<div id="sparkline_5"
												style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="panel panel-default card-view pt-0">
					<div class="panel-wrapper collapse in">
						<div class="panel-body pa-0">
							<div class="sm-data-box bg-white">
								<div class="container-fluid">
									<div class="row">
										<div class="col-xs-6 text-left pl-0 pr-0 data-wrap-left">
											<span class="txt-dark block counter"><span
													class="counter-anim"><?= count(get_transaction_status('')) ?></span></span>
											<span class="block"><span
													class="weight-500 uppercase-font txt-grey font-13">Transaksi</span><i
													class="zmdi txt-danger font-21 ml-5 vertical-align-middle"></i></span>
										</div>
										<div class="col-xs-6 text-left  pl-0 pr-0 pt-25 data-wrap-right">
											<div id="sparkline_6"
												style="width: 100px; overflow: hidden; margin: 0px auto;"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
				<div class="panel panel-default border-panel  review-box card-view">
					<div class="panel-heading">
						<div class="pull-left">
							<h6 class="panel-title txt-dark">Review Terbaru</h6>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="panel-wrapper collapse in">
						<div class="panel-body row pa-0">
							<div class="streamline">
								<?php foreach (get_feedbacks() as $key => $value) { ?>
									<div class="sl-item">
										<div class="sl-content">
											<div class="per-rating inline-block pull-left">
												<?= $value->bintang ?><a href="javascript:void(0);" class="zmdi zmdi-star"></a>
												<span class="inline-block">for <?= get_product($value->id_produk)['nama_produk'] ?></span>
											</div>
											<a href="javascript:void(0);" class=" pull-right txt-grey"><i
													class="zmdi zmdi-mail-reply"></i></a>
											<div class="clearfix"></div>
											<div class="inline-block pull-left">
												<span class="reviewer font-13">
													<span>Dari</span>
													<a href="javascript:void(0)"
														class="inline-block capitalize-font  mb-5"><?= get_user($value->id_user)['nama_lengkap'] ?></a>
												</span>
											</div>
											<div class="clearfix"></div>
											<p class="mt-5"><?= $value->isi ?></p>
										</div>
									</div>
									<hr class="light-grey-hr" />
								<?php } ?>
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

<?= $this->section('javascript') ?>
<script>
	$(document).ready(function () {
		if( $('#top_5_product').length > 0 ){
		var ctx7 = document.getElementById("top_5_product").getContext("2d");
		var data7 = {
			labels: [
			<?php
				foreach (get_top_5_product() as $key => $value) {
					echo $value->id_produk . ',';
				}	
			?>
		],
		datasets: [
			{
				data: [
					<?php
						foreach (get_top_5_product() as $key => $value) {
							echo $value->total . ',';
						}	
					?>
				],
				backgroundColor: [
					"rgba(240,197,65,.6)",
					"rgba(46,205,153,.6)",
					"rgba(78,157,230,.6)",
					"rgba(237,111,86,.6)",
					"rgba(241,161,199,.6)",
				],
				hoverBackgroundColor: [
					"rgba(240,197,65,.6)",
					"rgba(46,205,153,.6)",
					"rgba(78,157,230,.6)",
					"rgba(237,111,86,.6)",
					"rgba(241,161,199,.6)",
				]
			}]
		};
		
		var doughnutChart = new Chart(ctx7, {
			type: 'doughnut',
			data: data7,
			options: {
				animation: {
					duration:	3000
				},
				elements: {
					arc: {
						borderWidth: 0
					}
				},
				responsive: true,
				maintainAspectRatio:false,
				percentageInnerCutout: 50,
				legend: {
					display:false
				},
				tooltips: {
					backgroundColor:'rgba(33,33,33,1)',
					cornerRadius:0,
					footerFontFamily:"'Poppins'"
				},
				cutoutPercentage: 70,
				segmentShowStroke: false
			}
		});
	}

	if( $('#pendapatan_berdasarkan_kategori').length > 0 ){
		var ctx7 = document.getElementById("pendapatan_berdasarkan_kategori").getContext("2d");
		var data7 = {
			labels: [
			<?php
				foreach (get_income_by_category() as $key => $value) {
					echo '"' . $value->nama_jenis_produk . '"' . ',';
				}
			?>
		],
		datasets: [
			{
				data: [
					<?php
						foreach (get_purchases() as $key => $value_satu) {
							$total = 0;
							foreach (get_purchases_by_id($value_satu->id_produk) as $key => $value_dua) {
								$total  = $total + $value_dua->jumlah_beli;
							}
							echo $total . ',';
						}	

					?>
				],
				backgroundColor: [
					"rgba(240,197,65,.6)",
					"rgba(46,205,153,.6)",
					"rgba(78,157,230,.6)",
					"rgba(237,111,86,.6)",
				],
				hoverBackgroundColor: [
					"rgba(240,197,65,.6)",
					"rgba(46,205,153,.6)",
					"rgba(78,157,230,.6)",
					"rgba(237,111,86,.6)",
				]
			}]
		};
		
		var pieChart  = new Chart(ctx7,{
			type: 'pie',
			data: data7,
			options: {
				animation: {
					duration:	3000
				},
				responsive: true,
				maintainAspectRatio:false,
				legend: {
					display:false
				},
				elements: {
					arc: {
						borderWidth: 0
					}
				},
				tooltips: {
					backgroundColor:'rgba(33,33,33,1)',
					cornerRadius:0,
					footerFontFamily:"'Poppins'"
				}
			}
		});
	}

	if( $('#rating_status_transaksi').length > 0 ){
		$('#rating_status_transaksi').easyPieChart({
			barColor : 'rgba(46,205,153,.6)',
			lineWidth: 20,
			animate: 3000,
			size:	165,
			lineCap: 'square',
			trackColor: 'rgba(33,33,33,0.1)',
			scaleColor: false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
	}
	});
</script>
<?= $this->endSection() ?>