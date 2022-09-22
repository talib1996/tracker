<h1>Search Persons Record</h1>
<?= flashdata() ?>
<div class="card">
    <div class="card-heading">
        Search Persons
    </div>
    <div class="card-body">
        <?php echo form_open($form_location); ?>
        <label>CNIC or Phone Number</label>
        <input type="text" name="cnic_phonenum" placeholder="Enter CNIC or Phone Number">
        <button type="submit" value="Submit" name="submit">Submit</button>
        <?php echo form_close(); ?>
    </div>
</div>

<div class="card" style="width:100%">
    <div class="card-heading">
        Search Results
    </div>
    <div class="card-body">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>CNIC</th>
                    <th>Phone Number</th>
                    <th>Address</th>
                    <th style="width: 82px;">created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if (isset($persons)) {
                    foreach($persons as $person){
                    ?>
                <tr>
                    <td>
                        <?= $person->id ?>
                    </td>
                    <td>
                        <?= $person->first_name ?>
                    </td>
                    <td>
                        <?= $person->last_name ?>
                    </td>
                    <td>
                        <?= $person->cnic ?>
                    </td>
                    <td>
                        <?= $person->phonenum ?>
                    </td>
                    <td>
                        <?= $person->address_line_1.", ".$person->address_line_2.", "
                        .$person->city.", ".$person->state__province__region.", "
                        .$person->country
                         ?>
                    </td>
                    <td>
                        <?= $person->created_at ?>
                    </td>
                    <td>
                        <?= $person->updated_at ?>
                    </td>
                </tr>
                <?php
                    }
                        }
                    ?>
            </tbody>
            <tfoot>
            </tfoot>
        </table>
    </div>
</div>