<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sleek Minimalist Report</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap');

        /* 🌸 SOFT MODERN MINIMALIST STYLES 🌸 */
        :root {
            /* Color Palette (Muted Pastels, Geometric Focus) */
            --bg-color: #F8F8F8; /* Ultra-light background */
            --container-bg: #FFFFFF;

            /* Muted Pastel Focus Colors */
            --accent-primary: #5D6D7E; /* Deep Slate Gray-Blue (Revenue/Primary Action) */
            --accent-secondary: #F39C12; /* Muted Saffron Yellow (Quantity/Success) */
            --accent-tertiary: #5499C7; /* Dusty Sky Blue (Accent/Warning) */

            /* Text & Structure */
            --text-color-light: #606060; /* Darker gray secondary text */
            --text-color-dark: #333333; /* Near Black primary text */
            --header-color: #222222; /* Deepest tone for bold headings */
            --border-color: #E0E0E0; /* Light border color */
            --box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05); /* Very subtle shadow */
            --border-radius: 0px; /* SHARP, GEOMETRIC CORNERS */
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 40px 20px;
            background-color: var(--bg-color);
            color: var(--text-color-light);
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: var(--container-bg);
            padding: 40px 50px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            border: 1px solid var(--border-color); /* Added border for definition with 0 radius */
        }

        h1, h2, h3 {
            font-family: 'Poppins', sans-serif;
            color: var(--header-color);
            font-weight: 700; /* Bold headings */
            margin: 0 0 24px;
        }

        h1 {
            font-size: 2.5rem;
            text-align: center;
            padding-bottom: 20px;
            /* Changed accent line color to Slate Gray-Blue */
            border-bottom: 3px solid var(--accent-primary);
            margin-bottom: 35px;
        }

        h2 {
            font-size: 1.75rem;
            font-weight: 600;
            margin-top: 50px;
            margin-bottom: 25px;
            color: var(--text-color-dark);
            /* Added accent bar below H2 for geometric structure */
            border-bottom: 2px solid var(--accent-secondary);
            padding-bottom: 5px;
        }

        h3 {
             color: var(--accent-primary); /* Use a pastel color for subheadings */
             font-weight: 700;
        }

        /* --- Print Button Style (Updated to Primary Pastel) --- */
        .print-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 35px;
            padding: 14px 30px;
            background-color: var(--accent-primary); /* Slate Gray-Blue */
            color: #FFFFFF;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            border-radius: 0; /* SHARP */
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(93, 109, 126, 0.3); /* Shadow matching the new color */
            transition: background-color 0.3s ease, transform 0.2s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .print-btn:hover {
            background-color: #4A5665; /* Slightly darker shade of the primary color */
            transform: translateY(-1px);
        }

        /* --- Summary Cards --- */
        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 25px;
            margin-bottom: 50px;
        }

        .summary-card {
            background-color: var(--container-bg);
            border: 1px solid var(--border-color);
            padding: 25px;
            border-radius: 0; /* SHARP */
            text-align: left;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            /* Added a thick left border for a sleek, modern touch */
            border-left: 6px solid var(--accent-primary);
        }

        /* Reset card border for other colors */
        .summary-card:nth-child(1) { border-left-color: var(--accent-secondary); }
        .summary-card:nth-child(2) { border-left-color: var(--accent-primary); }
        .summary-card:nth-child(3) { border-left-color: var(--accent-tertiary); }
        .summary-card:nth-child(4) { border-left-color: var(--text-color-light); }


        .summary-card h4 {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-color-light);
            margin: 0 0 10px;
            text-transform: uppercase;
        }

        .summary-card p {
            font-family: 'Poppins', sans-serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--header-color);
            margin: 0;
            line-height: 1.2;
        }

        /* Specific card color coding for clarity */
        .summary-card:nth-child(2) p { color: var(--accent-primary); }
        .summary-card:nth-child(1) p { color: var(--accent-secondary); }


        /* --- Highlights List (Updated to Geometric) --- */
        .highlights-list {
            list-style: none;
            padding: 0;
            margin-bottom: 50px;
            border: 1px solid var(--border-color);
            border-radius: 0; /* SHARP */
            overflow: hidden;
        }

        .highlights-list li {
            font-size: 1.05rem;
            padding: 15px 25px;
            background-color: #FFFFFF;
            border-bottom: 1px solid var(--border-color);
            display: flex;
            align-items: center;
        }

        .highlights-list li:last-child {
            border-bottom: none;
        }

        .highlights-list li strong {
            font-weight: 700;
            color: var(--text-color-dark);
            margin-right: 8px;
        }

        .highlights-list li .value {
            font-weight: 600;
        }

        .highlights-list .highlight-icon {
            margin-right: 15px;
            font-size: 1.5rem;
            line-height: 1;
        }

        /* Updated Icon Colors to match new palette */
        .highlights-list .highlight-icon.blue { color: var(--accent-primary); }
        .highlights-list .highlight-icon.green { color: var(--accent-secondary); }
        .highlights-list .highlight-icon.yellow { color: var(--accent-tertiary); }

        /* --- Report Table (Updated to Geometric) --- */
        .report-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-bottom: 50px;
            border-radius: 0; /* SHARP */
            overflow: hidden;
            box-shadow: 0 4px 10px rgba(0,0,0,0.03);
            border: 1px solid var(--border-color);
        }

        .report-table thead {
            background-color: var(--accent-primary); /* Use Primary Pastel for header */
            color: #FFFFFF;
        }

        .report-table th, .report-table td {
            padding: 16px 20px;
            font-size: 1rem;
            text-align: left;
        }

        .report-table th {
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .report-table tbody tr {
            background-color: var(--container-bg);
            transition: background-color 0.2s ease;
        }

        .report-table tbody tr:nth-child(even) {
            background-color: var(--bg-color);
        }

        .report-table tbody tr:hover {
            background-color: #EFF5F8; /* Very light, cool hover effect */
            color: var(--text-color-dark);
        }

        .report-table td {
            color: var(--text-color-dark);
        }

        /* Print-specific styles */
        @media print {
            body { background-color: #FFFFFF; padding: 0; }
            .container { box-shadow: none; padding: 0; margin: 0; border: none; }
            .print-btn { display: none; }
            .report-table, .report-table th, .report-table td {
                border-color: #ddd;
                color: #000;
            }
            .report-table thead { background-color: #e8e8e8 !important; color: #000 !important; -webkit-print-color-adjust: exact; }
            .report-table tbody tr:hover, .report-table tbody tr:nth-child(even) {
                background-color: #f9f9f9 !important; -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <button class="print-btn" onclick="window.print()">
        <span style="margin-right: 8px;">🖨️</span> DOWNLOAD & PRINT REPORT
    </button>

    <h1>Business Performance Report</h1>
    <p style="font-size: 1rem; text-align: center; color: var(--text-color-light); margin-bottom: 40px; font-weight: 500;">
        Comprehensive data overview generated on <strong style="color: var(--text-color-dark);">{{ now()->format('F j, Y') }}</strong>
    </p>

    <h2>Summary Metrics</h2>
    <div class="summary-grid">
        <div class="summary-card">
            <h4>Total Quantity Sold</h4>
            <p>{{ $totalQuantity }}</p>
        </div>
        <div class="summary-card">
            <h4>Total Revenue</h4>
            <p>${{ number_format($totalRevenueValue, 2) }}</p>
        </div>
        <div class="summary-card">
            <h4>Average Quantity / Product</h4>
            <p>{{ $averageQuantity }}</p>
        </div>
        <div class="summary-card">
            <h4>Average Revenue / Product</h4>
            <p>${{ number_format($averageRevenue, 2) }}</p>
        </div>
    </div>

    <h2>🏆 Key Performance Highlights</h2>
    <ul class="highlights-list">
        <li>
            <span class="highlight-icon blue">📦</span>
            <strong>Top Product by Quantity:</strong> <span class="value">{{ $topByQuantity->title }}</span> ({{ $topByQuantity->total_quantity }} units)
        </li>
        <li>
            <span class="highlight-icon green">💲</span>
            <strong>Top Product by Revenue:</strong> <span class="value">{{ $topByRevenue->title }}</span> (${{ number_format($topByRevenue->total_revenue, 2) }})
        </li>
        <li>
            <span class="highlight-icon yellow">🤝</span>
            <strong>Top Customer:</strong> <span class="value">{{ $topCustomers->first()->name }}</span> (Spent ${{ number_format($topCustomers->first()->total_spent, 2) }})
        </li>
    </ul>

    <h2>📈 Product Performance</h2>
    <table class="report-table">
        <thead>
        <tr>
            <th>Product Title</th>
            <th>Quantity Sold</th>
            <th>Total Revenue</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topProducts as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->total_quantity }}</td>
                <td>${{ number_format($product->total_revenue, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>👤 Customer Loyalty & Spending</h2>
    <table class="report-table">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Total Spent ($)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($topCustomers as $customer)
            <tr>
                <td>{{ $customer->name }}</td>
                <td>{{ number_format($customer->total_spent, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>🔁 Repeated Buyers</h2>
    <table class="report-table">
        <thead>
        <tr>
            <th>Buyer Name</th>
            <th>Number of Orders</th>
        </tr>
        </thead>
        <tbody>
        @foreach($repeatedBuyers as $buyer)
            <tr>
                <td>{{ $buyer->name }}</td>
                <td>{{ $buyer->orders_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>📅 Monthly Financial Trend</h2>
    <table class="report-table">
        <thead>
        <tr>
            <th>Month</th>
            <th>Total Revenue ($)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monthlyRevenue as $month)
            <tr>
                <td>{{ $month->month_name }}</td>
                <td>${{ number_format($month->revenue, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>🗓️ Monthly Order Volume</h2>
    <table class="report-table">
        <thead>
        <tr>
            <th>Month</th>
            <th>Total Orders</th>
        </tr>
        </thead>
        <tbody>
        @foreach($monthlyOrders as $month)
            <tr>
                <td>{{ $month->month }}</td>
                <td>{{ $month->total_orders }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2>📊 Product Purchase Frequency Analysis</h2>

    <h3 style="font-size: 1.35rem; color: var(--text-color-dark); font-weight: 600; margin-top: 30px; margin-bottom: 15px;">- By Number of Orders Appeared In</h3>
    <table class="report-table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Number of Orders</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productsByOrderFrequency as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->orders_count }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 style="font-size: 1.35rem; color: var(--text-color-dark); font-weight: 600; margin-top: 30px; margin-bottom: 15px;">- By Number of Unique Customers</h3>
    <table class="report-table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Unique Customers</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productsByUniqueCustomers as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->unique_customers }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h3 style="font-size: 1.35rem; color: var(--text-color-dark); font-weight: 600; margin-top: 30px; margin-bottom: 15px;">- By Re-purchase Rate (%)</h3>
    <table class="report-table">
        <thead>
        <tr>
            <th>Product</th>
            <th>Re-purchase Rate (%)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($productsByRepurchaseRate as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ number_format($product->repurchase_rate, 2) }}%</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
