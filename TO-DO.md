Postare, Commentare, Like, Amici:
- Collega bottone unfollow al db
- Publish: sistema post preview
    - guarda link alle immagini, risolvi config get path...
- sistema i bottoni form -> da javascript
- immagine profilo di default se su db è null o se non è stata trovata la risorsa nel server

Dopo:

- Feed-javascript (caricamento dinamico)

- Notifiche (Follow-Request, Richiesta follow accettata, Notifiche post di utenti seguiti (attiva campanella al canale))

- CSS desktop
- Rivedere HTML -> usare tag accessibili

- Collegare framework YT + embed video
- Relazione

---------------------------
CSS:

if(stile di un componente uguale in tutte le pagine) {
    creo css/components/nomeComponente.css con lo stile del componente (no misure assolute)
    (posso poi inserire la parte di stile relativa ad una view specifica, es: dimensioni, nel file della view)
} else if (stile relativo ad una particolare vista) {
    creo css/views/nomeVista.css
} else if (stile relativo al layout) {
    css/layout.css
} else if (utility) {
    css/utils.css
}

esempio di cosa fare:
    - sposta i bottoni feed/explore nel file css/components/buttons.css
    - sistema lo stile dei post che ho spostato da views/feed.css a components/post.css (qualsiasi pagina mostra un post con lo stesso stile). Se voglio post di stile diverso posso anche creare più classi: small-post, post, big-post, etc... sempre nel file post.css