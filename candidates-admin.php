<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidates - Zamzam University</title>
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
            --danger: #dc2626;
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
            --radius: 12px;
            --radius-sm: 8px;
            --radius-lg: 16px;
            --chairperson: #7c3aed;
            --chairperson-light: #a78bfa;
            --vice: #0891b2;
            --vice-light: #22d3ee;
            --sidebar-width: 260px;
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

        /* Layout */
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--surface);
            border-right: 1px solid var(--border);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .sidebar-header {
            padding: 24px;
            border-bottom: 1px solid var(--border);
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
            font-size: 1.125rem;
        }

        .logo-text span {
            color: var(--primary);
        }

        .sidebar-nav {
            padding: 16px 12px;
            flex: 1;
        }

        .nav-item {
            margin-bottom: 4px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            color: var(--text-secondary);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: var(--bg);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: rgba(30, 64, 175, 0.1);
            color: var(--primary);
        }

        .nav-link i {
            font-size: 1.25rem;
        }

        .sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--border);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 32px;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 32px;
        }

        .page-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin: 0;
        }

        .page-subtitle {
            color: var(--text-muted);
            margin: 4px 0 0;
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
            justify-content: space-between;
        }

        .card-header-custom h3 {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body-custom {
            padding: 24px;
        }

        /* Grid Layout */
        .content-grid {
            display: grid;
            grid-template-columns: 400px 1fr;
            gap: 32px;
        }

        @media (max-width: 1200px) {
            .content-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Forms */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 8px;
            color: var(--text-primary);
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.9375rem;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        .form-select {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.9375rem;
            font-family: inherit;
            background: var(--surface);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .form-select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 0.875rem;
            font-family: inherit;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: var(--shadow);
        }

        .btn-secondary {
            background: var(--bg);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border-light);
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
        }

        .btn-block {
            width: 100%;
        }

        /* Candidate Cards */
        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .section-icon {
            width: 40px;
            height: 40px;
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
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
        }

        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
            gap: 16px;
        }

        .candidate-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            text-align: center;
            transition: all 0.2s ease;
            position: relative;
        }

        .candidate-card:hover {
            border-color: var(--primary);
            box-shadow: var(--shadow);
        }

        .candidate-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: var(--radius) var(--radius) 0 0;
        }

        .candidate-card.chairperson::before {
            background: linear-gradient(90deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice::before {
            background: linear-gradient(90deg, var(--vice), var(--vice-light));
        }

        .candidate-avatar {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            margin: 0 auto 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .candidate-card.chairperson .candidate-avatar {
            background: linear-gradient(135deg, var(--chairperson), var(--chairperson-light));
        }

        .candidate-card.vice .candidate-avatar {
            background: linear-gradient(135deg, var(--vice), var(--vice-light));
        }

        .candidate-name {
            font-size: 0.9375rem;
            font-weight: 600;
            margin: 0 0 4px;
        }

        .candidate-role {
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin: 0 0 12px;
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
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 4px;
        }

        .vote-label {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 12px;
        }

        .candidate-actions {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .btn-sm {
            padding: 8px 12px;
            font-size: 0.8125rem;
        }

        .btn-vote {
            background: rgba(30, 64, 175, 0.1);
            color: var(--primary);
        }

        .btn-vote:hover {
            background: var(--primary);
            color: white;
        }

        .btn-delete {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

        /* Stats Cards */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
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

        .stat-value {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.5rem;
            font-weight: 700;
            line-height: 1;
        }

        .stat-label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin-top: 4px;
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
        .toast.error {
            border-left: 4px solid var(--danger);
        }
        .toast.error i { color: var(--danger); }

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

        /* Animations */
        @keyframes countUp {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }

        .vote-count.animate {
            animation: countUp 0.3s ease;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 16px;
            left: 16px;
            z-index: 101;
            width: 44px;
            height: 44px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                padding: 80px 16px 16px;
            }

            .mobile-toggle {
                display: flex;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .candidates-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
    </style>
</head>
<body>
    <button class="mobile-toggle" id="mobileToggle">
        <i class="bi bi-list"></i>
    </button>

    <div class="admin-layout">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <a href="index.php" class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="logo-text">Zamzam <span>University</span></span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="admin.php" class="nav-link">
                        <i class="bi bi-grid-1x2"></i>
                        Dashboard
                    </a>
                </div>
                <div class="nav-item">
                    <a href="candidates-admin.php" class="nav-link active">
                        <i class="bi bi-people-fill"></i>
                        Candidates
                    </a>
                </div>
                <div class="nav-item">
                    <a href="students-admin.php" class="nav-link">
                        <i class="bi bi-person-badge"></i>
                        Students
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <div class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="bi bi-box-arrow-left"></i>
                        Back to Voting
                    </a>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <div class="page-header">
                <div>
                    <h1 class="page-title">Candidates</h1>
                    <p class="page-subtitle">Manage election candidates and view votes</p>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div id="statTotal" class="stat-value">0</div>
                        <div class="stat-label">Total Candidates</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div id="statVotes" class="stat-value">0</div>
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
            </div>

            <div class="content-grid">
                <div>
                    <div class="card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-plus-circle"></i> Add Candidate</h3>
                        </div>
                        <div class="card-body-custom">
                            <form id="addCandidateForm">
                                <div class="form-group">
                                    <label class="form-label">Candidate Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Enter candidate name" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Position</label>
                                    <select class="form-select" name="type" required>
                                        <option value="Chairperson">Chairperson</option>
                                        <option value="Vice-Chairperson">Vice-Chairperson</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" id="submitBtn">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Candidate
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="card">
                        <div class="card-header-custom">
                            <h3><i class="bi bi-list-ul"></i> All Candidates</h3>
                        </div>
                        <div class="card-body-custom">
                            <section class="mb-4">
                                <div class="section-header">
                                    <div class="section-icon chairperson">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <h4 class="section-title">Chairperson</h4>
                                </div>
                                <div id="chairpersonList" class="candidates-grid">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <p>No chairperson candidates yet</p>
                                    </div>
                                </div>
                            </section>

                            <section>
                                <div class="section-header">
                                    <div class="section-icon vice">
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <h4 class="section-title">Vice-Chairperson</h4>
                                </div>
                                <div id="viceChairpersonList" class="candidates-grid">
                                    <div class="empty-state">
                                        <i class="bi bi-people"></i>
                                        <p>No vice-chairperson candidates yet</p>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

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
            }, 3000);
        }

        async function loadCandidates() {
            try {
                const data = await apiCall('api.php?action=all_candidates');
                
                const chairpersons = data.candidates.filter(c => c.type === 'Chairperson');
                const viceChairpersons = data.candidates.filter(c => c.type === 'Vice-Chairperson');
                
                renderCandidates('chairpersonList', chairpersons, 'chairperson');
                renderCandidates('viceChairpersonList', viceChairpersons, 'vice');
                
                updateStats(data.candidates);
            } catch (error) {
                console.error('Failed to load candidates');
            }
        }

        function renderCandidates(containerId, candidates, type) {
            const container = document.getElementById(containerId);
            
            if (candidates.length === 0) {
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
                    <div class="candidate-actions">
                        <button class="btn btn-sm btn-vote" onclick="voteCandidate(${c.id})">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                        <button class="btn btn-sm btn-delete" onclick="deleteCandidate(${c.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function updateStats(candidates) {
            const total = candidates.length;
            const votes = candidates.reduce((sum, c) => sum + parseInt(c.vote_count), 0);
            const chairperson = candidates.filter(c => c.type === 'Chairperson').length;
            
            document.getElementById('statTotal').textContent = total;
            document.getElementById('statVotes').textContent = votes;
            document.getElementById('statChairperson').textContent = chairperson;
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
                loadCandidates();
            } catch (error) {
                console.error('Vote failed');
            }
        }

        async function deleteCandidate(id) {
            if (!confirm('Are you sure you want to delete this candidate?')) return;
            
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'delete_candidate', id: id })
                });
                
                const data = await response.json();
                
                if (!response.ok) throw new Error(data.error || 'Failed to delete');
                
                showToast('Candidate deleted');
                loadCandidates();
            } catch (error) {
                console.error('Delete failed');
            }
        }

        document.getElementById('addCandidateForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            const btn = document.getElementById('submitBtn');
            
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Adding...';
            
            try {
                await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'add_candidate',
                        name: formData.get('name'),
                        type: formData.get('type')
                    })
                });
                
                showToast('Candidate added successfully');
                e.target.reset();
                loadCandidates();
            } catch (error) {
                console.error('Add failed');
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-plus-lg"></i> Add Candidate';
            }
        });

        document.getElementById('mobileToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('open');
        });

        loadCandidates();
    </script>
</body>
</html>
