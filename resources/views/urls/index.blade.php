@extends('sample')

@section('main_content')

    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Сайты</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Последняя проверка</th>
                        <th>Код ответа</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($urls as $url)
                        <tr>
                            <td>{{ $url->id }}</td>
                            <td><a href="{{ route('urls.show', [$url->id]) }}"/>{{ $url->name }}</a></td>
                            <td>{{ optional($lastChecks[$url->id]->get($url->id))->created_at }}</td>
                            <td>{{ optional($lastChecks[$url->id]->get($url->id))->status_code }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div>
                    {{ $urls->links('vendor/pagination/bootstrap-5') }}
                </div>
            </div>
        </div>
        </div>
    </main>
@endsection
