<x-app-layout>

<div class="p-6">

    <h2 class="text-2xl font-bold mb-5">
        Edit Appointment
    </h2>

    <form action="{{ route('appointments.update', $appointment->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Patient Name</label>

            <input type="text"
                   name="patient_name"
                   value="{{ $appointment->patient_name }}"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Clinic Location</label>

            <input type="text"
                   name="clinic_location"
                   value="{{ $appointment->clinic_location }}"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Clinician</label>

            <select name="clinician_id"
                    class="w-full border rounded">

                @foreach($clinicians as $clinician)

                    <option value="{{ $clinician->id }}"
                        {{ $appointment->clinician_id == $clinician->id ? 'selected' : '' }}>

                        {{ $clinician->name }}

                    </option>

                @endforeach

            </select>

        </div>

        <div class="mb-3">

            <label>Appointment Date</label>

            <input type="datetime-local"
                   name="appointment_date"
                   value="{{ date('Y-m-d\TH:i', strtotime($appointment->appointment_date)) }}"
                   class="w-full border rounded">

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select name="status"
                    class="w-full border rounded">

                <option value="pending"
                    {{ $appointment->status == 'pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="confirmed"
                    {{ $appointment->status == 'confirmed' ? 'selected' : '' }}>
                    Confirmed
                </option>

                <option value="completed"
                    {{ $appointment->status == 'completed' ? 'selected' : '' }}>
                    Completed
                </option>

                <option value="cancelled"
                    {{ $appointment->status == 'cancelled' ? 'selected' : '' }}>
                    Cancelled
                </option>

            </select>

        </div>

        <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded">

            Update Appointment

        </button>

    </form>

</div>

</x-app-layout>