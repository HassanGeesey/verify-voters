<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vote Counter - Zamzam University</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
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
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 20px 40px -10px rgba(0,0,0,0.15);
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
            padding: 20px 0;
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .header-title h1 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0;
        }

        .header-title p {
            font-size: 0.875rem;
            opacity: 0.9;
            margin: 0;
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
            border-radius: 8px;
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

        /* Section Headers */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .section-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
        }

        .section-icon.chairperson {
            background: linear-gradient(135deg, var(--chairperson), var(--chairperson-light));
        }

        .section-icon.vice {
            background: linear-gradient(135deg, var(--vice), var(--vice-light));
        }

        .section-title {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
            text-align: center;
        }

        .section-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin: 0;
            text-align: center;
        }

        /* Candidates Grid */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 12px;
            margin-bottom: 24px;
        }

        /* Candidate Card */
        .candidate-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 12px 12px 0 0;
        }

        .candidate-card.chairperson::before {
            background: linear-gradient(90deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice::before {
            background: linear-gradient(90deg, var(--vice), var(--vice-light));
        }

        .candidate-card:hover {
            box-shadow: var(--shadow);
        }

        .candidate-card:active {
            transform: scale(0.97);
        }

        .candidate-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            margin: 0 auto 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: white;
        }

        .candidate-card.chairperson .candidate-avatar {
            background: linear-gradient(135deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice .candidate-avatar {
            background: linear-gradient(135deg, var(--vice), var(--vice-light));
        }

        .candidate-name {
            font-size: 0.875rem;
            font-weight: 600;
            margin: 0 0 4px;
        }

        .candidate-role {
            font-size: 0.625rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 8px;
        }

        .candidate-card.chairperson .candidate-role {
            color: var(--chairperson);
        }

        .candidate-card.vice .candidate-role {
            color: var(--vice);
        }

        .vote-count {
            font-family: 'JetBrains Mono', monospace;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 2px;
            transition: transform 0.1s ease;
        }

        .candidate-card.chairperson .vote-count {
            color: var(--chairperson);
        }

        .candidate-card.vice .vote-count {
            color: var(--vice);
        }

        .vote-count.animate {
            transform: scale(1.1);
        }

        .vote-label {
            font-size: 0.625rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0;
        }

        /* Divider */
        .section-divider {
            margin: 24px 0;
            border: 0;
            height: 1px;
            background: var(--border);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 32px 16px;
            background: var(--surface);
            border: 1px dashed var(--border);
            border-radius: 12px;
            color: var(--text-muted);
        }

        .empty-state i {
            font-size: 1.5rem;
            margin-bottom: 8px;
            opacity: 0.5;
        }

        .empty-state p {
            margin: 0;
            font-size: 0.875rem;
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
            border-radius: 12px;
            padding: 16px 24px;
            box-shadow: var(--shadow-lg);
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.3s ease;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(100%); }
            to { opacity: 1; transform: translateX(0); }
        }

        .toast.success {
            border-left: 4px solid var(--success);
        }

        .toast.success i { color: var(--success); }

        /* Responsive */
        @media (max-width: 992px) {
            .candidates-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
            }
        }

        @media (max-width: 768px) {
            .header {
                padding: 12px 0;
            }

            .header-content {
                flex-direction: column;
                gap: 12px;
                text-align: center;
            }

            .logo-icon {
                width: 36px;
                height: 36px;
                font-size: 1rem;
            }

            .header-title h1 {
                font-size: 0.875rem;
            }

            .header-title p {
                font-size: 0.75rem;
            }

            .header-actions {
                width: 100%;
                justify-content: center;
                gap: 8px;
            }

            .header-actions .btn {
                padding: 6px 12px;
                font-size: 0.75rem;
            }

            .section-header {
                gap: 8px;
                margin-bottom: 16px;
            }

            .section-icon {
                width: 28px;
                height: 28px;
                font-size: 0.875rem;
            }

            .section-title {
                font-size: 0.875rem;
            }

            .section-subtitle {
                font-size: 0.625rem;
            }

            .candidates-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
                margin-bottom: 20px;
            }

            .candidate-card {
                padding: 12px 8px;
                border-radius: 10px;
            }

            .candidate-avatar {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .candidate-name {
                font-size: 0.75rem;
            }

            .vote-count {
                font-size: 1.75rem;
            }

            .vote-label {
                font-size: 0.5rem;
            }

            .section-divider {
                margin: 16px 0;
            }
        }

        @media (max-width: 480px) {
            .candidates-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }

            .vote-count {
                font-size: 1.5rem;
            }

            .candidate-avatar {
                width: 36px;
                height: 36px;
                font-size: 0.875rem;
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
                        <p>Vote Counter</p>
                    </div>
                </div>
                
                <div class="header-actions">
                    <a href="results-display.php" class="btn btn-outline">
                        <i class="bi bi-bar-chart"></i>
                        <span>Results</span>
                    </a>
                    <a href="admin.php" class="btn btn-white">
                        <i class="bi bi-gear"></i>
                        <span>Admin</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <!-- Chairperson Section -->
            <div class="section-header">
                <div class="section-icon chairperson">
                    <i class="bi bi-star-fill"></i>
                </div>
                <div>
                    <h2 class="section-title">Chairperson</h2>
                    <p class="section-subtitle">Guddiga Madaxda - Click to add vote</p>
                </div>
            </div>
            
            <div id="chairpersonList" class="candidates-grid">
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <p>No chairperson candidates yet</p>
                </div>
            </div>

            <hr class="section-divider">

            <!-- Vice-Chairperson Section -->
            <div class="section-header">
                <div class="section-icon vice">
                    <i class="bi bi-star"></i>
                </div>
                <div>
                    <h2 class="section-title">Vice-Chairperson</h2>
                    <p class="section-subtitle">Guddiga Madaxda ee Ku Xiga - Click to add vote</p>
                </div>
            </div>
            
            <div id="viceChairpersonList" class="candidates-grid">
                <div class="empty-state">
                    <i class="bi bi-people"></i>
                    <p>No vice-chairperson candidates yet</p>
                </div>
            </div>
        </div>
    </main>

    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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
            }, 1500);
        }

        async function loadCandidates() {
            try {
                const data = await apiCall('api.php?action=all_candidates');
                
                const chairpersons = data.candidates.filter(c => c.type === 'Chairperson');
                const viceChairpersons = data.candidates.filter(c => c.type === 'Vice-Chairperson');
                
                renderCandidates('chairpersonList', chairpersons, 'chairperson');
                renderCandidates('viceChairpersonList', viceChairpersons, 'vice');
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
                <div class="candidate-card ${type}" onclick="voteCandidate(${c.id})">
                    <div class="candidate-avatar">
                        <i class="bi bi-person-fill"></i>
                    </div>
                    <h3 class="candidate-name">${c.name}</h3>
                    <p class="candidate-role">${c.type}</p>
                    <div class="vote-count" id="count-${c.id}">${c.vote_count}</div>
                    <p class="vote-label">votes</p>
                    <span class="tap-hint">Tap to add vote</span>
                </div>
            `).join('');
        }

        async function voteCandidate(id) {
            const countEl = document.getElementById(`count-${id}`);
            countEl.classList.add('animate');
            
            try {
                const data = await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'vote_candidate', id: id })
                });
                
                countEl.textContent = data.candidate.vote_count;
                
                setTimeout(() => {
                    countEl.classList.remove('animate');
                }, 100);
                
            } catch (error) {
                countEl.classList.remove('animate');
            }
        }

        loadCandidates();
        setInterval(loadCandidates, 2000);
    </script>
</body>
</html>
