@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/descriptions') }}">Description</a> :
@endsection
@section("contentheader_description", $description->$view_col)
@section("section", "Descriptions")
@section("section_url", url(config('laraadmin.adminRoute') . '/descriptions'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Descriptions Edit : ".$description->$view_col)

@section("main-content")

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="box">
	<div class="box-header">
		
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::model($description, ['route' => [config('laraadmin.adminRoute') . '.descriptions.update', $description->id ], 'method'=>'PUT', 'id' => 'description-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'name')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/descriptions') }}">Cancel</a></button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script>
$(function () {
	$("#description-edit-form").validate({
		
	});
});
</script>
@endpush
