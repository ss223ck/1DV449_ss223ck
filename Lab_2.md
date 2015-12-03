# Laborationsrapport av Sverker Söderlund, ss223ck

## Säkerhetsproblematik

## Känslig data över webben
### Problembeskrivning
Klienterna skickar känslig data över internet. I detta fall inloggningsuppgifter som skickas okrypterat till servern. 
### Följder
Okrypterad information som skickas över nätet går enkelt att läsa ut och man kan även bli känslig för MITM-attacker. 
### Åtgärder
[1] Genom att kryptera data med hjälp av tex SSL kan man kryptera informationen som skickas till servern. Detta förhindrar personer som avlyssnar från att läsa ut informationen i klartext. Även om detta inte helt tar bort all problematik försvinner en stor del av den. 

## Cross Site Scripting (XSS)
### Problembeskrivning 
Cross site scripting är ett vanligt problem. Sidan är känslig för det. Jag kunde delvis injektera html-kod i sidan som kan användas för att utföra attacker.
### Följder 
Cross site scripting används vanligast till att stjäla information av användaren för att tex komma över konton. Det behandlas mer i under CSRF nedan. Det kan också användas för att dirigera om användaren till en annan site.
### Åtgärder 
Man kan undvika detta genom att låta information användaren angett som tolkas av servern inte ska skrivas ut som html-kod. Man låter servern byta ut tecken som används inom html. [2]

## Cross Site Request Forgery (CSRF)
### Problembeskrivning 
Cross site request forgery är ett problem när applikationen inte är tillräckligt säker ur ett autentisiering och auktoriseringsperspektiv. Vid denna applikation kan man stjäla connectionid och logga in med hjälp av den. Id:t förstörs inte efter att användaren loggar ut. Så om användare trycker på logga ut kan man fortfarande få tillgång till message board genom att bara skriva localhost:3000/message.
### Följder 
En person som kommit över connectionid kopplad till inloggningen får samma tillgång till sidan som användare som blev stulen på id:t. 
### Åtgärder 
[3]Genom att använda färdiga ramverk för att hantera inlogging av användare kan man minska risken att applikationen får dessa säkerhetshål i sig. Man kan också använda sig av ett extra token som kompletterar sessionsnyckeln.

## Sql-inject
### Problembeskrivning 
En applikation som är känslig för att man i inmatningsfält skickar med sql-satser för att tex förbipassera autentisieringen. Jag testade att använda ett simpel sql-injekt attack mot servern genom att ange ett användarnamn som finns i databasen och ange 1' or '1' = '1 i lösenordsfältet.
### Följder 
Attacken lyckades och genom att veta en användares email kan man enkelt logga in som den personen. Om applikationen är känslig för sql-inject så finns det risk att man kan hämta ut data ur databasen.
### Åtgärder 
[4] Detta åtgärdas enkelt genom att använda parameteriserade anrop till databasen. Dock finns det en risk att dessa även kan tolka det inmatade värdet som en SQL-sats. Det är viktigt att validera användarens inmatade data och tex banna vissa tecken i fälten som skickas till databasen.

## Hashning/saltning
### Problembeskrivning
Användaruppgifter för inloggning ligger sparade i klartext i databasen. I applikationen är inte lösenorden hashade. 
### Följder
Om en person kommer över databasen/informationen som är sparad kan man enkelt läsa ut användarnamn och lösenord för att sedan ta över kontot. 
### Åtgärder
[5] Använd en säker hashalgoritm som inte går att knäcka på ett enkelt sätt/utdaterad när man lagrar lösenord i en databas. Även annan känslig information kan vara bra att hasha text återställningssvar till återställningsfrågor. 

#Prestandaproblematik

## Utloggning
### Problembeskrivning
Felaktigt skriven inloggningssystem. Valmöjligheten att logga ut finns innan man är inloggad. 
### Följder
Funktionen uppfyller inte rimliga krav och kan upfattas som störande eller förstöra prestanda genom att den är ihopkopplad med javascript som inte behöver laddas in innan användare än inloggad.  
### Åtgärder
Möjligheten att logga ut ska bara gå om man är inloggad. 

## Cachning
### Problembeskrivning
Expires HTTP header saknas. Det ska innehålla ett "HTTP date". [6]
### Följder
När det saknas  kommer ingenting att cachas 
### Åtgärder
Anges i headern

## MessageBoard.js
### Problembeskrivning
Javascriptet MessageBoard.js laddas in i inloggningssidan vilket verkar vara onödigt och fyller inte någon funktion för inloggningen. Javascriptet länkas i headern på indexfilen.  
### Följder
Onödig javascript ligger och laddas in på servern och exikverar felaktig kod. 
### Åtgärder
Dela upp javascripten beroende på om man är inloggad eller inte. Länka in javascripten längst ner i bodyn. 

## Bortagning av meddelande
### Problembeskrivning
Funktionen på applikationen att ta bort medelanden som administratör fungerar inte.   
### Följder
Applikationen är trasig och fyller inte sin funktion. 
### Åtgärder
Ändra javascripten så att applikationen fungerar. Det är även viktigt att ge feedback till användaren. 

##Egna reflektioner
Ska man byggen en applikation på webben tycker jag man ska använda ett ramverk för att implementera autentisering och auktorisering av användaren. Chansen är större att man minskar säkerhetshålen och bygger en generellt sätt bättre applikation både ur säkerhetsperspektiv men också ur prestandaperspektiv. På owasp wiki anges det även att api är bra att använda för att förebygga säkerhetsbrister i applikationen. Roligt att leta luckor och intressant att se och experimentera med de verktyg och metoder som finns. Man kan antagligen hitta många fler luckor om man har rutin på vad man ska leta efter. Skulle man ha det som arbetsuppgift så skulle jag upprätta en lista över de saker jag skulle testa och leta efter och efterhand fylla på den med erfarenheter.

##Referenser
[1] OWASP foundation, "Top 10 2013-A6-Injection", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A6-Sensitive_Data_Exposure[Hämtad: 3 december, 2015]

 [2] OWASP foundation, "Top 10 2013-A3-Cross-Site-Scripting", 3 Februari 2014 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A3-Cross-Site_Scripting_%28XSS%29 [Hämtad: 3 december, 2015]
 
[3] OWASP foundation, "Top 10 2013-A2-Broken-Autentication -And- Session-Management", 3 Februari 2015 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A2-Broken_Authentication_and_Session_Management [Hämtad: 3 december, 2015]

[4] OWASP foundation, "Top 10 2013-A1-Injection”, 23 juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A1-Injection [Hämtad: 3 december, 2015]

[5] OWASP foundation, "Top 10 2013-A6-Injection", 23 Juni 2013 [Online] Tillgänglig: https://www.owasp.org/index.php/Top_10_2013-A6-Sensitive_Data_Exposure [Hämtad: 3 december, 2015].

[6] Steve Souders, High Performance Web Sites: Combined Scripts and Stylesheets, O'Reilly, 2007. [Online] Tillgänglig: http://www.it.iitb.ac.in/frg/wiki/images/4/44/Oreilly.Seve.Suoders.High.Performance.Web.Sites.Sep.2007.pdf [Hämtad: 3 december, 2015].


