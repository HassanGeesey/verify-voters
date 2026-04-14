<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Voting Verification System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary: #2563eb;
            --success: #16a34a;
            --danger: #dc2626;
            --warning: #ca8a04;
        }
        
        body {
            background: linear-gradient(135deg, #f0f4f8 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        
        .card-elevated {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        }
        
        .search-input {
            border-radius: 12px;
            padding: 16px 20px;
            font-size: 1.1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s;
        }
        
        .search-input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(37,99,235,0.1);
        }
        
        .btn-vote {
            border-radius: 12px;
            padding: 14px 32px;
            font-size: 1.1rem;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-vote:hover {
            transform: translateY(-2px);
        }
        
        .status-badge {
            border-radius: 50px;
            padding: 12px 24px;
            font-weight: 600;
        }
        
        .student-card {
            border-radius: 12px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .student-card.animate-in {
            animation: slideUp 0.4s ease-out;
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
        
        .stat-card {
            border-radius: 12px;
            padding: 20px;
            text-align: center;
        }
        
        .pulse-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .fade-in {
            animation: fadeIn 0.3s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .admin-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }
        
        @media (max-width: 768px) {
            .btn-vote {
                width: 100%;
                margin-bottom: 10px;
            }
            
            .stat-card {
                padding: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="text-center mb-4">
                    <h1 class="h3 fw-bold text-dark mb-2">
                        <i class="bi bi-shield-check text-primary me-2"></i>
                        Student Voting Verification
                    </h1>
                    <p class="text-muted">Enter student ID to verify and record vote</p>
                </div>
                
                <div class="card card-elevated p-4 mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-12 col-md-8">
                            <label for="studentId" class="form-label fw-semibold">Student ID</label>
                            <input 
                                type="text" 
                                id="studentId" 
                                class="form-control search-input" 
                                placeholder="Enter or scan student ID..."
                                autocomplete="off"
                                autofocus
                            >
                        </div>
                        <div class="col-12 col-md-4">
                            <button id="searchBtn" class="btn btn-primary w-100 btn-vote">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                        </div>
                    </div>
                </div>
                
                <div id="resultContainer" class="mb-4" style="display: none;"></div>
                
                <div class="row g-3">
                    <div class="col-4">
                        <div class="stat-card bg-white">
                            <h3 id="totalCount" class="mb-1 fw-bold text-primary">0</h3>
                            <small class="text-muted">Total Students</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card bg-white">
                            <h3 id="votedCount" class="mb-1 fw-bold text-success">0</h3>
                            <small class="text-muted">Voted</small>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stat-card bg-white">
                            <h3 id="percentage" class="mb-1 fw-bold text-warning">0%</h3>
                            <small class="text-muted">Turnout</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <a href="admin.php" class="btn btn-dark btn-sm admin-link shadow">
        <i class="bi bi-gear me-1"></i> Admin
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const studentIdInput = document.getElementById('studentId');
        const searchBtn = document.getElementById('searchBtn');
        const resultContainer = document.getElementById('resultContainer');
        
        let isProcessing = false;
        
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
                showToast(error.message, 'danger');
                throw error;
            }
        }
        
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} position-fixed top-0 start-50 translate-middle-x mt-3 z-100`;
            toast.style.cssText = 'z-index: 1050; min-width: 280px;';
            toast.innerHTML = `<i class="bi bi-${type === 'success' ? 'check-circle' : type === 'danger' ? 'exclamation-circle' : 'info-circle'} me-2"></i>${message}`;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 3000);
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
                    <div class="card card-elevated student-card animate-in border border-danger">
                        <div class="card-body text-center py-5">
                            <i class="bi bi-x-circle text-danger" style="font-size: 4rem;"></i>
                            <h4 class="mt-3 text-danger">Student Not Found</h4>
                            <p class="text-muted">No student found with ID: <strong>${studentId}</strong></p>
                        </div>
                    </div>
                `;
                resultContainer.style.display = 'block';
            } finally {
                isProcessing = false;
                searchBtn.disabled = false;
                searchBtn.innerHTML = '<i class="bi bi-search me-2"></i>Search';
            }
        }
        
        function displayStudent(student) {
            const isVoted = student.has_voted;
            const statusClass = isVoted ? 'danger' : 'success';
            const statusIcon = isVoted ? 'x-circle' : 'check-circle';
            const statusText = isVoted ? 'Already Voted' : 'Can Vote';
            const borderClass = isVoted ? 'border-danger' : 'border-success';
            
            resultContainer.innerHTML = `
                <div class="card card-elevated student-card animate-in ${borderClass}">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h4 class="mb-1 fw-bold">${student.name}</h4>
                                <p class="mb-0 text-muted">
                                    <i class="bi bi-person-badge me-1"></i>${student.student_id}
                                </p>
                            </div>
                            <span class="badge bg-${statusClass} status-badge">
                                <i class="bi bi-${statusIcon} me-1"></i>${statusText}
                            </span>
                        </div>
                        
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted d-block">Department</small>
                                    <strong>${student.department}</strong>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-3 bg-light rounded">
                                    <small class="text-muted d-block">Status</small>
                                    <strong class="text-${statusClass}">
                                        ${isVoted ? 'Voted' : 'Not Voted'}
                                    </strong>
                                </div>
                            </div>
                        </div>
                        
                        ${student.voted_at ? `
                            <div class="text-center text-muted small mb-3">
                                <i class="bi bi-clock me-1"></i>
                                Voted on: ${new Date(student.voted_at).toLocaleString()}
                            </div>
                        ` : ''}
                        
                        ${isVoted ? `
                            <div class="alert alert-danger mb-0">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                This student has already voted and cannot vote again.
                            </div>
                        ` : `
                            <button id="confirmVoteBtn" class="btn btn-success btn-vote w-100" data-student-id="${student.student_id}">
                                <i class="bi bi-check-circle me-2"></i>Confirm Vote
                            </button>
                        `}
                    </div>
                </div>
            `;
            
            resultContainer.style.display = 'block';
            
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
                const response = await fetch('api.php?action=search&student_id=' + encodeURIComponent(studentId));
                const data = await response.json();
                
                if (!data.student || data.student.has_voted) {
                    throw new Error('This student has already voted');
                }
                
                await apiCall('api.php', {
                    method: 'POST',
                    body: JSON.stringify({ action: 'confirm_vote', student_id: studentId })
                });
                
                showToast('Vote confirmed successfully!', 'success');
                studentIdInput.value = '';
                studentIdInput.focus();
                
                displayStudent({ ...data.student, has_voted: true, voted_at: new Date().toISOString() });
                loadStats();
            } catch (error) {
                showToast(error.message, 'danger');
                btn.disabled = false;
                btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Confirm Vote';
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
        
        studentIdInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') searchStudent();
        });
        
        studentIdInput.addEventListener('input', () => {
            studentIdInput.classList.remove('is-invalid');
        });
        
        searchBtn.addEventListener('click', searchStudent);
        
        loadStats();
        setInterval(loadStats, 30000);
    </script>
</body>
</html>
