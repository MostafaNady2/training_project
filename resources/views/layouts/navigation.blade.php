<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            Job Board
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
            </ul>

            <ul class="navbar-nav ms-auto">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            @if (auth()->user()->isAdmin())
                                <a class="dropdown-item" href="{{ route('admin.pending-jobs') }}">Admin Dashboard</a>
                                <a class="dropdown-item" href="{{ route('admin.all-jobs') }}">All Jobs</a>
                                <a class="dropdown-item" href="{{ route('admin.approved-jobs') }}">Approved Jobs</a>
                                <a class="dropdown-item" href="{{ route('admin.user-behavior') }}">User Behavior</a>
                            @elseif (auth()->user()->isEmployer())
                                <a class="dropdown-item" href="{{ route('jobs.create') }}">Post a Job</a>
                                <a class="dropdown-item" href="{{ route('jobs.my-jobs') }}">My Jobs</a>
                                <a class="dropdown-item" href="{{ route('applications.received') }}">Applications Received</a>
                            @elseif (auth()->user()->isCandidate())
                                <a class="dropdown-item" href="{{ route('jobs.index') }}">Search Jobs</a>
                                <a class="dropdown-item" href="{{ route('applications.my-applications') }}">My Applications</a>
                                <a class="dropdown-item" href="{{ route('applications.pending') }}">Pending Applications</a>
                                <a class="dropdown-item" href="{{ route('applications.approved') }}">Approved Applications</a>
                                <a class="dropdown-item" href="{{ route('applications.rejected') }}">Rejected Applications</a>
                                <a class="dropdown-item" href="{{ route('profile.history') }}">Application History</a>
                            @endif

                            <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>