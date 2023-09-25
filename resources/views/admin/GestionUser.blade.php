<x-navbarAdmin>
</x-navbarAdmin>
<style>
    .ban-btn {
        margin-right: 5px;
    }
</style>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Users Table</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>
                                    id
                                </th>
                                <th>
                                    First name
                                </th>
                                <th>
                                    Email
                                </th>
                                <th>
                                    Status
                                </th>
                                <th class="text-right">
                                    Details
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td>
                                        {{ $user['id'] }}
                                    </td>
                                    <td>
                                        {{ $user['prenom'] }}
                                    </td>
                                    <td>
                                        {{ $user['email'] }}
                                    </td>
                                    <td>
                                        @if($user['isBan'] == 1)
                                        <span class="badge badge-danger">Banned</span>
                                        <form method="POST" action="{{ route('admin.unbanUser', $user->id) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-success ban-btn">Unban user</button>
                                        </form>
                                        @else
                                        <form method="POST" action="{{ route('admin.banUser', $user->id) }}"
                                            onsubmit="return showSweetAlert(event);">
                                            @csrf
                                            <button type="submit" class="btn btn-danger ban-btn">Ban user</button>
                                        </form>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <i class=""></i>
                                        <a href="{{route('admin.userdetails',$user->id)}}">
                                            <button type="submit" class="btn btn-success">view more</button>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showSweetAlert(event) {
        event.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, ban them!'
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>