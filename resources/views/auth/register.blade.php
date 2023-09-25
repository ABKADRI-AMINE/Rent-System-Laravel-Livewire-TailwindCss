<x-app-layout>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Register
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
                                        <form id="myRegister" method="post" action="{{route('register')}}" enctype="multipart/form-data">

                                        @csrf
                                            <div class="form-group">
                                            <label for="name">Last Name</label>
                                                <input type="text" required="" name="name" placeholder="Name" :value="old('name')" required autofocus autocomplete="name">
                                                @error("name")
                                                    <p class="text-red-500 text-xs mb-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="prenom">First Name</label>
                                                <input type="text"  name="prenom" placeholder="Prenom" :value="old('prenom')"  autofocus autocomplete="prenom">
                                                @error("prenom")
                                                    <p class="text-red-500 text-xs mb-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="flex flex-col mb-2">
                                                <label class="font-medium text-sm text-gray-700 mb-1">Profile pictures</label>
                                                <div class="relative focus-within:text-gray-600 text-gray-400">
                                                    <input type="file" name="image" multiple class="pr-4 pl-4 py-2 border focus:ring-gray-500 focus:border-gray-900 w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600">

                                                    @error('images')
                                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                                                @error('email')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="telephone">Phone Number</label>
                                                <input type="tel" id="telephone" name="telephone" placeholder="Telephone" value="{{ old('telephone') }}" autofocus autocomplete="telephone" pattern="[0-9]{10,15}">
                                                @error('telephone')
                                                    <p class="text-red-500 text-xs mb-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="password">Password</label>
                                                <input required="" type="password" name="password" placeholder="Password" required autocomplete="new-password">
                                                @error("password")
                                                    <p class="text-red-500 text-xs mb-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                            <label for="password">Confirm Password</label>
                                                <input required="" type="password" name="password_confirmation" placeholder="Confirm password" required autocomplete="new-password">
                                                @error("password_confirmation")
                                                    <p class="text-red-500 text-xs mb-1">{{$message}}</p>
                                                @enderror
                                            </div>
                                            <div class="login_footer form-group">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox12" value="">
                                                        <label class="form-check-label" for="exampleCheckbox12"><span>I agree to terms &amp; Policy.</span></label>
                                                    </div>
                                                </div>
                                                <a href="{{route('privacy')}}"><i class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="button" class="btn btn-fill-out btn-block hover-up" name="login" onclick="showSweetAlert()" style="color: #FFA500; transition: color 0.3s;">Submit &amp; Register</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">Already have an account? <a href="{{route('login')}}">Sign in now</a></div>
                                    </div>
                                </div>
                            </div>
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
            const form = document.getElementById('myRegister');
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
                text: 'Do you want to Register in with the entered credentials?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sign in',
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
