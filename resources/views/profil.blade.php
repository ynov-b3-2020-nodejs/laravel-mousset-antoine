@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="title m-b-md">
                    Bienvenue sur ton profil: <br> {{ Auth::user()->name }}<br><br>
                    Ton adresse mail est :<br> {{ Auth::user()->email }}<br><br>
                    Date de création du compte :<br> {{ Auth::user()->created_at }}<br><br>
                   Ton mdp est (crypté bien sur)  :<br> {{ Auth::user()->password }}

                </div>
            </br>
                </br>
                <a type="text"><a href="/products"> Accéder au produits</a></a>


                <div>

                </div>
            </div>
        </div>
@endsection
