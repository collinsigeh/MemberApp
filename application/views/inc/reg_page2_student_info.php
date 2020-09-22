
                    <div class="form2-section">
                        <div class="form2-section-heading">Student Professional Information</div>
                        <div class="form2-section-body">

                            <div class="form-group">
                                <label for="institution">Name of Institution</label>
                                <input class="form-control" type="text" name="institution" id="institution" value="<?php echo $this->session->institution; ?>" required />
                            </div>

                            <div class="form-group">
                                <label for="course_of_study">Course of Study</label>
                                <input class="form-control" type="text" name="course_of_study" id="course_of_study" value="<?php echo $this->session->course_of_study; ?>" required />
                            </div>

                            <div class="form-group">
                                <label for="degree">What degree are you studying for?</label>
                                <select class="form-control" name="degree" id="degree" required>
                                    <option value="">-- Select appropriate degree --</option>
                                    <option value="B.Sc" <?php if($this->session->industry == 'B.Sc'){ echo 'selected'; } ?>>B.Sc</option>
                                    <option value="Diploma" <?php if($this->session->industry == 'Diploma'){ echo 'selected'; } ?>>Diploma</option>
                                    <option value="Masters" <?php if($this->session->industry == 'Masters'){ echo 'selected'; } ?>>Masters</option>
                                    <option value="PhD" <?php if($this->session->industry == 'PhD'){ echo 'selected'; } ?>>PhD</option>
                                    <option value="Professional Certification" <?php if($this->session->industry == 'Professional Certification'){ echo 'selected'; } ?>>Professional Certification</option>
                                    <option value="School Certificate" <?php if($this->session->industry == 'School Certificate'){ echo 'selected'; } ?>>School Certificate</option>
                                    <option value="Others" <?php if($this->session->industry == 'Others'){ echo 'selected'; } ?>>Others</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="graduation_year">Possible Year of Graduation</label>
                                <input class="form-control" type="text" name="graduation_year" id="graduation_year" value="<?php echo $this->session->graduation_year; ?>" required />
                            </div>

                        </div>
                    </div>