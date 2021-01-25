<h2>Thêm mới user</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="username">Username <span class="red">*</span></label>
        <input type="text" name="username" id="username"
               value="<?php echo isset($_POST['username']) ? $_POST['username'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="password">Password <span class="red">*</span></label>
        <input type="password" name="password" id="password"
               value="<?php echo isset($_POST['password']) ? $_POST['password'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="password_confirm">Nhập lại password <span class="red">*</span></label>
        <input type="password" name="password_confirm" id="password_confirm" value="" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="first_name">First_name</label>
        <input type="text" name="first_name" id="first_name"
               value="<?php echo isset($_POST['first_name']) ? $_POST['first_name'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="last_name">Last_name</label>
        <input type="text" name="last_name" id="last_name" value="<?php echo isset($_POST['last_name']) ? $_POST['last_name'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="<?php echo isset($_POST['phone']) ? $_POST['phone'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="dob">dob</label>
        <input type="date" name="dob" id="dob" value="<?php echo isset($_POST['dob']) ? $_POST['dob'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="address">home_number</label>
        <input type="number" name="home_number" id="home_number" value="<?php echo isset($_POST['home_number']) ? $_POST['home_number'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="street">street</label>
        <input type="text" name="street" id="street" value="<?php echo isset($_POST['street']) ? $_POST['street'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="district">district</label>
        <input type="text" name="district" id="district" value="<?php echo isset($_POST['district']) ? $_POST['district'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="city">city</label>
        <input type="text" name="city" id="city" value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="job">Job</label>
        <input type="text" name="job" id="job" value="<?php echo isset($_POST['job']) ? $_POST['job'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="gender">Giới tính</label>
        <select name="gender" class="form-control" id="gender">
            <option value="M">Nam</option>
            <option value="F">Nữ</option>
        </select>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <select name="role" class="form-control" id="role">
            <option value="1">Người cho thuê</option>
            <option value="2">Người thuê</option>
            <option value="3">Người cho thuê và người thuê</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=user&action=index" class="btn btn-default">Back</a>
    </div>
</form>