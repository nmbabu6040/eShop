 <div class="shadow p-4 sidebar">
     <ul class="gap-2">
         <li><a href="{{ route('user.dashboard') }}"
                 class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">Dashboard</a>
         </li>
         <li><a href="">Profile</a></li>
         <li><a href="{{ route('user.orders') }}"
                 class="{{ request()->routeIs('user.orders') ? 'active' : '' }}">Orders</a></li>
         <li><a href="{{ route('logout') }}">Logout</a></li>
     </ul>

 </div>

 <style>
     .sidebar ul li a {
         display: inline-block;
         font-size: 18px;
         color: #000;
         font-weight: 500;
         text-decoration: none;
         padding: 5px;
         transition: all linear .4s;
     }

     .sidebar ul li a:hover {
         color: #FAA40E;
     }

     .sidebar ul li a.active {
         color: #FAA40E;
     }
 </style>
