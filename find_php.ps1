[Net.ServicePointManager]::SecurityProtocol = [Net.SecurityProtocolType]::Tls12
$content = (Invoke-WebRequest -Uri "https://windows.php.net/downloads/releases/").Content
$matches = [regex]::Matches($content, 'php-8\.3\.\d+-nts-Win32-vs16-x64\.zip')
$filename = $matches[$matches.Count - 1].Value
Write-Host "Found: $filename"
