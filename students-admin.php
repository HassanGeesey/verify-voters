<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students - Zamzam University</title>
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
            --warning: #ca8a04;
            --danger: #dc2626;
            --bg: #f8fafc;
            --surface: #ffffff;
            --text-primary: #0f172a;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05);
            --radius: 12px;
            --radius-sm: 8px;
            --sidebar-width: 260px;
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
            flex-wrap: wrap;
            gap: 16px;
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
            box-shadow: var(--shadow);
        }

        .card-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        .card-title {
            font-size: 1rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .card-body {
            padding: 0;
        }

        /* Search & Filter */
        .search-box {
            display: flex;
            gap: 12px;
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            background: var(--bg);
        }

        .search-input {
            flex: 1;
            padding: 10px 16px;
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            font-size: 0.9375rem;
            font-family: inherit;
            transition: all 0.2s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.1);
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            text-align: left;
            padding: 14px 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            border-bottom: 1px solid var(--border);
            background: var(--bg);
            white-space: nowrap;
        }

        .table td {
            padding: 16px 20px;
            border-bottom: 1px solid var(--border);
            font-size: 0.9375rem;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .table tr:hover td {
            background: var(--bg);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 4px 10px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-success {
            background: rgba(5, 150, 105, 0.1);
            color: var(--success);
        }

        .badge-warning {
            background: rgba(202, 138, 4, 0.1);
            color: var(--warning);
        }

        /* Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-success {
            background: rgba(5, 150, 105, 0.1);
            color: var(--success);
        }

        .btn-success:hover {
            background: var(--success);
            color: white;
        }

        .btn-danger {
            background: rgba(220, 38, 38, 0.1);
            color: var(--danger);
        }

        .btn-danger:hover {
            background: var(--danger);
            color: white;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.8125rem;
        }

        .btn-block {
            width: 100%;
        }

        /* Pagination */
        .pagination {
            display: flex;
            gap: 8px;
            justify-content: center;
            padding: 20px;
            border-top: 1px solid var(--border);
        }

        .pagination button {
            min-width: 40px;
            height: 40px;
            border: 1px solid var(--border);
            background: var(--surface);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .pagination button:hover:not(:disabled) {
            border-color: var(--primary);
            color: var(--primary);
        }

        .pagination button.active {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .pagination button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Add Student Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
        }

        .modal-overlay.show {
            opacity: 1;
            visibility: visible;
        }

        .modal {
            background: var(--surface);
            border-radius: var(--radius);
            width: 100%;
            max-width: 480px;
            max-height: 90vh;
            overflow-y: auto;
            transform: scale(0.95);
            transition: transform 0.2s ease;
        }

        .modal-overlay.show .modal {
            transform: scale(1);
        }

        .modal-header {
            padding: 20px 24px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .modal-header h3 {
            margin: 0;
            font-size: 1.125rem;
            font-weight: 600;
        }

        .modal-close {
            width: 32px;
            height: 32px;
            border: none;
            background: var(--bg);
            border-radius: var(--radius-sm);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .modal-close:hover {
            background: var(--border);
        }

        .modal-body {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 8px;
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

        .modal-footer {
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        /* Toast */
        .toast-container {
            position: fixed;
            top: 24px;
            right: 24px;
            z-index: 1001;
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

        /* Stats */
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

        .stat-icon.warning {
            background: rgba(202, 138, 4, 0.1);
            color: var(--warning);
        }

        .stat-icon.info {
            background: rgba(8, 145, 178, 0.1);
            color: #0891b2;
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
                    <a href="candidates-admin.php" class="nav-link">
                        <i class="bi bi-people-fill"></i>
                        Candidates
                    </a>
                </div>
                <div class="nav-item">
                    <a href="students-admin.php" class="nav-link active">
                        <i class="bi bi-person-badge"></i>
                        Students
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="openAddModal(); return false;">
                        <i class="bi bi-person-plus"></i>
                        Add Student
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="openImportModal(); return false;">
                        <i class="bi bi-file-earmark-arrow-up"></i>
                        Import CSV
                    </a>
                </div>
                <div class="nav-item">
                    <a href="#" class="nav-link" onclick="downloadSampleCSV(); return false;">
                        <i class="bi bi-file-earmark-arrow-down"></i>
                        CSV Format
                    </a>
                </div>
                <div class="nav-item">
                    <a href="dashboard.php" class="nav-link">
                        <i class="bi bi-display"></i>
                        Voting Dashboard
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
                    <h1 class="page-title">Students</h1>
                    <p class="page-subtitle">Manage student records and voting status</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-success" onclick="openImportModal()">
                        <i class="bi bi-upload"></i>
                        Import CSV
                    </button>
                    <button class="btn btn-primary" onclick="openAddModal()">
                        <i class="bi bi-plus-lg"></i>
                        Add Student
                    </button>
                </div>
            </div>

            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon primary">
                        <i class="bi bi-people-fill"></i>
                    </div>
                    <div>
                        <div id="statTotal" class="stat-value">0</div>
                        <div class="stat-label">Total Students</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div>
                        <div id="statVoted" class="stat-value">0</div>
                        <div class="stat-label">Voted</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon warning">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div id="statNotVoted" class="stat-value">0</div>
                        <div class="stat-label">Not Voted</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon info">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                    <div>
                        <div id="statPercentage" class="stat-value">0%</div>
                        <div class="stat-label">Turnout</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="search-box">
                    <input type="text" class="search-input" id="searchInput" placeholder="Search by Student ID, Name, or Department...">
                    <button class="btn btn-primary" onclick="loadStudents(1)">
                        <i class="bi bi-search"></i>
                        Search
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                    <th>Voted At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="studentsTable">
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="spinner-border text-primary" role="status"></div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="pagination"></div>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Student Modal -->
    <div class="modal-overlay" id="addModal">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-person-plus me-2"></i>Add New Student</h3>
                <button class="modal-close" onclick="closeAddModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="addStudentForm">
                    <div class="form-group">
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" name="student_id" placeholder="e.g. STU001" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter full name" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Department</label>
                        <input type="text" class="form-control" name="department" placeholder="Enter department" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn" style="background: var(--bg);" onclick="closeAddModal()">Cancel</button>
                <button class="btn btn-primary" onclick="submitAddStudent()">
                    <i class="bi bi-check-lg"></i>
                    Add Student
                </button>
            </div>
        </div>
    </div>

    <!-- Import Modal -->
    <div class="modal-overlay" id="importModal">
        <div class="modal">
            <div class="modal-header">
                <h3><i class="bi bi-upload me-2"></i>Import Students</h3>
                <button class="modal-close" onclick="closeImportModal()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <div class="modal-body">
                <p class="text-muted mb-3">Upload a CSV file with columns: student_id, name, department</p>
                <input type="file" class="form-control" id="importFile" accept=".csv,.txt">
                <div class="mt-3 p-3" style="background: var(--bg); border-radius: var(--radius-sm);">
                    <p class="small mb-1"><strong>CSV Format:</strong></p>
                    <code class="small">student_id,name,department</code><br>
                    <code class="small">STU001,Ahmed Mohamed,Computer Science</code>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn" style="background: var(--bg);" onclick="closeImportModal()">Cancel</button>
                <button class="btn btn-primary" onclick="importStudents()">
                    <i class="bi bi-upload"></i>
                    Import
                </button>
            </div>
        </div>
    </div>

    <div class="toast-container" id="toastContainer"></div>

    <script>
        let currentPage = 1;
        let searchQuery = '';

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

        async function loadStats() {
            try {
                const data = await apiCall('api.php?action=stats');
                document.getElementById('statTotal').textContent = data.stats.total;
                document.getElementById('statVoted').textContent = data.stats.voted;
                document.getElementById('statNotVoted').textContent = data.stats.not_voted;
                document.getElementById('statPercentage').textContent = data.stats.percentage + '%';
            } catch (error) {
                console.error('Failed to load stats');
            }
        }

        async function loadStudents(page = 1) {
            currentPage = page;
            const tbody = document.getElementById('studentsTable');
            const search = document.getElementById('searchInput').value.trim();
            searchQuery = search;
            
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-5"><div class="spinner-border text-primary" role="status"></div></td></tr>';
            
            try {
                const data = await apiCall(`api.php?action=all_students&page=${page}&search=${encodeURIComponent(search)}`);
                renderStudents(data.students);
                renderPagination(data.pagination);
            } catch (error) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-danger">Failed to load students</td></tr>';
            }
        }

        function renderStudents(students) {
            const tbody = document.getElementById('studentsTable');
            
            if (students.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <i class="bi bi-people"></i>
                                <p>No students found</p>
                            </div>
                        </td>
                    </tr>
                `;
                return;
            }
            
            tbody.innerHTML = students.map(s => `
                <tr>
                    <td><strong class="font-mono">${s.student_id}</strong></td>
                    <td>${s.name}</td>
                    <td>${s.department}</td>
                    <td>
                        <span class="badge ${s.has_voted ? 'badge-success' : 'badge-warning'}">
                            <i class="bi bi-${s.has_voted ? 'check-circle' : 'clock'}"></i>
                            ${s.has_voted ? 'Voted' : 'Not Voted'}
                        </span>
                    </td>
                    <td class="text-muted">${s.voted_at ? new Date(s.voted_at).toLocaleString() : '-'}</td>
                    <td>
                        ${s.has_voted ? `
                            <button class="btn btn-danger btn-sm" onclick="resetVote('${s.student_id}')">
                                <i class="bi bi-arrow-counterclockwise"></i>
                            </button>
                        ` : '<span class="text-muted">-</span>'}
                    </td>
                </tr>
            `).join('');
        }

        function renderPagination(pagination) {
            const ul = document.getElementById('pagination');
            if (pagination.total_pages <= 1) {
                ul.innerHTML = '';
                return;
            }
            
            let html = '';
            
            if (pagination.current_page > 1) {
                html += `<button onclick="loadStudents(${pagination.current_page - 1})"><i class="bi bi-chevron-left"></i></button>`;
            }
            
            for (let i = 1; i <= pagination.total_pages; i++) {
                if (i === pagination.current_page) {
                    html += `<button class="active">${i}</button>`;
                } else if (i <= 3 || i > pagination.total_pages - 2 || Math.abs(i - pagination.current_page) <= 1) {
                    html += `<button onclick="loadStudents(${i})">${i}</button>`;
                } else if (i === 4 || i === pagination.total_pages - 3) {
                    html += `<button disabled>...</button>`;
                }
            }
            
            if (pagination.current_page < pagination.total_pages) {
                html += `<button onclick="loadStudents(${pagination.current_page + 1})"><i class="bi bi-chevron-right"></i></button>`;
            }
            
            ul.innerHTML = html;
        }

        async function resetVote(studentId) {
            if (!confirm('Reset vote for this student?')) return;
            
            try {
                await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ action: 'reset_vote', student_id: studentId })
                });
                showToast('Vote reset successfully');
                loadStudents(currentPage);
                loadStats();
            } catch (error) {
                console.error('Failed to reset vote');
            }
        }

        function openAddModal() {
            document.getElementById('addModal').classList.add('show');
        }

        function closeAddModal() {
            document.getElementById('addModal').classList.remove('show');
            document.getElementById('addStudentForm').reset();
        }

        async function submitAddStudent() {
            const form = document.getElementById('addStudentForm');
            const formData = new FormData(form);
            
            try {
                await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        action: 'add_student',
                        student_id: formData.get('student_id'),
                        name: formData.get('name'),
                        department: formData.get('department')
                    })
                });
                
                showToast('Student added successfully');
                closeAddModal();
                loadStudents(1);
                loadStats();
            } catch (error) {
                console.error('Failed to add student');
            }
        }

        function openImportModal() {
            document.getElementById('importModal').classList.add('show');
        }

        function downloadSampleCSV() {
            const csv = 'student_id,name,department\nSTU001,Ahmed Mohamed,Computer Science\nSTU002,Fatima Ali,Engineering\nSTU003,Omar Hassan,Business\nSTU004,Aisha Ibrahim,Medicine';
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students_template.csv';
            a.click();
            URL.revokeObjectURL(url);
        }

        function closeImportModal() {
            document.getElementById('importModal').classList.remove('show');
            document.getElementById('importFile').value = '';
        }

        async function importStudents() {
            const fileInput = document.getElementById('importFile');
            const file = fileInput.files[0];
            
            if (!file) {
                showToast('Please select a file', 'error');
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'import_students');
            formData.append('file', file);
            
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (!response.ok) throw new Error(data.error);
                
                showToast(data.message);
                closeImportModal();
                loadStudents(1);
                loadStats();
            } catch (error) {
                console.error('Import failed');
            }
        }

        document.getElementById('searchInput').addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                loadStudents(1);
            }
        });

        document.getElementById('mobileToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('open');
        });

        loadStats();
        loadStudents(1);
    </script>
</body>
</html>
