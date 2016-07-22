            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="">Categories Manager</a>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> Categories list
                        <small>categories and sub-categories</small>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <?php if ($this->session->flashdata('msg')): ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                    <?php elseif ($this->session->flashdata('warn')): ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('warn'); ?>
                    </div> 
                    <?php endif ?>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light portlet-fit portlet-datatable bordered" id="form_wizard_1">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class=" icon-layers font-green"></i>
                                        <span class="caption-subject font-green bold uppercase">Parent Categories</span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-cloud-upload"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-wrench"></i>
                                        </a>
                                        <a class="btn btn-circle btn-icon-only btn-default" href="javascript:;">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_2">
                                        <thead>
                                            <tr>
                                                <th style="font-size:10px;">
                                                    <input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /> </th>
                                                <th style="font-size:10px;"> Name </th>
                                                <th style="font-size:10px;"> Total Childs</th>
                                                <th style="font-size:10px;"> Total Products </th>
                                                <th style="font-size:10px;"> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($child_list): ?>
                                                <?php foreach ($parent_list as $parent): ?>
                                                    <div class="modal fade bs-modal-md" id="cat-<?php echo $parent->id_category?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-md">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Delete Parent category</h4>
                                                                </div>
                                                                <div class="modal-body"> Are you sure to delete this category? The auctions and subcategories within will be deleted as well. </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                    <button type="button" onclick="location.href='<?php echo base_url() ?>admin/categories/delete_parent/<?php echo $parent->id_category ?>'" class="btn green">Delete</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                    <div class="modal fade " id="edit-<?php echo $parent->id_category?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog ">
                                                        <?php 
                                                        $attr = array('class' => "form-horizontal");
                                                        echo form_open('admin/categories/edit_parent', '', $attr); ?>
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                    <h4 class="modal-title">Edit category name for <strong><?php echo $parent->category_name ?></strong></h4>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="portlet-body form">
                                                                            <!-- BEGIN FORM-->
                                                                                <div class="form-body">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12">
                                                                                          <div class="form-group">
                                                                                                <label class="col-md-4 control-label">Category name</label>
                                                                                                <div class="col-md-8">
                                                                                                    <input type="text" name="category_name" class="form-control input-medium" value="<?php echo $parent->category_name ?>" placeholder="">
                                                                                                </div>
                                                                                            </div>  
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <!-- END FORM-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input type="hidden" name="id_category" value="<?php echo $parent->id_category ?>"></input>
                                                                    <button type="submit" class="btn green">Save change</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        <?php echo form_close(); ?>
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                <tr role="row">
                                                    <td>
                                                        <input type="checkbox" class="checkboxes" value="1" /> </td>
                                                    <td><?php echo $parent->category_name ?></td>
                                                    <td><?php echo $parent->child_count ?></td>
                                                    <td><?php echo $parent->products_count ?></td>
                                                    <td>
                                                        <div class="btn-group">
                                                                <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                                    <i class="fa fa-angle-down"></i>
                                                                </button>
                                                                <ul class="dropdown-menu" role="menu">
                                                                    <li>
                                                                        <a data-toggle="modal" href="#edit-<?php echo $parent->id_category ?>"> Edit </a>
                                                                    </li>
                                                                    <li>
                                                                        <a data-toggle="modal" href="#cat-<?php echo $parent->id_category ?>"> Delete </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
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
                        <div class="col-md-6 col-sm-12">
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="icon-plus font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase">Add New category</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="tabbable tabbable-tabdrop">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a aria-expanded="true" href="#tab1" data-toggle="tab">New Parent</a>
                                            </li>
                                            <li class="">
                                                <a aria-expanded="false" href="#tab2" data-toggle="tab">New Child/subcategory</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <?php echo form_open('admin/categories/add_parent'); ?>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>New Parent Name</label>
                                                        <input type="text" name="category_name" class="form-control input-medium">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="parent_submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                <?php echo form_open('admin/categories/add_child'); ?>
                                                <div class="form-body">
                                                    <div class="form-group">
                                                        <label>Parent Name</label>
                                                        <select class="form-control input-medium" name="id_category">
                                                            <option value="0">Select a parent</option>
                                                            <?php foreach ($parent_list as $parent ): ?>
                                                            <option value="<?php echo $parent->id_category ?>"><?php echo $parent->category_name ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>New Child Name</label>
                                                        <input type="text" name="sub_name" class="form-control input-medium" required="">
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" name="child_submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-green-sharp"></i>
                                        <span class="caption-subject font-green-sharp bold uppercase"> Child Categories list</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="table-toolbar">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="btn-group">
                                                    <button id="sample_editable_1_new" class="btn sbold green"> Add New
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-checkable order-column" id="sample_1">
                                        <thead>
                                            <tr>
                                                <tr role="row" class="heading">
                                                    <th></th>
                                                    <th> # </th>
                                                    <th> Parent Name > Child Name </th>
                                                    <th> Total Products </th>
                                                    <th> Actions </th>
                                                </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($child_list): ?>
                                            <?php foreach ($child_list as $child): ?>
                                                <div class="modal fade bs-modal-sm" id="sub-<?php echo $child->id_subcategory?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Delete child category</h4>
                                                            </div>
                                                            <div class="modal-body"> Are you sure to delete this category? The auctions within will be deleted as well. </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                                                                <button type="button" onclick="location.href='<?php echo base_url() ?>admin/categories/delete_child/<?php echo $child->id_subcategory ?>'" class="btn green">Delete</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                <div class="modal fade " id="edit2-<?php echo $child->id_subcategory?>" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog ">
                                                    <?php 
                                                    $attr = array('class' => "form-horizontal");
                                                    echo form_open('admin/categories/edit_child', '', $attr); ?>
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                                <h4 class="modal-title">Edit child category for <strong><?php echo $child->sub_name ?></strong></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="portlet-body form">
                                                                        <!-- BEGIN FORM-->
                                                                            <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                      <div class="form-group">
                                                                                            <label class="col-md-4 control-label">Child category name</label>
                                                                                            <div class="col-md-8">
                                                                                                <input type="text" name="sub_name" class="form-control input-medium" value="<?php echo $child->sub_name ?>" placeholder="">
                                                                                            </div>
                                                                                        </div> 
                                                                                    </div> 
                                                                                    <div class="col-md-12" style="margin-top: 10px;">
                                                                                        <div class="form-group">
                                                                                            <label class="col-md-4 control-label">Parent Name</label>
                                                                                            <div class="col-md-8">
                                                                                                <select class="form-control input-medium" name="id_category">
                                                                                                    <option>Select a parent</option>
                                                                                                    <?php foreach ($parent_list as $parent ): ?>
                                                                                                    <option value="<?php echo $parent->id_category ?>" <?php echo ($parent->id_category == $child->id_category) ? 'selected="selected"': ''?>><?php echo $parent->category_name ?></option>
                                                                                                    <?php endforeach ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <!-- END FORM-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_subcategory" value="<?php echo $child->id_subcategory ?>"></input>
                                                                <input type="hidden" name="current_category" value="<?php echo $child->id_category ?>"></input>
                                                                <button type="submit" class="btn green">Save change</button>
                                                            </div>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    <?php echo form_close(); ?>
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                            <tr role="row">
                                                <td></td>
                                                <td><?php echo $child->id_subcategory ?></td>
                                                <td><?php echo $child->category_name ?> > <?php echo $child->sub_name ?></td>
                                                <td><?php echo $child->products_count ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false"> Actions
                                                            <i class="fa fa-angle-down"></i>
                                                        </button>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <li>
                                                                <a data-toggle="modal" href="#edit2-<?php echo $child->id_subcategory ?>"> Edit </a>
                                                            </li>
                                                            <li>
                                                                <a data-toggle="modal" href="#sub-<?php echo $child->id_subcategory ?>"> Delete </a>
                                                            </li>
                                                        </ul>
                                                    </div>
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
            <!-- END CONTENT