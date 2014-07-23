# Txt-o-war
Proof of concept of SMS voting game

## Description
Project concepted to help grow the VA Lottery mobile database, users texted their votes to one of two options with a real time interface update. Finished project ran on the big screen during half time of all VCU Mens home basketball games at the Siegel Center for the 2012-2013 season growing the VAL mobile user base by 10%.

## Mobile backend
For this proof of concept, the free Twillio API was used.

## If using this code for yourself - 
Need to set up a three field table - 
id (autoincrement, index)
handle (varchar)
option (varchar)

Will also need to set up your own free Twillio app and point incoming sms to hit the 'textToDb.php' file on your server.

Finally change your db config in the results.php and textToDb.php file

$mysql_host = "YOUR HOST";
$mysql_database = "YOUR DB";
$mysql_user = "YOUR UN";
$mysql_password = "YOUR PW";