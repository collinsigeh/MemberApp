

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="subscription_type">Subscription type</label>
                            </div>
                            <div class="col-md-9">
                              <select name="status" id="" class="form-control">
                                <option value="Membership" <?php if($this->session->product_subscription_type == 'Membership'){ echo 'selected'; } ?>>Membership</option>
                                <option value="Non-membership" <?php if($this->session->product_subscription_type == 'Non-membership'){ echo 'selected'; } ?>>Non-membership</option>
                              </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="duration">Validity (days)</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="duration" id="duration" value="<?php echo $this->session->product_subscription_duration; ?>" placeholder="E.g. 365" required />
                                <small class="text-muted">*** How many days will this subscription be valid for? ***</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="user_limit">User limit</label>
                            </div>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="user_limit" id="user_limit" value="<?php echo $this->session->product_subscription_duration; ?>" placeholder="E.g. 1" required />
                                <small class="text-muted">*** How many users is allowed to make use of this subscription? ***</small>
                            </div>
                        </div>
                    </div>