 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('element_backend.element_material_list') }}
<small><a href="{{ action('Backend\Element\MaterialController@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

</h1>
 
 @endsection
 
 
 @section('content')
 
<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
		<div class="box-header">
				<h3 class="box-title">{{ trans('menu_backend.element_material_list') }}</h3>
				<div class="box-tools">
					<div class="input-group" style="width: 200px;">
					
					<form style="display: table;" name="search" method="POST" action="{{ route('admin.menu.material.search') }}">
						<input class="form-control input-sm pull-right" type="text" placeholder="Search" name="table_search">
						<div class="input-group-btn">
								<button class="btn btn-sm btn-default">
								<i class="fa fa-search"></i>
								</button>
							</div>
						{{ csrf_field() }}
					</form>
					
					</div>
				</div>
			</div>
			
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>{{ trans('element_backend.element_material.id') }}</th>
							<th>{{ trans('element_backend.element_material.type') }}</th>
							<th>{{ trans('element_backend.element_material.name') }}</th>
							<th>{{ trans('element_backend.element_material.price') }}</th>
							<th>{{ trans('element_backend.element_material.photo') }}</th>
							<th>{{ trans('element_backend.element_material.created') }}</th>
							<th>{{ trans('element_backend.element_material.lastupdated') }}</th>
							<th>{{ trans('element_backend.element_action') }}</th>
						</tr>
						@foreach($materials as $material)
						<tr>
							<td>{{ $material->id }}</td>
							<td>{{ $material->type->name }}</td>
							<td>{{ $material->name }}</td>
							<td>
								 {{ number_format($material->price,2) }}
							</td>
							<td>
								@if($material->photo_thumbnail_path)
									<img width="50" src="/{{ $material->photo_thumbnail_path }}" alt="">
								@endif
							</td>
							<td>{!! $material->created_at->diffForHumans() !!}</td>
							<td>{!! $material->updated_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.element.material.edit', $material->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.element.material.destroy', $material->id) }}">
									<input type="hidden" value="delete" name="_method">
									{{ csrf_field() }}
									</form>
								</a>
							</td>
							
						</tr>
						@endforeach
						
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
			
			<div class="box-footer clearfix">
				{!! $materials->render() !!}
			</div>
			
		</div>
		<!-- /.box -->
	</div>
</div>

@endsection