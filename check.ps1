$tools = @('php', 'composer', 'laravel', 'node', 'npm', 'git', 'mysql', 'python', 'java', 'docker', 'go', 'rustc')
foreach ($tool in $tools) {
    if (Get-Command $tool -ErrorAction SilentlyContinue) {
        $version = ""
        try {
            if ($tool -eq 'php') { $version = (php -v | Select-Object -First 1) }
            elseif ($tool -eq 'composer') { $version = (composer -V | Select-Object -First 1) }
            elseif ($tool -eq 'laravel') { $version = (laravel -V | Select-Object -First 1) }
            elseif ($tool -eq 'node') { $version = (node -v | Select-Object -First 1) }
            elseif ($tool -eq 'npm') { $version = (npm -v | Select-Object -First 1) }
            elseif ($tool -eq 'git') { $version = (git --version | Select-Object -First 1) }
            elseif ($tool -eq 'python') { $version = (python --version 2>&1 | Select-Object -First 1) }
            elseif ($tool -eq 'java') { $version = (java --version 2>&1 | Select-Object -First 1) }
            # elseif ($tool -eq 'docker') { $version = (docker -v | Select-Object -First 1) }
        } catch {}
        if ($version) {
            Write-Host "[v] $tool is installed. ($version)"
        } else {
            Write-Host "[v] $tool is installed."
        }
    } else {
        Write-Host "[x] $tool is NOT installed."
    }
}
