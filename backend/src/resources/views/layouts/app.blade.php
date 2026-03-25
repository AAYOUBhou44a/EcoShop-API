<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'EcoShop')</title>
    <style>
        :root { font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif; }
        * { box-sizing: border-box; }
        body { margin: 0; background: #f8fafc; color: #0f172a; }
        header { background: #0f766e; color: #fff; padding: 1rem 1.5rem; }
        nav { display: flex; flex-wrap: wrap; gap: .75rem; margin-top: .5rem; }
        nav a { color: #fff; text-decoration: none; padding: .35rem .65rem; border: 1px solid rgba(255,255,255,.35); border-radius: 999px; }
        main { max-width: 980px; margin: 2rem auto; padding: 0 1rem; }
        .card { background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 1rem; margin-bottom: 1rem; }
        footer { padding: 1rem; text-align: center; color: #475569; }
    </style>
</head>
<body>
<header>
    <h1 style="margin:0;">EcoShop</h1>
    <nav>
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('products') }}">Produits</a>
        <a href="{{ route('categories') }}">Catégories</a>
        <a href="{{ route('cart') }}">Panier</a>
        <a href="{{ route('contact') }}">Contact</a>
    </nav>
</header>
<main>
    @yield('content')
</main>
<footer>EcoShop API &copy; {{ date('Y') }}</footer>
</body>
</html>
