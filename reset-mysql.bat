@echo off
echo ====================================
echo   MySQL/MariaDB Reset Script
echo ====================================
echo.

echo Step 1: Stopping MySQL/MariaDB service...
net stop mysql 2>nul
net stop mariadb 2>nul
net stop MySQL 2>nul
net stop MariaDB 2>nul
echo Done.
echo.

echo Step 2: Starting MySQL in safe mode (skip grants)...
cd /d C:\xampp\mysql\bin
start /b mysqld --skip-grant-tables --skip-networking
echo Waiting 5 seconds for MySQL to start...
timeout /t 5 /nobreak >nul
echo Done.
echo.

echo Step 3: Resetting root password...
echo You need to run these commands manually in MySQL:
echo.
echo mysql -u root
echo.
echo Then run these SQL commands:
echo.
echo USE mysql;
echo ALTER USER 'root'@'localhost' IDENTIFIED BY '';
echo UPDATE mysql.user SET plugin='mysql_native_password' WHERE User='root';
echo FLUSH PRIVILEGES;
echo EXIT;
echo.
echo.
echo Alternatively, copy this script to run directly:
echo ====================================
echo COPY THESE LINES AFTER "mysql -u root"
echo ====================================
echo USE mysql;
echo ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY '';
echo UPDATE user SET plugin='mysql_native_password' WHERE User='root';
echo FLUSH PRIVILEGES;
echo ====================================
echo.
pause
