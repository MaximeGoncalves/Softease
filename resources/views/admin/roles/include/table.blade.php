<table class="table">
    <thead class="thead">
    <tr>
        <th scope="col">Nom</th>
        <th scope="col">Société</th>
        <th scope="col">Activé ?</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>
                {{$user->name}}
            </td>
            <td>
                {{$user->society->name}}
            </td>
            <td>
                <label class="switch switch-3d switch-success">
                    {!! Form::checkbox('Active', 1, $user->active, ['class' => 'switch-input','disabled']) !!}
                    <span class="switch-label"></span>
                    <span class="switch-handle"></span>
                </label>
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{route('user.edit', [ $user->id ] )}}"><i
                                class="fa fa-pencil"
                                style="color:grey; font-size: 20px;"></i></a>

                    {!! Form::open(['route' => ['user.destroy', $user->id], 'class' => 'mb-4', 'method' => 'delete']) !!}

                    <button type="submit"
                            style="border: none; background: transparent; cursor: pointer;"
                            class="d-inline">
                        <i class="fa fa-trash ml-2" style="color:red;font-size: 20px"></i>
                    </button>
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>