# Login_1DV608 Project

Ide: användare ska enkelt kunna ladda up en musik fil och dela den med vem som helst.

### Vision:
Har du någonsin kännt att du velat dela med dig av en mp3 men inte har verktyget för att göra det?
Då har jag produkten för dig! med denna product kan du enkelt ladda up en mp3 fil och dela den med vem du vill.

Login uppgifter:
användarnamn: Admin
lösenord: Password

Max fil storlek borde var 2m

### Use case:

pre-vilkor:
Användaren är på sidan.

Primärt flöde:
- Användaren klickar på "välj fil" kanppen.
- Användaren väljer en 'mp3' fil och klickar ok.
- Användaren klickar på ladda up.
- Användaren tas till en ny sida där en länk visas.
- Användaren klickar på länken för att testa om den fungerar.
- Användaren tas till en ny sidan där användaren kan spela up mp3 filen.
- Använadren tesar och kollar om allt fungerar.
- Användaren kopierar länken och delar den med en kompis.

Alternativt flöde:
- Användaren klickar på "välj fil" kanppen.
- Användaren väljer en 'png' fil och klickar ok.
- Användaren klickar på ladda up.
- Användaren får ett felmedelande om att det är fel fyl typ.

### test case
- Man ska inte kunna ladda up filer som inte är .mp3
- Man ska inte kunna ladda up för stora filer.
- Man ska inte kunna logga in utan användarnamn eller lösenord.
- Man ska inte kunna logga in utan användarnamn.
- Man ska inte kunna logga in utan lösenord.
- Man ska inte kunna logga in med fel användarnamn.
- Man ska inte kunna logga in med fel lösenord.
- Man ska få ett felmedelande om man försöker hitta en fil som inte finns.
