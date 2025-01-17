@extends('layout.app')

@section('content')
<style>
    .main-content {
        min-height: 100vh;
        margin-left: 16rem;
        padding: 20px;
        box-sizing: border-box;
    }

    .dropdown-content {
        display: none;
    }

    .dropdown-content.show {
        display: block;
    }

    .table-container {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 0.5rem; /* Tabloyu oval yap */
        overflow: hidden;
        background-color: #f8f9fa; /* Açık gri arka plan rengi */
    }

    .table-container th,
    .table-container td {
        padding: 0.75rem;
        text-align: left;
        white-space: nowrap; /* Metin kaymasını önler */
    }

    .table-container th {
        background-color: #e9ecef; /* Biraz daha koyu açık gri arka plan rengi */
        font-weight: 600;
    }

    .table-container td {
        border-bottom: 1px solid #dee2e6;
    }

    .table-container tr {
        background-color: #ffffff;
        transition: background-color 0.2s;
    }

    .table-container tr:hover {
        background-color: #f1f3f5;
    }

    .table-container tr:first-child th:first-child,
    .table-container tr:first-child td:first-child {
        border-top-left-radius: 0.75rem; /* Üst sol köşeyi oval yap */
    }

    .table-container tr:first-child th:last-child,
    .table-container tr:first-child td:last-child {
        border-top-right-radius: 0.75rem; /* Üst sağ köşeyi oval yap */
    }

    .table-container tr:last-child th:first-child,
    .table-container tr:last-child td:first-child {
        border-bottom-left-radius: 0.75rem; /* Alt sol köşeyi oval yap */
    }

    .table-container tr:last-child th:last-child,
    .table-container tr:last-child td:last-child {
        border-bottom-right-radius: 0.75rem; /* Alt sağ köşeyi oval yap */
    }

    .icon-container {
        display: flex;
        align-items: center;
        background-color: #ffffff; /* Beyaz arka plan rengi */
        padding: 0.5rem;
        border-radius: 0.50rem; /* Köşeleri yuvarlama */
    }

    .icon-container img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .dropdown {
        position: relative;
    }

    .dropdown-toggle {
        background: none;
        border: none;
        cursor: pointer;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: 100%;
        z-index: 10;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 0.25rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .dropdown-content a,
    .dropdown-content form {
        display: block;
        padding: 0.5rem 1rem;
        text-decoration: none;
        color: #212529;
    }

    .dropdown-content a:hover,
    .dropdown-content form:hover {
        background-color: #f8f9fa;
    }

    .text-muted {
        color: #6c757d !important;
    }

    .text-sky-500 {
        color: #0ea5e9 !important;
    }
</style>

<div class="main-content w-5/6 mx-auto p-4">
    <div class="flex justify-between items-center mb-5">
        <h2 class="text-3xl text-gray-600">
            <i class="fas fa-users text-sky-500"></i> Tüm Kullanıcılar
        </h2>
    </div>

    <div class="flex justify-between items-center mb-5">
        <form action="{{ route('admin.users.search1') }}" method="GET" class="flex items-center w-full">
            <input type="text" name="search" value="{{ request()->query('search') }}"
                class="border rounded-lg px-4 py-2 w-80" placeholder="Kullanıcı adı ile ara...">
            <button type="submit"
                class="ml-2 bg-sky-500 text-white px-4 py-2 rounded-lg hover:bg-sky-500 transition duration-300">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>

        <a href="{{ route('admin.users.create') }}"
            class="ml-4 bg-sky-500 text-white px-4 py-1 rounded-full hover:bg-blue-500 transform hover:scale-100 transition duration-200">
            <button class="text-md font-semibold"><i class="fa-solid fa-circle-plus"></i> Kullanıcı Ekle</button>
        </a>
    </div>

    @if ($users->isEmpty())
        <p class="text-gray-500">Hiç kullanıcı bulunamadı. <a href="{{ route('admin.users.index') }}" class="text-blue-500 underline">Listeye geri dön</a></p>
    @endif
        <div class="overflow-x-auto">
            <table class="table-container">
                <thead>
                    <tr>
                        <th>Profil Resmi</th>
                        <th>İsim-Soyisim</th>
                        <th>Kullanıcı Adı</th>
                        <th>Görevi</th>
                        <th>Telefon</th>
                        <th>LinkedIn</th>
                        <th>Portfolio</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $badgeColors = ['bg-orange-100 text-gray-600', 'bg-purple-100 text-gray-600', 'bg-sky-100 text-gray-600'];
                    @endphp
                    @foreach ($users as $index => $user)
                        @php
                            $badgeColor = $badgeColors[$index % count($badgeColors)];
                        @endphp
                        <tr>
                            <td class="icon-container">
                                <img src="{{ asset('storage/profile_pics/' . $user->profilePic) }}" alt="{{ $user->name }}">
                            </td>
                            <td>
                                {{ $user->name }}
                                <p class="text-muted">{{ $user->email }}</p>
                            </td>
                            <td>{{ $user->username }}</td>
                            <td><span class="inline-block rounded-full px-2 py-1 text-sm font-semibold {{ $badgeColor }}">{{ $user->gorev }}</span></td>
                            <td>{{ $user->phoneNumber }}</td>
                            <td><a href="{{ $user->linkedinAddress }}" class="text-sky-500 hover:text-blue-500"><i class="fab fa-linkedin"></i></a></td>
                            <td><a href="{{ $user->portfolioLink }}" class="text-sky-500 hover:text-blue-500"><i class="fas fa-link"></i></a></td>
                            <td class="relative">
                                <div class="dropdown">
                                    <button class="dropdown-toggle">
                                        <i class="fa-solid fa-ellipsis-vertical"></i>
                                    </button>
                                    <div class="dropdown-content">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="block px-4 py-2 text-blue-600 hover:bg-blue-100">Düzenle</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Bu kullanıcıyı silmek istediğinize emin misiniz?');" class="block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-100">Sil</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.dropdown-toggle').forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();
                const dropdownContent = this.nextElementSibling;
                document.querySelectorAll('.dropdown-content').forEach(content => {
                    if (content !== dropdownContent) {
                        content.classList.remove('show');
                    }
                });
                dropdownContent.classList.toggle('show');
            });
        });

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown-content').forEach(dropdownContent => {
                    dropdownContent.classList.remove('show');
                });
            }
        });
    });
</script>
@endsection
