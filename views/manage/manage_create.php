<h2>ADD sản phẩm</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city"
               value="<?php echo isset($_POST['city']) ? $_POST['city'] : '' ?>"
               class="form-control" id="city"/>
    </div>
    <div class="form-group">
        <label for="home_number">home_number</label>
        <input type="number" name="home_number"
               value="<?php echo isset($_POST['home_number']) ? $_POST['home_number'] : '' ?>"
               class="form-control" id="home_number"/>
    </div>
    <div class="form-group">
        <label for="street">street</label>
        <input type="text" name="street"
               value="<?php echo isset($_POST['street']) ? $_POST['street'] : '' ?>"
               class="form-control" id="street"/>
    </div>
    <div class="form-group">
        <label for="district">district</label>
        <input type="text" name="district"
               value="<?php echo isset($_POST['district']) ? $_POST['district'] : '' ?>"
               class="form-control" id="district"/>
    </div>
    <div class="form-group">
        <label for="max_people">max_people</label>
        <input type="number" name="max_people"
               value="<?php echo isset($_POST['max_people']) ? $_POST['max_people'] : '' ?>"
               class="form-control" id="max_people"/>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="parking">Parking</label>
            <select name="parking" class="form-control" id="parking">
                <option value="0" <?php echo $product['parking'] == "0" ? "selected" : ""; ?>>Không</option>
                <option value="1" <?php echo $product['parking'] == "1" ? "selected" : ""; ?>>Có</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="time">time</label>
        <input type="number" name="time"
               value="<?php echo isset($_POST['time']) ? $_POST['time'] : '' ?>"
               class="form-control" id="time"/>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="wc_type">wc_type</label>
            <select name="wc_type" class="form-control" id="wc_type">
                <option value="0" <?php echo $product['wc_type'] == "0" ? "selected" : ""; ?>>Không</option>
                <option value="1" <?php echo $product['wc_type'] == "1" ? "selected" : ""; ?>>Có</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="heater">heater</label>
            <select name="heater" class="form-control" id="heater">
                <option value="0" <?php echo $product['heater'] == "0" ? "selected" : ""; ?>>Không</option>
                <option value="1" <?php echo $product['heater'] == "1" ? "selected" : ""; ?>>Có</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="aircondition">aircondition</label>
            <select name="aircondition" class="form-control" id="aircondition">
                <option value="0" <?php echo $product['aircondition'] == "0" ? "selected" : ""; ?>>Không</option>
                <option value="1" <?php echo $product['aircondition'] == "1" ? "selected" : ""; ?>>Có</option>
            </select>
        </div>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control"
              name="description"><?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?></textarea>
    </div>
    <div class="form-group">
        <label for="state">State</label>
        <input type="text" name="state"
               value="0"
               class="form-control" id="state"/>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="text" name="price"
               value="<?php echo isset($_POST['price']) ? $_POST['price'] : '' ?>"
               class="form-control" id="price"/>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="type_room">type_room</label>
            <select name="type_room" class="form-control" id="type_room">
                <option value="Nha Tro" <?php echo $product['type_room'] == "Nha Tro" ? "selected" : ""; ?>>Nhà trọ</option>
                <option value="Nha Rieng" <?php echo $product['type_room'] == "Nha Rieng" ? "selected" : ""; ?>>Nhà riêng </option>
                <option value="Chung Cu" <?php echo $product['type_room'] == "Chung Cu" ? "selected" : ""; ?>>Chung cư</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="area">Area</label>
        <input type="text" name="area" value="<?php echo isset($_POST['area']) ? $_POST['area'] : '' ?>"
               class="form-control" id="area"/>
    </div>

    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=manage&action=manage" class="btn btn-default">Back</a>
    </div>
</form>