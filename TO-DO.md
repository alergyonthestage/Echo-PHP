Adesso:
- Rivedi le post interactions (like, comment, etc...), vedi se usare ajax
- Notifiche (Follow-Request, Richiesta follow accettata, Notifiche post di utenti seguiti (attiva campanella al canale))
- Sistema post preview in publish
- Vedi come gestire il caso no more posts to show
- load animation on feed infinite scroll

REFACTORING:

- post: fetchComments? perchè in post? deve essere in comments...
- gli oggetti inglobati vanno istanziati nel costruttore... (es: commenti, song, user, etc... in Post.)
- MYSQL_ASSOC in fetch...


Dopo:

- optimize imgs and img lazy loading on posts (+ placeholders on load)

- CSS desktop

- Rivedere HTML -> usare tag accessibili

- Collegare framework YT + embed video

- Relazione

- ajax update comments, friend status, etc... without reload page
