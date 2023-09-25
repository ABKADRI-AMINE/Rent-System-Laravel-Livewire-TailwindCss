<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                        </div>
                                        @if(session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if(session('ban'))
                                            <div class="alert alert-danger">
                                                {{ session('ban') }}
                                            </div>
                                        @endif
                                        <form id="myLogin" method="post" action="{{ route('login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                @error('email')
                                                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input required="" type="password" name="password" placeholder="Password" requierd autocomplete="current-password">
                                                @error('password')
                                                <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="exampleCheckbox1" value="">
                                                        <label class="form-check-label" for="exampleCheckbox1"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                            
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">


<button type="button" class="btn btn-fill-out btn-block hover-up" name="login" onclick="showSweetAlert()" style="color: #FFA500; transition: color 0.3s;">Log in</button>

<a class="text-muted" href="{{ route('register') }}" style="display: inline-block; color: #FFA500; padding: 10px 20px; margin-top: 10px; float: right; transition: color 0.3s;" onmouseover="this.style.color='#fff'; this.style.background='#FFA500';" onmouseout="this.style.color='#FFA500'; this.style.background='none';">Sign up</a>


                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <img src="assets/imgs/login.png">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        function showSweetAlert() {
            event.preventDefault(); // prevent
            // Get form data
            const form = document.getElementById('myLogin');
            const email = form.email.value;
            const password = form.password.value;

            // Validate form data
            if (email === '' || password === '') {
                Swal.fire({
                    title: 'Error!',
                    text: 'Please enter your email and password',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                return false;
            }

            // Show SweetAlert
            Swal.fire({
                title: 'Login',
                text: 'Do you want to log in with the entered credentials?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Log in',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form
                    form.submit();
                }
            });
        }
    </script>

</x-app-layout>
