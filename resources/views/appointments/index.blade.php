<x-app-layout>

<div class="p-6">

    <div class="flex justify-between mb-5">

        <h2 class="text-2xl font-bold">
            Appointment List
        </h2>

        <a href="{{ route('appointments.create') }}"
           class="bg-blue-500 text-white px-4 py-2 rounded">

            Add Appointment

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-200 p-3 rounded mb-4">

            {{ session('success') }}

        </div>

    @endif

    <table class="w-full border">

        <thead class="bg-gray-100">

            <tr>

                <th class="border p-2">Patient</th>

                <th class="border p-2">Clinic</th>

                <th class="border p-2">Clinician</th>

                <th class="border p-2">Date</th>

                <th class="border p-2">Status</th>

                <th class="border p-2">Action</th>

            </tr>

        </thead>

        <tbody>

            @foreach($appointments as $appointment)

            <tr>

                <td class="border p-2">
                    {{ $appointment->patient_name }}
                </td>

                <td class="border p-2">
                    {{ $appointment->clinic_location }}
                </td>

                <td class="border p-2">
                    {{ $appointment->clinician->name ?? 'N/A' }}
                </td>

                <td class="border p-2">
                    {{ $appointment->appointment_date }}
                </td>

                <td class="border p-2">
                    {{ $appointment->status }}
                </td>

                <td class="border p-2">

                    <a href="{{ route('appointments.edit', $appointment->id) }}"
                       class="bg-yellow-400 px-3 py-1 rounded">

                        Edit

                    </a>

                    <form action="{{ route('appointments.destroy', $appointment->id) }}"
                          method="POST"
                          class="inline-block">

                        @csrf
                        @method('DELETE')

                        <button type="submit"
                                class="bg-red-500 text-white px-3 py-1 rounded">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

</div>

</x-app-layout>