@if($errors->has())
    <div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4>Following errors occurred</h4>
        <ul>
            @foreach($errors->all() as $error)
                <li>1: {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(count($errors) > 0 )
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
	        <div class="alert alert-danger fade in">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        <h4>Following errors occurred</h4>
		        <ul>
		            @foreach($errors->all() as $error)
		                <li>1: {{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
        </div>
    </div>
@endif

@if(Session::has('message'))
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
        	<div class="alert alert-success fade in">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        message: {{ Session::get('message') }}
        	</div>
        </div>
    </div>
@endif