<x-app-layout>

<div class="p-6">

    <!-- DATATABLE CSS -->

    <link rel="stylesheet"
          href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- HEADER -->

    <div class="flex justify-between items-center mb-5">

        <h2 class="text-2xl font-bold">

            Activity Logs

        </h2>

    </div>

    <!-- TABLE -->

    <div class="bg-white shadow rounded-lg">

        <table id="activity-log-table"
               class="min-w-full border border-gray-200">

            <thead class="bg-gray-100">

                <tr>

                    <th>ID</th>

                    <th>User</th>

                    <th>Module</th>

                    <th>Action</th>

                    <th>Date</th>

                </tr>

            </thead>

        </table>

    </div>

</div>

<!-- JQUERY -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DATATABLE -->

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function () {

    $('#activity-log-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('activity-logs.index') }}",

        columns: [

            {
                data: 'id',
                name: 'id'
            },

            {
                data: 'user_name',
                name: 'user.name'
            },

            {
                data: 'module',
                name: 'module'
            },

            {
                data: 'action',
                name: 'action'
            },

            {
                data: 'created_at',
                name: 'created_at'
            }

        ]

    });

});

</script>

</x-app-layout>