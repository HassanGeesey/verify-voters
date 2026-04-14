<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Voting System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
    <style>
        :root {
            --primary: #2563eb;
            --success: #16a34a;
            --danger: #dc2626;
        }
        
        body {
            background: #f8fafc;
        }
        
        .sidebar {
            background: white;
            min-height: 100vh;
            border-right: 1px solid #e2e8f0;
        }
        
        .nav-link {
            border-radius: 8px;
            padding: 12px 16px;
            color: #64748b;
            transition: all 0.2s;
        }
        
        .nav-link:hover, .nav-link.active {
            background: #f1f5f9;
            color: var(--primary);
        }
        
        .stat-card {
            border-radius: 12px;
            border: none;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .table-modern {
            border-radius: 12px;
            overflow: hidden;
        }
        
        .table-modern thead {
            background: linear-gradient(135deg, var(--primary), #1d4ed8);
            color: white;
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }
        
        .chart-container {
            position: relative;
            height: 250px;
            width: 100%;
        }
        
        .chart-container canvas {
            max-height: 100%;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                z-index: 100;
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 col-lg-2 sidebar p-3" id="sidebar">
                <h5 class="mb-4 fw-bold text-primary">
                    <i class="bi bi-shield-check me-2"></i>Voting Admin
                </h5>
                <ul class="nav flex-column gap-2">
                    <li class="nav-item">
                        <a class="nav-link active" href="#" data-page="dashboard">
                            <i class="bi bi-grid me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="students">
                            <i class="bi bi-people me-2"></i>Students
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="add">
                            <i class="bi bi-person-plus me-2"></i>Add Student
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-page="import">
                            <i class="bi bi-upload me-2"></i>Import Students
                        </a>
                    </li>
                    <li class="nav-item mt-3">
                        <a class="nav-link" href="index.php">
                            <i class="bi bi-box-arrow-left me-2"></i>Back to Voting
                        </a>
                    </li>
                </ul>
            </nav>
            
            <main class="col-md-10 col-lg-10 ms-auto p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="h4 fw-bold mb-1" id="pageTitle">Dashboard</h2>
                        <p class="text-muted mb-0" id="pageSubtitle">Overview of voting statistics</p>
                    </div>
                    <button class="btn btn-primary d-md-none" id="menuToggle">
                        <i class="bi bi-list"></i>
                    </button>
                </div>
                
                <div id="dashboardPage">
                    <div class="row g-4 mb-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Total Students</p>
                                        <h3 class="mb-0 fw-bold" id="statTotal">0</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Voted</p>
                                        <h3 class="mb-0 fw-bold text-success" id="statVoted">0</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Not Voted</p>
                                        <h3 class="mb-0 fw-bold text-warning" id="statNotVoted">0</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Turnout</p>
                                        <h3 class="mb-0 fw-bold" id="statPercentage">0%</h3>
                                    </div>
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-pie-chart-fill text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3"><i class="bi bi-pie-chart me-2"></i>Voting Progress</h5>
                                    <div class="chart-container">
                                        <canvas id="votingChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body">
                                    <h5 class="mb-3"><i class="bi bi-bar-chart me-2"></i>Department Breakdown</h5>
                                    <div class="chart-container">
                                        <canvas id="deptChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row g-4 mb-4">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Total Students</p>
                                        <h3 class="mb-0 fw-bold" id="statTotal">0</h3>
                                    </div>
                                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-people-fill text-primary fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Voted</p>
                                        <h3 class="mb-0 fw-bold text-success" id="statVoted">0</h3>
                                    </div>
                                    <div class="bg-success bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Not Voted</p>
                                        <h3 class="mb-0 fw-bold text-warning" id="statNotVoted">0</h3>
                                    </div>
                                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="card stat-card bg-white shadow-sm p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="text-muted mb-1 small">Turnout</p>
                                        <h3 class="mb-0 fw-bold" id="statPercentage">0%</h3>
                                    </div>
                                    <div class="bg-info bg-opacity-10 p-3 rounded">
                                        <i class="bi bi-pie-chart-fill text-info fs-4"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Activity</h5>
                            <button class="btn btn-success btn-sm" onclick="exportCSV()">
                                <i class="bi bi-download me-1"></i>Export CSV
                            </button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-modern table-hover mb-0">
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
                                            <td colspan="6" class="text-center py-4">Loading...</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <nav>
                                <ul class="pagination pagination-sm mb-0 justify-content-center" id="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <div id="addStudentPage" style="display: none;">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Add New Student</h5>
                            <form id="addStudentForm">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Student ID</label>
                                        <input type="text" class="form-control" name="student_id" required placeholder="STU011">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" required placeholder="Enter full name">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Department</label>
                                        <input type="text" class="form-control" name="department" required placeholder="Enter department">
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-plus-circle me-2"></i>Add Student
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div id="importPage" style="display: none;">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-4">
                                    <h5 class="mb-3"><i class="bi bi-upload me-2"></i>Import Students from CSV</h5>
                                    <p class="text-muted small mb-4">Upload a CSV file with columns: Student ID, Name, Department</p>
                                    
                                    <form id="importForm">
                                        <div class="mb-4">
                                            <input type="file" class="form-control" id="importFile" accept=".csv,.txt" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary" id="importBtn">
                                            <i class="bi bi-upload me-2"></i>Import Students
                                        </button>
                                    </form>
                                    
                                    <div id="importResult" class="mt-4" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card border-0 shadow-sm bg-primary bg-opacity-5">
                                <div class="card-body p-4">
                                    <h5 class="mb-3"><i class="bi bi-file-earmark-text me-2"></i>CSV Format</h5>
                                    <p class="small text-muted mb-3">Your CSV file should have these columns:</p>
                                    <div class="bg-white rounded p-3 small mb-3">
                                        <code>student_id,name,department</code><br>
                                        <code>STU001,Ahmed Mohamed,Computer Science</code><br>
                                        <code>STU002,Fatima Ali,Business</code>
                                    </div>
                                    <button class="btn btn-outline-primary btn-sm w-100" onclick="downloadTemplate()">
                                        <i class="bi bi-download me-2"></i>Download Template
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let currentPage = 1;
        let currentSearch = '';
        let votingChart, deptChart;
        
        const chartColors = [
            '#2563eb', '#16a34a', '#ca8a04', '#dc2626', '#7c3aed',
            '#0891b2', '#be185d', '#047857', '#b45309', '#6366f1'
        ];
        
        async function apiCall(url, options = {}) {
            try {
                const response = await fetch(url, {
                    ...options
                });
                const data = await response.json();
                if (!response.ok) throw new Error(data.error || 'Request failed');
                return data;
            } catch (error) {
                showToast(error.message, 'danger');
                throw error;
            }
        }
        
        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3`;
            toast.style.cssText = 'z-index: 1050; min-width: 280px;';
            toast.innerHTML = message;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
        }
        
        function initCharts() {
            Chart.defaults.animation = { duration: 0 };
            Chart.defaults.responsive = true;
            Chart.defaults.maintainAspectRatio = false;
            
            const votingCtx = document.getElementById('votingChart').getContext('2d');
            votingChart = new Chart(votingCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Voted', 'Not Voted'],
                    datasets: [{
                        data: [0, 0],
                        backgroundColor: ['#16a34a', '#f59e0b'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { padding: 15, usePointStyle: true }
                        }
                    }
                }
            });
            
            const deptCtx = document.getElementById('deptChart').getContext('2d');
            deptChart = new Chart(deptCtx, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: 'Total',
                        data: [],
                        backgroundColor: '#2563eb',
                        borderRadius: 4
                    }, {
                        label: 'Voted',
                        data: [],
                        backgroundColor: '#16a34a',
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { padding: 15, usePointStyle: true }
                        }
                    },
                    scales: {
                        x: { grid: { display: false } },
                        y: { beginAtZero: true, ticks: { stepSize: 1, precision: 0 } }
                    }
                }
            });
        }
        
        async function loadStats() {
            try {
                const data = await apiCall('api.php?action=stats');
                document.getElementById('statTotal').textContent = data.stats.total;
                document.getElementById('statVoted').textContent = data.stats.voted;
                document.getElementById('statNotVoted').textContent = data.stats.not_voted;
                document.getElementById('statPercentage').textContent = data.stats.percentage + '%';
                
                if (votingChart) {
                    votingChart.data.datasets[0].data = [data.stats.voted, data.stats.not_voted];
                    votingChart.update();
                }
                
                if (deptChart && data.departments) {
                    deptChart.data.labels = data.departments.map(d => d.department);
                    deptChart.data.datasets[0].data = data.departments.map(d => d.count);
                    deptChart.data.datasets[1].data = data.departments.map(d => d.voted);
                    deptChart.update();
                }
            } catch (error) {
                console.error('Failed to load stats');
            }
        }
        
        async function loadStudents(page = 1) {
            currentPage = page;
            const tbody = document.getElementById('studentsTable');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4">Loading...</td></tr>';
            
            try {
                const data = await apiCall(`api.php?action=all_students&page=${page}&search=${encodeURIComponent(currentSearch)}`);
                renderStudents(data.students);
                renderPagination(data.pagination);
            } catch (error) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-danger">Failed to load students</td></tr>';
            }
        }
        
        function renderStudents(students) {
            const tbody = document.getElementById('studentsTable');
            
            if (students.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">No students found</td></tr>';
                return;
            }
            
            tbody.innerHTML = students.map(s => `
                <tr>
                    <td><strong>${s.student_id}</strong></td>
                    <td>${s.name}</td>
                    <td>${s.department}</td>
                    <td>
                        <span class="badge ${s.has_voted ? 'bg-success' : 'bg-warning'}">
                            <span class="status-dot me-1 ${s.has_voted ? 'bg-white' : 'bg-dark'}"></span>
                            ${s.has_voted ? 'Voted' : 'Not Voted'}
                        </span>
                    </td>
                    <td>${s.voted_at ? new Date(s.voted_at).toLocaleString() : '-'}</td>
                    <td>
                        ${s.has_voted ? `
                            <button class="btn btn-outline-danger btn-sm" onclick="resetVote('${s.student_id}')">
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
                html += `<li class="page-item"><a class="page-link" href="#" onclick="loadStudents(${pagination.current_page - 1}); return false;">Prev</a></li>`;
            }
            
            for (let i = 1; i <= pagination.total_pages; i++) {
                if (i === pagination.current_page) {
                    html += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
                } else if (i <= 3 || i > pagination.total_pages - 2 || Math.abs(i - pagination.current_page) <= 1) {
                    html += `<li class="page-item"><a class="page-link" href="#" onclick="loadStudents(${i}); return false;">${i}</a></li>`;
                } else if (i === 4 || i === pagination.total_pages - 3) {
                    html += `<li class="page-item"><span class="page-link">...</span></li>`;
                }
            }
            
            if (pagination.current_page < pagination.total_pages) {
                html += `<li class="page-item"><a class="page-link" href="#" onclick="loadStudents(${pagination.current_page + 1}); return false;">Next</a></li>`;
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
                showToast('Vote reset successfully', 'success');
                loadStudents(currentPage);
                loadStats();
            } catch (error) {
                console.error('Failed to reset vote');
            }
        }
        
        function exportCSV() {
            window.location.href = 'api.php?action=export_csv';
        }
        
        function downloadTemplate() {
            const csv = 'student_id,name,department\nSTU001,Ahmed Mohamed,Computer Science\nSTU002,Fatima Ali,Business Administration';
            const blob = new Blob([csv], { type: 'text/csv' });
            const url = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = url;
            a.download = 'students_template.csv';
            a.click();
            URL.revokeObjectURL(url);
        }
        
        document.getElementById('addStudentForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const formData = new FormData(e.target);
            const data = {
                action: 'add_student',
                student_id: formData.get('student_id'),
                name: formData.get('name'),
                department: formData.get('department')
            };
            
            try {
                await apiCall('api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                });
                showToast('Student added successfully', 'success');
                e.target.reset();
                loadStats();
            } catch (error) {
                console.error('Failed to add student');
            }
        });
        
        document.getElementById('importForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            const fileInput = document.getElementById('importFile');
            const btn = document.getElementById('importBtn');
            const resultDiv = document.getElementById('importResult');
            
            if (!fileInput.files[0]) {
                showToast('Please select a file', 'warning');
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'import_students');
            formData.append('file', fileInput.files[0]);
            
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Importing...';
            
            try {
                const response = await fetch('api.php', {
                    method: 'POST',
                    body: formData
                });
                const data = await response.json();
                
                if (!response.ok) throw new Error(data.error || 'Import failed');
                
                resultDiv.innerHTML = `
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle me-2"></i>${data.message}
                    </div>
                `;
                resultDiv.style.display = 'block';
                fileInput.value = '';
                loadStats();
                
            } catch (error) {
                resultDiv.innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-circle me-2"></i>${error.message}
                    </div>
                `;
                resultDiv.style.display = 'block';
            } finally {
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-upload me-2"></i>Import Students';
            }
        });
        
        document.getElementById('menuToggle').addEventListener('click', () => {
            document.getElementById('sidebar').classList.toggle('show');
        });
        
        document.querySelectorAll('.nav-link[data-page]').forEach(link => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const page = link.dataset.page;
                
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                link.classList.add('active');
                
                document.getElementById('dashboardPage').style.display = page === 'dashboard' || page === 'students' ? 'block' : 'none';
                document.getElementById('addStudentPage').style.display = page === 'add' ? 'block' : 'none';
                document.getElementById('importPage').style.display = page === 'import' ? 'block' : 'none';
                
                if (page === 'add') {
                    document.getElementById('pageTitle').textContent = 'Add Student';
                    document.getElementById('pageSubtitle').textContent = 'Register a new student for voting';
                } else if (page === 'import') {
                    document.getElementById('pageTitle').textContent = 'Import Students';
                    document.getElementById('pageSubtitle').textContent = 'Bulk import from CSV file';
                    document.getElementById('importResult').style.display = 'none';
                } else {
                    document.getElementById('pageTitle').textContent = 'Dashboard';
                    document.getElementById('pageSubtitle').textContent = 'Overview of voting statistics';
                }
                
                if (page === 'students') {
                    loadStudents(1);
                }
                
                document.getElementById('sidebar').classList.remove('show');
            });
        });
        
        initCharts();
        loadStats();
        loadStudents(1);
    </script>
</body>
</html>
