<!DOCTYPE html>
<html lang="en" class="light">

<!-- head -->
<?= $this->include('layouts/auth/auth-head'); ?>
<!-- End head -->

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="<?= base_url() ?>source/dist-css/images/logo.svg">
                    <span class="text-white text-lg ml-3"> Monitoring SMPN 2 Sumber </span> 
                </a>
                <div class="my-auto">
                    <img alt="Midone - HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="<?= base_url() ?>source/dist-css/images/illustration.svg">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Welcome To Monitoring<br>SMPN 2 Sumber
                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Silahkan melakukan proses login terlebih dahulu.</div>
                </div>
            </div>
            <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign In
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 xl:hidden text-center">Welcome To Monitoring SMPN 2 Sumber. Silahkan melakukan Sign-In untuk mendapatkan akses masuk.</div>
                    <form action="<?= base_url('login') ?>" method="post">
                        <div class="intro-x mt-8 validate-form">
                            <?= $this->include('components/alert-login') ?>
                            <div class="input-form" for="validation-form-2">
                                <input id="validation-form-2" type="email" name="email" class="intro-x login__input form-control py-3 px-4 block" placeholder="Email" value="<?= old('email') ?>" required>
                            </div>
                            <div class="input-form" for="validation-form-3">
                                <input type="password" name="password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password" id="validation-form-3" minlength="6" required>
                            </div>
                        </div>
                        <!-- <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                            <div class="flex items-center mr-auto">
                                <input id="remember-me" type="checkbox" class="form-check-input border mr-2">
                                <label class="cursor-pointer select-none" for="remember-me">Ingatkan Saya</label>
                            </div>
                            <a href="">Lupa Password?</a> 
                        </div> -->
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Login</button>
                            <!-- <button class="btn btn-outline-secondary py-3 px-4 w-full xl:w-32 mt-3 xl:mt-0 align-top">Daftar Akun</button> -->
                        </form>
                    </div>
                    <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> Template By <a class="text-primary dark:text-slate-200" href="#">midone tailwind.</a> App By <a class="text-primary dark:text-slate-200" href="#">SMP Negeri 2 Sumber</a> </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Dark Mode Switcher-->
    <div data-url="<?= base_url('login-dark') ?>" class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
        <div class="mr-4 text-slate-600 dark:text-slate-200">Dark Mode</div>
        <div class="dark-mode-switcher__toggle border"></div>
    </div>
    <!-- END: Dark Mode Switcher-->

    <!-- Script -->
    <?= $this->include('layouts/auth/auth-script'); ?>
    <!-- End Script -->