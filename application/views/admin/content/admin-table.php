            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="#">Administrators</a>
                            </li>
                        </ul>
                    </div>
                    <h3 class="page-title"> Administrators list
                    </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Administrators list</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <?php if ($this->session->flashdata('msg')): ?>
                                    <div class="alert alert-info"><?php echo $this->session->flashdata('msg'); ?></div>
                                    <?php elseif($this->session->flashdata('warn')): ?>
                                    <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                                    <?php endif ?>
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <button onclick="location.href='<?php echo base_url() ?>admin/administrators/add_new'" id="sample_editable_1_new" class="btn green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Full Name</th>
                                                <th>Username</th>
                                                <th>E-mail</th>
                                                <th>Last updated</th>
                                                <th>Last login</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($users_list): ?>
                                            <?php foreach ($users_list as $us): ?>
                                                <div class="modal fade bs-modal-sm" id="small-<?php echo $us->id_administrator?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Delete user</h4>
                                                            </div>
                                                            <div class="modal-body"> Are you sure to delete this user? </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                <button type="button" onclick="location.href='<?php echo base_url() ?>admin/administrators/delete/<?php echo $us->id_administrator ?>'" class="btn green">Delete</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <div class="modal fade " id="edit-<?php echo $us->id_administrator?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                    <?php 
                                                    $attr = array('class' => "form-horizontal");
                                                    echo form_open('admin/administrators/edit_process', '', $attr); ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Administrator detail</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="portlet light bordered">
                                                                        <div class="portlet-title">
                                                                            <div class="caption">
                                                                                <i class="icon-user font-red-sunglo"></i
                                                                                <span class="caption-subject font-red-sunglo bold uppercase"><?php echo $us->fullname ?></span>
                                                                                <span class="caption-helper"><?php echo $us->username ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="portlet-body form">
                                                                            <!-- BEGIN FORM-->
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                          <div class="form-group">
                                                                                                <label class="col-md-4 control-label">Fullname</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" name="fullname" class="form-control" value="<?php echo $us->fullname ?>" placeholder="">
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                                          <div class="form-group">
                                                                                                <label class="col-md-4 control-label">Username</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" name="username" class="form-control" value="<?php echo $us->username ?>" placeholder="">
                                                                                                    <input type="hidden" name="current_username" value="<?php echo $us->username ?>"></input>
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                                            <div class="form-group">
                                                                                                <label class="col-md-4 control-label">E-mail</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" name="email" class="form-control" value="<?php echo $us->email ?>" placeholder="">
                                                                                                    <input type="hidden" name="current_email" value="<?php echo $us->email ?>"></input>
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                                            <div class="form-group">
                                                                                                <label class="col-md-4 control-label">Change password</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input name="password" type="password" class="form-control" placeholder="Enter new password here">
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                        <div class="col-md-12" style="margin-top: 10px;">
                                                                                            <div class="form-group">
                                                                                                <label class="col-md-4 control-label">Confirm password</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="password" name="passconf" class="form-control" placeholder="Enter again">
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                            <!-- END FORM-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_administrator" value="<?php echo $us->id_administrator ?>"></input>
                                                                <button type="submit" class="btn green">Save changes</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    <?php echo form_close(); ?>
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            <tr>
                                                <td><?php echo $us->id_administrator ?></td>
                                                <td> <a data-toggle="modal" href="#edit-<?php echo $us->id_administrator ?>"><?php echo $us->fullname; ?></a> </td>
                                                <td> <?php echo $us->username ?> </td>
                                                <td> <?php echo $us->email ?> </td>
                                                <td> <?php echo $us->last_updated ?> </td>
                                                <td> <?php echo ($us->last_login == '0000-00-00 00:00:00') ? '-' : $us->last_login ?></td>
                                                <td>
                                                    <a class="edit btn btn-info" data-toggle="modal" href="#edit-<?php echo $us->id_administrator ?>"> Edit </a>
                                                </td>
                                                <td>
                                                    <a class="delete btn btn-danger" data-toggle="modal" href="#small-<?php echo $us->id_administrator ?>"> Delete </a>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
