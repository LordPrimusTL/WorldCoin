<div id="WithUserModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit User</h4>
                <div class="modal-body">
                    <form method="post" action="<?php echo e('/user/withdraw'); ?>">
                        <?php echo e(csrf_field()); ?>

                        <p class="well-sm">
                            Please note that you can only withdraw your full amount if you have referred three active users, else 10% of the withdrawal amount will be deducted and the 90% will be withdrawn to your payment platform.
                        </p>
                        <div class="form-horizontal">

                            <div class="col-md-offset-3 col-md-6">
                                <div class="form-group">
                                    <select name="with_from" class="form-control input-lg">
                                        <option value="">---Select Account---</option>
                                        <option value="0">Referral</option>
                                        <option value="1">Trade</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-offset-3 col-md-6">
                                <div class="form-group">
                                    <input type="number" class="form-control input-lg" name="with_number" id="with_number" placeholder="Amount To Withdraw" style="border-radius:0!important;" required/>
                                </div>
                            </div>

                            <div class="pull-right">
                                <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-save"></span> Submit</button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span> Close
                                    </button>
                            </div>

                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>