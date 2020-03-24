<?php
    if(isset($_POST['submit'])){
        require 'config.php';
        $connect = new PDO($dsn, $user, $password);
        $data = array(
            'name' => $_POST['name'],
            'authorname' => $_POST['authorname'],
            'isbn' => $_POST['isbn'],
            'genres' => $_POST['genres'],
            'price' => $_POST['price']
        );

        $sql = 'INSERT INTO books (name, authorname, isbn, genres, price) VALUES (:name, :authorname, :isbn, :genres, :price)';

        $prepared = $connect->prepare($sql);
        $prepared->execute($data);
    }
?>
<?php include('includes/header.php'); ?>
<main>
    <section class="container mt-5 mb-5">
        <h2 class="mb-5">Add New Book</h2>
        <?php if(isset($_POST['submit']) && $prepared ): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data is saved seccessfuly 
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <form method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="bname">Name</label>
                    <input type="text" class="form-control" id="bname" name="name" placeholder="Name">
                </div>
                <div class="form-group col-md-6">
                    <label for="author_name">Author Name</label>
                    <input type="text" class="form-control" id="author_name" name="authorname" placeholder="Author Name">
                </div>
            </div>
            <div class="form-group">
                <label for="isbn">Isbn</label>
                <input type="text" class="form-control" id="isbn" name="isbn" placeholder="ISBN ex: 978-9953-68-866-4">
            </div>
            <div class="form-group">
                <label for="genres">Book Genres</label>
                <select name="genres" id="genres" class="custom-select">
                    <option selected>Choose...</option>
                    <option value="Action and adventure">Action and adventure</option>
                    <option value="Children's">Children's</option>
                    <option value="Drama">Drama</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Romance">Romance</option>
                    <option value="Art">Art</option>
                    <option value="Diary">Diary</option>
                    <option value="Biography">Biography</option>
                    <option value="History">History</option>
                    <option value="Math">Math</option>
                    <option value="Science">Science</option>
                    <option value="Self help">Self help</option>
                    <option value="Travel">Travel</option>
                    <option value="Health">Health</option>
                    <option value="Cookbook">Cookbook</option>
                    <option value="Journal">Journal</option>
                    <option value="Poetry">Poetry</option>
                    <option value="Political">Political</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Price</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Price($) ex: 5">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Add New Book</button>
        </form>
    </section>
</main>
<?php include('includes/footer.php'); ?>