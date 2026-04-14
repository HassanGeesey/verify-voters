<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Dashboard - Zamzam University</title>
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
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
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
            line-height: 1.6;
            min-height: 100vh;
        }

        .font-mono {
            font-family: 'JetBrains Mono', monospace;
        }

        /* Header */
        .header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 24px 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .logo-icon {
            width: 56px;
            height: 56px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
        }

        .header-title h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }

        .header-title p {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 0;
        }

        .live-badge {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.2);
            padding: 12px 20px;
            border-radius: 50px;
            font-weight: 600;
        }

        .live-dot {
            width: 10px;
            height: 10px;
            background: var(--success);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(1.2); }
        }

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            font-family: inherit;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-white {
            background: white;
            color: var(--primary);
        }

        .btn-white:hover {
            background: #f8fafc;
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid rgba(255,255,255,0.3);
        }

        .btn-outline:hover {
            background: rgba(255,255,255,0.1);
            border-color: rgba(255,255,255,0.5);
        }

        /* Main Content */
        .main-content {
            padding: 32px 0;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }

        @media (max-width: 992px) {
            .stats-row {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .stats-row {
                grid-template-columns: 1fr;
            }
        }

        .stat-card {
            background: var(--surface);
            border-radius: var(--radius);
            padding: 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .stat-icon.primary {
            background: rgba(30, 64, 175, 0.1);
            color: var(--primary);
        }

        .stat-icon.success {
            background: rgba(5, 150, 105, 0.1);
            color: var(--success);
        }

        .stat-icon.chairperson {
            background: rgba(124, 58, 237, 0.1);
            color: var(--chairperson);
        }

        .stat-icon.vice {
            background: rgba(8, 145, 178, 0.1);
            color: var(--vice);
        }

        .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            color: var(--text-primary);
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-top: 4px;
        }

        /* Content Grid */
        .content-grid {
            display: grid;
            grid-template-columns: 1fr 400px;
            gap: 32px;
        }

        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
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

        /* Candidate Cards */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .candidate-card {
            background: var(--surface);
            border: 2px solid var(--border);
            border-radius: var(--radius);
            padding: 24px 16px;
            text-align: center;
            transition: all 0.25s ease;
            cursor: pointer;
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
        }

        .candidate-card.chairperson:hover {
            border-color: var(--chairperson);
        }

        .candidate-card.vice:hover {
            border-color: var(--vice);
        }

        .candidate-card:active {
            transform: scale(0.98);
        }

        .candidate-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            margin: 0 auto 12px;
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
            margin-bottom: 0;
        }

        /* Animation */
        @keyframes countUp {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }

        .vote-count.animate {
            animation: countUp 0.3s ease;
        }

        /* Sidebar */
        .sidebar {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* Cards */
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header-custom {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
        }

        .card-body-custom {
            padding: 20px;
        }

        /* Charts */
        .chart-container {
            position: relative;
            height: 200px;
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
            background: #f1f5f9;
        }

        .rank {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8125rem;
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

        .leaderboard-votes {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 700;
            font-size: 1rem;
            color: var(--primary);
        }

        .leaderboard-bar {
            height: 4px;
            background: var(--border);
            border-radius: 2px;
            margin-top: 6px;
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
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
            margin-bottom: 8px;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        .toast.success {
            border-left: 4px solid var(--success);
        }

        .toast.success i { color: var(--success); }

        /* Divider */
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
            background: var(--bg);
            border-radius: var(--radius-sm);
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 16px;
                text-align: center;
            }

            .candidates-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .vote-count {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-content">
                <div class="logo-section">
                    <div class="logo-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="header-title">
                        <h1>DOORASHADA JAAMACADA ZAMZAM</h1>
                        <p>Voting Dashboard</p>
                    </div>
                </div>
                
                <div class="d-flex align-items-center gap-3">
                    <div class="live-badge">
                        <span class="live-dot"></span>
                        <span id="totalVotesHeader">0</span> Votes
                    </div>
                    <div class="header-actions">
                        <a href="vote-counter.php" class="btn btn-outline">
                            <i class="bi bi-plus-circle"></i>
                            <span class="d-none d-md-inline">Count Votes</span>
                        </a>
                        <a href="results-display.php" class="btn btn-outline">
                            <i class="bi bi-display"></i>
                            <span class="d-none d-md-inline">Display</span>
                        </a>
                        <a href="admin.php" class="btn btn-white">
                            <i class="bi bi-gear"></i>
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <!-- Stats Row -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div id="statCandidates" class="stat-value">0</div>
                        <div class="stat-label">Total Candidates</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="bi bi-hand-thumbs-up-fill"></i>
                    </div>
                    <div>
                        <div id="statTotalVotes" class="stat-value">0</div>
                        <div class="stat-label">Total Votes</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon chairperson">
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div>
                        <div id="statChairperson" class="stat-value">0</div>
                        <div class="stat-label">Chairperson</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon vice">
                        <i class="bi bi-star"></i>
                    </div>
                    <div>
                        <div id="statViceChairperson" class="stat-value">0</div>
                        <div class="stat-label">Vice-Chairperson</div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="content-grid">
                <!-- Left: Candidates -->
                <div>
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
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>No chairperson candidates yet</p>
                            </div>
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
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>No vice-chairperson candidates yet</p>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Right: Sidebar -->
                <aside class="sidebar">
                    <!-- Charts Card -->
                    <div class="card">
                        <div class="card-header-custom">
                            <i class="bi bi-pie-chart-fill" style="color: var(--primary);"></i>
                            Live Results
                        </div>
                        <div class="card-body-custom">
                            <div class="mb-4">
                                <p class="small text-muted mb-2 fw-semibold" style="color: var(--chairperson) !important;">
                                    <i class="bi bi-star-fill me-1"></i> Chairperson
                                </p>
                                <div class="chart-container">
                                    <canvas id="chairpersonChart"></canvas>
                                </div>
                            </div>
                            <div>
                                <p class="small text-muted mb-2 fw-semibold" style="color: var(--vice) !important;">
                                    <i class="bi bi-star me-1"></i> Vice-Chairperson
                                </p>
                                <div class="chart-container">
                                    <canvas id="viceChairpersonChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Leaderboard Card -->
                    <div class="card">
                        <div class="card-header-custom">
                            <i class="bi bi-trophy-fill" style="color: #f59e0b;"></i>
                            Leaderboard
                        </div>
                        <div class="card-body-custom">
                            <div class="mb-4">
                                <p class="small text-muted mb-2 fw-semibold" style="color: var(--chairperson) !important;">
                                    <i class="bi bi-star-fill me-1"></i> Chairperson
                                </p>
                                <div id="leaderboardChairperson" class="leaderboard-list"></div>
                            </div>
                            <div>
                                <p class="small text-muted mb-2 fw-semibold" style="color: var(--vice) !important;">
                                    <i class="bi bi-star me-1"></i> Vice-Chairperson
                                </p>
                                <div id="leaderboardViceChairperson" class="leaderboard-list"></div>
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
                showToast(error.message, 'error');
                throw error;
            }
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toastContainer');
            const toast = document.createElement('div');
            toast.className = `toast ${type}`;
            toast.innerHTML = `
                <i class="bi bi-${type === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill'}"></i>
                <span>${message}</span>
            `;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        }

        async function loadCandidates() {
            try {
                const data = await apiCall('api.php?action=all_candidates');
                
                const chairpersons = data.candidates.filter(c => c.type === 'Chairperson');
                const viceChairpersons = data.candidates.filter(c => c.type === 'Vice-Chairperson');
                
                renderCandidates('chairpersonList', chairpersons, 'chairperson');
                renderCandidates('viceChairpersonList', viceChairpersons, 'vice');
                
                updateLeaderboard(chairpersons, 'leaderboardChairperson', 'chairperson');
                updateLeaderboard(viceChairpersons, 'leaderboardViceChairperson', 'vice');
                
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
                <div class="candidate-card ${type}" id="candidate-${c.id}" onclick="voteCandidate(${c.id})">
                    <div class="candidate-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h4 class="candidate-name">${c.name}</h4>
                    <p class="candidate-role">${c.type}</p>
                    <div class="vote-count" id="count-${c.id}">${c.vote_count}</div>
                    <div class="vote-label">votes</div>
                </div>
            `).join('');
        }

        async function voteCandidate(id) {
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
                
                setTimeout(() => loadCandidates(), 200);
            } catch (error) {
                console.error('Vote failed');
            }
        }

        function updateStats(candidates) {
            const total = candidates.length;
            const totalVotes = candidates.reduce((sum, c) => sum + parseInt(c.vote_count), 0);
            const chairperson = candidates.filter(c => c.type === 'Chairperson').length;
            const viceChairperson = candidates.filter(c => c.type === 'Vice-Chairperson').length;
            
            document.getElementById('statCandidates').textContent = total;
            document.getElementById('statTotalVotes').textContent = totalVotes;
            document.getElementById('statChairperson').textContent = chairperson;
            document.getElementById('statViceChairperson').textContent = viceChairperson;
            document.getElementById('totalVotesHeader').textContent = totalVotes;
        }

        function updateLeaderboard(candidates, containerId, type) {
            const container = document.getElementById(containerId);
            const sorted = [...candidates].sort((a, b) => b.vote_count - a.vote_count);
            const maxVotes = sorted.length > 0 ? Math.max(...sorted.map(c => c.vote_count)) : 0;
            
            if (sorted.length === 0) {
                container.innerHTML = '<p class="text-muted small">No candidates yet</p>';
                return;
            }
            
            container.innerHTML = sorted.map((c, index) => {
                const rank = index + 1;
                const rankClass = rank === 1 ? 'rank-1' : rank === 2 ? 'rank-2' : rank === 3 ? 'rank-3' : 'rank-default';
                const percentage = maxVotes > 0 ? (c.vote_count / maxVotes) * 100 : 0;
                
                return `
                    <div class="leaderboard-item">
                        <div class="rank ${rankClass}">${rank}</div>
                        <div class="leaderboard-info">
                            <p class="leaderboard-name">${c.name}</p>
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
                            padding: 10,
                            usePointStyle: true,
                            font: { family: "'Plus Jakarta Sans', sans-serif", size: 10 }
                        }
                    }
                },
                cutout: '60%'
            };
            
            const chairCtx = document.getElementById('chairpersonChart').getContext('2d');
            chairpersonChart = new Chart(chairCtx, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#7c3aed', '#a78bfa', '#c4b5fd', '#ddd6fe', '#8b5cf6'],
                        borderWidth: 0
                    }]
                },
                options: chartOptions
            });
            
            const viceCtx = document.getElementById('viceChairpersonChart').getContext('2d');
            viceChairpersonChart = new Chart(viceCtx, {
                type: 'doughnut',
                data: {
                    labels: [],
                    datasets: [{
                        data: [],
                        backgroundColor: ['#0891b2', '#06b6d4', '#22d3ee', '#67e8f9', '#0e7490'],
                        borderWidth: 0
                    }]
                },
                options: chartOptions
            });
        }

        function updateCharts(chairpersons, viceChairpersons) {
            if (chairpersonChart) {
                chairpersonChart.data.labels = chairpersons.map(c => c.name);
                chairpersonChart.data.datasets[0].data = chairpersons.map(c => c.vote_count);
                chairpersonChart.update();
            }
            
            if (viceChairpersonChart) {
                viceChairpersonChart.data.labels = viceChairpersons.map(c => c.name);
                viceChairpersonChart.data.datasets[0].data = viceChairpersons.map(c => c.vote_count);
                viceChairpersonChart.update();
            }
        }

        initCharts();
        loadCandidates();
        setInterval(loadCandidates, 3000);
    </script>
</body>
</html>
