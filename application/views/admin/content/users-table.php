            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="#">Members</a>
                            </li>
                        </ul>
                    </div>
                    <h3 class="page-title"> Members list
                    </h3>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-settings font-red"></i>
                                        <span class="caption-subject font-red sbold uppercase">Members list</span>
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
                                                    <button onclick="location.href='members/add_new'" id="sample_editable_1_new" class="btn green"> Add New
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
                                                <th>Join date</th>
                                                <th>Last login</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($users_list): ?>
                                            <?php foreach ($users_list as $us): ?>
                                                <div class="modal fade bs-modal-sm" id="small-<?php echo $us->id_member?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Delete user</h4>
                                                            </div>
                                                            <div class="modal-body"> Are you sure to delete this user? </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                <button type="button" onclick="location.href='members/delete/<?php echo $us->id_member ?>'" class="btn green">Delete</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            <tr>
                                                <td><?php echo $us->id_member ?></td>
                                                <td> <a href="<?php echo base_url().'admin/members/edit/'.$us->id_member.'/'.$us->username; ?>"><?php echo $us->fullname; ?></a> </td>
                                                <td> <?php echo $us->username ?> </td>
                                                <td> <?php echo $us->email ?> </td>
                                                <td> <?php echo $us->join_date ?> </td>
                                                <td> <?php echo ($us->last_login == '0000-00-00 00:00:00') ? '-' : $us->last_login ?></td>
                                                <td>
                                                    <a class="edit btn btn-info" href="<?php echo base_url().'admin/members/edit/'.$us->id_member.'/'.$us->username; ?>"> Edit </a>
                                                </td>
                                                <td>
                                                    <a class="delete btn btn-danger" data-toggle="modal" href="#small-<?php echo $us->id_member?>"> Delete </a>
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