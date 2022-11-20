<?php if(session()->get('level') == 3) { ?>
    <div class="wrapper theme-3-active pimary-color-green">
        <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="mobile-only-brand pull-left">
                <div class="nav-header pull-left">
                    <div class="logo-wrap">
                        <a href="index.html">
                            <span class="brand-text">CreDifyShop</span>
                            <span style="font-size: 12px;" class="brand-text">Admin</span>
                        </a>
                    </div>
                </div>
                <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left"
                    href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
                <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
                    href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i
                        class="zmdi zmdi-more"></i></a>
            </div>
            <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                <ul class="nav navbar-right top-nav pull-right">
                    <li class="dropdown alert-drp">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                class="zmdi zmdi-notifications top-nav-icon"></i><span
                                class="top-nav-icon-badge"><?= count(get_notifications(5)) ?></span></a>
                        <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn"
                            data-dropdown-out="bounceOut">
                            <li>
                                <div class="notification-box-head-wrap">
                                    <span class="notification-box-head pull-left inline-block">Notifications</span>
                                    <div class="clearfix"></div>
                                    <hr class="light-grey-hr ma-0" />
                                </div>
                            </li>
                            <li>
                                <div class="streamline message-nicescroll-bar">
                                        <?php foreach (get_notifications() as $key => $value) { 
                                        
                                            $icon = '';
                                            $status = '';
                                            $warna = '';
                                            if($value->transaction_status == "pending"){
                                                $status = "<span class='badge badge-warning'>Pending (Menunggu Pembayaran)</span>";
                                                $icon = 'spinner';
                                                $warna = 'warning';
                                            }else if($value->transaction_status == "settlement"){
                                                $status = "<span class='badge badge-success'>Success (Berhasil)</span>";
                                                $icon = 'check';
                                                $warna = 'success';
                                            }else if($value->transaction_status == "cancel"){
                                                $status = "<span class='badge badge-danger'>Cancel (Pembayaran Dibatalkan)</span>";
                                                $icon = 'close';
                                                $warna = 'danger';
                                            }else if($value->transaction_status == "expire"){
                                                $status = "<span class='badge badge-warning'>Expired (Waktu Pembayaran Berakhir)</span>";
                                                $icon = 'time-countdown';
                                                $warna = 'secondary';
                                            }else{
                                                $status = "<span>Alasan lain...</span>";
                                            }

                                        ?>
                                            <div class="sl-item">
                                                <a href="javascript:void(0)">
                                                    <div class="icon bg-<?= $warna ?>">
                                                        <i class="zmdi zmdi-<?= $icon ?>"></i>
                                                    </div>
                                                    <div class="sl-content">
                                                        <span
                                                            class="inline-block capitalize-font  pull-left truncate head-notifications">Transaction ID : <?= $value->transaction_id ?></span>
                                                        <span
                                                            class="inline-block font-11  pull-right notifications-time"><?= substr($value->transaction_time, 10) ?></span>
                                                        <div class="clearfix"></div>
                                                        <p class="truncate"><?= get_user($value->id_user)['nama_lengkap'] ?> Telah berbelanja sebesar (Rp. <?= format_rupiah($value->gross_amount) ?>)</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <hr class="light-grey-hr ma-0" />
                                        <?php } ?>
                                    </div>
                                </li>
                            <li>
                                <div class="notification-box-bottom-wrap">
                                    <hr class="light-grey-hr ma-0" />
                                    <a class="block text-center read-all" href="<?= route_to('merchant_transaction_index') ?>">Baca Semua</a>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li class="navigation-header">
                    <span>Main</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
                <li>
                    <a href="<?= route_to('admin_dashboard') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span
                                class="right-nav-text">Dashboard</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>       
                <li>
                    <a href="<?= route_to('admin_admin_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-account-box-phone mr-20"></i><span
                            class="right-nav-text">Admin</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('admin_merchant_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-money-box mr-20"></i><span
                                class="right-nav-text">Merchant</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('admin_user_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-account mr-20"></i><span
                                class="right-nav-text">Pengguna</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <hr class="light-grey-hr mb-10" />
                </li>
                <li>
                    <a href="<?= route_to('logout') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-close mr-20"></i><span
                                class="right-nav-text">Logout</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /Left Sidebar Menu -->




        <!-- Right Sidebar Backdrop -->
        <div class="right-sidebar-backdrop"></div>
        <!-- /Right Sidebar Backdrop -->

        <?= $this->renderSection('content') ?>

    </div>
<?php }else if(session()->get('level') == 2){ ?>
    <div class="wrapper theme-3-active pimary-color-green">
        <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="mobile-only-brand pull-left">
                <div class="nav-header pull-left">
                    <div class="logo-wrap">
                        <a href="index.html">
                            <span class="brand-text">CreDifyShop</span>
                            <span style="font-size: 12px;" class="brand-text">Merchant</span>
                        </a>
                    </div>
                </div>
                <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left"
                    href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
                <a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view"
                    href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
                <a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i
                        class="zmdi zmdi-more"></i></a>
            </div>
            <div id="mobile_only_nav" class="mobile-only-nav pull-right">
                <ul class="nav navbar-right top-nav pull-right">
                    <li class="dropdown alert-drp">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                                class="zmdi zmdi-notifications top-nav-icon"></i><span
                                class="top-nav-icon-badge"><?= count(get_notifications(5)) ?></span></a>
                        <ul class="dropdown-menu alert-dropdown" data-dropdown-in="bounceIn"
                            data-dropdown-out="bounceOut">
                            <li>
                                <div class="notification-box-head-wrap">
                                    <span class="notification-box-head pull-left inline-block">Notifications</span>
                                    <div class="clearfix"></div>
                                    <hr class="light-grey-hr ma-0" />
                                </div>
                            </li>
                            <li>
                                <div class="streamline message-nicescroll-bar">
                                        <?php foreach (get_notifications() as $key => $value) { 
                                        
                                            $icon = '';
                                            $status = '';
                                            $warna = '';
                                            if($value->transaction_status == "pending"){
                                                $status = "<span class='badge badge-warning'>Pending (Menunggu Pembayaran)</span>";
                                                $icon = 'spinner';
                                                $warna = 'warning';
                                            }else if($value->transaction_status == "settlement"){
                                                $status = "<span class='badge badge-success'>Success (Berhasil)</span>";
                                                $icon = 'check';
                                                $warna = 'success';
                                            }else if($value->transaction_status == "cancel"){
                                                $status = "<span class='badge badge-danger'>Cancel (Pembayaran Dibatalkan)</span>";
                                                $icon = 'close';
                                                $warna = 'danger';
                                            }else if($value->transaction_status == "expire"){
                                                $status = "<span class='badge badge-warning'>Expired (Waktu Pembayaran Berakhir)</span>";
                                                $icon = 'time-countdown';
                                                $warna = 'secondary';
                                            }else{
                                                $status = "<span>Alasan lain...</span>";
                                            }

                                        ?>
                                            <div class="sl-item">
                                                <a href="javascript:void(0)">
                                                    <div class="icon bg-<?= $warna ?>">
                                                        <i class="zmdi zmdi-<?= $icon ?>"></i>
                                                    </div>
                                                    <div class="sl-content">
                                                        <span
                                                            class="inline-block capitalize-font  pull-left truncate head-notifications">Transaction ID : <?= $value->transaction_id ?></span>
                                                        <span
                                                            class="inline-block font-11  pull-right notifications-time"><?= substr($value->transaction_time, 10) ?></span>
                                                        <div class="clearfix"></div>
                                                        <p class="truncate"><?= get_user($value->id_user)['nama_lengkap'] ?> Telah berbelanja sebesar (Rp. <?= format_rupiah($value->gross_amount) ?>)</p>
                                                    </div>
                                                </a>
                                            </div>
                                            <hr class="light-grey-hr ma-0" />
                                        <?php } ?>
                                    </div>
                                </li>
                            <li>
                                <div class="notification-box-bottom-wrap">
                                    <hr class="light-grey-hr ma-0" />
                                    <a class="block text-center read-all" href="<?= route_to('merchant_transaction_index') ?>">Baca Semua</a>
                                    <div class="clearfix"></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li class="navigation-header">
                    <span>Main</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
                <li>
                    <a href="<?= route_to('merchant_dashboard') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span
                                class="right-nav-text">Dashboard</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>       
                <li>
                    <a href="<?= route_to('merchant_product_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-account-box-phone mr-20"></i><span
                            class="right-nav-text">Produk</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('merchant_service_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-fire mr-20"></i><span
                            class="right-nav-text">Jasa</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('merchant_transaction_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-money-box mr-20"></i><span
                                class="right-nav-text">Transaksi/Pemesanan</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('merchant_feedback_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-flag mr-20"></i><span
                                class="right-nav-text">Feedback</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('merchant_category_index') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-archive mr-20"></i><span
                                class="right-nav-text">Kategori</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <hr class="light-grey-hr mb-10" />
                </li>
                <li class="navigation-header">
                    <span>Other</span>
                    <i class="zmdi zmdi-more"></i>
                </li>
                <li>
                    <a href="<?= route_to('merchant_user_list') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-account mr-20"></i><span
                                class="right-nav-text">Pengguna</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
                <li>
                    <a href="<?= route_to('logout') ?>">
                        <div class="pull-left"><i class="zmdi zmdi-close mr-20"></i><span
                                class="right-nav-text">Logout</span></div>
                        <div class="clearfix"></div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- /Left Sidebar Menu -->




        <!-- Right Sidebar Backdrop -->
        <div class="right-sidebar-backdrop"></div>
        <!-- /Right Sidebar Backdrop -->

        <?= $this->renderSection('content') ?>

    </div>
<?php } ?>