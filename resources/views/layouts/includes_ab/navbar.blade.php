<nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>

            <li class="nav-item">
                
                {{ html()->form('POST', route('ab.store.select'))->acceptsFiles()->open() }}
                <div class="input-group-sm1">
                    <select name="store" class="form-control" onchange="this.form.submit()">
                        <option value="">Select Store</option>
                        @foreach(getUserStores() as $value)
                            <option value="{{ $value->id }}" {{ $user->store_id==$value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>
                {{ html()->form()->close() }}
            </li>

        </ul>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="d-none d-md-inline">{{ $user->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="list-group">
                        <a href="{{ route('ab.store') }}"
                            class="list-group-item list-group-item-action">
                            Stores
                        </a>
                        <a href="{{ route('ab.profile') }}"
                            class="list-group-item list-group-item-action">
                            Profile
                        </a>
                        <a href="{{ route('ab.profile.password') }}"
                            class="list-group-item list-group-item-action">
                            Change Password
                        </a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                    </div>

                </ul>
            </li>
        </ul>
    </div>
</nav>
