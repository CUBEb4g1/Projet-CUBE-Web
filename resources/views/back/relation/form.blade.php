@extends('back._layouts.app')

@section('title', __('Relation').' - '.($user ? __('Edition') : __('Creation')))

@section('content')
	@component('back._cmpts.page_header', [
		'title' => __('Relation'),
		'subtitle' => $user ? __('Edition') : __('Creation'),
	])@endcomponent

	
@endpush
