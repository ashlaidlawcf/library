<?php
    /**
    * @backupGlobals disabled
    * #backupStaticAttributes disabled
    */

    require_once 'src/Book.php';

    $server = 'mysql:host=localhost:8889;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BookTest extends PHPUnit_Framework_TestCase
    {
        function tearDown()
        {
            Book::deleteAll();
        }

        function test_getTitle()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);

            // Act
            $result = $book->getTitle();

            // Assert
            $this->assertEquals($title, $result);
        }

        function test_setTitle()
        {
            // Arrange
            $title = "The Giving Tree";
            $new_title = "The Missing Piece";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);

            // Act
            $book->setTitle($new_title);
            $result = $book->getTitle();

            // Assert
            $this->assertEquals("The Missing Piece", $result);
        }

        function test_getAuthor()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);

            // Act
            $result = $book->getAuthor();

            // Assert
            $this->assertEquals("Shel Silverstein", $result);
        }

        function test_setAuthor()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);

            // Act
            $new_author = 'Shelly Silverstein';
            $book->setAuthor($new_author);
            $result = $book->getAuthor();

            // Assert
            $this->assertEquals($new_author, $result);
        }

        function test_save()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);
            $book->save();

            // Act
            $result = Book::getAll();

            // Assert
            $this->assertEquals($book, $result[0]);
        }

        function test_deleteAll()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);
            $book->save();

            $title2 = "The Taking Boy";
            $author2 = "Sandy Goldenstein";
            $genre2 = "adult";
            $id2 = null;
            $book2 = new Book($title2, $author2, $genre2, $id2);
            $book2->save();

            // Act
            Book::deleteAll();
            $result = Book::getAll();

            // Assert
            $this->assertEquals([], $result);
        }

        function test_getAll()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);
            $book->save();

            $title2 = "The Taking Boy";
            $author2 = "Sandy Goldenstein";
            $genre2 = "adult";
            $id2 = null;
            $book2 = new Book($title2, $author2, $genre2, $id2);
            $book2->save();

            // Act
            $result = Book::getAll();


            // Assert
            $this->assertEquals([$book, $book2], $result);
        }

        function test_find()
        {
            // Arrange
            $title = "The Giving Tree";
            $author = "Shel Silverstein";
            $genre = "childrens";
            $id = null;
            $book = new Book($title, $author, $genre, $id);
            $book->save();

            $title2 = "The Taking Boy";
            $author2 = "Sandy Goldenstein";
            $genre2 = "adult";
            $id2 = null;
            $book2 = new Book($title2, $author2, $genre2, $id2);
            $book2->save();

            // Act
            $id = $book->getId();
            $result = Book::find($id);

            // Assert
            $this->assertEquals($book, $result);
        }


    }
?>
