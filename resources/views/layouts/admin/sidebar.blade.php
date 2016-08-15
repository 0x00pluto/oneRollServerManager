@section('body-sidebar')
@if (isset($sidebarmenus ))
<ul>
	@foreach ($sidebarmenus as $kindname=>$menu)
	<li> {{ $kindname }}
		<ul>
			@foreach ($menu as $item)
				<li>
					<a href="{{ $item['url'] }}">{{ $item['name'] }}</a>
					@if(isset($item['child']))
						<ul style="list-style-type:none">
							@foreach($item['child'] as $child)
								<li>
									<a href="{{ $child['url'] }}">{{ $child['name'] }}</a>
								</li>
							@endforeach
						</ul>
					@endif
				</li>
			@endforeach
		</ul>
	</li>
	@endforeach
</ul>
@else
<p>暂无列表</p>
@endif

@endsection
