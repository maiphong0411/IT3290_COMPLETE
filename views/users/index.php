<form method="GET" action="">
<div class="row">
        <div class="form-group col-md-2">
            <label for="username">Username</label>
            <input type="text" name="username" id="username"
                value="<?php echo isset($_GET['username']) ? $_GET['username'] : '' ?>" class="form-control"/>
        </div>
        <div class="form-group col-md-2">
            <label for="job">Job</label>
            <input type="text" name="job" id="job"
                value="<?php echo isset($_GET['job']) ? $_GET['job'] : '' ?>" class="form-control"/>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Gender</label>
            <select name="gender" class="form-control">
                <option value="" >Chọn</option>
                <option value="M" <?php if (isset($_GET['gender']) && $_GET['gender'] === 'M') echo "selected";?>>Nam</option>
                <option value="F" <?php if (isset($_GET['gender']) && $_GET['gender'] === 'F') echo "selected";?>>Nữ</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">Role</label>
            <select name="role" class="form-control">
                <option value="" >Chọn</option>
                <option value="2" <?php if (isset($_GET['role']) && $_GET['role'] === '2') echo "selected";?>>Người cho thuê</option>
                <option value="1" <?php if (isset($_GET['role']) && $_GET['role'] === '1') echo "selected";?>>Người thuê</option>
                <option value="3" <?php if (isset($_GET['role']) && $_GET['role'] === '3') echo "selected";?>>Người cho thuê và người thuê</option>
            </select>
        </div>
        <div class="form-group col-md-2">
            <label for="title">City</label>
            <select name="city" class="form-control">
                <option value="" >Chọn</option>
                <option value="1" <?php if (isset($_GET['city']) && $_GET['city'] === '1') echo "selected";?>>Hà Nội</option>
                <option value="2" <?php if (isset($_GET['city']) && $_GET['city'] === '2') echo "selected";?>>TP HCM</option>
            </select>
        </div>
        
    </div>
    <span>Tìm kiếm theo năm sinh</span>
    <div class="row">
        <div class="form-group col-md-2">
            <label for="username">Năm bắt đầu</label>
            <input type="text" name="start" id="start"
                value="<?php echo isset($_GET['start']) ? $_GET['start'] : '' ?>" class="form-control"/>
        </div>
        <div class="form-group col-md-2">
            <label for="username">Năm kết thúc</label>
            <input type="text" name="end" id="end"
                value="<?php echo isset($_GET['end']) ? $_GET['end'] : '' ?>" class="form-control"/>
        </div>
    </div>
    <div class="form-group">
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=user" class="btn btn-default">Back</a>
    </div>
</form>

<div class="row justify-content-between">
    <div class="col-md-6">
        <h2>Danh sách user</h2>
    </div>
    <div class="col-md-6">
        <h1 class="text-danger text-uppercase font-weight-bold">Có tất cả <?php echo $count_total; ?> bản ghi</h1>
    </div>
</div>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>gender</th>
        <th>phone</th>
        <th>email</th>
        <th>city</th>
        <th>address</th>
        <th>dob</th>
        <th>avatar</th>
        <th>jobs</th>
        <th>role</th>
        <th>account_start</th>
        <th></th>
    </tr>
    <?php if (!empty($users)): ?>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo $user['id'] ?></td>
                <td><?php echo $user['username'] ?></td>
                <td><?php echo $user['first_name'] ?></td>
                <td><?php echo $user['last_name'] ?></td>
                <td>
                    <?php 
                        $gender = $user['gender'] ==  M ? 'Nam' : 'Nữ';
                        echo $gender; 
                    ?>
                </td>
                <td><?php echo $user['phone'] ?></td>
                <td><?php echo $user['email'] ?></td>
                <td><?php echo $user['city'] ?></td>
                <td>
                    <?php 
                        echo $user['home_number'] . " " .$user['street']. " ". $user['district'] 
                    ?>
                </td>
                <td><?php echo date('d-m-Y', strtotime($user['dob'])) ?></td>
                <td>
                    <?php if (!empty($user['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $user['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo $user['job'] ?></td>
                <td>
                    <?php 
                        if($user['role'] == 2) {
                            echo "Người cho thuê";
                        }  
                        elseif ($user['role'] == 1) {
                            echo "Người thuê";
                        }
                        else {
                            echo "Người cho thuê & người thuê";
                        }
                    ?>
                </td>
                <td><?php echo date('d-m-Y', strtotime($user['account_start'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=user&action=detail&id=" . $user['id'];
                    $url_update = "index.php?controller=user&action=update&id=" . $user['id'];
                    $url_delete = "index.php?controller=user&action=delete&id=" . $user['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php echo $pages; ?>