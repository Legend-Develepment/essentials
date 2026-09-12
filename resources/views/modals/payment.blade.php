{{--
    What the payment provider last said about one attempt.

    A list of name and value rather than pretty-printed json, because the
    person opening this is looking for one word - a status, a mode, a method -
    and a wall of brackets is that word hidden.
--}}
<dl class="ld-answer">
    @foreach ($lines as $name => $value)
        <div>
            <dt>{{ $name }}</dt>
            <dd>{{ $value === '' ? '-' : $value }}</dd>
        </div>
    @endforeach
</dl>
