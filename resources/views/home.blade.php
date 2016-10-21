@extends('spark::layouts.app')

@section('content')
<home :user="user" inline-template>
    <div class="container">
        <!-- Application Dashboard -->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        Your application's dashboard.
                    </div>
                </div>
            </div>
        </div>
    </div>
</home>

<new_note :user="user" inline-template>
    <div class="modal fade" id="note_modal" tabindex="-1" role="dialog" aria-labelledby="note_modal_label">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="note_modal_label">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        ...
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Save</button>
	      </div>
	    </div>
	  </div>
	</div>


{{--     <div class="container">
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
    </div> --}}
</new_note>



@endsection
