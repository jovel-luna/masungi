@extends('web.master')

@section('content')

<section class="page-innerFrame bg-white projects-fr1 frame1 page-lastFrame">
	<div class="page-container">
		<div class="width--90 margin-a">
			<div class="page-innerFrame__title align-c">
				<h5 class="slideUp">More</h5>
				<h1 class="slideUp">Projects & Collaborators</h1>
			</div>
		</div>
		<div class="page-general page-grid grid-2 width--90 margin-a">
			@foreach($collaborators as $collaborator)
				<div class="page__gridChild">
			    <div class="projects-fr1__imgCon" style="background-image: url('{{ $collaborator['image_path'] }}')"></div>
			    <p>{!! $collaborator['description'] !!}</p>
			  </div>
			@endforeach
		</div>
	</div>
</section>

@endsection