<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin_assets/images/favicon.png')}}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>{{ Config::get('constants.site_name')}} - Login!</title>
</head>

<body>

    <section>
        <div class="container">
            <div class="row justify-content-center my-5">
                <div class="col-md-5 my-5">
                    <div class="card border border-primary">
                        <div class="card-body">
                            <h2 class="text-center mb-5">{{ Config::get('constants.site_name')}} Admin Panel</h2>
                            <form method="post" action="{{ route('admin.auth') }}">
                               @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control" >
                                </div>
                                <div class="mb-3">
                                    <label  class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                                <button button type="submit" class="btn btn-primary">Submit</button>
                                @if (session('error'))
                                    <p class="text-danger">
                                        {{ session('error') }}
                                    </p>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <footer class="footer text-center mt-5">
                All Rights Reserved by Flexy Admin. Designed and Developed by <a
                    href="https://www.wrappixel.com">WrapPixel</a>.
            </footer>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>
