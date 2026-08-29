{{--
    Holds the bar's height while the node is asked what state the server is in.
    A floating button holds nothing: it is out of the page's flow, so keeping a
    row open for it would leave a gap that never fills.
--}}
<div class="ld-controls @if ($floating ?? false) ld-controls--floating @else ld-controls--loading @endif" aria-hidden="true"></div>
