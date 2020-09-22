<!-- Page Content -->
<div class="container">
  <div class="page">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="main-content">
          <!-- Main content -->
          <?php 
            include('inc/action_message.php');
          ?>
          <div class="form2">
            <div class="form2-title">New Registration (Cont.)</div>
            <div class="forms-body">

                <?php echo form_open(base_url().'dashboard/requesting_password_reset/'); ?>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Professional Information</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="organisation">Name of Organisation / Company</label>
                                <input class="form-control" type="text" name="organisation" id="organisation" required />
                            </div>

                            <div class="form-group">
                                <label for="industrial_sector">Choose the Industry for your Organisation</label>
                                <select class="form-control" name="industrial_sector" id="industrial_sector" required>
                                    <option value="Agriculture">Agriculture</option>
                                    <option value="Construction & Real Estate">Construction & Real Estate</option>
                                    <option value="Consumer Goods Manufacturing">Consumer Goods Manufacturing</option>
                                    <option value="Financial Services">Financial Services</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Industrial Goods Manufacturing">Industrial Goods Manufacturing</option>
                                    <option value="Information & Communications Technology">Information & Communications Technology</option>
                                    <option value="Natural Resources (Mining & Mineral Extraction)">Natural Resources (Mining & Mineral Extraction)</option>
                                    <option value="Oil & Gas">Oil & Gas</option>
                                    <option value="Services">Services</option>
                                    <option value="Utilities (Electricity, Water, etc.)">Utilities (Electricity, Water, etc.)</option>
                                    <option value="Conglomerate">Conglomerate</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="organisation_description">Briefly describe your Organisation / Company</label>
                                <textarea class="form-control" name="organisation_description" id="organisation_description" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="office_address">Office Address</label>
                                <input class="form-control" type="text" name="office_address" id="office_address" required />
                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input class="form-control" type="text" name="designation" id="designation" required />
                                <span class="small text-muted">** Your official job title **</span>
                            </div>

                        </div>
                    </div>
                    
                    <div class="form2-section">
                        <div class="form2-section-heading">Authorization status</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="ncaa_roc_number">NCAA ROC Number</label>
                                <input class="form-control" type="text" name="ncaa_roc_number" id="ncaa_roc_number" required />
                                <span class="small text-muted">** If not available, state your status **</span>
                            </div>

                            <div class="form-group">
                                <label for="ncaa_roc_number">Class of Operations</label>
                                <div class="checkbox">
                                    <input type="checkbox" name="vlos" id="vlos" value="1"> <label for="vlos">VLOS (Visual Line of Sight)</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="bvlos" id="bvlos" value="1"> <label for="bvlos">BVLOS (Beyond Visual Line of Sight)</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ncaa_roc_number">Approved Operations</label>
                                <div class="radio">
                                    <input type="radio" name="approved_operations" id="commercial" value="1" required /> <label for="commercial">Commercial</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operations" id="government" value="1" required /> <label for="government">Government</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operations" id="corporate" value="1" required /> <label for="corporate">Corporate</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form2-section">
                        <div class="form2-section-heading">NUSA Code of Conduct</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label class="consent_detail" for="NUSA_code_of_conduct">
                                    <div class="alert alert-outline-light">
                                    I hereby acknowledge that I have read and understand the Nigeria Unmanned Systems & Robotics 
                                    Association's (NUSA) Code of Conduct and will be responsible for obtaining all future amendments 
                                    and modifications thereto. I further acknowledge that I have read and understand all of my 
                                    obligations, duties, and responsibilities under each principle and provision of the NUSA Code of 
                                    Conduct and constitution and will read and understand all of my obligations, duties and 
                                    responsibilities under all future amendments and modifications thereto. I understand that violations 
                                    of the Code of Conduct or NUSA policies may result in disciplinary action including suspension and/or 
                                    withdrawal of my membership. I certify that this is a true and correct statement by me.</div>
                                </label>
                                <div class="checkbox">
                                    <input type="checkbox" name="code_of_conduct" id="code_of_conduct" value="1"> <label for="code_of_conduct">I agree.</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="form2-section">
                        <div class="form2-section-heading">Terms and Conditions</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label class="consent_detail" for="NUSA_terms_and_conditions">
                                    <div class="alert alert-outline-light">
                                    I affirm that all information provided are correct. I understand that my completion of this form 
                                    authorizes the association to make use of the information for the business of the association, and as 
                                    may be required by the relevant authorities under the Nigerian Law, if the need arises.</div>
                                </label>
                                <div class="checkbox">
                                    <input type="checkbox" name="terms_and_conditions" id="terms_and_conditions" value="1"> <label for="terms_and_conditions">I agree.</label>
                                </div>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" name="form_page" value="reg_page2.2">
                    
                    <div class="form2-progress">
                        <div class="row">
                            <div class="col-7">
                                <div class="stage">Page 2 of 2 <a href="#" class="btn btn-sm btn-outline-secondary">Back to page 1</a></div>
                            </div>
                            <div class="col-5">
                                <div class="text-right">
                                    <input class="custom-outline-button" type="submit" name="submit" value="Submit" />
                                </div>
                            </div>
                        </div>
                    </div>

                <?php form_close(); ?>
                
            </div>
          </div>
      </div>
    </div>
  </div>
</div>