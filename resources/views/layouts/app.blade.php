<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Poppins', sans-serif;
            background:#eef3f9;
            color:#1e293b;
        }

        .wrapper{
            display:flex;
            min-height:100vh;
        }

        /* SIDEBAR */

        .sidebar{
            width:270px;
            min-height:100vh;
            background:
                linear-gradient(
                    180deg,
                    #042159 0%,
                    #005792 55%,
                    #0077B6 100%
                );
            padding:25px 18px;
            position:fixed;
            left:0;
            top:0;
            overflow-y:auto;
            box-shadow:4px 0 20px rgba(0,0,0,0.08);
        }

        .logo{
            font-size:28px;
            font-weight:700;
            color:white;
            margin-bottom:40px;
            text-align:center;
            letter-spacing:1px;
        }

        .menu-title{
            color:rgba(255,255,255,0.55);
            font-size:12px;
            margin-bottom:15px;
            text-transform:uppercase;
            padding-left:12px;
            letter-spacing:1px;
        }

        .sidebar a{
            display:flex;
            align-items:center;
            gap:12px;
            color:white;
            text-decoration:none;
            padding:14px 16px;
            border-radius:14px;
            margin-bottom:10px;
            transition:0.3s ease;
            font-size:15px;
            font-weight:500;
        }

        .sidebar a:hover{
            background:rgba(255,255,255,0.12);
            transform:translateX(4px);
        }

        .sidebar a.active{
            background:linear-gradient(
                135deg,
                #F7931E,
                #ff8c00
            );
            box-shadow:0 10px 20px rgba(247,147,30,0.3);
        }

        /* CONTENT */

        .content{
            flex:1;
            margin-left:270px;
            padding:30px;
        }

        /* TOPBAR */

        .topbar{
            background:white;
            padding:18px 24px;
            border-radius:20px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:30px;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }

        .welcome h3{
            font-size:20px;
            margin-bottom:3px;
            color:#042159;
        }

        .welcome p{
            color:#64748b;
            font-size:14px;
        }

        .logout-btn{
            background:linear-gradient(
                135deg,
                #F7931E,
                #ff8c00
            );
            color:white;
            border:none;
            padding:12px 22px;
            border-radius:12px;
            cursor:pointer;
            font-weight:600;
            transition:0.3s ease;
            box-shadow:0 8px 20px rgba(247,147,30,0.25);
        }

        .logout-btn:hover{
            transform:translateY(-2px);
        }

        /* COMMON CARD */

        .card{
            background:white;
            border-radius:22px;
            padding:25px;
            box-shadow:0 4px 20px rgba(0,0,0,0.05);
        }

        @media(max-width:991px){

            .sidebar{
                width:90px;
                padding:20px 10px;
            }

            .sidebar .logo{
                font-size:18px;
            }

            .sidebar a{
                justify-content:center;
                font-size:12px;
                padding:12px;
            }

            .content{
                margin-left:90px;
            }

        }

        @media(max-width:768px){

            .content{
                padding:20px;
            }

            .topbar{
                flex-direction:column;
                gap:15px;
                align-items:flex-start;
            }

        }

    .logo{
        font-size:28px;
        font-weight:700;
        color:white;
        margin-bottom:40px;
        text-align:center;
        letter-spacing:1px;

        display:flex;
        align-items:center;
        justify-content:center;
        gap:10px;
    }

    .sidebar a i{
        width:20px;
        text-align:center;
        font-size:16px;
    }

    .sidebar a span{
        flex:1;
    }

    @media(max-width:991px){

        .sidebar a span{
            display:none;
        }

        .logo{
            font-size:18px;
        }

        .logo i{
            font-size:22px;
        }

    }

    </style>

    @stack('styles')

</head>
<body>

<div class="wrapper">

    <!-- SIDEBAR -->

    <div class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-boxes-stacked"></i>
            Inventory
        </div>

        <div class="menu-title">
            Main Menu
        </div>

        <a href="/dashboard"
        class="{{ request()->is('dashboard') ? 'active' : '' }}">

            <i class="fa-solid fa-chart-line"></i>
            <span>Dashboard</span>

        </a>

        <a href="/locations"
        class="{{ request()->is('locations*') ? 'active' : '' }}">

            <i class="fa-solid fa-building"></i>
            <span>Accounts</span>

        </a>

        <a href="/categories"
        class="{{ request()->is('categories*') ? 'active' : '' }}">

            <i class="fa-solid fa-layer-group"></i>
            <span>Categories</span>

        </a>

        <a href="/brands"
        class="{{ request()->is('brands*') ? 'active' : '' }}">

            <i class="fa-solid fa-tags"></i>
            <span>Brands</span>

        </a>

        <a href="/units"
        class="{{ request()->is('units*') ? 'active' : '' }}">

            <i class="fa-solid fa-ruler-combined"></i>
            <span>Units</span>

        </a>

        <a href="/suppliers"
        class="{{ request()->is('suppliers*') ? 'active' : '' }}">

            <i class="fa-solid fa-truck-field"></i>
            <span>Suppliers</span>

        </a>

        @if(
            auth()->user()->role == 'admin' ||
            auth()->user()->role == 'storekeeper'
        )

            <a href="/inventory"
            class="{{ request()->is('inventory*') ? 'active' : '' }}">

                <i class="fa-solid fa-warehouse"></i>
                <span>Inventory</span>

            </a>

            <a href="/stock-movements"
            class="{{ request()->is('stock-movements*') ? 'active' : '' }}">

                <i class="fa-solid fa-arrow-right-arrow-left"></i>
                <span>Stock Movements</span>

            </a>

            <a href="/assets">Assets</a>

        @endif

        @if(auth()->user()->role == 'admin')

            <a href="/users"
            class="{{ request()->is('users*') ? 'active' : '' }}">

                <i class="fa-solid fa-users"></i>
                <span>Users</span>

            </a>

        @endif

    </div>

    <!-- CONTENT -->

    <div class="content">

        <!-- TOPBAR -->

        <div class="topbar">

            <div class="welcome">

                <h3>
                    Welcome, {{ auth()->user()->name }}
                </h3>

                <p>
                    Manage your inventory efficiently
                </p>

            </div>

            <form method="POST" action="/logout">

                @csrf

                <button class="logout-btn">
                    Logout
                </button>

            </form>

        </div>

        @yield('content')

    </div>

</div>

@stack('scripts')

</body>
</html>