<?php if ($sf_user->getCulture() == 'en') : ?>

<h3>[video <em>url</em> <em>float</em>]</h3>
<p>Display a thumbail for a video.</p>
<table class="table table-condensed table-bordered">
<tr><th colspan="2">Parameters</th></tr>
<tr><td>url</td><td>The url to the video. Currently supported: Youtube, Vimeo</td></tr>
<tr><td>float</td><td>A custom value for the <code>float</code> property. Default: <code>right</code></td></tr>
<tr><th colspan="2">Example</th></tr>
<tr><td colspan="2"><code>[video http://www.youtube.com/watch?v=wqvgttQVt4s]</code></td></tr>
</table>

<?php elseif ($sf_user->getCulture() == 'de') : ?>

<h3>[video <em>url</em> <em>float</em>]</h3>
<p>Zeige das Thmbnail zu einem Video.</p>
<table class="table table-condensed table-bordered">
<tr><th colspan="2">Parameter</th></tr>
<tr><td>url</td><td>Die Video-URL. Aktuell unterstützt: Youtube, Vimeo</td></tr>
<tr><td>float</td><td>Ein eigener Wert für die <code>float</code> Eigenschaft. Standard: <code>right</code></td></tr>
<tr><th colspan="2">Beispiel</th></tr>
<tr><td colspan="2"><code>[video http://www.youtube.com/watch?v=wqvgttQVt4s]</code></td></tr>
</table>

<?php endif; ?>