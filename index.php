<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Verification - Zamzam University</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #1e40af;
            --primary-light: #3b82f6;
            --primary-dark: #1e3a8a;
            --success: #059669;
            --success-light: #10b981;
            --danger: #dc2626;
            --warning: #ca8a04;
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
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }

        .container {
            width: 100%;
            max-width: 540px;
        }

        .card {
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            padding: 32px;
            text-align: center;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 48px;
            height: 48px;
            background: rgba(255,255,255,0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-text {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .header-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            opacity: 0.95;
        }

        .header-subtitle {
            font-size: 0.875rem;
            margin: 8px 0 0;
            opacity: 0.8;
        }

        .card-body {
            padding: 32px;
        }

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
            padding: 16px 20px;
            border: 2px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(30, 64, 175, 0.1);
        }

        .form-control.is-invalid {
            border-color: var(--danger);
        }
        
        /* Autocomplete */
        .autocomplete-wrapper {
            position: relative;
        }
        
        .autocomplete-list {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: var(--surface);
            border: 1px solid var(--border);
            border-top: none;
            border-radius: 0 0 var(--radius-sm) var(--radius-sm);
            box-shadow: var(--shadow-lg);
            max-height: 240px;
            overflow-y: auto;
            z-index: 100;
            display: none;
        }
        
        .autocomplete-list.show {
            display: block;
        }
        
        .autocomplete-item {
            padding: 12px 16px;
            cursor: pointer;
            border-bottom: 1px solid var(--border);
            transition: background 0.15s ease;
        }
        
        .autocomplete-item:last-child {
            border-bottom: none;
        }
        
        .autocomplete-item:hover {
            background: var(--bg);
        }
        
        .autocomplete-item.active {
            background: rgba(30, 64, 175, 0.1);
        }
        
        .autocomplete-item .student-id {
            font-family: 'JetBrains Mono', monospace;
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--primary);
        }
        
        .autocomplete-item .student-name {
            font-weight: 500;
            color: var(--text-primary);
        }
        
        .autocomplete-item .student-dept {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }
        
        .autocomplete-item .vote-status {
            font-size: 0.75rem;
            padding: 2px 8px;
            border-radius: 50px;
            font-weight: 600;
        }
        
        .autocomplete-item .vote-status.voted {
            background: rgba(5, 150, 105, 0.1);
            color: var(--success);
        }
        
        .autocomplete-item .vote-status.not-voted {
            background: rgba(202, 138, 4, 0.1);
            color: var(--warning);
        }
        
        .autocomplete-no-results {
            padding: 16px;
            text-align: center;
            color: var(--text-muted);
        }
        
        .autocomplete-loading {
            padding: 16px;
            text-align: center;
            color: var(--text-muted);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 16px 32px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        .btn-primary:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Stats Row */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid var(--border);
        }

        .stat-item {
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
            margin-top: 4px;
        }

        .stat-item.success .stat-value {
            color: var(--success);
        }

        /* Result Card */
        .result-card {
            margin-top: 24px;
            border-radius: var(--radius-sm);
            padding: 24px;
            text-align: center;
            animation: slideUp 0.3s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .result-card.success {
            background: rgba(5, 150, 105, 0.1);
            border: 1px solid rgba(5, 150, 105, 0.2);
        }

        .result-card.danger {
            background: rgba(220, 38, 38, 0.1);
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .result-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 2rem;
        }

        .result-card.success .result-icon {
            background: var(--success);
            color: white;
        }

        .result-card.danger .result-icon {
            background: var(--danger);
            color: white;
        }

        .result-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0 0 8px;
        }

        .result-card.success .result-title {
            color: var(--success);
        }

        .result-card.danger .result-title {
            color: var(--danger);
        }

        .result-name {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0 0 4px;
        }

        .result-details {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .result-time {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin-top: 12px;
        }

        .confirm-btn {
            margin-top: 20px;
            background: var(--success);
            color: white;
        }

        .confirm-btn:hover {
            background: #047857;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 12px;
            margin-top: 24px;
        }

        .btn-secondary {
            flex: 1;
            background: var(--bg);
            color: var(--text-secondary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--border);
            color: var(--text-primary);
        }

        .btn-admin {
            background: var(--primary);
            color: white;
            text-decoration: none;
            text-align: center;
        }

        .btn-admin:hover {
            background: var(--primary-dark);
            color: white;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 0.8125rem;
            color: var(--text-muted);
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

        @media (max-width: 480px) {
            body {
                padding: 16px;
                align-items: flex-start;
            }

            .card-body {
                padding: 24px;
            }

            .stats-row {
                grid-template-columns: 1fr;
                gap: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="logo">
                    <div class="logo-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <span class="logo-text">Zamzam University</span>
                </div>
                <h1 class="header-title">DOORASHADA JAAMACADA ZAMZAM</h1>
                <p class="header-subtitle">Verificationka Ardayda</p>
            </div>
            
            <div class="card-body">
                <form id="searchForm">
                    <div class="form-group">
                        <label class="form-label" for="studentId">Student ID</label>
                        <div class="autocomplete-wrapper">
                            <input 
                                type="text" 
                                id="studentId" 
                                class="form-control" 
                                placeholder="Enter or scan student ID..."
                                autocomplete="off"
                                autofocus
                            >
                            <div class="autocomplete-list" id="autocompleteList"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="searchBtn">
                        <i class="bi bi-search"></i>
                        Search Student
                    </button>
                </form>

                <div id="resultContainer"></div>

                <div class="stats-row">
                    <div class="stat-item">
                        <div id="totalCount" class="stat-value">0</div>
                        <div class="stat-label">Total</div>
                    </div>
                    <div class="stat-item success">
                        <div id="votedCount" class="stat-value">0</div>
                        <div class="stat-label">Voted</div>
                    </div>
                    <div class="stat-item">
                        <div id="percentage" class="stat-value">0%</div>
                        <div class="stat-label">Turnout</div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="dashboard.php" class="btn btn-secondary">
                        <i class="bi bi-display"></i>
                        Voting Dashboard
                    </a>
                    <a href="admin.php" class="btn btn-admin">
                        <i class="bi bi-gear"></i>
                        Admin
                    </a>
                </div>
            </div>
        </div>

        <p class="footer">
            DOORASHADA JAAMACADA ZAMZAM
        </p>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const studentIdInput = document.getElementById('studentId');
        const searchBtn = document.getElementById('searchBtn');
        const resultContainer = document.getElementById('resultContainer');
        const autocompleteList = document.getElementById('autocompleteList');
        
        let isProcessing = false;
        let searchTimeout = null;
        let selectedIndex = -1;
        let students = [];

        async function apiCall(url, options = {}) {
            try {
                const response = await fetch(url, {
                    headers: { 'Content-Type': 'application/json' },
                    ...options
                });
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
        
        async function searchStudents(query) {
            if (query.length < 1) {
                hideAutocomplete();
                return;
            }
            
            try {
                const data = await apiCall(`api.php?action=all_students&page=1&search=${encodeURIComponent(query)}`);
                students = data.students || [];
                renderAutocomplete(students);
            } catch (error) {
                console.error('Autocomplete error');
            }
        }
        
        function renderAutocomplete(students) {
            if (students.length === 0) {
                autocompleteList.innerHTML = '<div class="autocomplete-no-results">No students found</div>';
                autocompleteList.classList.add('show');
                return;
            }
            
            autocompleteList.innerHTML = students.slice(0, 8).map((s, i) => `
                <div class="autocomplete-item" data-index="${i}" onclick="selectStudent(${i})">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="student-id">${s.student_id}</span>
                            <span class="student-name ms-2">${s.name}</span>
                            <span class="student-dept ms-2">${s.department}</span>
                        </div>
                        <span class="vote-status ${s.has_voted ? 'voted' : 'not-voted'}">
                            ${s.has_voted ? 'Voted' : 'Not Voted'}
                        </span>
                    </div>
                </div>
            `).join('');
            
            autocompleteList.classList.add('show');
            selectedIndex = -1;
        }
        
        function selectStudent(index) {
            const student = students[index];
            if (student) {
                studentIdInput.value = student.student_id;
                hideAutocomplete();
                searchStudent();
            }
        }
        
        function hideAutocomplete() {
            autocompleteList.classList.remove('show');
            selectedIndex = -1;
        }
        
        function navigateAutocomplete(direction) {
            const items = autocompleteList.querySelectorAll('.autocomplete-item');
            if (items.length === 0) return;
            
            items.forEach(item => item.classList.remove('active'));
            
            if (direction === 'down') {
                selectedIndex = selectedIndex < items.length - 1 ? selectedIndex + 1 : 0;
            } else {
                selectedIndex = selectedIndex > 0 ? selectedIndex - 1 : items.length - 1;
            }
            
            items[selectedIndex].classList.add('active');
            items[selectedIndex].scrollIntoView({ block: 'nearest' });
        }

        async function searchStudent() {
            if (isProcessing) return;
            const studentId = studentIdInput.value.trim();
            
            if (!studentId) {
                studentIdInput.classList.add('is-invalid');
                return;
            }
            
            studentIdInput.classList.remove('is-invalid');
            isProcessing = true;
            searchBtn.disabled = true;
            searchBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Searching...';
            
            try {
                const data = await apiCall(`api.php?action=search&student_id=${encodeURIComponent(studentId)}`);
                displayStudent(data.student);
            } catch (error) {
                resultContainer.innerHTML = `
                    <div class="result-card danger">
                        <div class="result-icon">
                            <i class="bi bi-x-lg"></i>
                        </div>
                        <h3 class="result-title">Student Not Found</h3>
                        <p class="result-details">No student found with ID: <strong class="font-mono">${studentId}</strong></p>
                    </div>
                `;
            } finally {
                isProcessing = false;
                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="bi bi-search"></i> Search Student';
            }
        }

        function displayStudent(student) {
            const isVoted = student.has_voted;
            
            resultContainer.innerHTML = `
                <div class="result-card ${isVoted ? 'danger' : 'success'}">
                    <div class="result-icon">
                        <i class="bi bi-${isVoted ? 'x-lg' : 'check-lg'}"></i>
                    </div>
                    <h3 class="result-title">${isVoted ? 'Already Voted' : 'Can Vote'}</h3>
                    <p class="result-name">${student.name}</p>
                    <p class="result-details">
                        <span class="font-mono">${student.student_id}</span> &bull; ${student.department}
                    </p>
                    ${student.voted_at ? `<p class="result-time"><i class="bi bi-clock me-1"></i>${new Date(student.voted_at).toLocaleString()}</p>` : ''}
                    
                    ${isVoted ? `
                        <div style="margin-top: 16px; padding: 12px; background: rgba(220, 38, 38, 0.1); border-radius: 8px;">
                            <p style="margin: 0; font-size: 0.875rem; color: var(--danger);">
                                <i class="bi bi-exclamation-triangle me-1"></i>
                                This student has already voted and cannot vote again.
                            </p>
                        </div>
                    ` : `
                        <button id="confirmVoteBtn" class="btn confirm-btn" data-student-id="${student.student_id}">
                            <i class="bi bi-check-circle"></i>
                            Confirm Vote
                        </button>
                    `}
                </div>
            `;
            
            const confirmBtn = document.getElementById('confirmVoteBtn');
            if (confirmBtn) {
                confirmBtn.addEventListener('click', () => confirmVote(student.student_id));
            }
        }

        async function confirmVote(studentId) {
            const btn = document.getElementById('confirmVoteBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Confirming...';
            
            try {
                await apiCall('api.php', {
                    method: 'POST',
                    body: JSON.stringify({ action: 'confirm_vote', student_id: studentId })
                });
                
                showToast('Vote confirmed successfully!');
                studentIdInput.value = '';
                
                displayStudent({ ...arguments, has_voted: true, voted_at: new Date().toISOString() });
                loadStats();
                
                setTimeout(() => {
                    resultContainer.innerHTML = '';
                }, 2000);
            } catch (error) {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle"></i> Confirm Vote';
            }
        }

        async function loadStats() {
            try {
                const data = await apiCall('api.php?action=stats');
                document.getElementById('totalCount').textContent = data.stats.total;
                document.getElementById('votedCount').textContent = data.stats.voted;
                document.getElementById('percentage').textContent = data.stats.percentage + '%';
            } catch (error) {
                console.error('Failed to load stats');
            }
        }

        document.getElementById('searchForm').addEventListener('submit', (e) => {
            e.preventDefault();
            if (selectedIndex >= 0) {
                selectStudent(selectedIndex);
            } else {
                searchStudent();
            }
        });

        studentIdInput.addEventListener('input', () => {
            studentIdInput.classList.remove('is-invalid');
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                searchStudents(studentIdInput.value.trim());
            }, 250);
        });

        studentIdInput.addEventListener('keydown', (e) => {
            if (!autocompleteList.classList.contains('show')) return;
            
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                navigateAutocomplete('down');
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                navigateAutocomplete('up');
            } else if (e.key === 'Enter') {
                e.preventDefault();
                if (selectedIndex >= 0) {
                    selectStudent(selectedIndex);
                }
            } else if (e.key === 'Escape') {
                hideAutocomplete();
            }
        });

        document.addEventListener('click', (e) => {
            if (!e.target.closest('.autocomplete-wrapper')) {
                hideAutocomplete();
            }
        });

        loadStats();
        setInterval(loadStats, 30000);
    </script>
</body>
</html>
