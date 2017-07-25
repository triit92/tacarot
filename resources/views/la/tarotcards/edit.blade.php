@extends("la.layouts.app")

@section("contentheader_title")
	<a href="{{ url(config('laraadmin.adminRoute') . '/tarotcards') }}">Thông tin bói bài</a> :
@endsection
@section("contentheader_description", $tarotcard->$view_col)
@section("section", "Thông tin bói bài")
@section("section_url", url(config('laraadmin.adminRoute') . '/tarotcards'))
@section("sub_section", "Sửa")

@section("htmlheader_title", "Tarotcards Edit : ".$tarotcard->$view_col)

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
				{!! Form::model($tarotcard, ['route' => [config('laraadmin.adminRoute') . '.tarotcards.update', $tarotcard->id ], 'method'=>'PUT', 'id' => 'tarotcard-edit-form']) !!}
					@la_form($module)
					
					{{--
					@la_input($module, 'number')
					@la_input($module, 'clubs')
					@la_input($module, 'hearts')
					@la_input($module, 'diamonds')
					@la_input($module, 'spade')
					--}}
                    <br>
					<div class="form-group">
						{!! Form::submit( 'Cập nhật', ['class'=>'btn btn-success']) !!} <button class="btn btn-default pull-right"><a href="{{ url(config('laraadmin.adminRoute') . '/tarotcards') }}">Cancel</a></button>
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
	$("#tarotcard-edit-form").validate({
		
	});
});
</script>
@endpush
