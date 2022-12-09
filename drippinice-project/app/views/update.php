<?php 
    $pdo = new PDO('mysql:host=localhost;port=3306;dbname=bijoux_siteweb', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $id = $_GET['id'] ?? null;



    $statement = $pdo->prepare('SELECT * FROM product WHERE id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $product = $statement->fetch(PDO::FETCH_ASSOC);

    $errors = [];

    $title = '';
    $price = '';
    $description = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $errors = [];
    if(!$title){
      $errors[] = 'Product title is required';
    }
    if(!$price){
      $errors[] = 'Product price is required';
    }

    if (!is_dir('image')){
      mkdir('image');
    }
    if (empty($errors)){

      $image = $_FILES['image']??null;
      $imagePath = $product['image'];

      if ($image && $image['tmp_name']){

        if($product['image']){
          unlink($product['image']);
        }

        $imagePath = 'image/'.randomString(8).'/'.$image['name'];    
        mkdir((dirname($imagePath)));   
        
        move_uploaded_file($image['tmp_name'], $imagePath);
      }
      $statement = $pdo->prepare("UPDATE products SET title = :title, image = :image, description = :description, price = :price WHERE id = :id");
      $statement->bindValue(':title', $title);
      $statement->bindValue(':image', $imagePath);
      $statement->bindValue(':description', $description);
      $statement->bindValue(':price', $price);
      $statement->bindValue(':id', $id);
      $statement->execute();
    }
    
    }
    function randomString($n)
    {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $str = '';
      for($i = 0;$i < $n; $i++){
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
      }
      return $str;
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/css/admin.css">
    <title>products crud</title>
  </head>
  <body>

  <p>
    <a href="home" class="btn btn-secondary">Go Back to Products</a>
  </p>

    <h1>Create new Product</h1>
    <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $error): ?>
        <div><?php echo $error ?></div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">

    <?php if ($product['image']): ?>
        <img src="<?php echo $product['image'] ?>" class="update-image">
    <?php endif; ?>
  <div class="form-group">
    <label>Product Image :</label>
    <br>
    <input type="file" name="image">
  </div>
  <div class="form-group">
    <label>Product Title :</label>
    <input type="text" name="title" class="form-control" value="<?php echo $title ?>">
  </div>
  <div class="form-group">
    <label>Product Description :</label>
    <textarea class="form-control" name="description" <?php echo $description ?>></textarea>
  </div>
  <div class="form-group">
    <label>Product Price :</label>
    <input type="number" step=".01" class="form-control" name="price" <?php echo $price ?>>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
  </body>
</html>