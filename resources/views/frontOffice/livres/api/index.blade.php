    <!-- page liste -->
    <table class="table">
        <thead>
            <tr>
                <td style="width:105px;">#</td>
                <td> Nom du livre </td>
                <td> Actions </td>
                <td> Auteur </td>
            </tr>
        </thead>
        <tbody>
            @foreach ($livres as $livre)

            {{--
                @foreach ($livre->pages as $key => $value)
                    {{ $value->title }}
                @endforeach
            --}}
            
            <tr>
                <td> {{ $livre->id }} </td>
                <td> {{ $livre->name }} </td>
                <td> {{ $livre->author }} </td>

                <td> <a href="{{ $livre->id }}" data-name="{{ $livre->name }}" data-author="{{ $livre->author }}" data-id="{{ $livre->id }}" data-description="{{ $livre->description }}" data-publication="{{ $livre->date_publication }}" class="btn btn-info edit">Edit</a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $livres->links() }}
    <!-- page liste-->