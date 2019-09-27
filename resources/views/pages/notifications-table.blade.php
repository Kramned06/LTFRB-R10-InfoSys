
<table class="table table-hover">
    <thead>
        <tr>
            <th>No.</th>
            <th>Case number</th>
            <th>Expiry date</th>
            <th>Plate number</th>
            <th>Make</th>
            <th>Date notified</th>
            <th>Plate image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1;?>
        @foreach ($data as $user)
            <tr>
                <td>{{$count++}}</td>
                <td>{{$user->case_number}}</td>
                <td>{{$user->expiry_date}}</td>
                <td>{{$user->plate_number}}</td>
                <td>{{$user->make}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <img src="storage/PlatePicture/{{$user->plate_picture}}" alt="" style="width:100px;height:30px;">
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#view_{{$user->id}}">Details</button>
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#view_delete{{$user->id}}">Delete</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        {!! $data->links(); !!}
    </ul>
</nav> --}}