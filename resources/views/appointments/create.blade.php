<x-app-layout>
<div class="max-w-4xl mx-auto p-6">
    <!-- CARD -->
    <div class="bg-white   rounded-lg p-6">
        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Create Appointment
            </h2>
            <a href="{{ route('appointments.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                Back
            </a>
        </div>
        <!-- VALIDATION ERRORS -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-5">
                <ul class="list-disc ml-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!-- FORM -->
        <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <!-- PATIENT NAME -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Patient Name *
                    </label>
                    <input type="text" name="patient_name" value="{{ old('patient_name') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" placeholder="Enter Patient Name">
                </div>
                <!-- CLINIC LOCATION -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Clinic Location *
                    </label>
                    <input type="text" name="clinic_location" value="{{ old('clinic_location') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200" placeholder="Enter Clinic Location">
                </div>
                <!-- CLINICIAN -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Clinician *
                    </label>
                    <select name="clinician_id" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                        <option value=""> Select Clinician </option>
                        @foreach($clinicians as $clinician)
                            <option value="{{ $clinician->id }}"
                                {{ old('clinician_id') == $clinician->id ? 'selected' : '' }}>
                                {{ $clinician->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- APPOINTMENT DATE -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Appointment Date *
                    </label>
                    <input type="datetime-local" name="appointment_date" value="{{ old('appointment_date') }}" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                </div>
                <!-- STATUS -->
                <div>
                    <label class="block mb-2 font-semibold text-gray-700">
                        Status
                    </label>
                    <select name="status" class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-blue-200">
                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>
                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>
                    </select>
                </div>
            </div>
            <!-- BUTTON -->
            <div class="mt-6">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg shadow">
                    Save Appointment
                </button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>

<script>

$(document).ready(function () {
    $('#appointmentForm').validate({
        rules: {
            patient_name: {
                required: true,
                minlength: 3
            },
            clinic_location: {
                required: true
            },
            clinician_id: {
                required: true
            },
            appointment_date: {
                required: true
            },
            status: {
                required: true
            }
        },
        messages: {
            patient_name: {
                required: "Patient name is required",
                minlength: "Minimum 3 characters"
            },
            clinic_location: {
                required: "Clinic location is required"
            },
            clinician_id: {
                required: "Please select clinician"
            },
            appointment_date: {
                required: "Appointment date is required"
            },
            status: {
                required: "Please select status"
            }
        },
        errorElement: 'span',
        errorClass: 'text-red-500 text-sm',
    });
});
</script>