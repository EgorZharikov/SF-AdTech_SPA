<template>
    <div class="container text-center">
        <h4 class="mb-3 text-primary">User list:</h4>
        <div class="row align-items-center">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Mail</th>
                        <th scope="col">Name</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ban/Unban</th>
                    </tr>
                </thead>
                <!-- @foreach ($users as $user ) -->
                <tbody>
                    <tr>
                        <td>id</td>
                        <td>email</td>
                        <td>name</td>
                        <td>role_name</td>
                        <td>banned or active</td>
                        <td>
                            <form>
                                <button type="submit" name="unban"
                                    class="btn btn-outline-success btn-sm me-2">Unban</button>
                                <button type="submit" name="ban" class="btn btn-outline-danger btn-sm">Ban</button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                <!-- @endforeach -->
            </table>
        </div>
        <!-- {{ $users -> links() }} -->
    </div>

</template>