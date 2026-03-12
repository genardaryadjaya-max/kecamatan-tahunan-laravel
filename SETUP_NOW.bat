@echo off
chcp 65001 >nul
title Setup Kecamatan Tahunan Laravel

SET PHP=d:\LARAGON\laragon\bin\php\php-8.1.10-Win32-vs16-x64\php.exe
SET COMPOSER=d:\LARAGON\laragon\bin\composer\composer.phar
SET MYSQL=d:\LARAGON\laragon\bin\mysql\mysql-8.0.30-winx64\bin\mysql.exe
SET DIR=d:\LARAGON\laragon\www\kecamatan-tahunan-laravel

cd /d %DIR%

echo.
echo ================================================
echo   SETUP KECAMATAN TAHUNAN - LARAGON
echo ================================================
echo.

echo [1/6] Import Database (kecamatan_tahunan_FULL.sql)...
%MYSQL% -u root < "%DIR%\database\kecamatan_tahunan_FULL.sql"
if %errorlevel% equ 0 (echo    OK - Database berhasil diimport!) else (echo    WARNING - Mungkin sudah ada, lanjut...)
echo.

echo [2/6] Buat tabel layanans dan agendas...
%MYSQL% -u root kecamatan_tahunan_laravel < "%DIR%\database\create_missing_tables.sql"
if %errorlevel% equ 0 (echo    OK - Tabel berhasil dibuat!) else (echo    WARNING - Cek error di atas)
echo.

echo [3/6] Composer Install (tunggu beberapa menit)...
%PHP% %COMPOSER% install --no-interaction --no-progress
if %errorlevel% equ 0 (echo    OK!) else (echo    ERROR pada composer install)
echo.

echo [4/6] Generate App Key...
%PHP% artisan key:generate --force
echo.

echo [5/6] Run Migrations (tabel yang belum ada)...
%PHP% artisan migrate --force
echo.

echo [6/6] Storage Link...
%PHP% artisan storage:link --force
echo.

echo ================================================
echo   SELESAI!
echo   Buka: http://kecamatan-tahunan-laravel.test
echo   atau: http://localhost:8080/kecamatan-tahunan-laravel/public
echo.
echo   Login Admin:
echo   Email   : admin@kecamatantahunan.id
echo   Password: password
echo ================================================
echo.
pause
