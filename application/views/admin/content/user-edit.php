        <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="<?php echo base_url().'admin' ?>">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>User</span>
                            </li>
                        </ul>
                    </div>
                    <h3 class="page-title"> User Profile | <?php echo $user_detail->fullname ?>
                        <small><?php echo $user_detail->username ?></small>
                    </h3>
                    <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success"><?php echo $this->session->flashdata('msg'); ?></div>
                    <?php elseif($this->session->flashdata('warn')): ?>
                    <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-sidebar">
                                <div class="portlet light profile-sidebar-portlet ">
                                    <div class="profile-userpic">
                                        <img src="<?php echo base_url();?>assets/img/avatar/<?php echo ($user_detail->avatar) ? $user_detail->avatar : 'default_avatar.png' ?>" class="img-responsive" alt=""> </div>
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"> <?php echo $user_detail->fullname ?> </div>
                                        <div class="profile-usertitle-job"> Active </div>
                                    </div>
                                    <div class="profile-usermenu">
                                        <ul class="nav">
                                            <li>
                                                <a href="../../delete/<?php echo $user_detail->id_member ?>">
                                                    <i class="icon-trash"></i> Delete this user</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="portlet light ">
                                    <div class="row list-separated profile-stat">
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="#tab_1_4" data-toggle="tab"><div class="uppercase profile-stat-title"> <?php echo $bid_count ?> </div>
                                            <div class="uppercase profile-stat-text"> Bids </div></a>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="#tab_1_5" data-toggle="tab"><div class="uppercase profile-stat-title"> <?php echo $auc_count1 ?> </div>
                                            <div class="uppercase profile-stat-text"> Sold Auctions </div></a>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="#tab_1_5" data-toggle="tab"><div class="uppercase profile-stat-title"> <?php echo $auc_count2 ?> </div>
                                            <div class="uppercase profile-stat-text"> Ongoing Auctions </div></a>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="#tab_1_6" data-toggle="tab"><div class="uppercase profile-stat-title"> <?php echo $auc_count2 ?> </div>
                                            <div class="uppercase profile-stat-text"> (+) Reviews </div></a>
                                        </div>
                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                            <a href="#tab_1_7" data-toggle="tab"><div class="uppercase profile-stat-title"> <?php echo $auc_count2 ?> </div>
                                            <div class="uppercase profile-stat-text"> (-) Reviews </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light ">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_2" data-toggle="tab">Change Avatar</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_4" data-toggle="tab">Bids</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_5" data-toggle="tab">Auctions</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_6" data-toggle="tab">(+) Reviews</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_7" data-toggle="tab">(-) Reviews</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <?php echo form_open('admin/members/edit_process'); ?>
                                                            <div class="form-group">
                                                                <label class="control-label">Full Name</label>
                                                                <input name="fullname" value="<?php echo $user_detail->fullname ?>" type="text" placeholder="" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Username</label>
                                                                <input name="username" value="<?php echo $user_detail->username ?>" type="text" placeholder="" class="form-control" /> </div>
                                                                <input type="hidden" name="current_username" value="<?php echo $user_detail->username ?>"></input>
                                                            <div class="form-group">
                                                                <label class="control-label">E-mail</label>
                                                                <input name="email" value="<?php echo $user_detail->email ?>" type="text" placeholder="" class="form-control" /> </div>
                                                                <input name="current_email" value="<?php echo $user_detail->email ?>" type="hidden" /> 
                                                            <div class="form-group">
                                                                <label class="control-label">Phone Number</label>
                                                                <input name="phone_number" value="<?php echo $user_detail->phone_number ?>" type="text" placeholder="" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Address</label>
                                                                <input name="address" value="<?php echo $user_detail->address ?>" type="text" placeholder="Design, Web etc." class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">City</label>
                                                                <input name="city" value="<?php echo $user_detail->city ?>" type="text" placeholder="" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Province</label>
                                                                <input name="province" value="<?php echo $user_detail->province ?>" type="text" placeholder="" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Postal Code</label>
                                                                <input name="postal_code" value="<?php echo $user_detail->postal_code ?>" type="text" placeholder="" class="form-control" /> </div>
                                                            <div class="margiv-top-10">
                                                                <input type="hidden" value="<?php echo $user_detail->id_member ?>" name="current_id"></input>
                                                                <button class="btn green"> Save Changes </button>
                                                                <a href="../../" class="btn default"> Cancel </a>
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_2">
                                                        <?php echo form_open_multipart('admin/members/edit_avatar'); ?>
                                                            <div class="form-group">
                                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                    <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?php echo base_url().'assets/img/avatar/'.$user_detail->avatar ?>" alt="" /> </div>
                                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                                    <div>
                                                                        <span class="btn default btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" name="avatar"> </span>
                                                                            <input type="hidden" name="username" value="<?php echo $user_detail->username ?>"></input>
                                                                            <input type="hidden" name="id_member" value="<?php echo $user_detail->id_member ?>"></input>
                                                                        <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <button class="btn green"> Submit </button>
                                                                <a href="../../" class="btn default"> Cancel </a>
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_3">
                                                        <?php echo form_open('admin/members/edit_password'); ?>
                                                            <div class="form-group">
                                                                <label class="control-label">New Password</label>
                                                                <input name="password" type="password" class="form-control" /> </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Re-type New Password</label>
                                                                <input name="pass_conf" type="password" class="form-control" /> </div>
                                                                <input type="hidden" name="id_member" value="<?php echo $user_detail->id_member ?>"></input>
                                                                <input type="hidden" name="current_uri" value="<?php echo $this->uri->uri_string() ?>"></input>
                                                            <div class="margin-top-10">
                                                                <input type="hidden" value="<?php echo $this->uri->uri_string() ?>" name="current_uri"></input>
                                                                <button class="btn green"> Change Password </button>
                                                                <a href="../../" class="btn default"> Cancel </a>
                                                            </div>
                                                        <?php echo form_close(); ?>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_4">
                                                        <table class="table table-light table-hover">
                                                            <?php if ($bid_out): ?>
                                                            <?php foreach ($bid_out as $bid): ?>
                                                            <tr>
                                                                <td> <strong>Rp <?php echo number_format($bid->bid_value) ?></strong> on <a href=""><?php echo $bid->name.'</a> ('.$bid->auct_username.')' ?> </td>
                                                                <td>
                                                                    <?php if ($bid->id_winner == $bid->id_bid): ?>
                                                                    <div class="label label-info">Winner</div>
                                                                    <?php endif ?>
                                                                </td>
                                                                <td><?php echo $bid->bid_timestamp ?></td>
                                                                <td><a href="<?php echo base_url().'admin/auctions/delete_bid/'.$bid->id_auction.'/'.$bid->id_bid ?>"><i class="icon-trash"></i></a></td>
                                                            </tr>
                                                            <?php endforeach ?>
                                                            <?php else: ?>
                                                                <div class="alert alert-warning">This user has no bid right now.</div>
                                                            <?php endif ?>
                                                        </table>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_5">
                                                        <?php if ($auctions): ?>
                                                        <?php foreach ($auctions as $auc): ?>
                                                        <div class="panel panel-info">
                                                            <div class="panel-heading">
                                                                <h3 class="panel-title"><a href=""><?php echo $auc->name; ?></a></h3>
                                                            </div>
                                                            <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <?php $thumbnail = $this->products_picts_model->get_product_thumbnail($auc->id_product); ?>
                                                                    <img width="100%" src="<?php echo base_url().'assets/img/posts/'.$thumbnail->img_file ?>">
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <span><strong>Open price :</strong> Rp <?php echo number_format($auc->start_price) ?>,-</span><br>
                                                                    <span><strong>Lower limit : </strong>Rp <?php echo number_format($auc->lower_limit) ?>,-</span><br>
                                                                    <span><strong>Bid Interval : </strong>Rp <?php echo number_format($auc->bid_interval) ?></span><br>
                                                                    <span><strong>View(s) : </strong><?php echo $auc->views_count ?></span>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <span><strong>Start : </strong><?php echo $auc->start_timestamp ?></span><br>
                                                                    <span><strong>Last updated : </strong><?php echo $auc->last_updated; ?></span><br>
                                                                    <span><strong>Bid(s) : </strong><?php echo $this->bids_model->get_per_auction_rows($auc->id_auction) ?></span>
                                                                    <?php if ($auc->is_clossed): ?>
                                                                        <br><span><strong>Closed : </strong><?php echo $auc->closed_timestamp ?></span>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="col-md-2 pull-right">
                                                                    <a href="<?php echo base_url().'admin/auctions/detail/'.$auc->id_auction ?>" class="pull-right">See details</a>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach ?>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">This user has no auction right now.</div>
                                                        <?php endif ?>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_6">
                                                        <?php if ($reviews1): ?>
                                                        <table class="table table-striped table-bordered table-hover" id="datatable_history">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th style="font-size:10px;"> Timestamp </th>
                                                                    <th style="font-size:10px;"> Review Subject </th>
                                                                    <th style="font-size:10px;"> Content </th>
                                                                    <th style="font-size:10px;"> Reviewer </th>
                                                                    <th style="font-size:10px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($reviews1 as $rev): ?>
                                                                <tr>
                                                                    <td><?php echo $rev->review_timestamp ?></td>
                                                                    <td><?php echo $rev->review_subject ?> <div class="badge <?php echo ($rev->review_type==1) ? 'badge-info' : 'badge-danger' ?> badge-roundless"><?php echo ($rev->review_type==1) ? 'Positive': 'Negative' ?></div></td>
                                                                    <td><?php echo $rev->review_content ?></td>
                                                                    <td><a href="<?php echo base_url().'admin/members/edit/'.$rev->id_member.'/'.$rev->username ?>"><?php echo $rev->username ?></a></td>
                                                                    <td><a class="btn btn-danger btn-sm" href="../delete_review/<?php echo $rev->id_review.'/'.$rev->id_auction ?>">Delete</a></td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">This user has no (+) review.</div>
                                                        <?php endif ?>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_7">
                                                        <?php if ($reviews2): ?>
                                                        <table class="table table-striped table-bordered table-hover" id="datatable_history">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th style="font-size:10px;"> Timestamp </th>
                                                                    <th style="font-size:10px;"> Review Subject </th>
                                                                    <th style="font-size:10px;"> Content </th>
                                                                    <th style="font-size:10px;"> Reviewer </th>
                                                                    <th style="font-size:10px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($reviews2 as $rev): ?>
                                                                <tr>
                                                                    <td><?php echo $rev->review_timestamp ?></td>
                                                                    <td><?php echo $rev->review_subject ?> <div class="badge <?php echo ($rev->review_type==1) ? 'badge-info' : 'badge-danger' ?> badge-roundless"><?php echo ($rev->review_type==1) ? 'Positive': 'Negative' ?></div></td>
                                                                    <td><?php echo $rev->review_content ?></td>
                                                                    <td><a href="<?php echo base_url().'admin/members/edit/'.$rev->id_member.'/'.$rev->username ?>"><?php echo $rev->username ?></a></td>
                                                                    <td><a class="btn btn-danger btn-sm" href="../delete_review/<?php echo $rev->id_review.'/'.$rev->id_auction ?>">Delete</a></td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                        <?php else: ?>
                                                            <div class="alert alert-warning">This user has no (+) review.</div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- END PROFILE CONTENT -->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->