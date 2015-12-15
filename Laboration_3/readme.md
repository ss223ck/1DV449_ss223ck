# Laboration 3

adress: http://sverker.3space.info/Index.php

## Reflektionsfrågor

* Vad finns det för krav du måste anpassa dig efter i de olika API:erna?

Båda apierna har rättsliga krav som man måste anpassa sig efter. Det märks att ena api:et kommer från ett företag och andra api:et kommer från en myndighet. SR:s api är ganska fritt att använda. Dokumentationen är ganska liten och kraven är få. "Materialet som tillhandahålls via API får inte användas på ett sådant sätt att det skulle kunna skada Sveriges Radios oberoende eller trovärdighet.". Google har mycket information om hur man inte får använda det men generellt verkar det som att sålänge man inte använder det i kommersiellt syfte är det fritt. Dock så är det begränsnignar på hur många anrop man får göra. 

* Hur och hur länga cachar du ditt data för att slippa anropa API:erna i onödan?

Jag använder localstorage som stöds i html 5. Det är ett enkelt sätt att lagra information i användarens webbläsare. Nackdelen är nu att det är varje användares webbläsare som anropar api:erna och sparar sr information individuellt. Skulle jag anropa via servern och cacha där skulle applikationen använda mycket färre anrop. Jag cachar data så den sparas i fem minuter innan applikationen har möjlighet att skicka ett nytt anrop.

* Vad finns det för risker kring säkerhet och stabilitet i din applikation? 

Jag lagrar googles api-nyckel direkt i en scripttag i htmlkoden. Den blir lätt att stjäla och borde egentligen lagras på ett annat sätt. Eftersom det är via webbläsaren anropen sker mot api finns det förmodligen hål där. Applikationen är generellt sätt inte så stor så det finns inte så mycket risker. Det går det inte att göra code-injektion, CSFR eller SQL-injection. 

* Hur har du tänkt kring säkerheten i din applikation?

Det viktigaste i nuläget skulle vara att göra så det inte går att missbruka api-förfrågningarna från webbläsaren. Jag har generellt inte tänkt så mycket på säkerheten i denna applikation. Det finns inget formulär som skickas tillbaka till servern och användaren kan därför inte skicka skadlig kod.

* Hur har du tänkt kring optimeringen i din applikation?

Jag valde att bygga hela applikationen i Javascript för att det var enklare och jag hade inget behov av att använda php. Jag har försökt minimera koden som körs i applikationen och brutit ut olika delar av koden som inte ska köras i onödan. Det finns lite duplicering vilket jag borde ändra. Jag har inte så bra koll på javascript vilket gör att koden inte ser jättebra ut. 
