<h1 style="text-align: center;">Mobile Tracking System</h1>
<?php
if($_SESSION['role'] == 'admin'){
    ?>
    
<?php
}else{
?>
<div class="card">
    <div class="card-heading">
       Your Queries
    </div>
    <div class="card-body">
       <h2>Total Queries: <span><?= $_SESSION['queries_limit'] ?></span></h2>
       <h2>Remaining: <span><?= $_SESSION['remaining_queries'] ?></span></h2>
    </div>
    </div>
<?php
}
?>