<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager Sidebar</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .sidebar-item {
            transition: all 0.3s, transform 0.3s;
            display: block;
            padding: 10px;
        }
        .sidebar-item:hover {
            background-color: #e0f2fe;
            color: #075985;
        }
        .logo-box {
            background-color: #0ea5e9;
            padding: 10px;
            display: inline-block;
            transition: transform 0.3s ease;
        }
        .logo-box:hover {
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="flex">
        <div class="fixed w-64 bg-white h-screen p-5 text-gray-600 rounded-xl md:w-1/4 lg:w-1/5 xl:w-1/6">
            <div class="flex items-center mb-20">
                <a href="https://www.mfeteknoloji.com/" class="flex items-center" target="_blank">
                    <div class="logo-box rounded-full">
                        <img src="{{ asset('images/logo1.png') }}" alt="logo" class="w-14" />
                    </div>
                </a>
                <a href="{{ url('admin') }}" class="ml-2">
                    <span class="font-quicksand text-2xl">TaskManager</span>
                </a>
            </div>

            <ul class="space-y-4"> <!-- Increased space between items -->
                <li>
                    <a href="{{ route('admin') }}" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fas fa-th-large mr-3"></i> 
                         Admin Paneli
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users.show') }}" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fa-regular fa-id-card mr-3"></i> 
                        Kullanıcılar
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.workSessions') }}" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fa-regular fa-clock mr-3"></i> 
                        Mesai Takip
                    </a>
                </li>
                <li>
                    <a href="{{ route('projects.index') }}" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fa-regular fa-file-code mr-4"></i> 
                        Projeler
                    </a>
                </li>
                <li>
                    <a href="#" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fa-regular fa-copy mr-3"></i> 
                        Raporlar
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.offdays.index') }}" class="sidebar-item flex items-center text-lg text-gray-600">
                        <i class="fa-regular fa-pen-to-square mr-3"></i> 
                        İzin Takip
                    </a>
                </li>
            </ul>

            <div class="flex flex-col justify-center mt-40 gap-1 border-t border-gray-500 pt-2">
                <a href="{{ route('profile') }}" class="text-gray-600 hover:text-sky-700 transition-colors duration-200 flex items-center gap-2 pl-2">
                    <i class="fas fa-cog text-md mr-1"></i> 
                    <span class="text-md">Ayarlar</span>
                </a>

                <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-4 pl-2">
                    @csrf
                    <button type="submit" class="text-gray-600 hover:text-sky-700 transition-colors duration-200 flex items-center gap-2">
                        <i class="fas fa-sign-out-alt text-md mb-1 mr-1"></i> 
                        <span class="text-md mb-1">Çıkış Yap</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
