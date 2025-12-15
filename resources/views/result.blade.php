<h3>Original Text:</h3>
<p>{{ $original_text }}</p>

<form action="/simplify" method="POST">
    @csrf
    <input type="hidden" name="text" value="{{ $original_text }}">
    <button type="submit">Simplify Text</button>
</form>

@if(isset($simplified_text))
    <h3>Simplified Text:</h3>
    <p>{{ $simplified_text }}</p>
@endif
