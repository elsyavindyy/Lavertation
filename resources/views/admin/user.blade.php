<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Lavertation</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* --- GAYA SAMA PERSIS DASHBOARD --- */
        :root {
            --bg-body: #EAF0F6;       --bg-sidebar: #FFFFFF;    --text-dark: #1a1a2e;     
            --active-bg: #E6E6E6;     --table-head: #EAEAEA;    --row-odd: #F4F6F8;       
            --row-even: #E4E7EB;      --footer-blue: #3B6899;   --btn-green: #7BC67E;
        }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-body); overflow-x: hidden; }
        h1, h2, h3, .brand-font { font-family: 'Playfair Display', serif; color: var(--text-dark); }

        /* Sidebar */
        .sidebar { width: 260px; background: var(--bg-sidebar); height: 100vh; position: fixed; top: 0; left: 0; display: flex; flex-direction: column; border-right: 1px solid #ddd; z-index: 1000; }
        .sidebar-brand { font-size: 22px; font-weight: 700; padding: 30px 20px; color: var(--text-dark); font-family: 'Playfair Display', serif; }
        .nav-menu { display: flex; flex-direction: column; width: 100%; }
        .nav-link { color: #444; font-weight: 600; padding: 18px 30px; display: flex; align-items: center; transition: 0.2s; font-size: 15px; text-decoration: none; }
        .nav-link:hover { color: #000; background-color: #f8f9fa; }
        .nav-link.active { background-color: var(--active-bg); color: #000; font-weight: 700; }
        .nav-link i { margin-right: 15px; font-size: 1.3rem; }
        .sidebar-footer { margin-top: auto; padding-bottom: 40px; width: 100%; }
        .logout-btn { color: #444; font-weight: 600; padding-left: 30px; display: flex; align-items: center; background: none; border: none; width: 100%; text-align: left; cursor: pointer; }
        .logout-btn:hover { color: #dc3545; }

        /* Content */
        .main-content { margin-left: 260px; padding: 40px 50px; min-height: calc(100vh - 60px); }
        .page-title { font-size: 28px; font-weight: 700; margin-bottom: 30px; }
        
        /* Table */
        .table-responsive { border-radius: 0px; }
        .custom-table { width: 100%; border-collapse: separate; border-spacing: 0; }
        .custom-table thead tr th { background-color: var(--table-head); color: #666; font-weight: 700; padding: 20px; border: none; font-size: 15px; }
        .custom-table tbody tr:nth-child(odd) td { background-color: var(--row-odd); }
        .custom-table tbody tr:nth-child(even) td { background-color: var(--row-even); }
        .custom-table tbody td { padding: 20px; vertical-align: middle; color: #333; font-size: 14px; border: none; }
        
        /* Footer */
        .main-footer { background-color: var(--footer-blue); color: white; text-align: center; padding: 15px; font-size: 12px; position: fixed; bottom: 0; left: 260px; width: calc(100% - 260px); z-index: 900; }
        
        /* Pagination */
        .pagination .page-item .page-link { background: transparent; border: none; color: #333; font-weight: 600; margin: 0 5px; }
        .pagination .page-item.active .page-link { background-color: #dcdcdc; border-radius: 5px; color: #000; }
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
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <i class="bi bi-house-door"></i> Home
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-link active">
                <i class="bi bi-people"></i> User
            </a>

            <a href="{{ route('admin.dashboard', ['status' => 'approved']) }}" class="nav-link">
                <i class="bi bi-check-circle"></i> Approved
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'pending']) }}" class="nav-link">
                <i class="bi bi-clock-history"></i> Pending
            </a>
            <a href="{{ route('admin.dashboard', ['status' => 'rejected']) }}" class="nav-link">
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
        <h2 class="page-title brand-font">Daftar Pengguna (User)</h2>

        @if(session('success'))
            <div id="success-alert" class="alert alert-success border-0 shadow-sm mb-4">
                <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div id="error-alert" class="alert alert-danger border-0 shadow-sm mb-4">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Joined Date</th>
                        <th>Delete</th> </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><strong>{{ $user->username }}</strong></td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->is_admin)
                                <span style="color: var(--btn-green); font-weight: 700;">Admin</span>
                            @else
                                <span class="text-muted">User</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('d F Y') }}</td>
                        <td>
                            @if(!$user->is_admin)
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->username }}?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm text-danger fw-bold p-0 border-0 bg-transparent">
                                    <i class="bi bi-trash-fill" style="font-size: 1.2rem;"></i>
                                </button>
                            </form>
                            @else
                                <span class="text-muted" style="font-size: 12px;">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada user terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-4">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>

    </main>

    <footer class="main-footer">
        &copy; 2025 Lavertation. All Rights Reserved.<br>SMK Immanuel Pontianak
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            ['success-alert', 'error-alert'].forEach(function(id) {
                var alertBox = document.getElementById(id);
                if (alertBox) {
                    setTimeout(function() {
                        alertBox.style.transition = "opacity 0.5s ease";
                        alertBox.style.opacity = "0";
                        setTimeout(function() { alertBox.remove(); }, 500);
                    }, 3000); 
                }
            });
        });
    </script>

</body>
</html>