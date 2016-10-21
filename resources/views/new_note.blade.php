@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">New Note</div>
					<div class="panel-body">
						<form>
							<div class="form-group">
								<label for="title">Title:</label>
								<input type="input" class="form-control" id="title" name="title">
							</div>
							<div class="form-group">
								<label for="body">Body:</label>
								<textarea class="form-control" id="body" name="body"></textarea>
							</div>
							<div class="form-group">
								<label for="tags">Tags:</label>
								<select id="tags[]" name="tags[]" multiple="true">
									<option>Test</option>
								</select>
							</div>
							<button type="submit" class="btn btn-default">Save</button>
							</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</home>
@endsection
