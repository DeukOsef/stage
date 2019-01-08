@extends('layouts.layoutPrincipal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Connection</div>
                    <div class="card-body">
                        <form method="POST" action="{{url('/login')}}">
                            @csrf
                            @if(session('errPwd'))
                                <div class="form-group row">
                                    <label class="col-sm-12 col-form-label text-md-center"style="color: red"><b>{{session('errPwd')}}</b></label>
                                </div>
                            @endif

                            <div class="form-group row">
                                <label for="login" class="col-sm-4 col-form-label text-md-right">Login</label>

                                <div class="col-md-6">
                                    <input id="login" type="login" class="form-control" name="login" value="{{ old('login') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Connection
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
