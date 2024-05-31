
@extends('layouts.admin')


@section('content')


    <div class="container">

        <div class="text-center my-4">
            <h1>Type-Posts</h1>
        </div>



        <div class="container_table">
            <table class="table w-75">
                <thead>
                    <tr class="fs-5">
                        <th scope="col">Type</th>
                        <th scope="col">Projects</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($types as $type)
                        <tr>
                            <td>{{ $type->name }}</td>

                            <td>
                                <ul class="list-unstyled list-group">
                                    @foreach ($type->projects as $project)
                                        <li class="list-group-item "><a href="{{ route('admin.projects.show', $project) }}"> {{ $project->id }} - {{ $project->title }}</a></li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
