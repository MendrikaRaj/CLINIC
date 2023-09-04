<?php

namespace App\Http\Controllers;

use App\Models\Depense;
use App\Models\TotalActe;
use App\Models\TypeDepense;
use Dompdf\Dompdf;
use League\Csv\Reader;
use App\Models\V_Patient_Acte;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class PdfController extends Controller
{
    public function exportToPDF(Request $request)
    {
        $id = $request->input('id');
        $data = V_Patient_Acte::where('id', '=', $id)->get();
        $total = TotalActe::where('id', '=', $id)->first();

        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('pdf.facture', compact('data', 'total'))->render()); // Load the HTML content

        $pdf->setPaper('A4'); // Set the paper size if needed
        $pdf->render(); // Render the PDF

        return $pdf->stream('facture.pdf'); // Output the PDF for download
    }
    public function import_csv(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt'
        ]);
        $file = $request->file('file');
        $handle = fopen($file->path(), 'r');

        $contents = file_get_contents($file->path());

        $rows = explode(PHP_EOL, $contents);
        $data = [];
        foreach ($rows as $row) {
            //$data[] = str_getcsv($row,',');
        }
        while (($row = fgetcsv($handle, 0, ';')) !== false) {
            # code...
            $data[] = $row;
        }
        fclose($handle);
        for ($i = 0; $i < count($data); $i++) {

            $code = $data[$i][1];
            $typedepenseid = [];
            $typedepenseid = DB::select('select td.id from type_depenses td where td.code=\'' . $code . '\'');
            DB::table('depenses')->insert([
                'typedepenseid' => $typedepenseid[0]->id,
                'created_at' => $data[$i][0],
                'updated_at' => $data[$i][0],
                'montant' => $data[$i][2]
            ]);
        }
        return back()->with('success', 'Fichier csv importer avec succès');
    }
}
