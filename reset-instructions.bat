@echo off
echo ===========================================
echo   MySQL Root Password Reset (XAMPP)
echo ===========================================
echo.

echo This script will reset MySQL root password.
echo.
echo FOLLOW THESE STEPS:
echo.
echo 1. Open XAMPP Control Panel
echo 2. Stop MySQL
echo 3. Click MySQL "Config" button
echo 4. Select "my.ini"
echo 5. Add this line under [mysqld]:
echo    skip-grant-tables
echo 6. Save and close my.ini
echo 7. Start MySQL
echo 8. Refresh reset-mysql-password.php in browser
echo.
echo ===========================================
pause
