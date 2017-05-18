 @extends('backend.admin_master') 
 
 @section('page-header')

 <h1>
{{ trans('menu_backend.manage_couponlist') }}
<small><a href="{{ action('Backend\Manage\CouponConroller@create') }}"><button class="btn btn-danger" type="button">Create</button></a></small>

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
							<th>{{ trans('menu_backend.manage_coupon.id') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.order') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.code') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.title') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.value') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.photo') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.email') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.used') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.used_time') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.expired_time') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.updatetime') }}</th>
							<th>{{ trans('menu_backend.manage_coupon.createtime') }}</th>
							<th>{{ trans('menus.action') }}</th>
						</tr>
						@foreach($coupons as $coupon)
						<tr>
							<td>{{ $coupon->id }}</td>
							<td>{{ $coupon->order }}</td>
							<td>{{ $coupon->code }}</td>
							<td>{{ $coupon->title }}</td>
							<td>{{ $coupon->value }}</td>
							<td>
								<a href="/{{ $coupon->photo_path }}">
									<img width="100" src="/{{ $coupon->photo_path }}" alt="">
								</a>
							</td>
							<td>{{ $coupon->email }}</td>
							<td>{{ $coupon->used }}</td>
							<td>{{ $coupon->used_time }}</td>
							<td>{{ $coupon->expiretime() }}</td>
							<td>{!! $coupon->updated_at->diffForHumans() !!}</td>
							<td>{!! $coupon->created_at->diffForHumans() !!}</td>
							<td>
								<a class="btn btn-xs btn-primary" href="{{ route('admin.manage.coupon.edit', $coupon->id) }}"><i class="fa fa-pencil" title="" data-placement="top" data-toggle="tooltip" data-original-title="Edit"></i></a>
								
								<a class="btn btn-xs btn-danger" data-method="delete" style="cursor:pointer;" onclick="$(this).find('form').submit();">
								
								<i class="fa fa-trash" title="" data-placement="top" data-toggle="tooltip" data-original-title="Delete"></i>
									<form style="display:none" name="delete_item" method="POST" action="{{ route('admin.manage.coupon.destroy', $coupon->id) }}">
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
