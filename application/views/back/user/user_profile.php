<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">User Profile</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> <a href="<?php echo base_url() ?>back/user" class="btn btn-danger pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Refresh</a>
                        <ol class="breadcrumb">
                            <li><a href="<?php echo base_url() ?>front/Log/logout">Hospital</a></li>
                            <li class="active">User Profile</li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                <!-- .row -->
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="white-box">
                            <div class="user-bg" align="center"> <img width="20%"  alt="user" src="<?php echo base_url() ?>asset/back/plugins/images/users/user.png"> </div>
                            <div class="user-btm-box">
                                <!-- .row -->
                                 <?php 
                                    foreach($data_user as $list) { ?>
                                     <label for="id_gejala" class="control-group"></label>
                                 <div class="control-group">
                                 <input type="hidden" name="id_user" class="form-control" value="<?php echo $list['id_user']; ?>" />
                                </div>
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Nama</strong>
                                        <p><?php echo $list['nama']; ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Jenis Kelamin</strong>
                                        <p><?php $list['jenis_kelamin'];
                                        if ($list['jenis_kelamin']=="L") {
                                            echo "Laki-Laki";
                                         }
                                         else {
                                             echo "Perempuan";
                                         } ?></p>
                                    </div>
                                    
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                <div class="row text-center m-t-10">
                                    <div class="col-md-6 b-r"><strong>Username</strong>
                                        <p><?php echo $list['username']; ?></p>
                                    </div>
                                    <div class="col-md-6"><strong>Password</strong>
                                        <p><?php echo $list['password']; ?></p>
                                    </div>
                                </div>
                                <!-- /.row -->
                                <hr>
                                <!-- .row -->
                                 <div class="row text-center m-t-10">
                                    
                                </div>
                
                                <hr>
                                <!-- /.row -->
                                <div class="col-md-4 col-sm-4 text-center">
                                     <a href="<?php echo base_url() ?>back/user/edit/<?php echo $list['id_user'] ?>" class="btn btn-success"> Edit User Profile </a> </div>
                            </div> <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
