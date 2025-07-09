<nav class="pc-sidebar" style="background-color: purple">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="lucide lucide-bike h-8 w-8 text-white">
                    <circle cx="18.5" cy="17.5" r="3.5"></circle>
                    <circle cx="5.5" cy="17.5" r="3.5"></circle>
                    <circle cx="15" cy="5" r="1"></circle>
                    <path d="M12 17.5V14l-3-3 4-3 2 3h2"></path>
                </svg>
                <span class="text-xl font-bold text-white ps-1">BikeCare</span>
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-caption">
                    <label>Navigation</label>
                </li>

                @php
                    $role = auth()->user()->role;
                @endphp

                {{-- Admin --}}
                @if($role === 'admin')
                    <li class="pc-item">
                        <a href="{{ route('dashboard') }}" class="pc-link">
                            <span class="pc-micon"><i data-feather="home"></i></span>
                            <span class="pc-mtext">Dashboard</span>
                        </a>
                    </li>

                    <li class="pc-item">
                        <a href="{{ route('manageuser') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-users"></i></span>
                            <span class="pc-mtext">Manage User</span>
                        </a>
                    </li>
                @endif

                {{-- Bookings (admin & receptionist) --}}
                @if(in_array($role, ['admin', 'receptionist']))
                    <li class="pc-item">
                        <a href="{{ route('booking') }}" class="pc-link">
                            <span class="pc-micon"><i data-feather="calendar"></i></span>
                            <span class="pc-mtext">Bookings</span>
                        </a>
                    </li>
                @endif

                {{-- Inventory (admin & inventoryManager) --}}
                @if(in_array($role, ['admin', 'inventoryManager']))
                    <li class="pc-item">
                        <a href="{{ route('inventory') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-truck-moving"></i></span>
                            <span class="pc-mtext">Add Inventory</span>
                        </a>
                    </li>
                @endif

                {{-- Accountant --}}
                @if($role === 'accountant')
                    <li class="pc-item">
                        <a href="#" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-money-bills"></i></span>
                            <span class="pc-mtext">Accounting & Reports</span>
                        </a>
                    </li>
                @endif

                {{-- Receptionist --}}
                @if($role === 'receptionist')
                    <li class="pc-item">
                        <a href="{{ route('receptionist') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-money-bills"></i></span>
                            <span class="pc-mtext">Receptionist</span>
                        </a>
                    </li>
                @endif

                {{-- Technician --}}
                @if($role === 'technician')
                    <li class="pc-item">
                        <a href="{{ route('technician') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-tools"></i></span>
                            <span class="pc-mtext">Technician</span>
                        </a>
                    </li>
                @endif

                {{-- Service Manager --}}
                @if($role === 'serviceManager')
                    <li class="pc-item">
                        <a href="{{ route('servicemanager') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-user"></i></span>
                            <span class="pc-mtext">Service Manager</span>
                        </a>
                    </li>
                @endif

                {{-- Pickup Agent --}}
                @if($role === 'picupAgent')
                    <li class="pc-item">
                        <a href="{{ route('pickupagent') }}" class="pc-link">
                            <span class="pc-micon"><i class="fa-solid fa-truck"></i></span>
                            <span class="pc-mtext">Pickup & Delivery</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
