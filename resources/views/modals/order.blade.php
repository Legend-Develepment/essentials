{{--
    One order, read rather than acted on.

    A definition list, because that is what this is: a label and the one thing
    it says. Which rows exist at all is decided in Shop\Orders::detail() - a row
    with nothing to say is left out rather than drawn empty, so the list is
    short on an ordinary order and long on the one somebody is asking about.

    The wide ones are the answers the customer typed and the note from a failed
    build: those run to a sentence or a URL, and a URL in a narrow column is a
    URL nobody can read.
--}}
<dl class="ld-detail">
    @foreach ($rows as $row)
        <div class="ld-detail-row {{ $row['wide'] ? 'ld-detail-row--wide' : '' }}">
            <dt>{{ $row['label'] }}</dt>
            <dd>{{ $row['value'] }}</dd>
        </div>
    @endforeach
</dl>
