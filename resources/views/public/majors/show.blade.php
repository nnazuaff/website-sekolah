@extends('layouts.public')
@section('title', $major->name)
@section('content')
@include('layouts._public-page-header', ['title' => $major->name, 'description' => 'Program keahlian '.$major->short_name, 'parentRoute' => 'majors.index', 'parentLabel' => 'Program Keahlian'])
<section class="site-section"><div class="mx-auto max-w-4xl">@if($major->image)<img src="{{ asset('storage/'.$major->image) }}" alt="{{ $major->name }}" class="mx-auto mb-8 h-auto max-h-80 max-w-2xl rounded object-contain">@endif<div class="prose max-w-none text-slate-700">{!! nl2br(e($major->description ?? 'Informasi program keahlian belum tersedia.')) !!}</div></div></section>
@endsection