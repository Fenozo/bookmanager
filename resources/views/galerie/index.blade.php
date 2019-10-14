@extends('layouts.frontOffice.adminLTE')
@section('content')

<div  class="nosidebar">
	<div class="box box-info">
		<div class="box-header with-border">
		  <h3 class="box-title">Drop Files</h3>
		  <div class="box-tools pull-right">
		    <button type="button" class="btn btn-box-tool" data-widget="collapse">
		    	<i class="fa fa-minus"></i>
		    </button>
		  </div>
		</div>
		<!-- /.box-header -->
		<div id="content" class="box-body content">

			<?php foreach ($images as $file) { ?>
				
				<div  class="dropfile" data-value="{{ filename_in_path($file) }}" >
					<img src="{{ asset('\img'.$file)}}" >
				</div>
			<?php } ?>
			
			<div class="dropfile">
				
			</div>
		  <!-- /.table-responsive -->
		</div>
		<!-- /.box-body -->
		<div class="box-footer clearfix">
		  
		  <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
		</div>
	<!-- /.box-footer -->
	</div>
</div>

<input id="_token" type="hidden" name="_token" value="{{ csrf_token() }}">


@stop

@section('javascript')
<script type="text/javascript" src="{{ asset('js/dropfile.js') }}"></script>
<script type="text/javascript">
	
	jQuery('.dropfile').dropfile({ script:"{{ route('galerie.upload')}}",token : $('#_token').val()});
</script>
@stop