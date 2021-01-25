<div class="container" style="max-width: 500px">
    <form method="post" action="">
        <h2>Form login</h2>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" value="" id="username" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="" id="password" class="form-control"/>
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="exampleRadios1" value="2">
                <label class="form-check-label" for="exampleRadios1">
                    Người cho thuê
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="role" id="exampleRadios2" value="1">
                <label class="form-check-label" for="exampleRadios2">
                    Người thuê
                </label>
                </div>
                <div class="form-check disabled">
                <input class="form-check-input" type="radio" name="role" id="exampleRadios3" value="3">
                <label class="form-check-label" for="exampleRadios3">
                    Người cho thuê & người thuê
                </label>
            </div>
            
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary"/>
            <p>
                Chưa có tài khoản, <a href="index.php?controller=login&action=register">Đăng ký</a> ngay
            </p>
        </div>
    </form>
</div>