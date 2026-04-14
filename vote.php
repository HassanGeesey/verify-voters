<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote - Zamzam University</title>
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
            --primary-dark: #1e3a8a;
            --success: #059669;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.05);
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 16px;
            --chairperson: #7c3aed;
            --chairperson-light: #a78bfa;
            --vice: #0891b2;
            --vice-light: #22d3ee;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--bg);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Header */
        .header {
            background: var(--surface);
            border-bottom: 1px solid var(--border);
            padding: 16px 0;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(8px);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-primary);
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .logo-text {
            font-weight: 700;
            font-size: 1.25rem;
        }

        .logo-text span {
            color: var(--primary);
        }

        .live-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--bg);
            padding: 8px 16px;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .live-dot {
            width: 8px;
            height: 8px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }

        .btn-primary {
            background: var(--primary);
            border: none;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        /* Main Layout */
        .main-content {
            padding: 32px 0;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 32px;
        }

        @media (max-width: 1024px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
        }

        .card-header-custom {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .card-header-custom h3 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 700;
        }

        .card-body-custom {
            padding: 24px;
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-icon.chairperson {
            background: rgba(124, 58, 237, 0.1);
            color: var(--chairperson);
        }

        .section-icon.vice {
            background: rgba(8, 145, 178, 0.1);
            color: var(--vice);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .section-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* Candidate Grid */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }

        /* Candidate Card */
        .candidate-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            text-align: center;
            transition: all 0.25s ease;
            position: relative;
            overflow: hidden;
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
        }

        .candidate-card.chairperson::before {
            background: linear-gradient(90deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice::before {
            background: linear-gradient(90deg, var(--vice), var(--vice-light));
        }

        .candidate-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .candidate-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            margin: 0 auto 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .candidate-card.chairperson .candidate-avatar {
            background: linear-gradient(135deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice .candidate-avatar {
            background: linear-gradient(135deg, var(--vice), var(--vice-light));
        }

        .candidate-name {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 4px;
            color: var(--text-primary);
        }

        .candidate-role {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 16px;
        }

        .candidate-card.chairperson .candidate-role {
            color: var(--chairperson);
        }

        .candidate-card.vice .candidate-role {
            color: var(--vice);
        }

        .vote-count {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .vote-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .btn-vote {
            width: 100%;
            padding: 12px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            border: 2px solid transparent;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .candidate-card.chairperson .btn-vote {
            background: rgba(124, 58, 237, 0.1);
            color: var(--chairperson);
        }

        .candidate-card.chairperson .btn-vote:hover {
            background: var(--chairperson);
            color: white;
        }

        .candidate-card.vice .btn-vote {
            background: rgba(8, 145, 178, 0.1);
            color: var(--vice);
        }

        .candidate-card.vice .btn-vote:hover {
            background: var(--vice);
            color: white;
        }

        .btn-vote:active {
            transform: scale(0.96);
        }

        .btn-vote.voted {
            background: var(--success) !important;
            color: white !important;
        }

        /* Vote Animation */
        @keyframes countUp {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }

        .vote-count.animate {
            animation: countUp 0.3s ease;
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 100px;
        }

        /* Stats Card */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--bg);
            border-radius: var(--radius-sm);
            padding: 16px;
            text-align: center;
        }

        .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Chart */
        .chart-wrapper {
            position: relative;
            height: 180px;
        }
        
        .card-header-custom {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-header-custom h3 {
            margin: 0;
            font-size: 0.9375rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* Leaderboard */
        .leaderboard-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: var(--bg);
            border-radius: var(--radius-sm);
            transition: all 0.2s ease;
        }

        .leaderboard-item:hover {
            background: var(--border-light);
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

        .rank-1 {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            color: white;
        }

        .rank-2 {
            background: linear-gradient(135deg, #9ca3af, #6b7280);
            color: white;
        }

        .rank-3 {
            background: linear-gradient(135deg, #d97706, #b45309);
            color: white;
        }

        .rank-default {
            background: var(--border);
            color: var(--text-muted);
        }

        .leaderboard-info {
            flex: 1;
            min-width: 0;
        }

        .leaderboard-name {
            font-weight: 600;
            font-size: 0.875rem;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .leaderboard-role {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin: 0;
        }

        .leaderboard-votes {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 0.875rem;
            color: var(--primary);
        }

        .leaderboard-bar {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            margin-top: 8px;
            overflow: hidden;
        }

        .leaderboard-bar-fill {
            height: 100%;
            border-radius: 2px;
            transition: width 0.5s ease;
        }

        .leaderboard-bar-fill.chairperson {
            background: var(--chairperson);
        }

        .leaderboard-bar-fill.vice {
            background: var(--vice);
        }

        /* Section Divider */
        .section-divider {
            margin: 40px 0;
            border: 0;
            height: 1px;
            background: var(--border);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 48px 24px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 16px;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0;
        }

        /* Loading */
        .skeleton {
            background: linear-gradient(90deg, var(--border) 25%, var(--border-light) 50%, var(--border) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: var(--radius-sm);
        }

        @keyframes shimmer {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 1000;
        }

        .toast {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            padding: 16px 20px;
            box-shadow: var(--shadow-xl);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .toast.success {
            border-left: 4px solid var(--success);
        }

        .toast.success i {
            color: var(--success);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 12px 0;
            }

            .content-grid {
                gap: 24px;
            }

            .candidates-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .candidate-card {
                padding: 16px;
            }

            .candidate-avatar {
                width: 56px;
                height: 56px;
                font-size: 1.5rem;
            }

            .vote-count {
                font-size: 2rem;
            }

            .sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="index.php" class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="logo-text">Zamzam <span>University</span></span>
                </a>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="live-badge">
                        <span class="live-dot"></span>
                        <span id="totalVotes">0</span> total votes
                    </div>
                    <a href="admin.php" class="btn btn-primary">
                        <i class="bi bi-gear me-1"></i>
                        <span class="d-none d-sm-inline">Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="content-grid">
                <div class="main-panel">
                    <!-- Chairperson Section -->
                    <section class="mb-5">
                        <div class="section-header">
                            <div class="section-icon chairperson">
                                <i class="bi bi-star-fill"></i>
                            </div>
<div>
    <h2 class="section-title">Chairperson</h2>
    <p class="section-subtitle">Guddiga Madaxda</p>
</div>
                        </div>
                        <div id="chairpersonList" class="candidates-grid">
                            <div class="skeleton" style="height: 280px;"></div>
                            <div class="skeleton" style="height: 280px;"></div>
                        </div>
                    </section>

                    <hr class="section-divider">

                    <!-- Vice-Chairperson Section -->
                    <section>
                        <div class="section-header">
                            <div class="section-icon vice">
                                <i class="bi bi-star"></i>
                            </div>
<div>
    <h2 class="section-title">Vice-Chairperson</h2>
    <p class="section-subtitle">Guddiga Madaxda ee Ku Xiga</p>
</div>
                        </div>
                        <div id="viceChairpersonList" class="candidates-grid">
                            <div class="skeleton" style="height: 280px;"></div>
                            <div class="skeleton" style="height: 280px;"></div>
                        </div>
                    </section>
                </div>

                <aside class="sidebar">
                    <!-- Stats Card -->
                    <div class="card mb-4">
                        <div class="card-header-custom">
                            <i class="bi bi-bar-chart-fill text-primary"></i>
                            <h3>Live Statistics</h3>
                        </div>
                        <div class="card-body-custom">
                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div id="statCandidates" class="stat-value">0</div>
                                    <div class="stat-label">Candidates</div>
                                </div>
                                <div class="stat-card">
                                    <div id="statVotes" class="stat-value">0</div>
                                    <div class="stat-label">Total Votes</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chairperson Chart Card -->
                    <div class="card mb-4">
                        <div class="card-header-custom" style="background: rgba(124, 58, 237, 0.05);">
                            <i class="bi bi-star-fill" style="color: var(--chairperson);"></i>
                            <h3 style="color: var(--chairperson);">Chairperson</h3>
                        </div>
                        <div class="card-body-custom">
                            <div class="chart-wrapper">
                                <canvas id="chairpersonChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Vice-Chairperson Chart Card -->
                    <div class="card mb-4">
                        <div class="card-header-custom" style="background: rgba(8, 145, 178, 0.05);">
                            <i class="bi bi-star" style="color: var(--vice);"></i>
                            <h3 style="color: var(--vice);">Vice-Chairperson</h3>
                        </div>
                        <div class="card-body-custom">
                            <div class="chart-wrapper">
                                <canvas id="viceChairpersonChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Leaderboard Card -->
                    <div class="card">
                        <div class="card-header-custom">
                            <i class="bi bi-trophy-fill text-warning"></i>
                            <h3>Leaderboard</h3>
                        </div>
                        <div class="card-body-custom">
                            <div id="leaderboardChairperson" class="mb-4">
                                <p class="text-muted small mb-2" style="color: var(--chairperson) !important;">
                                    <i class="bi bi-star-fill me-1"></i> Chairperson
                                </p>
                                <div id="leaderboardChairpersonList" class="leaderboard-list"></div>
                            </div>
                            
                            <div id="leaderboardViceChairperson">
                                <p class="text-muted small mb-2" style="color: var(--vice) !important;">
                                    <i class="bi bi-star me-1"></i> Vice-Chairperson
                                </p>
                                <div id="leaderboardViceChairpersonList" class="leaderboard-list"></div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </main>

    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let chairpersonChart = null;
        let viceChairpersonChart = null;

        async function apiCall(url, options = {}) {
            try {
                const response = await fetch(url, options);
                const data = await response.json();
                if (!response.ok) throw new Error(data.error || 'Request failed');
                return data;
            } catch (error) {
                console.error(error);
                throw error;
            }
        }

        function showToast(message) {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = 'toast success';
            toast.innerHTML = `
                <i class="bi bi-check-circle-fill"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => toast.remove(), 300);
            }, 2000);
        }

        async function loadCandidates() {
            try {
                const data = await apiCall('api.php?action=all_candidates');
                
                const chairpersons = data.candidates.filter(c => c.type === 'Chairperson');
                const viceChairpersons = data.candidates.filter(c => c.type === 'Vice-Chairperson');
                
                renderCandidates('chairpersonList', chairpersons, 'chairperson');
                renderCandidates('viceChairpersonList', viceChairpersons, 'vice');
                
                updateLeaderboard(chairpersons, 'leaderboardChairpersonList', 'chairperson');
                updateLeaderboard(viceChairpersons, 'leaderboardViceChairpersonList', 'vice');
                
                updateStats(data.candidates);
                updateCharts(chairpersons, viceChairpersons);
            } catch (error) {
                console.error('Failed to load candidates');
            }
        }

        function renderCandidates(containerId, candidates, type) {
            const container = document.getElementById(containerId);
            
            if (candidates.length === 0) {
                container.innerHTML = `
                    <div class="empty-state" style="grid-column: 1 / -1;">
                        <i class="bi bi-people"></i>
                        <p>No candidates yet</p>
                    </div>
                `;
                return;
            }
            
            container.innerHTML = candidates.map(c => `
                <div class="candidate-card ${type}" id="candidate-${c.id}">
                    <div class="candidate-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h4 class="candidate-name">${c.name}</h4>
                    <p class="candidate-role">${c.type}</p>
                    <div class="vote-count" id="count-${c.id}">${c.vote_count}</div>
                    <div class="vote-label">votes</div>
                    <button class="btn-vote" onclick="voteCandidate(${c.id}, '${type}')">
                        <i class="bi bi-hand-thumbs-up"></i>
                        Vote +1
                    </button>
                </div>
            `).join('');
        }

        async function voteCandidate(id, type) {
            const btn = event.currentTarget;
            const originalText = btn.innerHTML;
            
            btn.disabled = true;
            btn.innerHTML = '<i class="bi bi-hourglass-split"></i> Adding...';
            
            try {
                const data = await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'vote_candidate', id: id })
                });
                
                const countEl = document.getElementById(`count-${id}`);
                countEl.textContent = data.candidate.vote_count;
                countEl.classList.add('animate');
                setTimeout(() => countEl.classList.remove('animate'), 300);
                
                showToast(`Vote added for ${data.candidate.name}`);
                
                setTimeout(() => loadCandidates(), 300);
            } catch (error) {
                btn.disabled = false;
                btn.innerHTML = originalText;
            }
        }

        function updateStats(candidates) {
            const totalCandidates = candidates.length;
            const totalVotes = candidates.reduce((sum, c) => sum + parseInt(c.vote_count), 0);
            
            document.getElementById('statCandidates').textContent = totalCandidates;
            document.getElementById('statVotes').textContent = totalVotes;
            document.getElementById('totalVotes').textContent = totalVotes;
        }

        function updateLeaderboard(candidates, containerId, type) {
            const container = document.getElementById(containerId);
            const sorted = [...candidates].sort((a, b) => b.vote_count - a.vote_count);
            const maxVotes = sorted.length > 0 ? sorted[0].vote_count : 0;
            
            if (sorted.length === 0) {
                container.innerHTML = '<p class="text-muted small">No candidates yet</p>';
                return;
            }
            
            container.innerHTML = sorted.slice(0, 5).map((c, index) => {
                const rank = index + 1;
                const rankClass = rank === 1 ? 'rank-1' : rank === 2 ? 'rank-2' : rank === 3 ? 'rank-3' : 'rank-default';
                const percentage = maxVotes > 0 ? (c.vote_count / maxVotes) * 100 : 0;
                
                return `
                    <div class="leaderboard-item">
                        <div class="rank ${rankClass}">${rank}</div>
                        <div class="leaderboard-info">
                            <p class="leaderboard-name">${c.name}</p>
                            <p class="leaderboard-role">${c.type}</p>
                            <div class="leaderboard-bar">
                                <div class="leaderboard-bar-fill ${type}" style="width: ${percentage}%"></div>
                            </div>
                        </div>
                        <div class="leaderboard-votes">${c.vote_count}</div>
                    </div>
                `;
            }).join('');
        }

        function initCharts() {
            const chartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 12,
                            usePointStyle: true,
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 11 }
                        }
                    }
                },
                cutout: '60%'
            };
            
            // Chairperson Chart
            const chairCtx = document.getElementById('chairpersonChart').getContext('2d');
            chairpersonChart = new Chart(chairCtx, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#7c3aed', '#a78bfa', '#c4b5fd', '#ddd6fe', '#8b5cf6', '#6d28d9'],
                        borderWidth: 0
                    }]
                },
                options: chartOptions
            });
            
            // Vice-Chairperson Chart
            const viceCtx = document.getElementById('viceChairpersonChart').getContext('2d');
            viceChairpersonChart = new Chart(viceCtx, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9', '#0e7490', '#0891b2'],
                        borderWidth: 0
                    }]
                },
                options: chartOptions
            });
        }

        function updateCharts(chairpersons, viceChairpersons) {
            // Update Chairperson Chart
            if (chairpersonChart) {
                chairpersonChart.data.labels = chairpersons.map(c => c.name);
                chairpersonChart.data.datasets[0].data = chairpersons.map(c => c.vote_count);
                chairpersonChart.update();
            }
            
            // Update Vice-Chairperson Chart
            if (viceChairpersonChart) {
                viceChairpersonChart.data.labels = viceChairpersons.map(c => c.name);
                viceChairpersonChart.data.datasets[0].data = viceChairpersons.map(c => c.vote_count);
                viceChairpersonChart.update();
            }
        }

        initCharts();
        loadCandidates();
        setInterval(loadCandidates, 5000);
    </script>
</body>
</html>
