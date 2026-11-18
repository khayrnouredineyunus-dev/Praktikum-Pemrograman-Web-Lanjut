@extends('layouts.app')

@section('title', 'Profil Saya - Portfolio')

@section('content')
<div class="container">
    <h1>Profil Saya</h1>

    <article class="kartu">
        <h2>{{ $user->name }}</h2>
        <p class="kartu-meta">Email: {{ $user->email }}</p>
        <p class="kartu-meta">Terdaftar sejak: {{ $user->created_at->format('d-m-Y H:i') }}</p>
    </article>
</div>
@endsection