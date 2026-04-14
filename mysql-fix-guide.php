<?php
echo "<h2>MySQL/MariaDB Reset Tool</h2>";
echo "<pre>";
echo "This script will help you reset MySQL authentication.\n\n";
echo "The issue: caching_sha2_password plugin DLL is missing.\n\n";
echo "SOLUTION OPTIONS:\n";
echo "=================\n\n";

echo "OPTION 1: Change Authentication in phpMyAdmin\n";
echo "----------------------------------------------\n";
echo "1. Go to http://localhost/phpmyadmin\n";
echo "2. Click 'User Accounts' tab\n";
echo "3. Click 'Edit privileges' for root@localhost\n";
echo "4. Find 'Authentication Plugin' and change to 'mysql_native_password'\n";
echo "5. Click 'Go'\n\n";

echo "OPTION 2: Use SQL Commands (if you can connect)\n";
echo "------------------------------------------------\n";
echo "Run this SQL in phpMyAdmin > SQL tab:\n\n";
echo "ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';\n";
echo "FLUSH PRIVILEGES;\n\n";

echo "OPTION 3: Edit my.ini (XAMPP MySQL config)\n";
echo "--------------------------------------------\n";
echo "1. Open C:\\xampp\\mysql\\bin\\my.ini\n";
echo "2. Find [mysqld] section\n";
echo "3. Add this line: default-authentication-plugin=mysql_native_password\n";
echo "4. Restart MySQL from XAMPP Control Panel\n\n";

echo "OPTION 4: Create new user with native password\n";
echo "------------------------------------------------\n";
echo "If you can connect via CLI, run:\n\n";
echo "mysql -u root\n";
echo "CREATE USER 'admin'@'localhost' IDENTIFIED BY 'password123';\n";
echo "GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost';\n";
echo "FLUSH PRIVILEGES;\n";
echo "EXIT\n\n";
echo "Then update config.php with:\n";
echo "  username = 'admin'\n";
echo "  password = 'password123'\n\n";
echo "</pre>";
?>
