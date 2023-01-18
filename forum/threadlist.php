<?php include_once('partials/_header.php');?>
<?php include_once('partials/_dbConnect.php');?>
<?php
// Edited by lodu show alert ke uper wala code yaha dal diya
$id = $_GET['catid'];
$showAlert = FALSE;
$method = $_SERVER['REQUEST_METHOD'];
if ($method =='POST'){
  $th_title = $_POST['title'];
  $th_desc= $_POST['desc'];
  $sql = "INSERT INTO `threads` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_user_id`) VALUES ( '$th_title', '$th_desc', '$id', '0');";
  $result = mysqli_query($conn, $sql);

  $showAlert = TRUE;
  
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>welcome to iDiscuss- coading forum</title>
    <style>
      #ques{
        min-height:240px;
      }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <!-- ye code dala hai halwe ki gand me -->
    <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  </head>
  <body>
  <?php 
      $sql = "SELECT * FROM categories WHERE category_id= " . $id;
      
      $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) {
    $catname = $row['category_name'];
    $catdesc = $row['category_desc'];
  }


  ?>

  <?php
  if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Success!</strong> Your threads has been successfully added.
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
  }
  
  
  ?>
    <div class="jumbotron text-center">
  <h1 class="display-4">Welcome to <?php echo $catname;?> Forum
</h1>
  <p class="lead"></p>
  <hr class="my-4">
  <p><?php echo $catdesc;?></p>
  <p class="lead"> Don't spam the forums or create topics or posts with spammy content, including content or URLs......

  </p>
  <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>

</div>
<div class ="cointainer ">
  <div class="row mx-4 ">
  <h1 class="py-2  text-center">Start a Discussion</h1>
<form action="<?php echo $_SERVER['REQUEST_URI']?>" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Thread Title</label>
    <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp" placeholder="">
    <small id="helptitle" class="form-text text-muted">keep your title short.</small>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Ellaborate your concern here</label>
    <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
<div class="container " id="ques">
    <h1 class= "container py-3 text-center"> BROWSE QUESTIONS</h1>

<?php
$id = $_GET['catid'];
$sql = "SELECT * FROM threads WHERE thread_cat_id= $id";
$result = mysqli_query($conn, $sql);
  $noResult = TRUE;
while ($row = mysqli_fetch_assoc($result)) {
  $title = $row['thread_title'];
  $desc = $row['thread_desc'];
  $id = $row['thread_id'];
  $noResult = FALSE;

  echo '<div class = "media  mx-4" >
  <img class = "mr-3" src="/forum/img/img1.png" width="50px" alt="Generic placeholder image">
    <div class="media-body">
    <p class ="font-weight-bold my-0">Annonymus user</p>

   <h5 class="mt-0"><a class="text-primary" href="thread.php?catid=' . $id . ' "> ' . $title . '</a></h5> ' . $desc . '
  </div>
  </div>';

}

if($noResult){
  '<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">No Threats Found</h1>
    <p class="lead">Be the first person to ask question</p>
  </div>
  
</div>';
}

?>
</div>

            <?php include_once('partials/_footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>

</html>