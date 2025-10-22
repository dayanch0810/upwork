<nav class="navbar navbar-expand-sm navbar-dark bg-black shadow-sm px-4" aria-label="Navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('v1.auth.dashboard') }}">
            <div class="fw-bold fs-4">Upwork</div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar">
            @auth
                <ul class="navbar-nav me-auto">

                    {{--SECURITY--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Security
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.ipAddress.index') }}">
                                    Ip Address
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.userAgents.index') }}">
                                    User Agents
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.authAttempts.index') }}">
                                    Auth Attempts
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.visitors.index') }}">
                                    Visitors
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.verifications.index') }}">
                                    Verifications
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--USERS--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Users
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.admins.index') }}">
                                    Admins
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.clients.index') }}">
                                    Clients
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.freelancers.index') }}">
                                    Freelancers
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.profiles.index') }}">
                                    Profiles
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--WORKS--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Works
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.works.index') }}">
                                    Works
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.proposals.index') }}">
                                    Proposals
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--CATALOGS--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            Catalogs
                        </a>

                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.skills.index') }}">
                                    Skills
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.locations.index') }}">
                                    Locations
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('v1.auth.reviews.index') }}">
                                    Reviews
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-decoration-none link-primary" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout').submit();">
                            <i class="bi-box-arrow-right"></i>
                            Logout {{ auth()->user()->username }}
                        </a>
                    </li>
                </ul>

                <form method="POST" action="{{ route('v1.admin.logout') }}" id="logout" class="d-none">
                    @csrf
                </form>
        </div>
        @endauth
    </div>
</nav>
