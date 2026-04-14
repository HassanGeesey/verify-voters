<?php
// Auto-fix MySQL authentication plugin issue
$myiniPath = 'C:\xampp\mysql\bin\my.ini';

if (!file_exists($myiniPath)) {
    die("Could not find my.ini at: $myiniPath");
}

$content = file_get_contents($myiniPath);

// Check if the fix is already applied
if (strpos($content, 'default-authentication-plugin=mysql_native_password') !== false) {
    echo "Fix already applied! No changes needed.\n";
    exit;
}

// Add the fix under [mysqld] section
if (strpos($content, '[mysqld]') !== false) {
    $content = str_replace(
        '[mysqld]',
        "[mysqld]\ndefault-authentication-plugin=mysql_native_password",
        $content
    );
    
    if (file_put_contents($myiniPath, $content)) {
        echo "SUCCESS: Added default-authentication-plugin to my.ini\n";
        echo "\nNEXT STEPS:\n";
        echo "1. Open XAMPP Control Panel\n";
        echo "2. Stop MySQL service\n";
        echo "3. Start MySQL service again\n";
        echo "4. Refresh this page or test-db.php\n";
    } else {
        echo "ERROR: Could not write to my.ini\n";
        echo "Try running XAMPP as Administrator.\n";
    }
} else {
    echo "ERROR: Could not find [mysqld] section in my.ini\n";
}
?>
