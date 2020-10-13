<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-8">
        <div class="main-content">
          <!-- Main content -->
          <div class="page-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url().'dashboard'; ?>"><img src="<?php echo base_url().'assets/img/icon_images/homepage_icon.png'; ?>" alt="Dashboard" class="homepage-icon" ></a></li>
              <li class="breadcrumb-item"><a href="<?php echo base_url().'member_resources/'; ?>">Member resources</a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo $resource->name; ?></li>
            </ol>
          </nav>
          </div>
          <?php 
            $this->load->view('inc/action_message');
          ?>

          <?php echo form_open(base_url().'member_resources/update/'.$resource->id); ?>

          <div class="dashboard-section">
            <div class="section-heading">
                Resource details
            </div>
            <div class="section-body">
                <div class="section-item">
                    <div class="row">
                        <div class="col-12">

                            <div class="form3">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="name">Item name</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="name" id="name" value="<?php echo $resource->name; ?>" required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="created_for">Created for</label>
                                        </div>
                                        <div class="col-md-9">
                                            <div class="checkbox">
                                                <input type="checkbox" name="for_individual" id="for_individual" value="1" <?php if($resource->for_individual == 1){ echo 'checked'; } ?> /> <label for="for_individual">Individual members</label>
                                            </div>
                                            <div class="checkbox">
                                                <input type="checkbox" name="for_corporate" id="for_corporate" value="1" <?php if($resource->for_corporate == 1){ echo 'checked'; } ?> /> <label for="for_corporate">Corporate members</label>
                                            </div>
                                            <div class="checkbox">
                                                <input type="checkbox" name="for_student" id="for_student" value="1" <?php if($resource->for_student == 1){ echo 'checked'; } ?> /> <label for="for_student">Student members</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="description">Item description</label>
                                        </div>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="description" id="description" required><?php echo $resource->description; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="type">Nature of item</label>
                                        </div>
                                        <div class="col-md-9">
                                        <select name="type" id="" class="form-control">
                                            <option value="">-- Select an option --</option>
                                            <option value="Non-downloadable" <?php if($resource->type == 'Non-downloadable'){ echo 'selected'; } ?>>Non-downloadable</option>
                                            <option value="Downloadable" <?php if($resource->type == 'Downloadable'){ echo 'selected'; } ?>>Downloadable</option>
                                        </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="download_link">Download link</label>
                                        </div>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="download_link" id="download_link" value="<?php echo $resource->download_link; ?>" />
                                            <small class="text-muted">Required for downloadable items</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
          </div>
          
            <div class="update-button">
                <input class="custom-outline-button" type="submit" name="submit" value="Save" />
            </div>

          <?php form_close(); ?>

        </div>

      </div>

      <div class="col-md-4">
        <div class="sidebar">
          <!-- Sidebar -->
          <?php
            $this->load->view('inc/admin_sidebar'); 
          ?>
        </div>
      </div>
    </div>
  </div>
</div>