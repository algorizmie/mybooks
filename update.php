<?php
require 'config.php';
$connect = new PDO($dsn, $user, $password);
if(isset($_POST['update'])) {
    $data = array(
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'authorname' => $_POST['authorname'],
        'isbn' => $_POST['isbn'],
        'genres' => $_POST['genres'],
        'price' => $_POST['price']
    );
  
    $sql = "UPDATE books
            SET id = :id,
                name = :name,
                authorname = :authorname,
                isbn = :isbn,
                genres = :genres,
                price = :price
            WHERE id = :id";
  
    $statement = $connect->prepare($sql);
    $statement->execute($data);
}
if(isset($_GET['id'])){
    $sql = 'SELECT id,name,authorname,isbn,genres,price FROM books WHERE id = :id';
    $prepared = $connect->prepare($sql);
    $prepared->bindValue(':id', $_GET['id']);
    $prepared->execute();
    $book = $prepared->fetch(PDO::FETCH_ASSOC);
}


?>
<?php include('includes/header.php'); ?>
<main>
<section class="container mt-5 mb-5">
    <h2 class="mb-5">Update Book</h2>
    <form method="post">
        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="bname">Name</label>
                <input type="text" class="form-control" id="bname" value="<?php echo $book['name']; ?>" name="name" placeholder="Name">
            </div>
            <div class="form-group col-md-6">
                <label for="author_name">Author Name</label>
                <input type="text" class="form-control" value="<?php echo $book['authorname']; ?>" id="author_name" name="authorname" placeholder="Author Name">
            </div>
        </div>
        <div class="form-group">
            <label for="isbn">Isbn</label>
            <input type="text" class="form-control" value="<?php echo $book['isbn']; ?>" id="isbn" name="isbn" placeholder="ISBN ex: 978-9953-68-866-4">
        </div>
        <div class="form-group">
            <label for="genres">Book Genres</label>
            <select name="genres" id="genres" class="custom-select">
                <option value="Action and adventure" <?php if($book['genres'] == 'Action and adventure'){echo "selected";} ?>>Action and adventure</option>
                <option value="Children's" <?php if($book['genres'] == 'Action and adventure'){echo "selected";} ?>>Children's</option>
                <option value="Drama" <?php if($book['genres'] == 'Children\'s'){echo "selected";} ?>>Drama</option>
                <option value="Fantasy" <?php if($book['genres'] == 'Fantasy'){echo "selected";} ?>>Fantasy</option>
                <option value="Romance" <?php if($book['genres'] == 'Romance'){echo "selected";} ?>>Romance</option>
                <option value="Art" <?php if($book['genres'] == 'Art'){echo "selected";} ?>>Art</option>
                <option value="Diary" <?php if($book['genres'] == 'Diary'){echo "selected";} ?>>Diary</option>
                <option value="Biography" <?php if($book['genres'] == 'Biography'){echo "selected";} ?>>Biography</option>
                <option value="History" <?php if($book['genres'] == 'History'){echo "selected";} ?>>History</option>
                <option value="Math" <?php if($book['genres'] == 'Math'){echo "selected";} ?>>Math</option>
                <option value="Science" <?php if($book['genres'] == 'Science'){echo "selected";} ?>>Science</option>
                <option value="Self help" <?php if($book['genres'] == 'Self help'){echo "selected";} ?>>Self help</option>
                <option value="Travel" <?php if($book['genres'] == 'Travel'){echo "selected";} ?>>Travel</option>
                <option value="Health" <?php if($book['genres'] == 'Health'){echo "selected";} ?>>Health</option>
                <option value="Cookbook" <?php if($book['genres'] == 'Cookbook'){echo "selected";} ?>>Cookbook</option>
                <option value="Journal" <?php if($book['genres'] == 'Journal'){echo "selected";} ?>>Journal</option>
                <option value="Poetry" <?php if($book['genres'] == 'Poetry'){echo "selected";} ?>>Poetry</option>
                <option value="Political" <?php if($book['genres'] == 'Political'){echo "selected";} ?>>Political</option>
            </select>
        </div>
        <div class="form-group">
            <label for="address">Price</label>
            <input type="text" class="form-control" value="<?php echo $book['price']; ?>" id="price" name="price" placeholder="Price($) ex: 5">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
    </form>
</section>
</main>
<?php include('includes/footer.php'); ?>