<?php
    if($page_title == 'Product detail')
    {
        if(!empty($item_detail))
        {
            $this->session->product_nature          = $item_detail->nature;
            $this->session->product_download_link   = $item_detail->download_link;
        }
        else
        {
            $this->session->product_nature          = '';
            $this->session->product_download_link   = '';
        }
    }
?>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="nature">Nature of product</label>
                            </div>
                            <div class="col-md-9">
                              <select name="nature" id="nature" class="form-control">
                                <option value="">-- Select an option --</option>
                                <option value="Downloadable" <?php if($this->session->product_nature == 'Downloadable'){ echo 'selected'; } ?>>Downloadable</option>
                                <option value="Non-downloadable" <?php if($this->session->product_nature == 'Non-downloadable'){ echo 'selected'; } ?>>Non-downloadable</option>
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
                                <input type="text" class="form-control" name="download_link" id="download_link" value="<?php echo $this->session->product_download_link; ?>" />
                                <small class="text-muted">*** Optional for non-downloadable products ***</small>
                            </div>
                        </div>
                    </div>