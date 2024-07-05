@extends('layout.app')

@section('content')
<div class="container mx-auto px-6 py-3">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Mesai Giriş/Çıkış</h2>
        @if($formattedTotalWorkDuration)
            <div class="text-right">
                <p class="text-lg font-semibold">Toplam Mesai Süresi:</p>
                <p class="text-lg text-gray-800">{{ $formattedTotalWorkDuration }}</p>
            </div>
        @endif
    </div>

    <div class="mb-6">
        <form action="{{ route('user.startWorkSession') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-3 text-gray-800 hover:bg-green-100 hover:text-green-800 transition-colors duration-200">
                <i class="fas fa-play-circle"></i> Mesai Başlat
            </button>
        </form>
        
        <form action="{{ route('user.startBreak') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-3 text-gray-800 hover:bg-yellow-100 hover:text-yellow-800 transition-colors duration-200">
                <i class="fas fa-pause-circle"></i> Mola Başlat
            </button>
        </form>

        <form action="{{ route('user.endBreak') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-3 text-gray-800 hover:bg-red-100 hover:text-red-800 transition-colors duration-200">
                <i class="fas fa-stop-circle"></i> Mola Bitir
            </button>
        </form>

        <form action="{{ route('user.endWorkSession') }}" method="POST" class="inline-block">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-3 text-gray-800 hover:bg-blue-100 hover:text-blue-800 transition-colors duration-200">
                <i class="fas fa-stop-circle"></i> Mesai Bitir
            </button>
        </form>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full bg-white">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Başlangıç Zamanı</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Bitiş Zamanı</th>
                    <th class="py-2 px-4 border-b border-gray-300 text-left">Durum</th>
                </tr>
            </thead>
            <tbody>
                @foreach($workSessions as $session)
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $session->start_time }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $session->end_time }}</td>
                        <td class="py-2 px-4 border-b border-gray-300">{{ $session->status }}</td>
                    </tr>
                    @foreach($session->breaks as $break)
                        <tr class="bg-gray-100">
                            <td class="py-1 px-4 border-b border-gray-300 pl-10">Mola Başlangıcı: {{ $break->start_time }}</td>
                            <td class="py-1 px-4 border-b border-gray-300">Mola Bitişi: {{ $break->end_time }}</td>
                            <td class="py-1 px-4 border-b border-gray-300"></td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection