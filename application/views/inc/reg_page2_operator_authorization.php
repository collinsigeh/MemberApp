
                    <div class="form2-section">
                        <div class="form2-section-heading">Authorization status</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="ncaa_roc_number">NCAA ROC Number</label>
                                <input class="form-control" type="text" name="ncaa_roc_number" id="ncaa_roc_number" value="<?php echo $this->session->ncaa_roc_number; ?>" required />
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
                                    <input type="radio" name="approved_operation" id="commercial" value="Commercial" required /> <label for="commercial">Commercial</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operation" id="government" value="Government" required /> <label for="government">Government</label>
                                </div>
                                <div class="radio">
                                    <input type="radio" name="approved_operation" id="corporate" value="Corporate" required /> <label for="corporate">Corporate</label>
                                </div>
                            </div>

                        </div>
                    </div>