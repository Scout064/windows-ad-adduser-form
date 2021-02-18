#Set the User Account to start the Worker with
$user = "ADNAME\USER" 
#Set and convert the User Password
$pwd = convertto-securestring "Password" -AsPlainText -Force
#Prepare the needed Powershell String
$Credential = New-Object System.Management.Automation.PSCredential $user, $pwd
#Set the Path to the script
$script = "C:\path\to\script.ps1"
#Start the actual worker Process
Start-Process powershell.exe -File "C:\path\to\script.ps1"
