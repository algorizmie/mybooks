<?php 
require 'config.php';
$connect = new PDO($dsn, $user, $password);

$sql = 'SELECT id,name,authorname,isbn,genres,price FROM books';
$prepared = $connect->prepare($sql);
$prepared->execute();

//Delete
if(isset($_GET['id'])) {
    $query = 'DELETE FROM books WHERE id = ?';
    $delete = $connect->prepare($query);
    $delete->execute([$_GET['id']]);
    header("Location:" . $_SERVER['PHP_SELF']);
    exit();
}
?>

<?php include('includes/header.php'); ?>
<main>   
    <section class="container mt-5 mb-5">
        <h1 class="mb-5">Table of Books</h1>
        <?php if($prepared->rowCount() > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Author Name</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">Genres</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($posts = $prepared->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo $posts['id']; ?></td>
                    <td><?php echo $posts['name']; ?></td>
                    <td><?php echo $posts['authorname']; ?></td>
                    <td><?php echo htmlspecialchars($posts['isbn']); ?></td>
                    <td><?php echo $posts['genres']; ?></td>
                    <td><?php echo $posts['price']; ?></td>
                    <td>
                        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?id=<?php echo $posts['id']; ?>" class="btn btn-danger">Delete</a>
                        <a href="/books/update.php?id=<?php echo $posts['id']; ?>" class="btn btn-success">Update</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <?php else: ?>
        <p>There is no Data</p>
        <?php endif; ?>
    </section>
</main>
<?php include('includes/footer.php'); ?>