<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lavertation Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* --- COLOR PALETTE --- */
        :root {
            --bg-body: #EAF0F6;       
            --bg-sidebar: #FFFFFF;    
            --text-dark: #1a1a2e;     
            --active-bg: #E6E6E6;     
            --table-head: #EAEAEA;    
            --row-odd: #F4F6F8;       
            --row-even: #E4E7EB;      
            --btn-green: #7BC67E;     
            --footer-blue: #3B6899;   
            --status-pending: #F4B400;
            --status-success: #28a745;
            --status-danger: #dc3545;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-body);
            overflow-x: hidden;
        }

        /* --- TYPOGRAPHY --- */
        h1, h2, h3, .brand-font {
            font-family: 'Playfair Display', serif;
            color: var(--text-dark);
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;           
            flex-direction: column;  
            border-right: 1px solid #ddd;
            z-index: 1000;
        }

        .sidebar-brand {
            font-size: 22px;
            font-weight: 700;
            padding: 30px 20px;
            color: var(--text-dark);
            font-family: 'Playfair Display', serif;
        }

        .nav-menu {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .nav-link {
            color: #444;
            font-weight: 600;
            padding: 18px 30px;
            display: flex;
            align-items: center;
            transition: all 0.2s ease-in-out;
            font-size: 15px;
            text-decoration: none;
        }

        .nav-link i {
            margin-right: 15px;
            font-size: 1.3rem;
        }

        .nav-link:hover {
            color: #000;
            background-color: #f8f9fa;
        }

        .nav-link.active {
            background-color: var(--active-bg);
            color: #000;
            font-weight: 700;
        }

        /* Footer Sidebar */
        .sidebar-footer {
            margin-top: auto; 
            padding-bottom: 40px;
            width: 100%;
        }

        .logout-btn {
            color: #444;
            font-weight: 600;
            padding-left: 30px;
            display: flex;
            align-items: center;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .logout-btn:hover {
            color: #dc3545;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            padding: 40px 50px;
            min-height: calc(100vh - 60px);
        }

        .page-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        /* --- TOOLBAR --- */
        .toolbar-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .form-select-custom {
            border-radius: 10px;
            border: none;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            padding: 10px 20px;
            font-weight: 600;
            color: #444;
            width: 180px;
            cursor: pointer;
        }

        .btn-add {
            background-color: var(--btn-green);
            color: white;
            font-weight: 600;
            border: none;
            padding: 10px 35px;
            border-radius: 8px;
            transition: 0.3s;
            text-decoration: none;
        }
        .btn-add:hover {
            background-color: #68b06b;
            color: white;
        }

        /* --- TABLE --- */
        .table-responsive {
            border-radius: 0px;
        }

        .custom-table {
            width: 100%;
            border-collapse: separate; 
            border-spacing: 0;
        }

        .custom-table thead tr th {
            background-color: var(--table-head);
            color: #666;
            font-weight: 700;
            padding: 20px;
            border: none;
            font-size: 15px;
        }

        .custom-table tbody tr:nth-child(odd) td {
            background-color: var(--row-odd);
        }
        .custom-table tbody tr:nth-child(even) td {
            background-color: var(--row-even);
        }

        .custom-table tbody td {
            padding: 20px;
            vertical-align: middle;
            color: #333;
            font-size: 14px;
            border: none;
        }

        /* Status Colors */
        .text-pending { color: var(--status-pending) !important; font-weight: 600; }
        .text-completed { color: var(--status-success) !important; font-weight: 600; }
        .text-rejected { color: var(--status-danger) !important; font-weight: 600; }

        .action-icon {
            color: #333;
            font-size: 1.1rem;
            cursor: pointer;
        }

        /* --- FOOTER --- */
        .main-footer {
            background-color: var(--footer-blue);
            color: white;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            left: 260px;
            width: calc(100% - 260px);
            z-index: 900;
        }

        /* Pagination */
        .pagination .page-item .page-link {
            background-color: transparent;
            border: none;
            color: #333;
            font-weight: 600;
            margin: 0 5px;
        }
        .pagination .page-item.active .page-link {
            background-color: #dcdcdc;
            border-radius: 5px;
            color: #000;
        }
    </style>
</head>
<body>

    <nav class="sidebar">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-dark">
                Lavertation Admin
            </a>
        </div>

        <div class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') && !request()->has('status') ? 'active' : '' }}">
                <i class="bi bi-house-door"></i> Home
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <i class="bi bi-people"></i> User
            </a>

            <a href="{{ route('admin.dashboard', ['status' => 'approved']) }}" class="nav-link {{ request('status') == 'approved' ? 'active' : '' }}">
                <i class="bi bi-check-circle"></i> Approved
            </a>

            <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="nav-link {{ request('status') == 'pending' ? 'active' : '' }}">
                <i class="bi bi-clock-history"></i> Pending
            </a>

            <a href="{{ route('admin.dashboard', ['status' => 'rejected']) }}" class="nav-link {{ request('status') == 'rejected' ? 'active' : '' }}">
                <i class="bi bi-x-circle"></i> Rejected
            </a>
        </div>

        <div class="sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="bi bi-box-arrow-right me-3"></i> Log Out
                </button>
            </form>
        </div>
    </nav>

    <main class="main-content">
        
        <h2 class="page-title brand-font">Tabel Reservasi Lab</h2>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif


        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>User</th>
                        <th>Floor</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Approval</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td>
                            @if(isset($res->date))
                                {{ \Carbon\Carbon::parse($res->date)->format('d F Y') }}
                            @elseif(isset($res->start_time))
                                {{ \Carbon\Carbon::parse($res->start_time)->format('d F Y') }}
                            @endif
                            <div style="font-size: 0.85rem; color: #777; margin-top: 4px;">
                                @if(isset($res->time_start))
                                    {{ \Carbon\Carbon::parse($res->time_start)->format('H:i') }}
                                @elseif(isset($res->start_time))
                                    {{ \Carbon\Carbon::parse($res->start_time)->format('H:i') }}
                                @endif
                            </div>
                        </td>

                        <td>{{ $res->user->username ?? 'Unknown' }}</td>

                        <td>{{ $res->floor ?? '-' }}</td>

                        <td title="{{ $res->reason }}">
                            {{ \Illuminate\Support\Str::limit($res->reason ?? '-', 30) }}
                        </td>

                        <td>
                            @if($res->status == 'pending')
                                <span class="text-pending">Pending</span>
                            @elseif($res->status == 'approved' || $res->status == 'completed')
                                <span class="text-completed">Approved</span>
                            @elseif($res->status == 'rejected')
                                <span class="text-rejected">Rejected</span>
                            @else
                                {{ ucfirst($res->status) }}
                            @endif
                        </td>

                        <td>
                            @if($res->status == 'approved' || $res->status == 'completed')
                                Yes
                            @elseif($res->status == 'rejected')
                                No
                            @else
                                Pending
                            @endif
                        </td>

                        <td>
                            <div class="dropdown">
                                <i class="bi bi-pencil-fill action-icon" data-bs-toggle="dropdown"></i>
                                <ul class="dropdown-menu border-0 shadow">
                                    <li>
                                        <form action="{{ route('admin.reservations.updateStatus', $res->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="approved">
                                            <button class="dropdown-item text-success small fw-bold">
                                                <i class="bi bi-check-lg me-1"></i> Approve
                                            </button>
                                        </form>
                                    </li>
                                    
                                    <li>
                                        <form action="{{ route('admin.reservations.updateStatus', $res->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="status" value="rejected">
                                            <button class="dropdown-item text-warning small fw-bold">
                                                <i class="bi bi-x-lg me-1"></i> Reject
                                            </button>
                                        </form>
                                    </li>

                                    <li><hr class="dropdown-divider"></li>

                                    <li>
                                        <form action="{{ route('admin.reservations.destroy', $res->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger small fw-bold" onclick="return confirm('Hapus data ini?')">
                                                <i class="bi bi-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </li>

                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">Belum ada data reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $reservations->links('pagination::bootstrap-5') }}
        </div>

    </main>

    <footer class="main-footer">
        &copy; 2025 Lavertation. All Rights Reserved.<br>
        SMK Immanuel Pontianak
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var alertBox = document.getElementById('success-alert');
            if (alertBox) {
                setTimeout(function() {
                    alertBox.style.transition = "opacity 0.5s ease";
                    alertBox.style.opacity = "0";
                    setTimeout(function() {
                        alertBox.remove();
                    }, 500);
                }, 3000); 
            }
        });
    </script>

</body>
</html>