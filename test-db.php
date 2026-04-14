<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h3>Testing MySQL Connection...</h3>";

try {
    // First try without database
    $pdo = new PDO("mysql:host=localhost", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "✓ MySQL server connection: OK<br>";
    
    // Check if database exists
    $stmt = $pdo->query("SHOW DATABASES LIKE 'voting_system'");
    if ($stmt->rowCount() > 0) {
        echo "✓ Database 'voting_system': EXISTS<br>";
        
        // Connect to the database
        $pdo2 = new PDO("mysql:host=localhost;dbname=voting_system", 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
        echo "✓ Connected to database: OK<br>";
        
        // Check if table exists
        $stmt = $pdo2->query("SHOW TABLES LIKE 'students'");
        if ($stmt->rowCount() > 0) {
            echo "✓ Table 'students': EXISTS<br>";
            
            $count = $pdo2->query("SELECT COUNT(*) FROM students")->fetchColumn();
            echo "✓ Students count: $count<br>";
        } else {
            echo "✗ Table 'students': DOES NOT EXIST<br>";
            echo "<p>Please run this SQL in phpMyAdmin:</p>";
            echo "<pre>CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    department VARCHAR(100) NOT NULL,
    has_voted BOOLEAN DEFAULT FALSE,
    voted_at TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);</pre>";
        }
    } else {
        echo "✗ Database 'voting_system': DOES NOT EXIST<br>";
        echo "<p>Please go to phpMyAdmin and import the database.sql file.</p>";
    }
    
} catch (PDOException $e) {
    echo "✗ ERROR: " . $e->getMessage() . "<br>";
    echo "<br><strong>Possible issues:</strong>";
    echo "<ul>";
    echo "<li>MySQL service is not running - start it in XAMPP Control Panel</li>";
    echo "<li>Wrong username/password</li>";
    echo "<li>MySQL port is different (default is 3306)</li>";
    echo "</ul>";
}
?>
