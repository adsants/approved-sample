@extends('mainlayout')
@section('content')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Approval by</th>
                        <th scope="col">Tgl Proses</th>
                        <th scope="col">Status</th>
                        <th scope="col">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataHistorys as $dataHistory)
                        <tr>
                            <td>{{ $dataHistory->created_by_name }}</td>
                            <td>{{ $dataHistory->created_at }}</td>
                            <td>{{ $dataHistory->status }}</td>
                            <td>{{ $dataHistory->keterangan }}</td>
                            
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data History belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>  
         

@endsection