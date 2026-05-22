<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-5">
        Create Appointment
    </h2>

    <form action="{{ route('appointments.store') }}"
          method="POST">

        @csrf

        <div class="mb-3">

            <label>Patient Name</label>

            <input type="text"
                   name="patient_name"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Clinic Location</label>

            <input type="text"
                   name="clinic_location"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Clinician</label>

            <select name="clinician_id"
                    class="w-full border rounded">

                @foreach($clinicians as $clinician)

                    <option value="{{ $clinician->id }}">
                        {{ $clinician->name }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Appointment Date</label>

            <input type="datetime-local"
                   name="appointment_date"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select name="status"
                    class="w-full border rounded">

                <option value="pending">Pending</option>
                <option value="confirmed">Confirmed</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>

            </select>

        </div>

        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded">

            Save Appointment

        </button>

    </form>

</div>

</x-app-layout>