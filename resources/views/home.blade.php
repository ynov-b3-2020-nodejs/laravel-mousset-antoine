@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tableau de bord</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

             Tu es bien connecté,
                    accède a ton profil </br>
                        <button type="button" class="btn btn-dark"><a href="{{ route('profil') }}">Accéder </a></button>

</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
