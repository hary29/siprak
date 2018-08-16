 <?php $level= $this->session->userdata('level'); 
if($level==1){?>

        <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a class="has-arrow  " href="<?php echo base_url() ?>back/home_back" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-primary pull-right"></span></span></a>
                             <!-- <ul aria-expanded="false" class="collapse"> -->
                           <!--  <ul aria-expanded="false" class="collapse">
                               <li><a href="index.html">Ecommerce </a></li>
                               <li><a href="index1.html">Analytics </a></li>
                           </ul> -->
                        </li>
                        <li class="nav-label">Apps</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">user</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url() ?>back/user"><i class="ti-user"></i> My Profile</a></li>
                          <!--   <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li> -->
                            <li><a href="<?php echo base_url() ?>back/user/edit"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="<?php echo base_url() ?>front/Log/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                         <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-comments-smiley"></i><span class="hide-menu">Registrasi</span></a>
                            <ul aria-expanded="false" class="collapse">
                                 <li> <a href="<?php echo base_url() ?>back/register/register_user">Register User</a> </li>
                            <li> <a href="<?php echo base_url() ?>back/register">Register Sapi</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Pemeriksaan</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/pemeriksaan">pemeriksaan sapi</a> </li>
                            </ul>
                        </li>
                        <li class="nav-label">Features</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-suitcase"></i><span class="hide-menu">Metode<span class="label label-rouded label-warning pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/bayes">Batasan bayes</a> </li>
                            </ul>
                        </li>
						<li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">User <span class="label label-rouded label-danger pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                            <li> <a href="<?php echo base_url() ?>back/user/semua_user">Semua user</a> </li>
                            <li> <a href="<?php echo base_url() ?>back/register/register_user">Tambah user</a> </li>
                            <!-- <li> <a href="edit-doctor.html">Edit user</a> </li> -->
                            <li> <a href="<?php echo base_url() ?>back/user">User Profile</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">Sapi<span class="label label-rouded label-info pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/sapi">Semua Sapi</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-pulse p-r-10"></i><span class="hide-menu">Penyakit<span class="label label-rouded label-success pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/penyakit">Semua Penyakit</a> </li>
                                <li> <a href="<?php echo base_url() ?>back/penyakit/tambah">Tambah Penyakit</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="icon-chart p-r-10"></i><span class="hide-menu">Gejala<span class="label label-rouded label-danger pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/gejala">semua Gejala</a></li>
                                <li> <a href="<?php echo base_url() ?>back/gejala/tambah">Tambah Gejala</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-columns"></i><span class="hide-menu">Bobot Gejala<span class="label label-rouded label-info pull-right"></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/bobot">Semua Bobot</a></li>
                                <li> <a href="<?php echo base_url() ?>back/bobot/tambah">Tambah Bobot</a></li>
                            </ul>
                        </li>
                        <li class="nav-label">Hasil</li>
                        <!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Pages <span class="label label-rouded label-success pull-right">8</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                        
                                <li><a href="#" class="has-arrow">Authentication <span class="label label-rounded label-success">6</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="page-login.html">Login</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-invoice.html">Invoice</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="has-arrow">Error Pages</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="page-error-400.html">400</a></li>
                                        <li><a href="page-error-403.html">403</a></li>
                                        <li><a href="page-error-404.html">404</a></li>
                                        <li><a href="page-error-500.html">500</a></li>
                                        <li><a href="page-error-503.html">503</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Hasil Periksa</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/pemeriksaan/view_hasil">Hasil periksa</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="<?php echo base_url() ?>front/Log/logout" class="fa fa-power-off" aria-expanded="false"><i class="fa fa-power-off"></i><span class="hide-menu">logout<span class="label label-rouded label-danger pull-right"></span></span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div>
        <!-- End Left Sidebar  -->
        <?php } 
        else { ?>
                <!-- Left Sidebar  -->
        <div class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a class="has-arrow  " href="<?php echo base_url() ?>back/home_back" aria-expanded="false"><i class="fa fa-tachometer"></i><span class="hide-menu">Dashboard <span class="label label-rouded label-primary pull-right"></span></span></a> <!-- <ul aria-expanded="false" class="collapse"> -->
                           <!--  <ul aria-expanded="false" class="collapse">
                               <li><a href="index.html">Ecommerce </a></li>
                               <li><a href="index1.html">Analytics </a></li>
                           </ul> -->
                        </li>
                        <li class="nav-label">Apps</li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">user</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url() ?>back/user"><i class="ti-user"></i> My Profile</a></li>
                          <!--   <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li> -->
                            <li><a href="<?php echo base_url() ?>back/user/edit"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="<?php echo base_url() ?>front/Log/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </li>
                         <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-comments-smiley"></i><span class="hide-menu">Registrasi</span></a>
                            <ul aria-expanded="false" class="collapse">
                            <li> <a href="<?php echo base_url() ?>back/register">Register Sapi</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-bar-chart"></i><span class="hide-menu">Pemeriksaan</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/pemeriksaan">pemeriksaan sapi</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-user"></i><span class="hide-menu">User <span class="label label-rouded label-danger pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                            <!-- <li> <a href="edit-doctor.html">Edit user</a> </li> -->
                            <li> <a href="<?php echo base_url() ?>back/user">User Profile</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-wpforms"></i><span class="hide-menu">Sapi<span class="label label-rouded label-info pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/sapi/sapi_user">Semua Sapi</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="ti-pulse p-r-10"></i><span class="hide-menu">Penyakit<span class="label label-rouded label-success pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/penyakit">Semua Penyakit</a> </li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="icon-chart p-r-10"></i><span class="hide-menu">Gejala<span class="label label-rouded label-danger pull-right"></span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/gejala">semua Gejala</a></li>
                            </ul>
                        </li>
                        <li class="nav-label">Hasil</li>
                        <!-- <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-book"></i><span class="hide-menu">Pages <span class="label label-rouded label-success pull-right">8</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                        
                                <li><a href="#" class="has-arrow">Authentication <span class="label label-rounded label-success">6</span></a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="page-login.html">Login</a></li>
                                        <li><a href="page-register.html">Register</a></li>
                                        <li><a href="page-invoice.html">Invoice</a></li>
                                    </ul>
                                </li>
                                <li><a href="#" class="has-arrow">Error Pages</a>
                                    <ul aria-expanded="false" class="collapse">
                                        <li><a href="page-error-400.html">400</a></li>
                                        <li><a href="page-error-403.html">403</a></li>
                                        <li><a href="page-error-404.html">404</a></li>
                                        <li><a href="page-error-500.html">500</a></li>
                                        <li><a href="page-error-503.html">503</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li> -->
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-map-marker"></i><span class="hide-menu">Hasil Periksa</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li> <a href="<?php echo base_url() ?>back/pemeriksaan/view_hasil_user">Hasil periksa</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="<?php echo base_url() ?>front/Log/logout" class="fa fa-power-off" aria-expanded="false"><i class="fa fa-power-off"></i><span class="hide-menu">logout<span class="label label-rouded label-danger pull-right"></span></span></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </div></div></div>
         <?php }  ?>