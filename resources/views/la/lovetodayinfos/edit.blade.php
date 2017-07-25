@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/lovetodayinfos') }}">Lovetodayinfo</a> :
@endsection
@section("contentheader_description", $lovetodayinfo->$view_col)
@section("section", "Lovetodayinfos")
@section("section_url", url(config('laraadmin.adminRoute') . '/lovetodayinfos'))
@section("sub_section", "Edit")

@section("htmlheader_title", "Lovetodayinfos Edit : ".$lovetodayinfo->$view_col)

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
				{!! Form::model($lovetodayinfo, ['route' => [config('laraadmin.adminRoute') . '.lovetodayinfos.update', $lovetodayinfo->id ], 'method'=>'PUT', 'id' => 'lovetodayinfo-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'ngay')
					@la_input($module, 'bachduong')
					@la_input($module, 'kimnguu')
					@la_input($module, 'songtu')
					@la_input($module, 'cugiai')
					@la_input($module, 'sutu')
					@la_input($module, 'xunu')
					@la_input($module, 'thienbinh')
					@la_input($module, 'hocap')
					@la_input($module, 'nhanma')
					@la_input($module, 'maket')
					@la_input($module, 'baobinh')
					@la_input($module, 'songngu')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Update', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/lovetodayinfos') }}">Cancel</a></button>
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
	$("#lovetodayinfo-edit-form").validate({
		
	});
});
</script>
@endpush
