
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-GLhlTQ8i7uYeJ2/JzxPq5m7Xk1FpVOJ6+ktz0tW9un6LZ6p/JT5u1F7Tp5U02v2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
    <!-- Your existing HTML content here -->
</body>
</html>



<?php require_once views_path('partials/header');?>

<style>
    body {
        display: flex;
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        background: linear-gradient(120deg, #2980b9, #8e44ad);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        margin: 0; 
        height: 100vh;
        overflow: hidden;
    }

    .password-toggle-icon {
        cursor: pointer;
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: #333;
    }

    .input-group {
        position: relative;
    }



    .login-container {
    width: 100%;
    max-width: 400px;
    height: auto; /* Change this line */
    padding: 60px 30px;
    background-color: rgba(255, 255, 255, 0.9);
    border-radius: 10px;
    font: roboto;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

    
    .btn-primary{

        outline: none;
        width: 100%;
        height: 50px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 400;
        cursor: pointer;
        text-align: center;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .login-container {
            padding: 30px; 
        }

        button.btn-primary {
            font-size: 16px; 
        }
    }

    @media (max-width: 576px) {
        .login-container {
            height: auto;
    }
</style>

<div class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-10 col-sm-12 text-center">
            <!-- Content for the left column (if any) -->
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 col-sm-12">
            <div class="login-container">
                <form method="post" class="text-center">
                    <h1><i class="fa fa-user-tie"></i></h1>
                    <h3 style="padding-top: 10px; padding-bottom: 10px;">NovelSolar Stock Reconcilation</h3>

                    <div class="mb-3">
                        <div class="input-group">
                            <input type="email" name="email" value="<?=set_value('email')?>" class="form-control <?=!empty($errors['email'])?'border-danger':''?>" id="exampleFormControlInput1" placeholder="Email" autofocus required>
                            <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope"></i></span>
                        </div>
                        <?php if(!empty($errors['email'])):?>
                            <small class="text-danger"><?=$errors['email']?></small>
                        <?php endif;?>
                    </div>


                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Password</span>
                        <input type="password" name="password" value="<?=set_value('password')?>" class="form-control <?=!empty($errors['password'])?'border-danger':''?>" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" required>
                        <!-- Add an eye icon for toggling password visibility -->
                        <i class="fa fa-eye password-toggle-icon" onclick="togglePasswordVisibility('password')"></i>
                        <?php if(!empty($errors['password'])):?>
                            <small class="text-danger col-12"><?=$errors['password']?></small>
                        <?php endif;?>
                    </div>

                    <div class="row justify-content-center">
                        <button class="btn btn-primary" style="font-size: 20px;"> Login </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once views_path('partials/footer');?>

<script>
    // JavaScript function to toggle password visibility
    function togglePasswordVisibility(passwordFieldId) {
        const passwordField = document.getElementsByName(passwordFieldId)[0];
        passwordField.type = passwordField.type === 'password' ? 'text' : 'password';
    }
</script>
