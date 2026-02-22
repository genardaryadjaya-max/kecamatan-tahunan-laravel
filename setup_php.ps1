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

C:\php83\php.exe -v
