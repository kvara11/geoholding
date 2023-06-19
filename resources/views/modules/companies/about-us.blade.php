@extends('master')

@section('pageMetaTitle'){{ $page -> metaTitle }}@endsection
@section('pageMetaDescription'){{ $page -> metaDescription }}@endsection
@section('pageMetaUrl'){{ $page -> metaUrl }}@endsection

@section('content')
	<div class="d-flex flex-column align-items-center">
		<h1>{{ $activeAbout->title }}</h1>
		Page: {{ $page -> title }}
		<p>Company: {!! $activeAbout->text !!}</p>
	</div>

@endsection