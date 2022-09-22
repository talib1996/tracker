<h1>Add a Person</h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Add a person as a user or Admin
    </div>
    <div class="card-body">
        <?php echo form_open($form_location, array('id' => 'user_registration_form')); ?>
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter Username" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter Password" required>
        <label>Role</label>
        <select id="role" name="role" required>
            <option value=""></option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select>
        <div id="user_specific" hidden>
            <label>Queries Limit</label>
            <input id="queries_limit" type="number" name="queries_limit"
                placeholder="Enter number of Queries to be assigned">
        </div>
        <button type="submit" value="Submit" name="submit">Submit</button>
        <?php echo form_close(); ?>
        <!-- <button id="reset">Reset</button> -->

    </div>
</div>
<script>
    // var reset = document.getElementById('reset');
    // reset.addEventListener('click', () => {
    //     var form = document.getElementById('user_registration_form');
    //     form.reset();
    // });
    var role = document.getElementById('role');
    role.addEventListener('click', (e) => {
        if (role.options[role.selectedIndex].value == 'user') {
            var user_specific = document.getElementById('user_specific');
            //alert(user_specific);
            if (user_specific.hidden == true) {
                user_specific.hidden = false;
                var queries_limit = document.getElementById('queries_limit').required = true;
                //     var queries_limit = document.getElementById('queries_limit');
                //     queries_limit.setAttribute('required', true);
            }



        } else if (role.options[role.selectedIndex].value != 'user') {
            var user_specific = document.getElementById('user_specific');
            //alert(user_specific.style.display);
            if (user_specific.hidden == false) {
                user_specific.hidden = true;
                var queries_limit = document.getElementById('queries_limit').required = false;
                //     var queries_limit = document.getElementById('queries_limit');
                //     queries_limit.setAttribute('required', true);
            }

        }

    })
</script>