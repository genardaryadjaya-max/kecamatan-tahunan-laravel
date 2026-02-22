[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
$html = Invoke-WebRequest -Uri "https://windows.php.net/downloads/releases/" -UseBasicParsing
$link = $html.Links | Where-Object href -match '^php-8\.3\.\d+-nts-Win32-vs16-x64\.zip$' | Select-Object -Last 1
if (-not $link) {
    Write-Host "Could not find matching PHP zip."
    exit 1
}
$url = "https://windows.php.net/downloads/releases/" + $link.href
Write-Host "Downloading $url"
Invoke-WebRequest -Uri $url -OutFile "C:\php83.zip" -UseBasicParsing
if (Test-Path "C:\php83.zip") {
    Write-Host "Extracting..."
    Expand-Archive -Path "C:\php83.zip" -DestinationPath "C:\php83" -Force
    Copy-Item "C:\php83\php.ini-development" "C:\php83\php.ini" -Force
    
    $ini = Get-Content "C:\php83\php.ini"
    $ini = $ini -replace ';extension_dir = "ext"', 'extension_dir = "ext"'
    $ini = $ini -replace ';extension=curl', 'extension=curl'
    $ini = $ini -replace ';extension=fileinfo', 'extension=fileinfo'
    $ini = $ini -replace ';extension=mbstring', 'extension=mbstring'
    $ini = $ini -replace ';extension=openssl', 'extension=openssl'
    $ini = $ini -replace ';extension=pdo_mysql', 'extension=pdo_mysql'
    $ini = $ini -replace ';extension=zip', 'extension=zip'
    $ini | Set-Content "C:\php83\php.ini"
    
    Write-Host "PHP 8.3 installed to C:\php83 and basic extensions enabled."
} else {
    Write-Host "Download failed"
}
