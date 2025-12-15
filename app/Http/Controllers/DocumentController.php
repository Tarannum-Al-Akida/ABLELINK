use OpenAI\Client; // Add this at the top of the file

class DocumentController extends Controller
{
    public function showUploadForm() {
        return view('upload');
    }

    public function processDocument(Request $request) {
        $request->validate([
            'document' => 'required|mimes:jpg,jpeg,png,pdf'
        ]);

        $file = $request->file('document');
        $path = $file->getPathName();

        // OCR processing
        $text = (new \thiagoalessio\TesseractOCR\TesseractOCR($path))->run();

        return view('result', ['original_text' => $text]);
    }

    // Add this new method for simplification
    public function simplifyText(Request $request) {
        $text = $request->input('text');

        $client = new Client([
            'api_key' => env('OPENAI_API_KEY')
        ]);

        $response = $client->responses()->create([
            'model' => 'gpt-4.1-mini',
            'input' => "Simplify this text for easy understanding:\n\n$text"
        ]);

        $simplified = $response->output_text;

        return view('result', [
            'original_text' => $text,
            'simplified_text' => $simplified
        ]);
    }
}
