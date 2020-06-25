# Wijnen thema

Het thema wijnen is gemaakt om doorontwikkelen te versimpelen.

## Tools

Om makkelijker te templaten is gebruik gemaakt van Twig, hiermee kan
je templates beter in stukken hakken en hergebruiken.

De `package.json` bevat 2 type scripts, `dev` en `prod`. Dev
zorgt er voor dat je de code alleen gebundeld wordt. Met prod
komt er ook nog een optimalisatie overheen, styles worden 
geminimaliseerd en ongebruikte stijlen worden verwijderd.
scripts worden geminimaliseerd en onttrokken van externe code.

De src map heeft veel harde php-code, hierin kunnen via filters
en actions extra dingen aan toegevoegd worden. 
