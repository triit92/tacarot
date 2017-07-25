@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/facebookids') }}">Sửa thông tin người dùng</a> :
@endsection
@section("contentheader_description", $facebookid->$view_col)
@section("section", "Facebook ID")
@section("section_url", url(config('laraadmin.adminRoute') . '/facebookids'))
@section("sub_section", "Sửa")

    @section("htmlheader_title", "Facebookids Edit : ".$facebookid->$view_col)

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
				{!! Form::model($facebookid, ['route' => [config('laraadmin.adminRoute') . '.facebookids.update', $facebookid->id ], 'method'=>'PUT', 'id' => 'facebookid-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'UserID')
					@la_input($module, 'birthday')
					@la_input($module, 'Gender')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Cập nhật', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/facebookids') }}">Cancel</a></button>
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
	$("#facebookid-edit-form").validate({
		
	});
});
</script>
@endpush
