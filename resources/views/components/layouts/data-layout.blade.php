<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Analytics</title>
    <style>
        /* Base Typography & Reset */
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'Inter', sans-serif;
            background-color: #f9f9f9;
            color: #1d1d1f;
            -webkit-font-smoothing: antialiased;
        }

        a {
            text-decoration: none;
        }

        /* NAVBAR */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: #fff;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar h1 {
            margin: 0;
            font-size: 1.6rem;
            font-weight: 700;
            color: #007aff;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Logout Button */
        .logout-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.5rem 1rem;
            background: #ff3b30;
            color: #fff;
            font-weight: 600;
            font-size: 0.9rem;
            border-radius: 0.6rem;
            box-shadow: 0 3px 8px rgba(255,59,48,0.3);
            transition: all 0.25s ease;
        }

        .logout-btn:hover {
            background: #e03128;
            box-shadow: 0 5px 15px rgba(255,59,48,0.35);
            transform: translateY(-2px);
        }

        /* Main Content */
        main {
            padding: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Footer */
        footer {
            background-color: #f2f2f2;
            text-align: center;
            padding: 1.5rem 0;
            font-size: 0.875rem;
            color: #6e6e73;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <h1>📊 Data Analytics</h1>
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </nav>

    <!-- Main Dashboard Slot -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer>
        &copy; {{ date('Y') }} Analytics Dashboard
    </footer>

    <!-- Hidden logout form for Laravel -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
        @csrf
    </form>

</body>
</html>
