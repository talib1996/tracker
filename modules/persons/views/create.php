    <h1>Create New Persons Record</h1>
    <?= flashdata() ?>
    <div class="card">
        <div class="card-heading">
            Persons Details
        </div>
        <div class="card-body">
            <?php echo form_open($form_location); ?>
                <label>First Name</label>
                <input type="text" name="first_name" placeholder="Enter your first name">
                <label>Last Name</label>
                <input type="text" name="last_name" placeholder="Enter your first name">
                <label>CNIC</label>
                <input type="text" name="cnic" placeholder="Enter your CNIC number">
                <label>Phone Number</label>
                <input type="text" name="phonenum" placeholder="Enter your phone number">
                <label>Address Line 1</label>
                <input type="text" name="address_line_1" placeholder="Enter Address Line 1">
                <label>Address Line 1</label>
                <input type="text" name="address_line_2" placeholder="Enter Address Line 2">
                <label>City</label>
                <input type="text" name="city" placeholder="Enter City">
                <label>State / Province / Region</label>
                <input type="text" name="state__province__region" placeholder="Enter State / Province / Region">
                <label>Country</label>
                <input type="text" name="country" placeholder="Enter Country">
                <button type="submit" value="Submit" name="submit">Submit</button>
           <?php echo form_close(); ?>
        </div>
    </div>
