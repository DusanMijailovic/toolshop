@extends('layouts.admin')

@section('title')
    Log - Admin panel
@endsection

@section('content')

    <i class="fas fa-table"></i>
    Logovi Tabela </div>
    <div class="container-fluid">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <th>ID</th>
                    <th>Log</th>
                    <th>Date</th>
                    </thead>
                    <tbody class="category-table">
                    @foreach($logs as $log)

                        <tr>
                            <td>{{ $log->logID }}</td>
                            <td>{{ $log->log }}</td>
                            <td>{{ $log->date }}</td>


                        </tr>

                    @endforeach
                    {{ $logs->links() }}
                    </tbody>
                </table>


            </div>
        </div>
    </div>
    </div>
    </div>

    </div>
    </div>


    </div>
    </div>

@endsection

