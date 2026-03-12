# Push ke GitHub - Kecamatan Tahunan Laravel
# Cara pakai: Klik kanan file ini -> "Run with PowerShell"

$PROJECT = "D:\LARAGON\laragon\www\kecamatan-tahunan-laravel"
$REPO    = "https://github.com/genardaryadjaya-max/kecamatan-tahunan-laravel.git"

Set-Location $PROJECT

Write-Host ""
Write-Host "================================================" -ForegroundColor Cyan
Write-Host "  PUSH KE GITHUB - Kecamatan Tahunan" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Cek git tersedia
try {
    $gitVersion = git --version
    Write-Host "Git ditemukan: $gitVersion" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Git tidak ditemukan!" -ForegroundColor Red
    Write-Host "Download: https://git-scm.com/download/win" -ForegroundColor Yellow
    pause
    exit 1
}

Write-Host ""
Write-Host "[1/7] Init git repository..." -ForegroundColor Yellow
git init

Write-Host "[2/7] Konfigurasi user git..." -ForegroundColor Yellow
git config user.email "genardaryadjaya@gmail.com"
git config user.name "genardaryadjaya-max"

Write-Host "[3/7] Set remote origin..." -ForegroundColor Yellow
git remote remove origin 2>$null
git remote add origin $REPO

Write-Host "[4/7] Set branch ke main..." -ForegroundColor Yellow
git branch -M main

Write-Host "[5/7] Stage semua file (git add)..." -ForegroundColor Yellow
git add .

Write-Host "[6/7] Commit..." -ForegroundColor Yellow
$commitMsg = "Update: lightmode default, fix dropdown filter, slider video support, missing tables - $(Get-Date -Format 'yyyy-MM-dd HH:mm')"
git commit -m $commitMsg

Write-Host "[7/7] Push ke GitHub..." -ForegroundColor Yellow
Write-Host "Jika diminta login, masukkan username dan password/token GitHub" -ForegroundColor Cyan
git push -u origin main --force

Write-Host ""
if ($LASTEXITCODE -eq 0) {
    Write-Host "================================================" -ForegroundColor Green
    Write-Host "  BERHASIL PUSH KE GITHUB!" -ForegroundColor Green
    Write-Host "  Cek: https://github.com/genardaryadjaya-max/kecamatan-tahunan-laravel" -ForegroundColor Green
    Write-Host "================================================" -ForegroundColor Green
} else {
    Write-Host "================================================" -ForegroundColor Red
    Write-Host "  GAGAL! Cek error di atas." -ForegroundColor Red
    Write-Host "  Kemungkinan perlu Personal Access Token (PAT)" -ForegroundColor Yellow
    Write-Host "  Buat di: https://github.com/settings/tokens" -ForegroundColor Yellow
    Write-Host "================================================" -ForegroundColor Red
}

Write-Host ""
Write-Host "Tekan Enter untuk keluar..."
Read-Host
