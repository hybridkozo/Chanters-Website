<h3> New Article: </h3>
				<form class="form-horizontal" role="form" method="POST" enctype="multipart/form-data" action="include/postarticle.php">
					<div class="form-group">
						<label class="control-label col-md-2" for="email">Article Title:</label>
						<div class="col-md-10">
							<input type="text" class="form-control" id="title" name="title" placeholder="Insert Title">
						</div>
					</div>
					<div class="form-group">
						<label class="control-label col-md-2" for="pwd">Category:</label>
							<div class="col-md-10"> 
							<select class="form-control" id="category" name="category">
								<option>news</option>
								<option>old</option>
							</select>
						</div>
					</div>	
					<div class="form-group">
						    <label class="control-label col-md-2" for="pwd">Article Image:</label>
							<div class="col-md-10"> 
								<input type="file" name="fileToUpload" id="fileToUpload" class="form-control">
						</div>
					</div>
						<div class="form-group">
						<label class="control-label col-md-2" for="email">Article Body:</label>
						<div class="col-md-10">
							<textarea class="form-control" name="body" id="body"></textarea>
						</div>
					</div>
					<div class="form-group"> 
						<div class="col-md-offset-2 col-md-10">
							<button type="submit" class="btn btn-success btn-block">Submit</button>
						</div>
					</div>
				</form>
				<h3> Edit Articles: </h3>