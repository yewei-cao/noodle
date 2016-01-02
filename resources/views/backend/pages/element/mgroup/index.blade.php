 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('element_backend.mgroup_list') }}
<small><a href="{{ action('Backend\Element\MgroupController@create') }}"><button class="btn btn-danger" type="button">{{ trans('element_backend.create') }}</button></a></small>

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
							<th>{{ trans('element_backend.mgroup.id') }}</th>						
							<th>{{ trans('element_backend.mgroup.name') }}</th>
							<th>{{ trans('element_backend.mgroup.description') }}</th>
							<th>{{ trans('element_backend.mgroup.created') }}</th>
							<th>{{ trans('element_backend.mgroup.lastupdated') }}</th>
						</tr>
						@foreach($groups as $group)
						<tr>
							<td>{{ $group->id }}</td>
							<td>{{ $group->name }}</td>
							<td>{{ $group->description }}</td>
							<td>{!! $group->created_at->diffForHumans() !!}</td>
							<td>{!! $group->updated_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.element.mgroup.edit', $group->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.element.mgroup.destroy', $group->id) }}">
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