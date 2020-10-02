<template>

    <div class="row">
        <div class="col-lg-6 right-side img-fluid right-side-login">
            <!-- <img
         style="border-radius: 17px; padding: 10px; margin: 1% 0"
         class="img-fluid"
         src="{{ asset('images/welcome-banner.jpg') }}"
         alt=""> -->
        </div>
        <!-- Left Side Pub -->
        <div class="col-lg-6 left-side">
            <!-- Logo Part -->
            <div class="logo-container">
                <img class="logo-img" src="/images/logo.svg" alt="">
                <h1 class="header-logo-text" style="font-weight: bold; margin-bottom: 0;">COVIDZ-19</h1>
            </div>
            <!-- TODO: Make the Buttons responsive -->
            <!-- <div class="header-title">
                <button class="btn" style="background-color: #E5E5E5; "><img style="width: 25px; height: 25px;" src="/images/google.svg">Sign in with Google </button>
                <button class="btn" style="background-color: #3B5999;">fb</button>
                <button class="btn" style="background-color: #50ABF1">twitter</button>
            </div> -->
            <!-- <div style="margin: 3% auto;"><span style="margin: auto; display: table;">Or</span></div> -->
            <div class="auth-buttons" style="margin: 6% auto;">
                <form method="POST" action="/login">
                    <input type="hidden" name="_token" :value="csrf_token">
                    <div class="form-group row">
                        <div class="col">
                            <input id="email" type="email" class="form-control " name="email" required autocomplete="email" placeholder="Email">

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="Password">

                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                <label class="form-check-label" for="remember">
                                    remember me
                                </label>
                            </div>
                        </div>
                        <div class="col">

                            <a class="btn btn-link forget-pwd" href="">
                                Forgot Your Password?
                            </a>

                        </div>
                    </div>

                    <div class="form-group row">
                        <button style="width: 40%;margin: auto;" type="submit" class="btn btn-primary">
                            Login
                        </button>
                    </div>
                </form>
            </div>
            <div class="row" style="margin: auto;">
                <p style="margin: auto;">You don't have An account! <a class="login-link" href="">Signup</a> here</p>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                csrf_token: window.csrf_token
            }
        }
    }
</script>