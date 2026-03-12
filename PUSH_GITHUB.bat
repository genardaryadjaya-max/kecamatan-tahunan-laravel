@echo off
chcp 65001 >nul
title Push ke GitHub - Kecamatan Tahunan

SET PROJECT=d:\LARAGON\laragon\www\kecamatan-tahunan-laravel
SET REPO=https://github.com/genardaryadjaya-max/kecamatan-tahunan-laravel.git

cd /d %PROJECT%

echo.
echo ================================================
echo   PUSH KE GITHUB - Kecamatan Tahunan
echo   Repo: %REPO%
echo ================================================
echo.

REM Cek apakah git tersedia
git --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] Git tidak ditemukan di PATH!
    echo Pastikan Git sudah terinstall dan ada di PATH.
    echo Download: https://git-scm.com/download/win
    pause
    exit /b 1
)

echo [1/6] Inisialisasi Git repository...
git init
echo.

echo [2/6] Set remote origin ke GitHub...
git remote remove origin 2>nul
git remote add origin %REPO%
echo.

echo [3/6] Konfigurasi branch utama...
git branch -M main
echo.

echo [4/6] Tambahkan semua file (git add)...
git add .
echo.

echo [5/6] Commit perubahan...
git commit -m "Update: fix theme, dropdown, slider, missing tables - %date% %time%"
echo.

echo [6/6] Push ke GitHub (main)...
git push -u origin main --force
echo.

echo ================================================
echo   SELESAI! Cek GitHub:
echo   https://github.com/genardaryadjaya-max/kecamatan-tahunan-laravel
echo ================================================
echo.
pause
