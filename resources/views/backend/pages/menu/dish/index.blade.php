 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.menu_dish_list') }}
<small><a href="{{ action('Backend\Menu\DishController@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

</h1>
 @endsection
 
 @section('breadcrumbs')
 
  <li><a href="{!!route('backend.dashboard')!!}"><i class="fa fa-dashboard"></i> {{ trans('menus.dashboard') }}</a></li>
    <li>{!! link_to_route('admin.menu.dish.index', trans('menus.menu_manage.dish')) !!}</li>
 
 @endsection
 
 @section('content')
 
<div class="row">


	<div class="col-xs-12">
		<div class="box">
		
			<div class="box-header">
				<h3 class="box-title">{{ trans('menu_backend.menu_dish_list') }}</h3>
				<div class="box-tools">
					<div class="input-group" style="width: 200px;">
					
					<form style="display: table;" name="search" method="POST" action="{{ route('admin.menu.dish.search') }}">
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
			<div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
	                    <tbody><tr>
	                      <th>{{ trans('menu_backend.menu_dish.id') }}</th>
							<th>{{ trans('menu_backend.menu_dish.name') }}</th>
							<th>{{ trans('menu_backend.menu_dish.number') }}</th>
							<th>{{ trans('menu_backend.menu_dish.ranking') }}</th>
							<th>{{ trans('menu_backend.menu_dish.price') }}</th>
							<th>{{ trans('menu_backend.menu_dish.consum') }}</th>
							<th>{{ trans('menu_backend.menu_dish.photo') }}</th>
							<th>{{ trans('menu_backend.menu_dish.created') }}</th>
							<th>{{ trans('menu_backend.menu_dish.lastupdated') }}</th>
							<th>{{ trans('menu_backend.menu_action') }}</th>
	                    </tr>
		                  @foreach($dishes as $dish)
							<tr>
								<td>{{ $dish->id }}</td>
								<td>{{ $dish->name }}</td>
								<td>{{ $dish->number }}</td>
								<td>{{ $dish->ranking }}</td>
								<td>{{ number_format($dish->price,2) }}</td>
								<td>{{ $dish->consumptionpoint }}</td>
								<td>
								@if($dish->photo_thumbnail_path)
								<img width="100" src="/{{ $dish->photo_thumbnail_path }}" alt="">
								@endif
								</td>
								<td>{!! $dish->created_at->diffForHumans() !!}</td>
								<td>{!! $dish->updated_at->diffForHumans() !!}</td>
								<td>
									<a class="btn btn-xs btn-primary" href="{{ route('admin.menu.dish.edit', $dish->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
									
									<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
									
									<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
										<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.menu.dish.destroy', $dish->id) }}">
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
                
			<div class="box-footer clearfix">
				{!! $dishes->render() !!}
			</div>
		</div>
		
		
	</div>
</div>

@endsection