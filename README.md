# 1DV449_ss223ck
###address
http://sverker.3space.info/project/webteknikII/index.php

##Etiska aspekter
Att skrapa och samla information för att sedan publicera på sin egna sida är generellt sätt tillåtet även om koden kan vara kopierad rakt av. Däremot kan det också gå emot ”terms of use”.  Om ens program går emot ”terms of use” när den skrapar är man ansvarig för konsekvenserna. Det finns flertal fall där skrapning har ledit till stämmingar. Oftas när dom som skrapat missbrukat och använt informationen till personlig vinning.

##Finns det några riktlinjer för utvecklare att tänka på om man vill vara "en god skrapare" mot serverägarna?
Ange vem man är och att man är ett program som skrapar sidan. Detta görs i ”user agent string” som skickas med i http-requesten. Det kan vara viktigt att läsa igenom ”terms of use” och robot.txt. Generellt sätt gäller sunt förnuft när man skrapar. Är man osäker så är det viktigt att vara på säkra sidan och ta alla åtgärder för att inte göra olagliga saker.

##Begränsningar i din lösning- vad är generellt och vad är inte generellt i din kod?
* När skrapan hämtar länkarna på första sidan måste tex calendar vara första länken eftersom jag har angett i applikationen att den länken ligger först i en array.
* Applikationen är hårdkodad i redirect. 
* Generellt metod för att hämta datan och hämta ut specifik data i varje skrapning.

##Vad kan robots.txt spela för roll?
Den ger anvisningar till skrapan vart man får och inte får skrapa. Samt regler kring skrapning. Man försöker göra en standard för robot.txt så skrapor lättare ska förstå informationen. Sökmotorer använder även robots.txt i algoritmerna för att kartlägga webbapplikationer. 
