<x-layouts.data-layout>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Business Analytics Dashboard — Revamp</title>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <style>
    :root{
      --bg:#F7F8FA;
      --surface:#FFFFFF;
      --muted:#6B7280;
      --text:#0F1724;
      --accent-1:#4F46E5; /* Indigo */
      --accent-2:#06B6D4; /* Cyan */
      --accent-3:#F59E0B; /* Amber */
      --card-radius:12px;
      --card-shadow: 0 10px 30px rgba(12,17,24,0.06);
      --glass: linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.85));
      --label-bg: rgba(15,23,36,0.04);
      --grid-line: rgba(15,23,36,0.06);
      --font-sans: -apple-system, BlinkMacSystemFont, 'Inter', 'SF Pro Display', Helvetica, Arial, sans-serif;
    }

    /* Page baseline */
    html,body{height:100%;margin:0;background:var(--bg);font-family:var(--font-sans);color:var(--text);-webkit-font-smoothing:antialiased}
    .container{max-width:1200px;margin:0 auto;padding:32px}

    header.top{
      background:var(--surface);
      padding:36px 28px;border-radius:12px;margin-bottom:20px;box-shadow:var(--card-shadow);display:flex;align-items:center;justify-content:space-between;gap:20px
    }
    header .title{font-size:1.5rem;font-weight:800;letter-spacing:-0.02em}
    header .subtitle{color:var(--muted);font-size:0.95rem}

    /* KPI row */
    .kpis{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin:18px 0}
    .kpi{background:var(--surface);padding:20px;border-radius:12px;box-shadow:var(--card-shadow);border-left:6px solid var(--grid-line);transition:transform .18s ease}
    .kpi:hover{transform:translateY(-6px)}
    .kpi .label{font-size:0.75rem;color:var(--muted);text-transform:uppercase;letter-spacing:0.06em}
    .kpi .value{font-size:1.75rem;font-weight:700;margin-top:6px}

    /* Panels used for charts */
    .panel{background:var(--surface);border-radius:var(--card-radius);padding:18px;box-shadow:var(--card-shadow);}
    .panel h3{margin:0 0 12px;font-size:1.125rem;color:var(--accent-1)}
    .panel .controls{display:flex;gap:8px}
    .btn-toggle{padding:6px 10px;border-radius:8px;border:1px solid rgba(15,23,36,0.06);background:transparent;font-weight:700;cursor:pointer}
    .btn-toggle.active{background:var(--accent-1);color:#fff;border-color:transparent;box-shadow:0 6px 18px rgba(79,70,229,0.14)}

    /* Chart boxes preserve original heights exactly as requested */
    #topSellingChart{height:420px}
    #topCustomersChart{height:420px}
    #funnelChart{height:420px}
    #monthlyRevenueChart{height:420px}
    #monthlyOrdersChart{height:420px}
    #chartOrdersFrequency{height:420px}
    #chartUniqueCustomers{height:420px}
    #chartRepurchaseRate{height:420px}

    /* Small helpers */
    .muted-pill{display:inline-block;background:var(--label-bg);padding:6px 10px;border-radius:999px;font-weight:700;color:var(--muted);font-size:0.75rem}

    /* Mobile responsiveness */
    @media (max-width:980px){
      .kpis{grid-template-columns:repeat(2,1fr)}
      .container{padding:18px}
    }
    @media (max-width:600px){
      .kpis{grid-template-columns:1fr}
    }

    /* ApexCharts tweaks (target internal classes for a crisper look) */
    .apexcharts-canvas text{font-family:var(--font-sans)}
    .apexcharts-tooltip{border-radius:10px}
  </style>
</head>
<body>
  <div class="container">
    <header class="top">
      <div>
        <div class="title">Business Analytics Dashboard</div>
        <div class="subtitle">Sleek • Vibrant • Professional — charts that pop</div>
      </div>
      <div style="text-align:right">
        <div class="muted-pill">Updated: {{ now()->format('F j, Y') }}</div>
      </div>
    </header>

    <!-- KPI cards -->
    <section class="kpis">
      <div class="kpi" style="border-left-color:var(--accent-3)">
        <div class="label">Total Quantity Sold</div>
        <div class="value">{{ $totalQuantity }}</div>
      </div>

      <div class="kpi" style="border-left-color:var(--accent-1)">
        <div class="label">Total Revenue</div>
        <div class="value">${{ number_format($totalRevenueValue, 2) }}</div>
      </div>

      <div class="kpi" style="border-left-color:var(--accent-2)">
        <div class="label">Average Quantity / Product</div>
        <div class="value">{{ number_format($averageQuantity, 2) }}</div>
      </div>

      <div class="kpi" style="border-left-color:rgba(15,23,36,0.9)">
        <div class="label">Average Revenue / Product</div>
        <div class="value">${{ number_format($averageRevenue, 2) }}</div>
      </div>
    </section>

    <!-- Key highlights -->
    <section class="panel" style="margin-bottom:22px">
      <h3>Key Highlights</h3>
      <div style="display:flex;gap:18px;flex-wrap:wrap">
        <div style="min-width:220px">
          <div class="muted-pill" style="background:rgba(243,156,18,0.12);color:var(--accent-3)">Top Product (Qty)</div>
          <div style="font-weight:700;margin-top:8px">{{ $topByQuantity->title ?? 'No data' }}<span style="color:var(--muted);font-weight:500">({{ $topByQuantity->total_quantity ?? 0 }})</span></div>
        </div>
        <div style="min-width:220px">
          <div class="muted-pill" style="background:rgba(79,70,229,0.06);color:var(--accent-1)">Top Product (Revenue)</div>
          <div style="font-weight:700;margin-top:8px">{{ $topByRevenue->title ?? 'No data' }}<span style="color:var(--muted);font-weight:500">({{ number_format($topByRevenue->total_revenue ?? 0, 2) }})</span></div>
        </div>
        <div style="min-width:220px">
          <div class="muted-pill" style="background:rgba(6,182,212,0.08);color:var(--accent-2)">Top Customer</div>
          <div style="font-weight:700;margin-top:8px">{{ $topCustomers->first()->name ?? 'No data' }}<span style="color:var(--muted);font-weight:500">({{ number_format($topCustomers->first()->total_spent ?? 0, 2) }})</span></div>
        </div>
      </div>

      <div style="margin-top:18px;text-align:right">
        <a href="{{ route('data.analytics.printable') }}" target="_blank" class="btn-toggle" style="border-radius:8px;padding:10px 14px;background:var(--accent-1);color:#fff;">🖨️ Download Printable</a>
      </div>
    </section>

    <!-- Charts grid: keep the same heights and bar types as requested -->
    <div style="display:grid;grid-template-columns:1fr;gap:24px">

      <!-- Top Selling -->
      <div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
          <h3 style="margin:0">Top-Selling Products</h3>
          <div class="controls">
            <button id="showQuantity" class="btn-toggle">Quantity</button>
            <button id="showRevenue" class="btn-toggle">Revenue</button>
          </div>
        </div>
        <div class="panel">
          <div id="topSellingChart"></div>
        </div>
      </div>

      <!-- Top Customers -->
      <div>
        <h3 style="margin-bottom:12px">Top Customers by Spending</h3>
        <div class="panel"><div id="topCustomersChart"></div></div>
      </div>

      <!-- Repeat Buyers -->
      <div>
        <h3 style="margin-bottom:12px">Repeat Buyers (by Orders)</h3>
        <div class="panel"><div id="funnelChart"></div></div>
      </div>

      <!-- Monthly Revenue -->
      <div>
        <h3 style="margin-bottom:12px">Monthly Revenue Performance</h3>
        <div class="panel"><div id="monthlyRevenueChart"></div></div>
      </div>

      <!-- Monthly Orders -->
      <div>
        <h3 style="margin-bottom:12px">Monthly Order Volume Trend</h3>
        <div class="panel"><div id="monthlyOrdersChart"></div></div>
      </div>

      <!-- Product Purchase Frequency -->
      <div>
        <h3 style="margin-bottom:12px">Product Purchase Frequency Analysis</h3>
        <div style="display:grid;grid-template-columns:1fr;gap:18px">
          <div class="panel"><h4 style="margin-top:0;margin-bottom:12px">Top by Number of Orders Appeared In</h4><div id="chartOrdersFrequency"></div></div>
          <div class="panel"><h4 style="margin-top:0;margin-bottom:12px">Top by Number of Unique Customers</h4><div id="chartUniqueCustomers"></div></div>
          <div class="panel"><h4 style="margin-top:0;margin-bottom:12px">Top by Re-purchase Rate (%)</h4><div id="chartRepurchaseRate"></div></div>
        </div>
      </div>

    </div>

  </div>

  <!-- SCRIPT: ApexCharts configuration. Keeps bars (no line changes), preserves all container heights exactly. -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // server data (kept unchanged)
      const labels = {!! json_encode($topProducts->pluck('title')) !!};
      const quantityData = {!! json_encode($topProducts->pluck('total_quantity')) !!};
      const revenueData = {!! json_encode($topProducts->pluck('total_revenue')) !!};
      const customerLabels = {!! json_encode($topCustomers->pluck('name')) !!};
      const customerSpending = {!! json_encode($topCustomers->pluck('total_spent')) !!};
      const buyerLabels = {!! json_encode($repeatedBuyers->pluck('name')) !!};
      const buyerOrders = {!! json_encode($repeatedBuyers->pluck('orders_count')) !!};
      const monthlyLabels = {!! json_encode($monthlyRevenue->pluck('month_name')) !!};
      const monthlyValues = {!! json_encode($monthlyRevenue->pluck('revenue')) !!};
      const orderLabels = {!! json_encode($monthlyOrders->pluck('month')) !!};
      const orderCounts = {!! json_encode($monthlyOrders->pluck('total_orders')) !!};
      const productsByOrderFrequencyLabels = {!! json_encode($productsByOrderFrequency->pluck('title')) !!};
      const productsByOrderFrequencyData = {!! json_encode($productsByOrderFrequency->pluck('orders_count')) !!};
      const productsByUniqueCustomersLabels = {!! json_encode($productsByUniqueCustomers->pluck('title')) !!};
      const productsByUniqueCustomersData = {!! json_encode($productsByUniqueCustomers->pluck('unique_customers')) !!};
      const productsByRepurchaseRateLabels = {!! json_encode($productsByRepurchaseRate->pluck('title')) !!};
      const productsByRepurchaseRateData = {!! json_encode($productsByRepurchaseRate->pluck('repurchase_rate')) !!};

      // new refined palette — pop but professional
      const palette = {
        indigo: '#4F46E5',
        cyan: '#06B6D4',
        amber: '#F59E0B',
        violet: '#8B5CF6',
        green: '#10B981',
        slate: '#334155',
        multi: ['#4F46E5','#06B6D4','#F59E0B','#8B5CF6','#10B981','#FB7185']
      };

      const common = {
        chart: { toolbar: { show: false }, animations: { enabled: true, easing: 'easeout', speed: 600 } },
        theme: { mode: 'light' },
        stroke: { width: 0 },
        grid: { borderColor: getComputedStyle(document.documentElement).getPropertyValue('--grid-line') || 'rgba(15,23,36,0.06)', padding: { left: 8, right: 8 } },
        tooltip: { theme: 'light', style: { fontSize: '13px' } },
        dataLabels: { enabled: true, style: { fontSize: '12px', fontWeight: 700 } },
      };

      // helper for number formatting
      const fmt = (n, isCurrency=false) => {
        if (n === null || typeof n === 'undefined') return '';
        const val = Number(n);
        if (isNaN(val)) return n;
        return isCurrency ? '$' + val.toLocaleString(undefined, {maximumFractionDigits: 0}) : val.toLocaleString();
      };

      // -------- Top Selling (horizontal bar) --------
      const topSelling = new ApexCharts(document.querySelector('#topSellingChart'), Object.assign({}, common, {
        chart: { type: 'bar', height: 350 },
        series: [{ name: 'Quantity Sold', data: quantityData }],
        plotOptions: { bar: { horizontal: true, distributed: false, borderRadius: 8, barHeight: '62%' } },
        xaxis: { categories: labels, labels: { style: { colors: '#111827' } } },
        fill: { type: 'gradient', gradient: { shade: 'light', type: 'horizontal', shadeIntensity: 0.3, gradientToColors: [palette.cyan], stops: [0,100] }, colors: [palette.indigo] },
        colors: [palette.indigo],
        dataLabels: { enabled: true, formatter: (val) => fmt(val, false), style: { colors: ['#fff'] }, offsetX: 6 },
        tooltip: { y: { formatter: val => fmt(val, false) } }
      }));
      topSelling.render();

      // Toggle buttons
      const qBtn = document.getElementById('showQuantity');
      const rBtn = document.getElementById('showRevenue');
      const setActive = (activeBtn) => {
        [qBtn,rBtn].forEach(b=>b.classList.remove('active'));
        activeBtn.classList.add('active');
      };
      qBtn?.addEventListener('click', () => {
        topSelling.updateOptions({ series: [{ name: 'Quantity Sold', data: quantityData }], fill:{ colors:[palette.indigo] }, dataLabels:{ formatter: v => fmt(v,false) } });
        setActive(qBtn);
      });
      rBtn?.addEventListener('click', () => {
        topSelling.updateOptions({ series: [{ name: 'Revenue ($)', data: revenueData }], fill:{ colors:[palette.amber] }, dataLabels:{ formatter: v => '$' + Number(v).toLocaleString() } });
        setActive(rBtn);
      });
      // default active
      setActive(qBtn);

      // -------- Top Customers (horizontal) --------
      new ApexCharts(document.querySelector('#topCustomersChart'), Object.assign({}, common, {
        chart:{ type:'bar', height:350 },
        series:[{ name:'Total Spending', data: customerSpending }],
        plotOptions:{ bar:{ horizontal:true, borderRadius:8, barHeight:'60%' } },
        xaxis:{ categories: customerLabels },
        fill:{ type:'gradient', gradient:{ shade:'light', gradientToColors:[palette.cyan] } },
        colors: [palette.cyan],
        dataLabels:{ enabled:true, formatter: v => '$' + Number(v).toLocaleString(), style:{ colors:['#fff'] }, offsetX:6 },
        tooltip:{ y:{ formatter: v => '$' + Number(v).toLocaleString() } }
      })).render();

      // -------- Repeat Buyers (horizontal, distributed colors) --------
      const buyers = buyerLabels.map((n,i) => ({ name:n, val: buyerOrders[i] }));
      buyers.sort((a,b)=> b.val - a.val);
      new ApexCharts(document.querySelector('#funnelChart'), Object.assign({}, common, {
        chart:{ type:'bar', height:350 },
        series:[{ name:'Orders Count', data: buyers.map(b=>b.val) }],
        plotOptions:{ bar:{ horizontal:true, distributed:true, borderRadius:8, barHeight:'62%' } },
        xaxis:{ categories: buyers.map(b=>b.name), labels:{ show:false } },
        colors: palette.multi,
        dataLabels:{ enabled:true, formatter: v => fmt(v,false), offsetX: -10, style:{ colors:['#fff'] } },
        legend:{ show:false }
      })).render();

      // -------- Monthly Revenue (vertical bar, distributed) --------
      new ApexCharts(document.querySelector('#monthlyRevenueChart'), Object.assign({}, common, {
        chart:{ type:'bar', height:450 },
        series:[{ name:'Revenue ($)', data: monthlyValues }],
        plotOptions:{ bar:{ horizontal:false, columnWidth:'56%', borderRadius:6 } },
        xaxis:{ categories: monthlyLabels },
        colors: palette.multi,
        dataLabels:{ enabled:true, formatter: v => '$' + Number(v).toLocaleString(), style:{ colors:['#fff'] } },
        tooltip:{ y:{ formatter: v => '$' + Number(v).toLocaleString() } }
      })).render();

      // -------- Monthly Orders (horizontal) --------
      new ApexCharts(document.querySelector('#monthlyOrdersChart'), Object.assign({}, common, {
        chart:{ type:'bar', height:450 },
        series:[{ name:'Orders', data: orderCounts }],
        plotOptions:{ bar:{ horizontal:true, borderRadius:8, barHeight:'56%' } },
        xaxis:{ categories: orderLabels },
        colors: palette.multi.slice().reverse(),
        dataLabels:{ enabled:true, formatter: v => fmt(v,false), style:{ colors:['#fff'] } },
        tooltip:{ y:{ formatter: v => fmt(v,false) } }
      })).render();

      // -------- Product purchase frequency trio (horizontal) --------
      const trio = [
        { id: 'chartOrdersFrequency', labels: productsByOrderFrequencyLabels, data: productsByOrderFrequencyData, color: palette.violet, fmt: v => fmt(v,false) },
        { id: 'chartUniqueCustomers', labels: productsByUniqueCustomersLabels, data: productsByUniqueCustomersData, color: palette.green, fmt: v => fmt(v,false) },
        { id: 'chartRepurchaseRate', labels: productsByRepurchaseRateLabels, data: productsByRepurchaseRateData.map(r=> Math.round(r*100)/100), color: palette.amber, fmt: v => (Number(v).toFixed(2) + '%') }
      ];

      trio.forEach(item => {
        new ApexCharts(document.querySelector('#'+item.id), Object.assign({}, common, {
          chart:{ type:'bar', height:420 },
          series:[{ name: item.id, data: item.data }],
          plotOptions:{ bar:{ horizontal:true, borderRadius:8, barHeight:'58%' } },
          xaxis:{ categories: item.labels },
          colors: [item.color],
          dataLabels:{ enabled:true, formatter: v => item.fmt(v), style:{ colors:['#fff'] }, offsetX:6 },
          tooltip:{ y:{ formatter: v => item.fmt(v) } }
        })).render();
      });

    });
  </script>
</body>
</html>
</x-layouts.data-layout>
