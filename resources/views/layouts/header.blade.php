<header style="background:#4a90e2; padding:10px 20px; display:flex; justify-content:space-between; align-items:center; color:white;">
    <div class="logo">
        <h2 style="margin:0; font-size:18px;">ABC Member System</h2>
    </div>

    <div class="user-menu">
        <span>{{ auth()->user()->name }}</span>

        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
            @csrf
            <button type="submit" style="
                background:none;
                border:none;
                color:red;
                cursor:pointer;
                margin-left:15px;
                font-size:14px;
            ">Logout</button>
        </form>
    </div>
</header>
