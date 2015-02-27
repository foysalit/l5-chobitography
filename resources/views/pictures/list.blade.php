@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@foreach($pictures as $picture)
				{{ $picture->caption }}
			@endforeach
		</div>
	</div>
</div>
@endsection
