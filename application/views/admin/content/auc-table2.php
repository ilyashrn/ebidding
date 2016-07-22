<!-- BEGIN CONTENT -->            
            <div class="page-content-wrapper">

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="#">Auctions</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Auctions list
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Begin: life time stats -->
                            <div class="portlet light portlet-fit bordered ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-shopping-cart"></i>
                                        <span class="caption-subject font-red sbold uppercase">Auction list</span>
                                </div>
                                <div class="portlet-body">
                                    <?php if ($this->session->flashdata('msg')): ?>
                                    <div class="alert alert-info"><?php echo $this->session->flashdata('msg'); ?></div>
                                    <?php elseif($this->session->flashdata('warn')): ?>
                                    <div class="alert alert-danger"><?php echo $this->session->flashdata('warn'); ?></div>
                                    <?php endif ?>
                                    <div class="table-container">
                                    <?php echo form_open('admin/auctions/search'); ?>
                                        <table class="table table-striped table-bordered table-hover table-checkable" width="100%" id="datatable_products" style="font-size:10px;">
                                            <thead>
                                                <tr role="row" class="heading">
                                                    <th> ID </th>
                                                    <th> Product&nbsp;Name </th>
                                                    <th> Category </th>
                                                    <th> Price </th>
                                                    <th> User </th>
                                                    <th> Status </th>
                                                    <th> Date&nbsp;Created </th>
                                                    <th> Bids</th>
                                                    <th> Views</th>
                                                    <th> Actions </th>
                                                </tr>
                                                <tr role="row" class="filter">
                                                    <td></td>
                                                    <td>
                                                        <input type="text" class="form-control form-filter input-sm" name="name" value="<?php echo $this->session->userdata('name'); ?>"> </td>
                                                    <td>
                                                        <select name="product_category" class="form-control form-filter input-sm">
                                                            <option value="0">All</option>
                                                            <?php foreach ($cat_list as $cat) { ?>
                                                              <optgroup label="<?php echo $cat->category_name;?>">
                                                              <?php 
                                                              foreach ($this->categories_model->get_sub_per_category($cat->id_category) as $sub) { ?>
                                                               <option value="<?php echo $sub->id_subcategory;?>" <?php echo ($this->session->userdata('product_category') == $sub->id_subcategory) ? 'selected="selected"': '' ;?>><?php echo $sub->sub_name;?></option>                 
                                                              <?php 
                                                              } 
                                                              ?>
                                                              </optgroup>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                            <input value="<?php echo $this->session->userdata('price_from'); ?>" type="number" class="form-control form-filter input-sm" name="price_from" placeholder="From" /> </div>
                                                        <input value="<?php echo $this->session->userdata('price_to'); ?>" type="number" class="form-control form-filter input-sm" name="price_to" placeholder="To" /> </td>
                                                    <td></td>
                                                    <td>
                                                        <select name="status" class="form-control form-filter input-sm">
                                                            <option value="-99">All</option>
                                                            <option value="0" <?php echo ($this->session->userdata('status') == 0) ? 'selected="selected"' : ''; ?>>Ongoing</option>
                                                            <option value="1" <?php echo ($this->session->userdata('status') == 1) ? 'selected="selected"' : ''; ?>>Clossed</option>
                                                        </select>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <select name="bids" class="form-control form-filter input-sm">
                                                            <option value="0">No filter</option>
                                                            <option <?php echo ($this->session->userdata('bids') == 5) ? 'selected="selected"' : ''; ?> value="5"> <= 5</option>
                                                            <option <?php echo ($this->session->userdata('bids') == 10) ? 'selected="selected"' : ''; ?> value="10"> <= 10</option>
                                                            <option <?php echo ($this->session->userdata('bids') == 20) ? 'selected="selected"' : ''; ?> value="20"> <= 20</option>
                                                            <option <?php echo ($this->session->userdata('bids') == 50) ? 'selected="selected"' : ''; ?> value="50"> <= 50</option>
                                                            <option <?php echo ($this->session->userdata('bids') == 200) ? 'selected="selected"' : ''; ?> value="200"> => 50</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="views" class="form-control form-filter input-sm">
                                                            <option value="0">No filter</option>
                                                            <option <?php echo ($this->session->userdata('views') == 5) ? 'selected="selected"' : ''; ?> value="5"> <= 5</option>
                                                            <option <?php echo ($this->session->userdata('views') == 10) ? 'selected="selected"' : ''; ?> value="10"> <= 10</option>
                                                            <option <?php echo ($this->session->userdata('views') == 20) ? 'selected="selected"' : ''; ?> value="20"> <= 20</option>
                                                            <option <?php echo ($this->session->userdata('views') == 50) ? 'selected="selected"' : ''; ?> value="50"> <= 50</option>
                                                            <option <?php echo ($this->session->userdata('views') == 200) ? 'selected="selected"' : ''; ?> value="200"> => 50</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="margin-bottom-5">
                                                            <button type="submit" name="submit_search" class="btn btn-sm btn-success margin-bottom">
                                                                <i class="fa fa-search"></i> Search</button>
                                                        </div>
                                                        <a href="<?php echo base_url().'admin/auctions/' ?>" class="btn btn-sm btn-default">
                                                            <i class="fa fa-times"></i> Reset</a>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php if ($auc_list): ?>
                                            <?php foreach ($auc_list as $auc): ?>
                                                <div class="modal fade bs-modal-sm" id="small-<?php echo $auc->id_auction?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Delete auction</h4>
                                                            </div>
                                                            <div class="modal-body"> Are you sure to delete this auction? </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                <button type="button" onclick="location.href='<?php echo base_url() ?>admin/auctions/delete/<?php echo $auc->id_auction.'/'.$auc->id_product ?>'" class="btn green">Delete</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                            <tr role="row">
                                                <td><?php echo $auc->id_auction ?></td>
                                                <td><a href="<?php echo base_url().'admin/auctions/detail/'.$auc->id_auction ?>"><?php echo $auc->name ?></a></td>
                                                <td><?php echo $auc->category_name.'/'.$auc->sub_name ?></td>
                                                <td>Rp <?php echo number_format($auc->start_price) ?></td>
                                                <td><a href="<?php echo base_url().'admin/members/edit/'.$auc->id_auctioneer.'/'.$auc->username ?>"><?php echo $auc->username ?></a></td>
                                                <td><?php echo (!$auc->is_clossed) ? '<div class="label label-info">Ongoing</div>' : '<div class="label label-danger">Closed</div>'?></td>
                                                <td><?php echo $auc->start_timestamp ?></td>
                                                <td><?php echo $this->bids_model->get_per_auction_rows($auc->id_auction) ?></td>
                                                <td><?php echo $auc->views_count ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button aria-expanded="false" id="btnGroupVerticalDrop1" type="button" class="btn btn-default dropdown-toggle btn-sm" data-toggle="dropdown"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="btnGroupVerticalDrop1">
                                                            <li>
                                                                <a href="<?php echo base_url().'admin/auctions/detail/'.$auc->id_auction ?>"> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a data-toggle="modal" href="#small-<?php echo $auc->id_auction?>"> Delete </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <!-- <a class="edit btn btn-info btn-sm" data-toggle="modal" href="#edit-<?php echo $auc->id_auction ?>"> Edit </a>
                                                    <a class="edit btn btn-info btn-sm" data-toggle="modal" href="#edit-<?php echo $auc->id_auction ?>"> Delete </a> -->
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                            <?php endif ?>
                                             </tbody>
                                        </table>
                                        <?php echo form_close(); ?>    
                                    </div>
                                </div>
                            </div>
                            <!-- End: life time stats -->
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->

            </div>
            <!-- END CONTENT