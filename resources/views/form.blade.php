@extends('mainlayout')
@section('content')           
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Form Peserta
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

                <form method="POST" action="{{ route('form-peserta-store') }}">
                    @csrf
                    <div class="mb-3">
                    <label  class="form-label">Nama</label>
                        <input value="{{ old('nama') }}" type="text" class="form-control" name="nama" minlength="5" required autofocus>
                    </div>                        
                    <div class="mb-3">
                    <label  class="form-label">Alamat</label>
                        <input value="{{ old('alamat') }}" class="form-control" type="text" name="alamat" required>
                    </div>       
                            
                    <div class="mb-3">
                    <label  class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan">{{ old('keterangan') }}</textarea>
                    </div>                      
                    <div class="mb-3">
                        <button class="btn btn-sm btn-success" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>            
@endsection