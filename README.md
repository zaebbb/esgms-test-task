Реализованы 2 CRUD метода для игр и для жанров <br>
Имеется 2 API адреса по просмотру игра по жанрам:
<p>1) По ID жанра - все игры <br>
2) По ID жанра и идентификатору игры </p>
Соединяются с помощью промежуточной таблицы <br><br>
Префикс API: game-api (http://127.0.0.1:8000/game-api/genres)<br>
Реализовал функции в контроллерах с помощью Helper в директории app/Helpers
<br><br>
<h4>Список API-адресов</h4>
<h5>CRUD жанры</h5>
/genres <br>
/genres/create <br>
Входные данные:
<pre>{
    title: "Название жанра"
}</pre>


/genres/{id}<br>
/genres/{id}/update<br>
<pre>Входные данные:
{
    title: "Название жанра"
}</pre>
/genres/{id}/delete<br><br>

<h5>CRUD игры</h5>
/games<br>
/games/create<br>
<pre>Входные данные:
{
    "title": "Название игры",
    "studio_developer": "Название студии",
    "genres": [1,2,3,4,5] // (массив жанров по ID)
}</pre>
/games/{id}<br>
/games/{id}/update<br>
<pre>Входные данные:
{
    "title": "Название игры",
    "studio_developer": "Название студии",
    "genres": [1,2,3,4,5] // (массив жанров по ID)
}</pre>
/games/{id}/delete<br><br>

<h5>Поиск игр/игры по жанру</h5>
/genre/{genre_id}/games<br>
/genre/{genre_id}/games/{game_id}<br>



