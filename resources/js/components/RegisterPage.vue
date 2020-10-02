<template>
       <div class="row">
    <div class="col-lg-6 right-side img-fluid right-side-signup">
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
      <img class="logo-img"  src="/images/logo.svg" alt="">
      <h1 class="header-logo-text" style="font-weight: bold;">COVIDZ-19</h1>
   </div>
   <!-- TODO: Make the Buttons responsive -->
   <!-- <div class="header-title">
      <button class="btn" style="background-color: #E5E5E5; "><img style="width: 25px; height: 25px;" src="/images/google.svg">Join with Google </button>
      <button class="btn" style="background-color: #3B5999;">fb</button>
      <button class="btn" style="background-color: #50ABF1">twitter</button>
   </div>
   <div style="margin: 3% auto;"><span style="margin: auto; display: table;">Or</span></div> -->
   <div class="auth-buttons" style="margin: 6% auto;">
      <form method="POST" action="/register">
                          <input type="hidden" name="_token" :value="csrf_token"></input>
         <div id="st-step">
            <div class="form-group row">
               <div class="col">
                  <input id="username" type="text" class="form-control " name="username" value="" required autocomplete="username" autofocus placeholder="Username">
                 
                  <span class="invalid-feedback" role="alert">
                  <strong></strong>
                  </span>
                  
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input id="lname" type="text" class="form-control" name="lname" value="" required autocomplete="nom" autofocus placeholder="Lastname">
                  
                  <span class="invalid-feedback" role="alert">
                  <strong></strong>
                  </span>
                  
               </div>
            </div>
            <div class="form-group row">
               <div class="col">
                  <input id="fname" type="text" class="form-control" name="fname" value="" required autofocus autocomplete="prenom" placeholder="Firstname">
                  
                  <span class="invalid-feedback" role="alert">
                  <strong></strong>
                  </span>
                  
               </div>
            </div>
            <div class="form-group row">
                            <div class="col">
                                <select class="form-control" name="gender" id="gender" required>
                                    <!-- <option value="2" disabled selected>Gender</option> -->
                                    <option value="0">Male</option>
                                    <option value="1">Female</option>
                                </select>
                                
                                  <span class="invalid-feedback" role="alert">
                                  <strong></strong>
                                  </span>
                                
                            </div>
                        </div>
            <div class="form-group row">
               <div class="col">
                  <button style="width: 20%;" @click="toggleMenu('next')" id="next" type="button" class="btn btn-success right">
                  Next <!-- <span style="margin: auto; font-size: 120%; font-weight: 600"> > </span> -->
                  </button>
               </div>
            </div>
            </div>
            <div id="nd-step" style="display: none;">
               <div class="form-group row">
                  <div class="col">
                     <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email" placeholder="Email">
                     
                     <span class="invalid-feedback" role="alert">
                     <strong></strong>
                     </span>
                    
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col">
                     <input id="password" type="password" class="form-control " name="password" required autocomplete="new-password" placeholder="Password">
                     
                     <span class="invalid-feedback" role="alert">
                     <strong></strong>
                     </span>
                     
                  </div>
               </div>
               <div class="form-group row">
                  <div class="col">
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                     
                     <span class="invalid-feedback" role="alert">
                     <strong></strong>
                     </span>
                     
                  </div>
               </div>
               <div class="row inline-group">
                <div class="col">
                  <button style="width: 40%;" id="back" @click="toggleMenu('back')" type="button" class="btn btn-warning">Back</button>
                  </div>
                  <div class="col">
                     <button style="width: 40%;" type="submit" class="btn btn-success right">
                     Sign Up
                     </button>   
                     </div>               
                 </div>
               </div>
            
      </form>
      </div>
      <div class="row" style="margin: auto;">
         <p style="margin: auto;">Already Have an account! <a class="login-link" href="/login">Log In</a> here</p> 
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
        },
    methods: {
        toggleMenu(e) {
            var d = document.getElementById(e);
            var stStep = document.getElementById("st-step");
            var ndStep = document.getElementById("nd-step");
            if(e === "next"){
                ndStep.style.display='block';
                stStep.style.display='none';
            } else if(e === "back") {
                ndStep.style.display='none';
                stStep.style.display='block';
            }
        }
    },
}
</script>