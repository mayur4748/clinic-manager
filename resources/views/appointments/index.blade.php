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

        <!-- FILTERS -->
        <div class="grid grid-cols-3 gap-4 mb-5">
            <!-- STATUS -->
            <div>
                <select id="status" class="w-full border rounded p-2">
                    <option value=""> All Status </option>
                    <option value="pending">Pending</option>
                    <option value="confirmed">Confirmed</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <!-- CLINIC -->
            <div>
                <select id="clinic_location" class="w-full border rounded p-2">
                    <option value=""> All Clinics </option>
                    <option value="Ahmedabad"> Ahmedabad </option>
                    <option value="Surat"> Surat </option>
                    <option value="Vadodara"> Vadodara </option>
                </select>
            </div>
        </div>

        <!-- TABLE -->

        <table id="appointments-table" class="display w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th>ID</th>
                    <th>Patient</th>
                    <th>Clinic</th>
                    <th>Clinician</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</x-app-layout>

<script>
$(document).ready(function () {
    let table = $('#appointments-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('appointments.index') }}",
            data: function (d) {
                d.status = $('#status').val();
                d.clinic_location = $('#clinic_location').val();
            }
        },
        columns: [
            {
                data: 'id',
                name: 'id'
            },
            {
                data: 'patient_name',
                name: 'patient_name'
            },
            {
                data: 'clinic_location',
                name: 'clinic_location'
            },
            {
                data: 'clinician_name',
                name: 'clinician_name'
            },
            {
                data: 'appointment_date',
                name: 'appointment_date'
            },
            {
                data: 'status',
                name: 'status',
                orderable: false,
                searchable: false
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
    // FILTER EVENT
    $('#status, #clinic_location').change(function () {
        table.draw();
    });
});
</script>