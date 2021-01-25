<h2>Cập nhật user</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username <span class="red">*</span></label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : $user['username'] ?>" disabled
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="first_name">First_name</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : $user['first_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last_name</label>
        <input type="text" name="last_name" id="last_name"
               value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : $user['last_name'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="number" name="phone" id="phone"
               value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : $user['phone'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email"
               value="<?php echo isset($_POST['email']) ? $_POST['email'] : $user['email'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="home_number">home_number</label>
        <input type="number" name="home_number" id="home_number"
               value="<?php echo isset($_POST['home_number']) ? $_POST['home_number'] : $user['home_number'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="street">street</label>
        <input type="text" name="street" id="street"
               value="<?php echo isset($_POST['street']) ? $_POST['street'] : $user['street'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="district">district</label>
        <input type="text" name="district" id="district"
               value="<?php echo isset($_POST['district']) ? $_POST['district'] : $user['district'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="address">city</label>
        <input type="text" name="city" id="city"
               value="<?php echo isset($_POST['city']) ? $_POST['city'] : $user['city'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control"/>
        <?php if (!empty($user['avatar'])): ?>
            <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="job">job</label>
        <input type="text" name="job" id="job"
               value="<?php echo isset($_POST['job']) ? $_POST['job'] : $user['job'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <label for="dob">dob</label>
        <input type="date" name="dob" id="dob"
               value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : $user['dob'] ?>"
               class="form-control"/>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="gender">Giới tính</label>
            <select name="gender" class="form-control" id="gender">
                <option value="M" <?php echo $user['gender'] == "M" ? "selected" : ""; ?>>Nam</option>
                <option value="F" <?php echo $user['gender'] == "F" ? "selected" : ""; ?>>Nữ</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" class="form-control" id="role">
                <option value="1" <?php echo $user['role'] == "2" ? "selected" : ""; ?>>Người cho thuê</option>
                <option value="2" <?php echo $user['role'] == "1" ? "selected" : ""; ?>>Người thuê</option>
                <option value="3" <?php echo $user['role'] == "3" ? "selected" : ""; ?>>Người cho thuê và người thuê</option>
            </select>
        </div>
    </div>
    
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=home&action=index" class="btn btn-default">Back</a>
    </div>
</form>