@extends('mainlayout')
@section('content')
           
    <div class="col"></div>
    <div class="col">
        <div class="card">
            <div class="card-header">Form Login</div>
            <div class="card-body">
            @if ( session()->has('error') )
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        {!! session('error') !!}
                    </div>
                </div>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control"  value="{{ old('email') }}"  name="email" required autofocus>
                </div>                        
                <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                    <input class="form-control" id="password" type="password" name="password" required>
                </div>                        
                <div class="mb-3">
                    <button class="btn btn-sm btn-success" type="submit">Login</button>
                </div>
            </form>
            </div>
        </div>
    </div>            
    <div class="col"></div>
    
@endsection