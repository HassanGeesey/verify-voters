<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results - Zamzam University</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --success: #059669;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
            --radius: 16px;
            --radius-sm: 10px;
            --chairperson: #7c3aed;
            --chairperson-light: #a78bfa;
            --vice: #0891b2;
            --vice-light: #22d3ee;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            line-height: 1.5;
            min-height: 100vh;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 20px 0;
        }

        .header-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 44px;
            height: 44px;
            background: rgba(255,255,255,0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .logo-text h1 {
            font-size: 1.125rem;
            font-weight: 700;
            margin: 0;
        }

        .logo-text p {
            font-size: 0.8125rem;
            opacity: 0.85;
            margin: 0;
        }

        .live-indicator {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.15);
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.875rem;
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Main */
        .main {
            padding: 32px 0;
        }

        /* Grid */
        .grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 24px;
        }

        @media (max-width: 992px) {
            .grid { grid-template-columns: 1fr; }
        }

        /* Card */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header.chairperson {
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.08), rgba(124, 58, 237, 0.02));
        }

        .card-header.vice {
            background: linear-gradient(135deg, rgba(8, 145, 178, 0.08), rgba(8, 145, 178, 0.02));
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.125rem;
        }

        .card-header.chairperson .card-icon {
            background: var(--chairperson);
            color: white;
        }

        .card-header.vice .card-icon {
            background: var(--vice);
            color: white;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
        }

        .card-subtitle {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin: 0;
        }

        .card-body {
            padding: 24px;
        }

        /* Chart */
        .chart-wrap {
            height: 200px;
            margin-bottom: 24px;
        }

        /* Leaderboard */
        .list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .list-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            background: var(--bg);
            border-radius: var(--radius-sm);
        }

        .rank {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            flex-shrink: 0;
        }

        .rank-1 { background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; }
        .rank-2 { background: linear-gradient(135deg, #9ca3af, #6b7280); color: white; }
        .rank-3 { background: linear-gradient(135deg, #d97706, #b45309); color: white; }
        .rank-default { background: var(--border); color: var(--text-muted); }

        .info {
            flex: 1;
            min-width: 0;
        }

        .name {
            font-weight: 600;
            font-size: 0.9375rem;
            margin: 0;
        }

        .bar {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .bar-fill.chairperson { background: var(--chairperson); }
        .bar-fill.vice { background: var(--vice); }

        .votes {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.125rem;
            font-weight: 700;
            min-width: 40px;
            text-align: right;
        }

        .chairperson .votes { color: var(--chairperson); }
        .vice .votes { color: var(--vice); }

        /* Empty */
        .empty {
            text-align: center;
            padding: 32px;
            color: var(--text-muted);
        }

        .empty i {
            font-size: 2rem;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-inner {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="logo-text">
                        <h1>DOORASHADA JAAMACADA ZAMZAM</h1>
                        <p>Live Results</p>
                    </div>
                </div>
                <div class="live-indicator">
                    <span class="live-dot"></span>
                    <span id="totalVotes">0</span> Total Votes
                </div>
            </div>
        </div>
    </header>

    <main class="main">
        <div class="container">
            <div class="grid">
                <!-- Chairperson -->
                <div class="card">
                    <div class="card-header chairperson">
                        <div class="card-icon">
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div>
                            <h2 class="card-title">Chairperson</h2>
                            <p class="card-subtitle">Guddiga Madaxda</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrap">
                            <canvas id="chairpersonChart"></canvas>
                        </div>
                        <div id="leaderboardChairperson" class="list"></div>
                    </div>
                </div>

                <!-- Vice-Chairperson -->
                <div class="card">
                    <div class="card-header vice">
                        <div class="card-icon">
                            <i class="bi bi-star"></i>
                        </div>
                        <div>
                            <h2 class="card-title">Vice-Chairperson</h2>
                            <p class="card-subtitle">Guddiga Madaxda ee Ku Xiga</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-wrap">
                            <canvas id="viceChairpersonChart"></canvas>
                        </div>
                        <div id="leaderboardViceChairperson" class="list"></div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chairChart, viceChart;

        async function api(url) {
            const res = await fetch(url);
            return res.json();
        }

        async function load() {
            const data = await api('api.php?action=all_candidates');
            const chairs = data.candidates.filter(c => c.type === 'Chairperson');
            const vices = data.candidates.filter(c => c.type === 'Vice-Chairperson');

            document.getElementById('totalVotes').textContent = data.candidates.reduce((s, c) => s + parseInt(c.vote_count), 0);

            renderList(chairs, 'leaderboardChairperson', 'chairperson');
            renderList(vices, 'leaderboardViceChairperson', 'vice');
            updateCharts(chairs, vices);
        }

        function renderList(candidates, id, type) {
            const el = document.getElementById(id);
            const sorted = [...candidates].sort((a, b) => b.vote_count - a.vote_count);
            const max = sorted[0]?.vote_count || 0;

            if (sorted.length === 0) {
                el.innerHTML = '<div class="empty"><i class="bi bi-people"></i><p>No candidates</p></div>';
                return;
            }

            el.innerHTML = sorted.map((c, i) => {
                const rank = i + 1;
                const rankClass = rank === 1 ? 'rank-1' : rank === 2 ? 'rank-2' : rank === 3 ? 'rank-3' : 'rank-default';
                const pct = max ? (c.vote_count / max) * 100 : 0;
                return `
                    <div class="list-item ${type}">
                        <div class="rank ${rankClass}">${rank}</div>
                        <div class="info">
                            <p class="name">${c.name}</p>
                            <div class="bar"><div class="bar-fill ${type}" style="width:${pct}%"></div></div>
                        </div>
                        <div class="votes">${c.vote_count}</div>
                    </div>
                `;
            }).join('');
        }

        function initCharts() {
            const opts = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'bottom', labels: { padding: 12, usePointStyle: true, font: { size: 11 } } } },
                cutout: '60%'
            };

            chairChart = new Chart(document.getElementById('chairpersonChart'), {
                type: 'doughnut',
                data: { labels: [], datasets: [{ data: [], backgroundColor: ['#7c3aed', '#a78bfa', '#c4b5fd', '#ddd6fe'], borderWidth: 0 }] },
                options: opts
            });

            viceChart = new Chart(document.getElementById('viceChairpersonChart'), {
                type: 'doughnut',
                data: { labels: [], datasets: [{ data: [], backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9'], borderWidth: 0 }] },
                options: opts
            });
        }

        function updateCharts(chairs, vices) {
            if (chairChart) {
                chairChart.data.labels = chairs.map(c => c.name);
                chairChart.data.datasets[0].data = chairs.map(c => c.vote_count);
                chairChart.update();
            }
            if (viceChart) {
                viceChart.data.labels = vices.map(c => c.name);
                viceChart.data.datasets[0].data = vices.map(c => c.vote_count);
                viceChart.update();
            }
        }

        initCharts();
        load();
        setInterval(load, 3000);
    </script>
</body>
</html>
