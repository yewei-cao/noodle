 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_blacklist_list') }}
<small><a href="{{ action('Backend\Manage\BlacklistController@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

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
							<th>{{ trans('menu_backend.manage_blacklist.ip') }}</th>
							<th>{{ trans('menu_backend.manage_blacklist.reason') }}</th>
							<th>{{ trans('menu_backend.manage_blacklist.createtime') }}</th>
							<th>{{ trans('menu_backend.manage_blacklist.updatetime') }}</th>
						</tr>
						@foreach($blacklists as $blacklist)
						<tr>
							<td>{{ $blacklist->ip }}</td>
							<td>{{ $blacklist->reason }}</td>
							<td>{!! $blacklist->created_at->diffForHumans() !!}</td>
							<td>{!! $blacklist->updated_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.manage.blacklist.edit', $blacklist->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.manage.blacklist.destroy', $blacklist->id) }}">
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
