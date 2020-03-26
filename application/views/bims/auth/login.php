<div class="animatedParent">
    <div class="row">

        <div class="col-md-6 col-sm-6 hidden-xs">
            <br>
            <h3 class="sign animated flipInX"><?php echo $site_setting['app_title'];?></h3>
            <p class="small animated flipInX">Elevenia Project Manager</p>

           

            <h3 class="sign animated flipInX">Use your login</h3>
            <p class="small animated flipInX">you can connect with us.</p>

            
        </div>

        <div class="col-xs-12 col-md-4 col-sm-6 col-lg-4">

            <div class="blue-line sm normal"></div>

            <div class="signup-box">
                <div class="logo"><img src="" alt="" style="height: 40px;"></div>

                <form role="form" method="post" action="<?=$form_action?>" enctype="multipart/form-data">

                    <div class="form-group">
                        <input type="text" maxlength="20" name="username" class="form-control" placeholder="User ID" required>
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <i class="fa fa-lock" aria-hidden="true"></i>
                        <!-- <div class="forgot"><a href="<?=site_url('auth/forgot_password')?>">Forgot?</a></div> -->
                    </div>



                    <button href="#" type="submit" class="btn btn-primary btn-block">Login Now</button>
                </form>
            </div>

            <br>
            <div class="signup-box">
                <p class="signac animated flipInX">Register Account? Call your Administrator</p>
            </div>

            <div class="blue-line lg normal"></div>
        </div>
    </div>
</div>