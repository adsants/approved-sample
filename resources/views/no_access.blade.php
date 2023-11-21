@extends('mainlayout')
@section('content')    

    <div class="col"></div>
    <div class="col">       
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                Message Page
                <a href="{{ route('logout') }}"><span class="btn btn-sm btn-warning">Logout</span></a>
            </div>
            <div class="card-body">
                You don't have access this page.
            </div>
        </div>
    </div>            
    </div>           
    <div class="col"></div>  
@endsection