<?php

/*
    Задача №3
    Напишите код в парадигме ООП, соответствующий следующей структуре.
    Сущности: Пользователь, Статья.
    Связи: Один пользователь может написать несколько статей. У каждой статьи может быть только один пользователь-автор.
    Функциональность:
    •	возможность для пользователя создать новую статью;
    •	возможность получить автора статьи;
    •	возможность получить все статьи конкретного пользователя;
    •	возможность сменить автора статьи.
    Если вы применили какие-либо паттерны при написании, укажите какие и с какой целью.
    Код, реализующий конкретную функциональность, не требуется, только общая структура классов и методов.
    Код должен быть прокомментирован в стиле PHPDoc.
*/

##############################################################################################

namespace b2b\task3;


class User
{
    /*
     * Массив объектов статей
     * @var $articles
     */
    private $articles;

    /*
     * Тестовое значение имени пользователя
     * @var $name
     */
    public $name;

    /*
     * Инициализация значений пользователя при создании объекта
     * @return void
     */
    public function __construct($name)
    {
        $this->articles = [];
        $this->name = $name;
        echo "Пользователь {$name} был создан\n";
    }

    /*
     * Создает новую статью, принадлежащую инстантсу пользователя
     * @return Article
     */
    public function createNewArticle()
    {
        $new_article = new Article($this);
        $this->articles[] = $new_article;
        echo "Статья была создана пользователем {$this->name} \n";
        return $new_article;
    }

    /*
     * Возвращает массив объектов статей
     * @return array
     */
    public function getArticles()
    {
        return $this->articles;
    }
}

class Article
{
    /*
     * Объект автора статьи
     */
    private $author;

    /*
     * Инициализация статьи при создании объекта
     * @return void
     */
    public function __construct(User $author)
    {
        $this->author = $author;
    }

    /*
     * Получение инстанса автора данной статьи
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;    }

    /*
     * Изменение автора, которому принадлежит объект статьи
     * @return void
     */
    public function changeAuthor(User $author)
    {
        $this->author = $author;
    }
}

echo "======================================= CTRL + U (Chrome)\n";
$user1 = new User('Гена');
$user2 = new User('Виталий');
$user3 = new User('Софья');
echo "=============\n";
echo "=============\n";
$article1 = $user1->createNewArticle();
$article2 = $user1->createNewArticle();
$article3 = $user2->createNewArticle();
$article4 = $user2->createNewArticle();
$article5 = $user3->createNewArticle();
echo "=============\n";
echo "=============\n";
echo $article3->getAuthor()->name . "\n";
echo $article5->getAuthor()->name . "\n";
echo "=============\n";
echo "=============\n";
$user1_articles = $user1->getArticles();
print_r($user1_articles);
echo "=============\n";
echo "=============\n";
$user4 = new User('Евгений');
$article3->changeAuthor($user4);
echo "=============\n";
echo "=============\n";
echo $article3->getAuthor()->name . "\n";