<?php
$name = escapeshellarg($_POST['givenname'] . " " . $_POST['surname']);
$given_name = escapeshellarg($_POST['givenname']);
$surname = escapeshellarg($_POST['surname']);
$email = escapeshellarg($_POST['email']);
$password = $_POST['password'];
$usergroup = $_POST['user_group'];
$username = escapeshellarg($_POST['givenname'].$_POST['surname']);
$usn = $_POST['givenname'] . " " . $_POST['surname'];
$powershell1 = "".'$secureString'." = convertto-securestring $password -asplaintext -force\n";
$powershell2 = "New-ADUser -Name:".$name." -GivenName:".$given_name." -Surname:".$surname." -SamAccountName:".$username." -UserPrincipalName:".$email." -Path:".escapeshellarg('OU=users,OU=moessner,DC=ad,DC=moessner,DC=be')." -AccountPassword:".'$secureString'." -Enabled:".'$true'."\n";
$powershell3 = "Add-ADPrincipalGroupMembership -Identity:'CN=$usn,OU=users,OU=moessner,DC=ad,DC=moessner,DC=be' -MemberOf:'CN=$usergroup,OU=groups,OU=moessner,DC=ad,DC=moessner,DC=be' -Server:".escapeshellarg('server2016.ad.moessner.be')."";
$script = fopen("script.ps1", "w") or die("Unable to open file!");
$string1 = $powershell1;
fwrite($script, $string1);
$string2 = $powershell2;
fwrite($script, $string2);
$string3 = $powershell3;
fwrite($script, $string3);
fclose($script);
$run = shell_exec('powershell.exe -executionpolicy bypass -File "C:\inetpub\adusers\script.ps1"');
echo $run;
echo "Thank You!" . " -" . "<a href='index.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
?>