<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

$db = new Database();
$conn = $db->getConnection();
$method = $_SERVER['REQUEST_METHOD'];

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function jsonResponse($data, $statusCode = 200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

switch($method) {
    case 'GET':
        if (isset($_GET['action'])) {
            switch($_GET['action']) {
                case 'search':
                    if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
                        jsonResponse(['error' => 'Student ID is required'], 400);
                    }
                    
                    $studentId = sanitize($_GET['student_id']);
                    $stmt = $conn->prepare("SELECT id, student_id, name, department, has_voted, voted_at FROM students WHERE student_id = ?");
                    $stmt->execute([$studentId]);
                    $student = $stmt->fetch();
                    
                    if ($student) {
                        $student['status'] = $student['has_voted'] ? 'already_voted' : 'not_voted';
                        $student['can_vote'] = !$student['has_voted'];
                        jsonResponse(['success' => true, 'student' => $student]);
                    } else {
                        jsonResponse(['error' => 'Student not found'], 404);
                    }
                    break;
                    
                case 'stats':
                    $total = $conn->query("SELECT COUNT(*) FROM students")->fetchColumn();
                    $voted = $conn->query("SELECT COUNT(*) FROM students WHERE has_voted = 1")->fetchColumn();
                    $notVoted = $total - $voted;
                    
                    $deptStmt = $conn->query("SELECT department, COUNT(*) as count, SUM(CASE WHEN has_voted = 1 THEN 1 ELSE 0 END) as voted FROM students GROUP BY department ORDER BY count DESC");
                    $departments = $deptStmt->fetchAll();
                    
                    jsonResponse([
                        'success' => true,
                        'stats' => [
                            'total' => $total,
                            'voted' => $voted,
                            'not_voted' => $notVoted,
                            'percentage' => $total > 0 ? round(($voted / $total) * 100, 1) : 0
                        ],
                        'departments' => $departments
                    ]);
                    break;
                    
                case 'all_students':
                    $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
                    $limit = 20;
                    $offset = ($page - 1) * $limit;
                    $search = isset($_GET['search']) ? sanitize($_GET['search']) : '';
                    
                    $whereClause = '';
                    $params = [];
                    if (!empty($search)) {
                        $whereClause = "WHERE student_id LIKE ? OR name LIKE ? OR department LIKE ?";
                        $searchTerm = "%{$search}%";
                        $params = [$searchTerm, $searchTerm, $searchTerm];
                    }
                    
                    $countStmt = $conn->prepare("SELECT COUNT(*) FROM students $whereClause");
                    $countStmt->execute($params);
                    $totalRecords = $countStmt->fetchColumn();
                    $totalPages = ceil($totalRecords / $limit);
                    
                    $stmt = $conn->prepare("SELECT id, student_id, name, department, has_voted, voted_at FROM students $whereClause ORDER BY has_voted ASC, name ASC LIMIT $limit OFFSET $offset");
                    $stmt->execute($params);
                    $students = $stmt->fetchAll();
                    
                    jsonResponse([
                        'success' => true,
                        'students' => $students,
                        'pagination' => [
                            'current_page' => $page,
                            'total_pages' => $totalPages,
                            'total_records' => $totalRecords,
                            'limit' => $limit
                        ]
                    ]);
                    break;
                    
                case 'all_candidates':
                    $stmt = $conn->query("SELECT id, name, type, vote_count, created_at FROM candidates ORDER BY FIELD(type, 'Chairperson', 'Vice-Chairperson'), id DESC");
                    $candidates = $stmt->fetchAll();
                    jsonResponse(['success' => true, 'candidates' => $candidates]);
                    break;
            }
        }
        break;
        
    case 'POST':
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        
        if (stripos($contentType, 'multipart/form-data') !== false) {
            $data = $_POST;
            $file = $_FILES['image'] ?? null;
        } else {
            $data = json_decode(file_get_contents('php://input'), true);
            $file = null;
        }
        
        if (!isset($data['action'])) {
            jsonResponse(['error' => 'Action is required'], 400);
        }
        
        switch($data['action']) {
            case 'confirm_vote':
                if (!isset($data['student_id']) || empty($data['student_id'])) {
                    jsonResponse(['error' => 'Student ID is required'], 400);
                }
                
                $studentId = sanitize($data['student_id']);
                
                $stmt = $conn->prepare("SELECT id, has_voted FROM students WHERE student_id = ?");
                $stmt->execute([$studentId]);
                $student = $stmt->fetch();
                
                if (!$student) {
                    jsonResponse(['error' => 'Student not found'], 404);
                }
                
                if ($student['has_voted']) {
                    jsonResponse(['error' => 'This student has already voted', 'already_voted' => true], 400);
                }
                
                $updateStmt = $conn->prepare("UPDATE students SET has_voted = 1, voted_at = NOW() WHERE student_id = ? AND has_voted = 0");
                
                if ($updateStmt->execute([$studentId]) && $updateStmt->rowCount() > 0) {
                    jsonResponse(['success' => true, 'message' => 'Vote confirmed successfully']);
                } else {
                    jsonResponse(['error' => 'Failed to confirm vote. Student may have already voted.'], 400);
                }
                break;
                
            case 'add_student':
                $required = ['student_id', 'name', 'department'];
                foreach ($required as $field) {
                    if (!isset($data[$field]) || empty($data[$field])) {
                        jsonResponse(['error' => "Field '$field' is required"], 400);
                    }
                }
                
                $studentId = sanitize($data['student_id']);
                $name = sanitize($data['name']);
                $department = sanitize($data['department']);
                
                $checkStmt = $conn->prepare("SELECT id FROM students WHERE student_id = ?");
                $checkStmt->execute([$studentId]);
                if ($checkStmt->fetch()) {
                    jsonResponse(['error' => 'Student ID already exists'], 400);
                }
                
                $insertStmt = $conn->prepare("INSERT INTO students (student_id, name, department) VALUES (?, ?, ?)");
                if ($insertStmt->execute([$studentId, $name, $department])) {
                    jsonResponse(['success' => true, 'message' => 'Student added successfully', 'id' => $conn->lastInsertId()]);
                } else {
                    jsonResponse(['error' => 'Failed to add student'], 500);
                }
                break;
                
            case 'reset_vote':
                if (!isset($data['student_id']) || empty($data['student_id'])) {
                    jsonResponse(['error' => 'Student ID is required'], 400);
                }
                
                $studentId = sanitize($data['student_id']);
                $stmt = $conn->prepare("UPDATE students SET has_voted = 0, voted_at = NULL WHERE student_id = ?");
                
                if ($stmt->execute([$studentId])) {
                    jsonResponse(['success' => true, 'message' => 'Vote reset successfully']);
                } else {
                    jsonResponse(['error' => 'Failed to reset vote'], 500);
                }
                break;
                
            case 'export_csv':
                $stmt = $conn->query("SELECT student_id, name, department, has_voted, voted_at FROM students ORDER BY name");
                $students = $stmt->fetchAll();
                
                $csv = "Student ID,Name,Department,Has Voted,Voted At\n";
                foreach ($students as $s) {
                    $csv .= sprintf("%s,%s,%s,%s,%s\n",
                        $s['student_id'],
                        str_replace(',', ';', $s['name']),
                        str_replace(',', ';', $s['department']),
                        $s['has_voted'] ? 'Yes' : 'No',
                        $s['voted_at'] ?? 'N/A'
                    );
                }
                
                header('Content-Type: text/csv');
                header('Content-Disposition: attachment; filename="voters_report_' . date('Y-m-d_His') . '.csv"');
                echo $csv;
                exit;
                
            case 'import_students':
                if (!$file || $file['error'] === UPLOAD_ERR_NO_FILE) {
                    jsonResponse(['error' => 'No file uploaded'], 400);
                }
                
                $allowedTypes = ['text/csv', 'application/vnd.ms-excel', 'text/plain'];
                $allowedExt = ['csv', 'txt'];
                
                $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
                
                if (!in_array($ext, $allowedExt)) {
                    jsonResponse(['error' => 'Invalid file type. Please upload a CSV file.'], 400);
                }
                
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    jsonResponse(['error' => 'File upload error'], 400);
                }
                
                $handle = fopen($file['tmp_name'], 'r');
                if (!$handle) {
                    jsonResponse(['error' => 'Could not read file'], 400);
                }
                
                $imported = 0;
                $skipped = 0;
                $errors = [];
                $row = 0;
                
                while (($csvRow = fgetcsv($handle, 1000, ',')) !== false) {
                    $row++;
                    
                    if ($row === 1 && (strtolower($csvRow[0]) === 'student_id' || strtolower($csvRow[0]) === 'id')) {
                        continue;
                    }
                    
                    if (count($csvRow) < 3) {
                        $skipped++;
                        continue;
                    }
                    
                    $studentId = sanitize(trim($csvRow[0]));
                    $name = sanitize(trim($csvRow[1]));
                    $department = sanitize(trim($csvRow[2]));
                    
                    if (empty($studentId) || empty($name) || empty($department)) {
                        $skipped++;
                        continue;
                    }
                    
                    $checkStmt = $conn->prepare("SELECT id FROM students WHERE student_id = ?");
                    $checkStmt->execute([$studentId]);
                    
                    if ($checkStmt->fetch()) {
                        $skipped++;
                        continue;
                    }
                    
                    $insertStmt = $conn->prepare("INSERT INTO students (student_id, name, department) VALUES (?, ?, ?)");
                    if ($insertStmt->execute([$studentId, $name, $department])) {
                        $imported++;
                    } else {
                        $skipped++;
                    }
                }
                
                fclose($handle);
                
                jsonResponse([
                    'success' => true,
                    'message' => "Import completed: $imported imported, $skipped skipped",
                    'imported' => $imported,
                    'skipped' => $skipped
                ]);
                
            case 'add_candidate':
                if (!isset($data['name']) || empty(trim($data['name']))) {
                    jsonResponse(['error' => 'Candidate name is required'], 400);
                }
                
                $name = sanitize($data['name']);
                $type = isset($data['type']) && in_array($data['type'], ['Chairperson', 'Vice-Chairperson']) 
                    ? $data['type'] 
                    : 'Chairperson';
                
                $insertStmt = $conn->prepare("INSERT INTO candidates (name, type) VALUES (?, ?)");
                if ($insertStmt->execute([$name, $type])) {
                    jsonResponse([
                        'success' => true, 
                        'message' => 'Candidate added successfully', 
                        'id' => $conn->lastInsertId()
                    ]);
                } else {
                    jsonResponse(['error' => 'Failed to add candidate'], 500);
                }
                break;
                
            case 'vote_candidate':
                if (!isset($data['id']) || empty($data['id'])) {
                    jsonResponse(['error' => 'Candidate ID is required'], 400);
                }
                
                $candidateId = (int)$data['id'];
                
                $stmt = $conn->prepare("SELECT id FROM candidates WHERE id = ?");
                $stmt->execute([$candidateId]);
                if (!$stmt->fetch()) {
                    jsonResponse(['error' => 'Candidate not found'], 404);
                }
                
                $updateStmt = $conn->prepare("UPDATE candidates SET vote_count = vote_count + 1 WHERE id = ?");
                if ($updateStmt->execute([$candidateId])) {
                    $stmt = $conn->prepare("SELECT id, name, type, vote_count FROM candidates WHERE id = ?");
                    $stmt->execute([$candidateId]);
                    $candidate = $stmt->fetch();
                    jsonResponse([
                        'success' => true, 
                        'message' => 'Vote recorded',
                        'candidate' => $candidate
                    ]);
                } else {
                    jsonResponse(['error' => 'Failed to record vote'], 500);
                }
                break;
                
            case 'delete_candidate':
                if (!isset($data['id']) || empty($data['id'])) {
                    jsonResponse(['error' => 'Candidate ID is required'], 400);
                }
                
                $candidateId = (int)$data['id'];
                
                $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
                if ($stmt->execute([$candidateId])) {
                    jsonResponse(['success' => true, 'message' => 'Candidate deleted']);
                } else {
                    jsonResponse(['error' => 'Failed to delete candidate'], 500);
                }
                break;
        }
        break;
        
    default:
        jsonResponse(['error' => 'Method not allowed'], 405);
}
