<x-app-layout>
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">
        Dashboard
    </h1>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Total Products --}}
        <div class="bg-blue-500 text-white p-6 rounded shadow">
            <h2 class="text-xl font-bold">
                Total Products
            </h2>
            <p class="text-4xl mt-4">
                {{ $totalProducts }}
            </p>
        </div>
        {{-- Total Appointments --}}
        <div class="bg-green-500 text-white p-6 rounded shadow">
            <h2 class="text-xl font-bold">
                Total Appointments
            </h2>
            <p class="text-4xl mt-4">
                {{ $totalAppointments }}
            </p>
        </div>
        {{-- Upcoming Appointments --}}
        <div class="bg-yellow-500 text-white p-6 rounded shadow">
            <h2 class="text-xl font-bold">
                Upcoming (7 Days)
            </h2>
            <p class="text-4xl mt-4">
                {{ $upcomingAppointments }}
            </p>
        </div>
    </div>
</div>
</x-app-layout>