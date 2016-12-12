@extends('frontend.master')

@section('css.style')
<link rel="stylesheet" href="/css/ace.min.css">
<link rel="stylesheet" href="/css/acefonts/css/font-awesome.min.css">
@endsection

@section('content')

<div class="order-layout-left" style="min-height: 588px;" >

	<div id="product_menu_container" class="order-layout-left-inner">
	
			@if(!Auth::user()->orders()->count() && !session('regist'))
				<h4 class="lighter smaller text-center">{{ trans('front_home.qorder_text1') }}</h4>
				<h4 class="lighter smaller text-center">{{ trans('front_home.qorder_text2') }}</h4>
				<h4 class="lighter smaller text-center">{{ trans('front_home.qorder_text3') }}</h4>
				
				<ul class="horizon-list">
					<li>
					<a class="btn-yellow btn-primary btn-lg aspn" href="{{ route('home.delivery.info') }}"  type="button">
					{{ trans('front_home.delivery') }}
					</a>
					</li>
							
					<li>
					<a class="redbtn btn-lg aspn" href="{{ route('home.pickup.info') }}" type="button">
					{{ trans('front_home.pick_up') }}
					</a>
					</li>
				</ul>
			
			@elseif(session('regist'))
			<h4 class="header lighter smaller text-center">{{ trans('front_home.qorder_intro') }}</h4>
			
			<ul class="horizon-list">
				<li>
				<a class="btn-yellow btn-primary btn-lg aspn" href="{{ route('home.delivery.info') }}"  type="button">
				{{ trans('front_home.delivery') }}
				</a>
				</li>
						
				<li>
				<a class="redbtn btn-lg aspn" href="{{ route('home.pickup.info') }}" type="button">
				{{ trans('front_home.pick_up') }}
				</a>
				</li>
			</ul>
			
			@else
			
			<div class="row">
				
				<div class="col-xs-12 col-sm-10 col-sm-offset-1">
					<div class="timeline-container">
						<div class="timeline-label">
							<span class="label label-primary arrowed-in-right label-lg">
								<b>Within A Week</b>
							</span>
						</div>

						<div class="timeline-items">
						@foreach($user->descorders() as $order)
							<div class="timeline-item clearfix">
								<div class="timeline-info">
								@if($order->status==1)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-warning no-hover green"></i>
								@elseif($order->status==2)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-info no-hover green"></i>
								@elseif($order->status==3)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-danger no-hover green"></i>
								@elseif($order->status==4)
								<i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
								@elseif($order->status>=5|| $order->status<1)
								<i class="timeline-indicator ace-icon fa fa-close btn btn-success no-hover green"></i>
								@endif
								</div>

								<div class="widget-box transparent">
									<div class="widget-header widget-header-small">
										<h5 class="widget-title smaller">
											<span class="blue">{{ $user->name }}</span>
											<span class="grey">placed a {{ $order->ordertype }} order</span>
											@if($order->status==4)
										
									
										<a class="btn" style="cursor:pointer;" onclick="$(this).find('form').submit();">
									
										<form name="delete_item" method="GET" action="{{ route('home.quickorder.cloneorder', $order->id) }}">
										<button class="btn btn-xs btn-info" type="submit" >Clone</button>
										<input type="hidden" value="{{$order->id}}" name="orderid">
										</form>
										
										</a>
										
									
											@endif
										</h5>

										<span class="widget-toolbar no-border">
											<i class="ace-icon fa fa-clock-o bigger-110"></i>
											{{ $order->created_at->diffForHumans() }}
										</span>

										<span class="widget-toolbar">

											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</span>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="row">
												@foreach($order->dishes as $dish)
							                    <div class="col-9">
							                        <span class="description">
							                         {{ $dish->pivot->amount }} x {{ $dish->name }}
							                        </span>
							                    </div>
						                        <div class="col-3"><span class="ace_red">${{ $dish->pivot->total }}</span></div>
			                					@endforeach
			                				</div>
											<span class="blue">Message:</span>
											
											{{ $order->message }}
											
											<div class="space-6"></div>

											<div class="widget-toolbox clearfix">
													<div class="pull-left">
													<span>{{ $order->created_at }}</span>
												</div>
												<div class="pull-right action-buttons">
													<i class="ace-icon fa fa-check blue bigger-130"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach
							
							
						</div><!-- /.timeline-items -->
					</div><!-- /.timeline-container -->

					<div class="timeline-container">
						<div class="timeline-label">
							<span class="label label-success arrowed-in-right label-lg">
								<b>Previous</b>
							</span>
						</div>

						<div class="timeline-items">
							@foreach($user->lastorders() as $order)
							<div class="timeline-item clearfix">
								<div class="timeline-info">
								@if($order->status==1)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-warning no-hover green"></i>
								@elseif($order->status==2)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-info no-hover green"></i>
								@elseif($order->status==3)
									<i class="timeline-indicator ace-icon fa fa-star btn btn-danger no-hover green"></i>
								@elseif($order->status==4)
								<i class="timeline-indicator ace-icon fa fa-cutlery btn btn-success no-hover"></i>
								@elseif($order->status>=5|| $order->status<1)
								<i class="timeline-indicator ace-icon fa fa-close btn btn-success no-hover green"></i>
								@endif
								</div>

								<div class="widget-box transparent">
									<div class="widget-header widget-header-small">
										<h5 class="widget-title smaller">
											<span class="blue">{{ $user->name }}</span>
											<span class="grey">placed a {{ $order->ordertype }} order</span>
											@if($order->status==4)
										
									
										<a class="btn" style="cursor:pointer;" onclick="$(this).find('form').submit();">
									
										<form name="delete_item" method="GET" action="{{ route('home.quickorder.cloneorder', $order->id) }}">
										<button class="btn btn-xs btn-info" type="submit" >Clone</button>
										<input type="hidden" value="{{$order->id}}" name="orderid">
										</form>
										
										</a>
										
									
											@endif
										</h5>

										<span class="widget-toolbar no-border">
											<i class="ace-icon fa fa-clock-o bigger-110"></i>
											{{ $order->created_at->diffForHumans() }}
										</span>

										<span class="widget-toolbar">

											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>
										</span>
									</div>

									<div class="widget-body">
										<div class="widget-main">
											<div class="row">
												@foreach($order->dishes as $dish)
							                    <div class="col-9">
							                        <span class="description">
							                         {{ $dish->pivot->amount }} x {{ $dish->name }}
							                        </span>
							                    </div>
						                        <div class="col-3"><span class="ace_red">${{ $dish->pivot->total }}</span></div>
			                					@endforeach
			                				</div>
											<span class="blue">Message:</span>
											
											{{ $order->message }}
											
											<div class="space-6"></div>

											<div class="widget-toolbox clearfix">

												<div class="pull-right action-buttons">
														<i class="ace-icon fa fa-check blue bigger-130"></i>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							@endforeach

						</div><!-- /.timeline-items -->
					</div><!-- /.timeline-container -->

					
				</div>
		
			</div>
			
			@endif
			
		
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-sm-offset-1">
			<h3 class="lighter smaller"><a href="{{ url('/home') }}">Home Page</a></h3>
		</div>
	</div>
	
</div>


        
@endsection

@section('scripts.footer')
<script src="/js/ace/ace.min.js"></script>

@endsection
