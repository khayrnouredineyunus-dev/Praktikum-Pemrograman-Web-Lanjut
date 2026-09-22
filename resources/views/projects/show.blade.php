@extends('layouts.app')

@section('title', $project->judul . ' - Portfolio')

@section('content')
<div class="container">
    <h1>{{ $project->judul }}</h1>
    <p class="kartu-meta">{{ $project->stack }}</p>
    <p>{{ $project->deskripsi }}</p>
</div>
@endsection