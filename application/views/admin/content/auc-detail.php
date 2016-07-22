        <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            
                            <li>
                                <a href="<?php echo base_url().'admin/auctions' ?>">Auctions</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span><?php echo $auc_detail->name ?></span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Auctions detail
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <?php 
                            $attr = array('class' => "form-horizontal form-row-seperated");
                            echo form_open_multipart('admin/auctions/edit_process', $attr); 
                            ?>
                            <?php if ($this->session->flashdata('msg')): ?>
                            <div class="alert alert-info">
                                <?php echo $this->session->flashdata('msg'); ?>
                            </div>
                            <?php endif ?>
                                <div class="portlet">
                                    <div class="portlet-title">
                                        <div class="caption font-red">
                                            <i class="fa fa-shopping-cart"></i><?php echo $auc_detail->name ?> </div>
                                        <div class="actions btn-set">
                                            <a href="../" name="back" class="btn btn-secondary-outline">
                                                <i class="fa fa-angle-left"></i> Back</a>
                                            <button class="btn btn-success">
                                                <i class="fa fa-check"></i> Save</button>
                                            <a href="../delete/<?php echo $auc_detail->id_auction.'/'.$auc_detail->id_product ?>" class="btn btn-success">
                                                <i class="fa fa-check-circle"></i> Delete this</a>
                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="tabbable-bordered">
                                            <ul class="nav nav-tabs">
                                                <li class="active">
                                                    <a href="#tab_general" data-toggle="tab"> General </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_images" data-toggle="tab"> Images/photos
                                                        <span class="badge badge-success"> <?php echo $imgs_count ?> </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_reviews" data-toggle="tab"> Bids
                                                        <span class="badge badge-success"> <?php echo $bids_count ?> </span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#tab_history" data-toggle="tab"> Reviews from this post 
                                                        <span class="badge badge-success"> <?php echo $reviews_count ?> </span>
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_general">
                                                    <input type="hidden" name="id_auction" value="<?php echo $auc_detail->id_auction ?>">
                                                    <input type="hidden" name="id_product" value="<?php echo $auc_detail->id_product ?>">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Name:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="name" placeholder="" value="<?php echo $auc_detail->name ?>"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Auctioneer:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <a href="<?php echo base_url().'admin/members/edit/'.$auc_detail->id_auctioneer.'/'.$auc_detail->username ?>"><?php echo $auc_detail->fullname.' / '.$auc_detail->username ?></a>
                                                                <input type="hidden" name="id_auctioneer" value="<?php echo $auc_detail->id_auctioneer ?>">
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Condition :
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <select class="table-group-action-input form-control input-medium" name="condition">
                                                                    <option value="">Select...</option>
                                                                    <option value="Baru" <?php echo ($auc_detail->condition=='Baru') ? 'selected="selected"': ''; ?>>Baru </option>
                                                                    <option value="Bekas" <?php echo ($auc_detail->condition=='Bekas') ? 'selected="selected"': ''; ?>>Bekas</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Description:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <textarea rows="15" class="form-control" name="description"><?php echo $auc_detail->description ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Start - End Date:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="input-group date-picker input-daterange" data-date-format="mm/dd/yyyy" style="width:400px;">
                                                                    <input type="text" class="form-control" name="" value="<?php echo $auc_detail->start_timestamp ?>" disabled="disabled">
                                                                    <span class="input-group-addon"> to </span>
                                                                    <input type="text" class="form-control" name="" value="<?php echo ($auc_detail->is_clossed=='1') ? $auc_detail->closed_timestamp : 'isn\'t closed yet' ?>" disabled="disabled"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Last Updated:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <div class="input-group date-picker input-daterange" data-date-format="mm/dd/yyyy" style="width:400px;">
                                                                    <input type="text" class="form-control" name="" value="<?php echo $auc_detail->auct_last_updated ?>" disabled="disabled"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Lower Limit:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="lower_limit" placeholder="" value="<?php echo $auc_detail->lower_limit ?>"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Bid Interval:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="bid_interval" placeholder="" value="<?php echo $auc_detail->bid_interval ?>"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Price:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <input type="text" class="form-control" name="start_price" placeholder="" value="<?php echo $auc_detail->start_price ?>"> </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Product Category:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <select class="table-group-action-input form-control input-medium" name="sub_category">
                                                                <?php foreach ($cat_list as $cat) { ?>
                                                                  <optgroup label="<?php echo $cat->category_name;?>">
                                                                  <?php 
                                                                  foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub) { ?>
                                                                   <option value="<?php echo $sub->id_subcategory;?>" <?php echo ($auc_detail->id_cat == $sub->id_subcategory) ? 'selected="selected"': '' ;?>><?php echo $sub->sub_name;?></option>                 
                                                                  <?php 
                                                                  } 
                                                                  ?>
                                                                  </optgroup>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label">Status:
                                                                <span class="required"> * </span>
                                                            </label>
                                                            <div class="col-md-10">
                                                                <select class="table-group-action-input form-control input-medium" name="is_clossed">
                                                                    <option value="">Select...</option>
                                                                    <option value="0" <?php echo ($auc_detail->is_clossed=='0') ? 'selected="selected"': ''; ?>>On Going</option>
                                                                    <option value="1" <?php echo ($auc_detail->is_clossed=='1') ? 'selected="selected"': ''; ?>>Closed</option>
                                                                </select>
                                                            </div>
                                                            <input type="hidden" name="current_stat" value="<?php echo $auc_detail->is_clossed ?>">
                                                        </div>
                                                    </div>
                                                    <?php echo form_close(); ?>
                                                </div>
                                                <div class="tab-pane" id="tab_images">
                                                <?php echo form_open_multipart('admin/auctions/add_picts'); ?>
                                                    <div class="col-md-2 pull-right">
                                                        <a href="../delete_all_picts/<?php echo $auc_detail->id_product.'/'.$auc_detail->id_auction ?>" class="btn btn-primary">Remove all</a>
                                                    </div>
                                                    <div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
                                                        <input name="images[]" id="input-id" type="file" class="file" multiple class="file-loading">
                                                    </div>
                                                    <input type="hidden" name="id_product" value="<?php echo $auc_detail->id_product ?>">
                                                    <input type="hidden" name="id_auction" value="<?php echo $auc_detail->id_auction ?>">
                                                <?php echo form_close(); ?>
                                                    <div class="row">
                                                    <?php if ($imgs): ?>
                                                    <?php foreach ($imgs as $img): ?>
                                                        <div class="col-md-2">
                                                            <a href="<?php echo base_url().'assets/img/posts/'.$img->img_file ?>" class="fancybox-button" data-rel="fancybox-button">
                                                                <img class="img-responsive" src="<?php echo base_url().'assets/img/posts/'.$img->img_file ?>" alt=""></a>
                                                            <a href="../delete_pict/<?php echo $auc_detail->id_auction.'/'.$img->img_file.'/'.$img->id_pict ?>" style="margin-top:10px;margin-bottom:10px;" class="btn btn-default btn-sm">
                                                                <i class="fa fa-times"></i> Remove </a>
                                                        </div>
                                                    <?php endforeach ?>
                                                    <?php else: ?>
                                                        <div class="note note-warning">
                                                            No images on this post.
                                                        </div>
                                                    <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab_reviews">
                                                    <div class="table-container">
                                                        <?php if ($bids): ?>
                                                        <table class="table table-striped table-bordered table-hover" id="datatable_reviews">
                                                            <thead>
                                                                <tr role="row" class="heading">
                                                                    <th width="2%"> # </th>
                                                                    <th width="10%"> Bid Timestamp </th>
                                                                    <th width="17%"> Bidder </th>
                                                                    <th width="15%"> Bid value </th>
                                                                    <th width="10%"> Status </th>
                                                                    <th width="10%"> Action </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody> 
                                                                <?php foreach ($bids as $bid): ?>
                                                                <tr>
                                                                    <td><?php echo $bid->id_bid ?></td>
                                                                    <td><?php echo $bid->bid_timestamp ?></td>
                                                                    <td><a href="<?php echo base_url().'admin/members/edit/'.$bid->id_bidder.'/'.$bid->username ?>"><?php echo $bid->fullname.' / '.$bid->username ?></a></td>
                                                                    <td>Rp <?php echo number_format($bid->bid_value) ?></td>
                                                                    <td><label class="label <?php echo ($bid->id_bid == $auc_detail->id_winner) ? 'label-warning' : 'label-info'; ?> label-sm"><?php echo ($bid->id_bid == $auc_detail->id_winner) ? 'Win' : 'Valid'; ?></label></td>
                                                                    <td><a <?php echo ($bid->id_bid == $auc_detail->id_winner) ? 'disabled' : ''; ?> href="../delete_bid/<?php echo $auc_detail->id_auction.'/'.$bid->id_bid ?>" class="btn btn-danger btn-sm">Delete bid</a></td>
                                                                </tr>
                                                                <?php endforeach ?>
                                                            </tbody>
                                                        </table>
                                                        <?php else: ?>
                                                            <div class="note note-warning">
                                                                No bid on this auction.
                                                            </div>
                                                        <?php endif ?>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tab_history">
                                                    <div class="table-container">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col-md-10">
                                                                    <?php if ($reviews): ?>
                                                                    <table class="table table-striped table-bordered table-hover" id="datatable_history">
                                                                        <thead>
                                                                            <tr role="row" class="heading">
                                                                                <th> Timestamp </th>
                                                                                <th> Review Subject </th>
                                                                                <th> Content </th>
                                                                                <th> Reviewer </th>
                                                                                <th> Receiver</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <?php foreach ($reviews as $rev): ?>
                                                                            <tr>
                                                                                <td><?php echo $rev->review_timestamp ?></td>
                                                                                <td><?php echo $rev->review_subject ?> <div class="badge <?php echo ($rev->review_type==1) ? 'badge-info' : 'badge-danger' ?> badge-roundless"><?php echo ($rev->review_type==1) ? 'Positive': 'Negative' ?></div></td>
                                                                                <td><?php echo $rev->review_content ?></td>
                                                                                <td><a href="<?php echo base_url().'admin/members/edit/'.$rev->giver_id.'/'.$rev->giver_username ?>"><?php echo $rev->giver_fullname ?></a></td>
                                                                                <td><a href="<?php echo base_url().'admin/members/edit/'.$rev->receiver_id.'/'.$rev->receiver_username ?>"><?php echo $rev->receiver_fullname ?></a></td>
                                                                                <td><a class="btn btn-danger btn-sm" href="../delete_review/<?php echo $rev->id_review.'/'.$rev->id_auction ?>">Delete</a></td>
                                                                            </tr>
                                                                            <?php endforeach ?>
                                                                        </tbody>
                                                                    </table>
                                                                    <?php else: ?>
                                                                        <div class="note note-warning">
                                                                            No reviews on this post.
                                                                        </div>
                                                                    <?php endif ?>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->