<nav class="navbar navbar-expand-lg bg-success shadow-lg ">
    <div class="container ">
        <a class="navbar-brand text-white " href="{{ url('/') }}">
            <i class='fas fa-house-chimney-crack'></i>
        </a>
        {{-- search bar --}}
        <div class="searchbar-wrapper position-relative">
            <form id='search-form' action="" method="get">
                <input type="text" class="searchbar rounded-pill form-control" placeholder="search for a book">
                <button type="submit" class='position-absolute make-search bg-transparent p-2 top-0 end-0 outline-none border-0' ><i class="fas fa-magnifying-glass"></i></button>
                 <ul  hidden class="search-results position-absolute top-100 w-100 border border-dark-subtle bg-white">
                  
                 </ul>
            </form>
        </div>
        {{-- search bar --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @auth
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('books') }}">show books</a>
                    </li>
                  <li>
                    <x-addbookbtn></x-addbookbtn>
                  </li>
                  
                  <li >
                    <x-updatebookmodal ></x-updatebookmodal>
                  </li>


                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <input type='submit' value='Logout' class="nav-link" />
                        </form>
                    </li>
                @endauth
                @guest
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('register') }}">register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ url('login') }}">login</a>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
