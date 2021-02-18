$user = "ADMOESSNER\Administrator" 
$pwd = convertto-securestring "DimsSPW_147258963" -AsPlainText -Force
$Credential = New-Object System.Management.Automation.PSCredential $user, $pwd
$script = "C:\inetpub\adusers\script.ps1"
#Start-Process -WorkingDirectory (Split-Path $script) powershell.exe -Credential $Credential -File "C:\inetpub\adusers\script.ps1"
Start-Process powershell.exe -File "C:\inetpub\adusers\script.ps1"