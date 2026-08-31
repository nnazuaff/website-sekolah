@extends('layouts.public')
@section('title', 'Guru dan Tenaga Kependidikan')
@section('content')
@include('layouts._public-page-header', ['title' => 'Guru dan Tenaga Kependidikan', 'description' => 'Pendidik yang mendampingi siswa untuk berkembang dan berprestasi.'])
<section class="site-section"><livewire:teacher-list /></section>
@endsection