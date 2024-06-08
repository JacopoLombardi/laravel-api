
@extends('layouts.admin')


@section('content')


    <div class="container-fluid me-5">

        <div class="text-center my-4">
            <h1>Projects</h1>
        </div>


        @if (isset($_GET['stringSearch']))
            <div class=" text-bg-light w-auto d-inline-block rounded-4 border ms-5 py-2 px-3">
                <p class="m-0">Ricerca per: <strong>{{ $_GET['stringSearch'] }}</strong></p>
                <p class="m-0">Elementi trovati: <strong>{{ $projects_count }}</strong></p>
            </div>
        @endif


        {{-- messaggio in caso di eliminazione di un Project --}}
        @if (session('success'))
            <div class="d-flex justify-content-center">
                <div class="alert alert-danger text-center w-50 mb-5" role="alert">
                    {{ session('success') }}
                </div>
            </div>
        @endif
        {{-- /////////////////// --}}


        <div class="container_table px-5 pt-4">
            <table class="table w-100">
                <thead>
                    <tr class="fs-5">
                        <th scope="col">Titolo</th>
                        <th scope="col">Type</th>
                        <th scope="col">Technology</th>
                        <th scope="col">Link al Progetto</th>
                        <th scope="col">Descrizione</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($projects as $project)
                        <tr>
                            <td>{{ $project->title }}</td>

                            {{-- tramite One to Many mi ricavo il nome del Type associato al rispettivo Project, e con ? nullsafeoperator, mi restituisce il name solo se esiste, seza dare errori --}}
                            <td>{{ $project->type?->name }}</td>


                            {{-- tramite Many to Many ricavo i Technologies da assegnare ad ogni Project tramite un ciclo each con condizione --}}
                            <td class="col-2">
                                @forelse ($project->technologies as $technology)
                                    <span class="badge text-bg-warning">{{ $technology->name }}</span>
                                @empty
                                    <span class="badge text-bg-danger">Empty</span>
                                @endforelse
                            </td>

                            <td>{{ $project->link }}</td>

                            <td>{{ $project->description }}</td>

                            <td class="py-4">
                                <div class="d-flex">
                                    <a
                                      href="{{ route('admin.projects.show', $project) }}"
                                      class="btn btn-success me-2 h-50"
                                      ><i class="fa-solid fa-eye"></i>
                                    </a>

                                    <a
                                      href="{{ route('admin.projects.edit', $project) }}"
                                      class="btn btn-warning me-2 h-50"
                                      ><i class="fa-solid fa-pencil"></i>
                                    </a>


                                    <form
                                      action="{{ route('admin.projects.destroy', $project) }}"
                                      method="POST"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>



@endsection

