 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_type_list') }}
<small><a href="{{ action('Backend\Menu\TypeController@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

</h1>
 
 @endsection
 
 
 @section('content')

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			
			<!-- /.box-header -->
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover">
					<tbody>
						<tr>
							<th>{{ trans('menu_backend.menu_type.id') }}</th>
							<th>{{ trans('menu_backend.menu_type.name') }}</th>
							<th>{{ trans('menu_backend.menu_type.description') }}</th>
							<th>{{ trans('menu_backend.menu_type.created') }}</th>
							<th>{{ trans('menu_backend.menu_type.lastupdated') }}</th>
							<th>{{ trans('menu_backend.menu_type_action') }}</th>
						</tr>
						@foreach($types as $type)
						<tr>
							<td>{{ $type->id }}</td>
							<td>{{ $type->name }}</td>
							<td>{{ $type->description }}</td>
							<td>{!! $type->created_at->diffForHumans() !!}</td>
							<td>{!! $type->updated_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.menu.type.edit', $type->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.menu.type.destroy', $type->id) }}">
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
		</div>
		<!-- /.box -->
	</div>
</div>


@endsection
