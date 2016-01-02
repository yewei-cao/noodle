 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_catalogue_list') }}
<small><a href="{{ action('Backend\Menu\CataloguesController@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

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
							<th>{{ trans('menu_backend.menu_catalogue.id') }}</th>
							<th>{{ trans('menu_backend.menu_type_') }}</th>
							
							<th>{{ trans('menu_backend.menu_catalogue.name') }}</th>
							<th>{{ trans('menu_backend.menu_catalogue.description') }}</th>
							<th>{{ trans('menu_backend.menu_catalogue.created') }}</th>
							<th>{{ trans('menu_backend.menu_catalogue.lastupdated') }}</th>
							<th>{{ trans('menu_backend.menu_catalogue_action') }}</th>
						</tr>
						@foreach($catalogues as $catalogue)
						<tr>
							<td>{{ $catalogue->id }}</td>
							<td>{{ $catalogue->type->name }}</td>
							<td>{{ $catalogue->name }}</td>
							<td>{{ $catalogue->description }}</td>
							<td>{!! $catalogue->created_at->diffForHumans() !!}</td>
							<td>{!! $catalogue->updated_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.menu.catalogue.edit', $catalogue->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.menu.catalogue.destroy', $catalogue->id) }}">
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