@extends('layouts.app')

@section('title', 'Projects - Portfolio')

@section('content')
    <section>
        <h1>Projects</h1>

        @php
            $total = count($projects);
        @endphp
        <p>Total project: {{ $total }}</p>

        <div class="grid">
            @forelse ($projects as $project)
                @include('partials.kartu-project', ['project' => $project])
            @empty
                <p>Belum ada data project.</p>
            @endforelse
        </div>
    </section>
@endsection
