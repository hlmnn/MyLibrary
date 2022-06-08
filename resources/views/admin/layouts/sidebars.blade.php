<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark" style="width: 280px; height: 100vh;">
    <a href="/dashboard" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <span class="fs-4">MyPerpus</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="/dashboard" class="nav-link text-white">
                <div class="row">
                    <div class="col-2">
                        <i class="fa-solid fa-house"></i>
                    </div>
                    <div class="col">
                        Dashboard
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="/dashboard/buku" class="nav-link text-white">
                <div class="row">
                    <div class="col-2">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="col">
                        Buku
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="/dashboard/member" class="nav-link text-white">
                <div class="row">
                    <div class="col-2">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="col">
                        Member
                    </div>
                </div>
            </a>
        </li>
        </li>
            <a href="/dashboard/pinjaman" class="nav-link text-white">
                <div class="row">
                    <div class="col-2">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <div class="col">
                        Peminjaman
                    </div>
                </div>
            </a>
        <li>
    </ul>
    <hr>
    @auth
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Halo, {{ auth()->user()->username }}!</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
            <li>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </li>
        </ul>
    </div>
    @endauth
</div>