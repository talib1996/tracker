<h1>Login</h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Login as a user or admin
    </div>
    <div class="card-body">
        <?php echo form_open($form_location); ?>
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>
        <button type="submit" value="Submit" name="submit">Submit</button>
        <?php echo form_close(); ?>
    </div>
</div>