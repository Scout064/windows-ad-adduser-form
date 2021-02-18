#Setup Variable for the Password
$secureString = convertto-securestring YourPassword -asplaintext -force
#Actual Powershell Command to add  the AD-User
New-ADUser -Name:"Max Mustermann" -GivenName:"Max" -Surname:"Mustermann" -SamAccountName:"MaxMustermann" -UserPrincipalName:"max@mail.com" -Path:"OU=users,OU=anotherou,DC=ad,DC=fqdn,DC=tld" -AccountPassword:$secureString -Enabled:$true
#Powershell Command to add User to a Group
Add-ADPrincipalGroupMembership -Identity:'CN=Max Mustermann,OU=users,OU=anotherou,DC=ad,DC=fqdn,DC=tld' -MemberOf:'CN=group_cn,OU=groups,OU=anotherou,DC=ad,DC=fqdn,DC=tld' -Server:"fqdn.of.ad.server"
