<?php
// This script will help reset the MySQL root password

echo "<h2>MySQL Root Password Reset</h2>";
echo "<p>Step-by-step instructions:</p>";
echo "<ol>";
echo "<li><strong>Open XAMPP Control Panel</strong></li>";
echo "<li><strong>Stop MySQL</strong></li>";
echo "<li><strong>Click 'Config' next to MySQL</strong></li>";
echo "<li><strong>Click 'my.ini'</strong></li>";
echo "<li><strong>Add this line under [mysqld] section:</strong><br>";
echo "<code>skip-grant-tables</code></li>";
echo "<li><strong>Save and close the file</strong></li>";
echo "<li><strong>Start MySQL again</strong></li>";
echo "<li><strong>Refresh this page</strong></li>";
echo "</ol>";

$myiniPath = 'C:\xampp\mysql\bin\my.ini';

if (file_exists($myiniPath)) {
    $content = file_get_contents($myiniPath);
    
    if (strpos($content, 'skip-grant-tables') !== false) {
        echo "<h3 style='color: green;'>✓ skip-grant-tables is already enabled!</h3>";
        echo "<p>Now run this SQL:</p>";
        echo "<pre>";
        echo "UPDATE mysql.user SET plugin='mysql_native_password', Password='' WHERE User='root' AND Host='localhost';\n";
        echo "FLUSH PRIVILEGES;\n";
        echo "EXIT;\n";
        echo "</pre>";
        
        echo "<p>Then remove 'skip-grant-tables' from my.ini and restart MySQL.</p>";
        
        // Try to run SQL directly
        echo "<h3>Or, try auto-reset:</h3>";
        echo "<form method='post'>";
        echo "<button type='submit' name='reset' style='padding: 10px 20px; font-size: 16px; cursor: pointer;'>";
        echo "Reset Root Password Now</button>";
        echo "</form>";
        
        if (isset($_POST['reset'])) {
            try {
                $pdo = new PDO("mysql:host=localhost;dbname=mysql", 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                
                $pdo->exec("UPDATE mysql.user SET plugin='mysql_native_password', Password='' WHERE User='root'");
                $pdo->exec("FLUSH PRIVILEGES");
                
                echo "<p style='color: green; font-weight: bold;'>✓ SUCCESS! Root password reset to empty.</p>";
                echo "<p>Now remove 'skip-grant-tables' from my.ini and restart MySQL.</p>";
                
            } catch (PDOException $e) {
                echo "<p style='color: red;'>Error: " . $e->getMessage() . "</p>";
            }
        }
    }
}
?>
