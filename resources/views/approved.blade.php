@extends('mainlayout')
@section('content')

    <div class="col-md-12">
        <div class="card rounded">
            <div class="card-header d-flex justify-content-between align-items-center">
                Approved Peserta
                <a href="{{ route('logout') }}"><span class="btn btn-sm btn-warning">Logout</span></a>
            </div>
            <div class="card-body">
                

                @if ( session()->has('success') )
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-success">
                            {!! session('success') !!}
                        </div>
                    </div>
                </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Status</th>
                        <th scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataPesertas as $dataPeserta)
                        <tr>
                            <td>{{ $dataPeserta->nama }}</td>
                            <td>{{ $dataPeserta->alamat }}</td>
                            <td>{{ $dataPeserta->keterangan }}</td>
                            <td>
                                {!! statusHtml($dataPeserta->status_akhir) !!}
                                @if ( $dataPeserta->status_akhir != 'Unprocessed')
                                    <br><a href="" data-bs-toggle="modal" data-bs-target="#modalHistory" data-bs-id="{{ $dataPeserta->id }}">Approval Histori</a>
                                @endif

                            </td>
                            <td class="text-center">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalForm" data-bs-nama="{{ $dataPeserta->nama }}" data-bs-alamat="{{ $dataPeserta->alamat }}" data-bs-keterangan="{{ $dataPeserta->keterangan }}" data-bs-id="{{ $dataPeserta->id }}">Proses</button>
                            </td>
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Peserta belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>  
                {{ $dataPesertas->links() }}
            </div>
        </div>
    </div>


<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form method="POST" action="{{ route('approved-peserta-store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Form Approval</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <input id="id" type="hidden" name="id">
                        <b><span id="nama"></span></b><br>
                        <span id="alamat"></span><br>
                        <span id="keterangan"></span><br>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Status Approval </label>
                        <select class="form-control" required name="status">
                            <option value="">Silahkan Pilih Status</option>
                            <option value="Approved">Approved</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Keterangan Approval</label>
                        <textarea class="form-control" required name="keterangan"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <span class="btn btn-secondary" data-bs-dismiss="modal">Batal</span>
                <button type="submit" class="btn btn-primary">Proses</button>
            </div>
            
            </form>
        </div>
    </div>
</div>


<div class="modal fade modal-lg" id="modalHistory" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-body">
                
            <span id="approvalHistory"></span>
            <span class="btn btn-secondary" data-bs-dismiss="modal">Tutup</span>
            </div>
        </div>
    </div>
</div>

<script>
var modalForm = document.getElementById('modalForm')
modalForm.addEventListener('show.bs.modal', function (event) {
    
    var button      = event.relatedTarget
    var nama        = button.getAttribute('data-bs-nama')
    var alamat      = button.getAttribute('data-bs-alamat')
    var keterangan  = button.getAttribute('data-bs-keterangan')
    var id          = button.getAttribute('data-bs-id')

    $('#alamat').html(alamat);
    $('#nama').html(nama);
    $('#keterangan').html(keterangan);
    $('#id').val(id);
})

var modalHistory = document.getElementById('modalHistory')
modalHistory.addEventListener('show.bs.modal', function (event) {
    
    var button  = event.relatedTarget
    var id      = button.getAttribute('data-bs-id')

    $.ajax({
        url     :   '/history-peserta/'+id,
        type    :   'GET',
        success: function(data){
            $('#approvalHistory').html(data);
        }
    });
})

</script>
    


@endsection