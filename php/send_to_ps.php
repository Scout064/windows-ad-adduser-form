<?php
#prepare and sanitize the User Inputs from the Form
$name = escapeshellarg($_POST['givenname'] . " " . $_POST['surname']);
$given_name = escapeshellarg($_POST['givenname']);
$surname = escapeshellarg($_POST['surname']);
$email = escapeshellarg($_POST['email']);
$password = $_POST['password'];
$usergroup = $_POST['user_group'];
$username = escapeshellarg($_POST['givenname'].$_POST['surname']);
$usn = $_POST['givenname'] . " " . $_POST['surname'];
#Prepare the Variables for the Powershell
$ougrp = "OU=$usergroup,";
$powershell1 = "".'$secureString'." = convertto-securestring $password -asplaintext -force\n";
$powershell2 = "New-ADUser -Name:".$name." -GivenName:".$given_name." -Surname:".$surname." -SamAccountName:".$username." -UserPrincipalName:".$email." -Path:".escapeshellarg($ougrp.'OU=users,OU=anotherou,DC=ad,DC=fqdn,DC=tld')." -AccountPassword:".'$secureString'." -Enabled:".'$true'."\n";
$powershell3 = "Add-ADPrincipalGroupMembership -Identity:'CN=$usn,OU=$usergroup,OU=users,OU=anotherou,DC=ad,DC=fqdn,DC=tld' -MemberOf:'CN=$usergroup,OU=groups,OU=anotherou,DC=ad,DC=fqdn,DC=tld' -Server:".escapeshellarg('fqdn.of.ad.server')."";
#Prepare the Variable for the script and Action to be taken if unable to open or run
$script = fopen("script.ps1", "w") or die("Unable to open file!");
#Prepare the Powershell Strings and pass them to the Script
$string1 = $powershell1;
fwrite($script, $string1);
$string2 = $powershell2;
fwrite($script, $string2);
$string3 = $powershell3;
fwrite($script, $string3);
fclose($script);
#Final Preperation for Script exec
$run = shell_exec('powershell.exe -executionpolicy bypass -File "C:\path\to\script.ps1"');
#Execute the Script and work Powershell Magic
echo $run;
echo "Thank You!" . " -" . "<a href='index.html' style='text-decoration:none;color:#ff0099;'> Return Home</a>";
?>
