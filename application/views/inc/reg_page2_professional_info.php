
                    <div class="form2-section">
                        <div class="form2-section-heading">Professional Information</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="organisation">Name of Organisation / Company</label>
                                <input class="form-control" type="text" name="organisation" id="organisation" value="<?php echo $this->session->organisation; ?>" required />
                            </div>

                            <div class="form-group">
                                <label for="industry">Choose the Industry for your Organisation</label>
                                <select class="form-control" name="industry" id="industry" required>
                                    <option value="Agriculture" <?php if($this->session->industry == 'Agriculture'){ echo 'selected'; } ?>>Agriculture</option>
                                    <option value="Construction & Real Estate" <?php if($this->session->industry == 'Construction & Real Estate'){ echo 'selected'; } ?>>Construction & Real Estate</option>
                                    <option value="Consumer Goods Manufacturing" <?php if($this->session->industry == 'Consumer Goods Manufacturing'){ echo 'selected'; } ?>>Consumer Goods Manufacturing</option>
                                    <option value="Financial Services" <?php if($this->session->industry == 'Financial Services'){ echo 'selected'; } ?>>Financial Services</option>
                                    <option value="Healthcare" <?php if($this->session->industry == 'Healthcare'){ echo 'selected'; } ?>>Healthcare</option>
                                    <option value="Industrial Goods Manufacturing" <?php if($this->session->industry == 'Industrial Goods Manufacturing'){ echo 'selected'; } ?>>Industrial Goods Manufacturing</option>
                                    <option value="Information & Communications Technology" <?php if($this->session->industry == 'Information & Communications Technology'){ echo 'selected'; } ?>>Information & Communications Technology</option>
                                    <option value="Natural Resources (Mining & Mineral Extraction)" <?php if($this->session->industry == 'Natural Resources (Mining & Mineral Extraction)'){ echo 'selected'; } ?>>Natural Resources (Mining & Mineral Extraction)</option>
                                    <option value="Oil & Gas" <?php if($this->session->industry == 'Oil & Gas'){ echo 'selected'; } ?>>Oil & Gas</option>
                                    <option value="Services" <?php if($this->session->industry == 'Services'){ echo 'selected'; } ?>>Services</option>
                                    <option value="Utilities (Electricity, Water, etc.)" <?php if($this->session->industry == 'Utilities (Electricity, Water, etc.)'){ echo 'selected'; } ?>>Utilities (Electricity, Water, etc.)</option>
                                    <option value="Conglomerate" <?php if($this->session->industry == 'Conglomerate'){ echo 'selected'; } ?>>Conglomerate</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="organisation_description">Briefly describe your Organisation / Company</label>
                                <textarea class="form-control" name="organisation_description" id="organisation_description" required><?php echo $this->session->organisation_description; ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="office_address">Office Address</label>
                                <input class="form-control" type="text" name="office_address" id="office_address" value="<?php echo $this->session->office_address; ?>" required />
                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input class="form-control" type="text" name="designation" id="designation" value="<?php echo $this->session->designation; ?>" required />
                                <span class="small text-muted">*** Your official job title ***</span>
                            </div>

                        </div>
                    </div>