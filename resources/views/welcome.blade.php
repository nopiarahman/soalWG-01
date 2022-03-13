<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
    <title>Newsfeed</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

</head>

<body>

    <div class="container">
        <header class="blog-header py-3">
            <div class="row flex-nowrap justify-content-between align-items-center">
                <div class="col-4 pt-1">
                    {{-- <a class="text-muted" href="#">Subscribe</a> --}}
                </div>
                <div class="col-4 text-center">
                    <a class="blog-header-logo text-dark" href="#">
                        <h2>News Feed</h2>
                    </a>
                </div>
                <div class="col-4 d-flex justify-content-end align-items-center">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                <a href="{{ url('/home') }}" type="button" class="btn btn-primary">Home</a>
                            @else
                                <a href="{{ route('login') }}" type="button" class="btn btn-primary">Login</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" type="button" class="btn btn-primary">Register</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <div class="row mb-2 justify-content-center">
            <div class="col-md-8 ">
                @forelse ($berita as $i)
                    <div
                        class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">{{ $i->kategori->nama }}</strong>
                            <h3 class="mb-0">{{ $i->judul }}</h3>
                            <div class="mb-1 text-muted">{{ $i->created_at }}</div>
                            <p class="card-text mb-auto">{{ $i->isi }}</p>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="{{ Storage::url($i->foto) }}" alt="" srcset="" width="300px">

                        </div>
                    </div>
                @empty
                    Belum ada kabar berita
                @endforelse
            </div>
        </div>
    </div>

    <footer class="text-center">
        <i class="fa fa-copyright" aria-hidden="true"></i>LSK TIK
    </footer>



</body>

</html>
