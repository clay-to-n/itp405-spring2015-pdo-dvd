<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/search.css">
    <title>DVD Search</title>
  </head>
  
  <body>
    <div class="container">     
      <div class="row">
        <div class="search col-md-4 col-md-offset-4">

          <form action="results.php" method="get"> 
            <div class="input-group search">
              <input type="text" class="form-control" name="title" placeholder="Search DVDs by Title">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" value="search">Go!</button>
              </span>
            </div>
          </form>
          
        </div>
      </div> 
    </div>
  </body>
  
</html>