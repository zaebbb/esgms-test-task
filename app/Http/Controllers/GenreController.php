<?php

// устанавливает пространство имен
namespace App\Http\Controllers;

// импорт класса CreateGenreHelper для его работы внутри контроллера и
// создания значения внутри таблицы "genres"
use App\Helpers\GenreHelper\CreateGenreHelper;
// импорт класса DeleteGenreHelper для его работы внутри контроллера и
// удаления значения полученного по ID внутри таблицы "genres"
use App\Helpers\GenreHelper\DeleteGenreHelper;
// импорт класса UpdateGenreHelper для его работы внутри контроллера и
// обновления значения полученного по ID внутри таблицы "genres"
use App\Helpers\GenreHelper\UpdateGenreHelper;
// импорт класса ViewGenreHelper для его работы внутри контроллера и
// получения значения полученного по ID из таблицы "genres"
use App\Helpers\GenreHelper\ViewGenreHelper;
// импорт класса ViewGenreHelper для его работы внутри контроллера и
// для общего формата работы с возвращаемым значением
use App\Helpers\ReturnApi;
// импорт класса Genre (модели) для связи с таблице "genres" в базе данных
use App\Models\Genre;
// импорт класса Request для взаимодействия с HTTP-запросом
use Illuminate\Http\Request;

// создание класса GenreController и наследование от Controller для работы с запросами и ответами
class GenreController extends Controller
{
    // создаются пустые переменные (параметры) для записи хелперов
    public $helperReturn;
    public $findGenre;
    public $deleteGenre;
    public $createGenre;
    public $updateGenre;

    // вызывается метод __construct который назначает значения по умолчанию для начальный параметров
    public function __construct(){
        // передача в параметр нового экземпляра класса ReturnApi
        $this->helperReturn = new ReturnApi();
        // передача в параметр нового экземпляра класса ViewGenreHelper
        $this->findGenre = new ViewGenreHelper();
        // передача в параметр нового экземпляра класса DeleteGenreHelper
        $this->deleteGenre = new DeleteGenreHelper();
        // передача в параметр нового экземпляра класса CreateGenreHelper
        $this->createGenre = new CreateGenreHelper();
        // передача в параметр нового экземпляра класса UpdateGenreHelper
        $this->updateGenre = new UpdateGenreHelper();
    }

    // создается public метод index
    public function index(){
        // записывается в переменную значения полученное с помощью модели Genre и метода all
        $genres = Genre::all();

        // возвращение значения в виде метода responseApi которое в свою очередь вовращает
        // json формат данных и устанавливает status code который передается в метод
        return $this->helperReturn->responseApi(200, $genres);
    }

    // создание public метода create с передачей входящего запроса т.к. необходимо
    // получать данные из запроса
    public function create(Request $request){
        // запись в переменную genreCreate массива полученного с помощью метода genreCreate
        // который обрабатывает входщие данные и возвращает массив состоящий из статус кода и массива данных
        $genreCreate = $this->createGenre->genreCreate($request);

        // возвращение значения в виде метода responseApi которое в свою очередь вовращает
        // json формат данных и устанавливает status code который передается в метод
        return $this->helperReturn->responseApi($genreCreate["code"], $genreCreate["genre"]);
    }

    // создание public метода view с передачей идентификатора полученного из URL-адреса
    // для представления данных определенного жанра
    public function view($id){
        // запись в переменную genre значения в формате массива содержащей статус код и массив данных
        // полученны с помощью метода genreView
        $genre = $this->findGenre->genreView($id);

        // возвращение значения в виде метода responseApi которое в свою очередь вовращает
        // json формат данных и устанавливает status code который передается в метод
        return $this->helperReturn->responseApi($genre["code"], $genre["genre"]);
    }

    // создание public метода update с передачей идентификатора и запроса
    // для обновления данных в таблице Genre
    public function update(Request $request, $id){
        // запись в переменную genreUpdate значения полученного с помощью метода genreUpdate
        // передается статус код и сообщение об ошибках валидации или json формат обновленного значения
        $genreUpdate = $this->updateGenre->genreUpdate($request, $id);

        // возвращение значения в виде метода responseApi которое в свою очередь вовращает
        // json формат данных и устанавливает status code который передается в метод
        return $this->helperReturn->responseApi($genreUpdate["code"], $genreUpdate["genre"]);
    }

    // создание public метода delete с передачей идентификатора полученного из URL-адреса
    // для удаления данных определенного жанра
    public function delete($id){
        // запись в переменную genreDelete значения с помощью вызова метода genreDelete
        // которое возвращает массива со код статусом и сообщением
        $genreDelete = $this->deleteGenre->genreDelete($id);

        // возвращение значения в виде метода responseApi которое в свою очередь вовращает
        // json формат данных и устанавливает status code который передается в метод
        return $this->helperReturn->responseApi($genreDelete["code"], $genreDelete["genre"]);
    }
}
