
@extends('layouts.admin')


@section('content')


    <div class="container">
        <div class="text-center my-5">
            <h1>Modifica il Progetto {{ $project->title }}</h1>
        </div>


        {{-- messaggi in caso di errori nella compilazione degli input --}}
        @if ($errors->any())
        <div class="alert alert-danger text-center w-50 pb-0" role="alert">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- progetto già esistente --}}
        @if (session('error'))
            <div class="alert alert-danger text-center w-50 mb-5" role="alert">
                {{ session('error') }}
            </div>
        @endif
        {{-- /////////////////// --}}


        <div>
            <h5>Aggiungi un Progetto:</h5>

            <form class="my-3" action="{{ route('admin.projects.update', $project) }}" method="POST">
                @csrf
                @method('PUT')
                <input
                  class="form-control w-50 @error ('title') is-invalid @enderror" placeholder="Titolo"
                  type="text"
                  name="title"
                  value="{{ old('title', $project->title) }}"
                >

                @error('title')
                    <h6 class="text-danger">{{ $message }}</h6>
                @enderror

                {{-- selezione del Type tramite select --}}
                <div class="mt-3">
                    <label>Select Type</label>
                    <select class="form-select w-50 mt-2" name="type_id">
                        <option value="">Selected Type</option>
                        @foreach ($types as $type)
                            <option
                            value="{{ $type->id }}"
                            @if (old('type_id', $project->type?->id) == $type->id) selected @endif
                            >
                            {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- selezione del Technology tramite checkbox --}}
                <div class="col-6 d-flex flex-column mt-3 mb-5">
                    <label>Select Technology</label>
                    <div>
                        @foreach ($technologies as $technology)
                            <input
                              class="btn-check"
                              type="checkbox"
                              name="technologies[]"
                              autocomplete="off"
                              id="technology{{ $technology->id }}"
                              value="{{ $technology->id }}"
                              @if ($errors->any() && in_array($technology->id, old('technologies', [])) || !$errors->any() && $project->technologies->contains($technology))
                                checked
                              @endif
                            >
                            <label class="btn btn-outline-primary rounded-5 me-2 mt-3 py-1" for="technology{{ $technology->id }}">{{ $technology->name }}</label>
                        @endforeach
                    </div>
                </div>


                <textarea
                  class="form-control w-50 my-4"
                  placeholder="Descrizione"
                  name="description"
                  cols="30"
                  rows="5"
                  name="description">{{ $project->description }}
                </textarea>

                <button class="btn btn-success" type="submit">modifica</button>
            </form>
        </div>
    </div>

@endsection
