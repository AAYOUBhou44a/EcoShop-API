@extends('layouts.app')

@section('title', 'Accueil - EcoShop')

@section('content')
    <section class="card">
        <h2>Bienvenue sur EcoShop</h2>
        <p>Le site est maintenant servi côté web et l'API reste disponible sous <strong>/api/v1</strong>.</p>
        <p>Teste aussi le healthcheck via <a href="/up">/up</a>.</p>
    </section>
@endsection
