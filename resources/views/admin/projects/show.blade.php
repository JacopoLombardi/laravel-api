
@extends('layouts.admin')


@section('content')


    <div class="container">

        <div class="text-center my-5">
            <h1 class="mb-4">Project</h1>
            <h2>{{ $project->title }}</h2>
        </div>

        <div>
            {{-- stampo i type --}}
            @if ($project->type)
                <div class="mb-3">
                    <label>Type:</label>
                    <p class="badge text-bg-success fs-6 ms-2">{{ $project->type->name }}</p>
                </div>
            @endif

            {{-- stampo le technology --}}
            @if ($project->technologies)
                <div class="mb-3">
                    <label>Technology:</label>
                    @forelse ($project->technologies as $technology)
                        <span class="badge text-bg-warning fs-6 ms-2">{{ $technology->name }}</span>
                    @empty
                        <span class="badge text-bg-danger fs-6 ms-2">Empty</span>
                    @endforelse
                </div>
            @endif


            <div class="mb-5">
                <label>Titolo:</label>
                <p>{{ $project->title }}</p>
            </div>

            <div class="w-50 mb-5">
                <label>Descrizione:</label>
                <p>{{ $project->description }}</p>
            </div>
        </div>

        <div class="pt-5">
            <a class="btn btn-danger" href="{{ route('admin.projects.index') }}">Torna Indietro</a>
        </div>

@endsection




<style>

    label{
        font-size: 22px;
        font-weight: 600;
    }
    p{
        font-size: 18px;
    }

</style>
