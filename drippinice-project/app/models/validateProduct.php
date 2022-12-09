<?php
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
      header('Location: admin.php');
    }
    
    }