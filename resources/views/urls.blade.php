@extends('sample')

@section('main_content')
<main class="flex-grow-1">
    <div class="container-lg">
        <h1 class="mt-5 mb-3">Сайты</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <tbody>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Created_at</th>
                </tr>
                @foreach($urls as $url)
                <tr>:
                    <td>{{$url['id']}}</td>
                    <td><a href="/urls/{{$url['id']}}"/>{{$url['name']}}</a></td>
                    <td>{{$url['created_at']}}</td>
                </tr>
                @endforeach
                </tbody></table>

        </div>
    </div>
</main>
@endsection
