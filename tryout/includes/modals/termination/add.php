<div id="add_termination" class="modal custom-modal fade" role="dialog">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Add Termination</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form method="POST" action="add-termination.php">
									<div class="form-group">
										<label>Terminated Contractor <span class="text-danger">*</span></label>
										<input class="form-control" type="text">
									</div>
									<div class="form-group">
										<label>Termination Type <span class="text-danger">*</span></label>
										<div class="add-group-btn">
											<select class="select">
												<option>Misconduct</option>
												<option>Others</option>
											</select>
											<a class="btn btn-primary" href="javascript:void(0);"><i class="fa fa-plus"></i> Add</a>
										</div>
									</div>
									<div class="form-group">
										<label>Termination Date <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input type="text" class="form-control datetimepicker">
										</div>
									</div>
									<div class="form-group">
										<label>Reason <span class="text-danger">*</span></label>
										<textarea class="form-control" rows="4"></textarea>
									</div>
									<div class="form-group">
										<label>Notice Date <span class="text-danger">*</span></label>
										<div class="cal-icon">
											<input type="text" class="form-control datetimepicker">
										</div>
									</div>
									<div class="submit-section">
										<button type="submit" name="termination" class="btn btn-primary submit-btn" >Submit</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>