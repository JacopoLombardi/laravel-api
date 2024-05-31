
@extends('layouts.admin')


@section('content')


    <div class="container">

        <div class="text-center my-4">
            <h1>Types</h1>
        </div>


        <div class="mb-5">
            <h5>Aggiungi un Type:</h5>

            <form class="d-flex my-3" action="{{ route('admin.types.store') }}" method="POST">
                @csrf
                <input class="form-control me-4 w-25" placeholder="Name" type="text" name="name">
                <button class="btn btn-success" type="submit">aggiungi</button>
            </form>
        </div>


        {{-- messaggi in caso di aggiunta di un Project --}}
        @if (session('error'))
            <div class="alert alert-danger text-center w-50 mb-5" role="alert">
                {{ session('error') }}
            </div>
        @endif


        @if (session('success'))
            <div class="alert alert-success text-center w-50 mb-5" role="alert">
                {{ session('success') }}
            </div>
        @endif
        {{-- /////////////////// --}}


        <div class="container_table_s">
            <table class="table w-25">
                <thead>
                    <tr class="fs-5">
                        <th scope="col">Name</th>
                        <th scope="col">Azioni</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($types as $type)
                        <tr>
                            <td>
                                <form
                                  action="{{ route('admin.types.update', $type) }}"
                                  method="POST"
                                  id="form-edit-{{ $type->id }}"
                                  class="m-0"
                                  >
                                    @csrf
                                    @method('PUT')
                                    <input class="w-100" value="{{ $type->name }}" name="name">
                                </form>
                            </td>


                            <td>
                                <div class="d-flex">
                                    <button
                                      class="btn btn-warning me-2"
                                      onclick="submitForm( {{ $type->id }} )"
                                    ><i class="fa-solid fa-pencil"></i>
                                    </button>


                                    <form
                                    class="mb-0"
                                    action="{{ route('admin.types.destroy', $type) }}"
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




<script>

    function submitForm(id){
        const form = document.getElementById(`form-edit-${id}`);
        form.submit();
    }

</script>
