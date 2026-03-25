<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoShop API</title>
    <style>
        :root {
            color-scheme: light dark;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            background: linear-gradient(120deg, #0f766e, #115e59);
            color: #f8fafc;
        }

        .card {
            width: min(680px, 92vw);
            background: rgba(15, 23, 42, 0.65);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 25px 60px rgba(2, 6, 23, 0.45);
            backdrop-filter: blur(8px);
        }

        h1 {
            margin-top: 0;
            font-size: clamp(1.8rem, 4vw, 2.3rem);
        }

        p {
            line-height: 1.55;
            opacity: 0.95;
        }

        .links {
            display: flex;
            flex-wrap: wrap;
            gap: .75rem;
            margin-top: 1.5rem;
        }

        a {
            color: #f8fafc;
            text-decoration: none;
            padding: .6rem .9rem;
            border-radius: 999px;
            border: 1px solid rgba(248, 250, 252, 0.35);
        }

        a:hover {
            background: rgba(248, 250, 252, 0.12);
        }

        code {
            font-size: .95rem;
            background: rgba(15, 23, 42, 0.6);
            padding: .1rem .35rem;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<main class="card">
    <h1>EcoShop API est prête ✅</h1>
    <p>
        L'API e-commerce fonctionne avec Laravel + Sanctum.
        Point d'entrée principal: <code>/api/v1</code>.
    </p>
    <div class="links">
        <a href="/up">Healthcheck</a>
        <a href="/api/v1/products">Produits (API)</a>
    </div>
</main>
</body>
</html>
