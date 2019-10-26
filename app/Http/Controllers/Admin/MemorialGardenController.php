<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use Mpdf\Mpdf;
use App\Events\SendPlaqueToEngraver
use App\Rules\Postcode;
use App\Rules\Telephone;
use App\Models\Plaque;

class MemorialGardenController extends Controller
{
    public function index()
    {
        $orders = Plaque::with('order')->get();

        $data = [
            'orders' => $orders
        ];


        return View('admin.memorial-garden.index')->with($data);
    }

    public function edit($id)
    {
        $plaque = Plaque::with('order')
            ->where('id', $id)
            ->first();

        $data = [
            'plaque' => $plaque
        ];
        
        return View('admin.memorial-garden.edit')->with($data);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|string',
            'email' => 'required|email',
            'address1' => 'required',
            'town' => 'required',
            'county' => 'required',
            'postcode' => ['required', new Postcode],
            'telephone' => ['sometimes', 'nullable', new Telephone],
            'rank' => 'required|string',
            'name' => 'required',
            'dob' => 'required|string',
            'dod' => 'required',
            'regiment' => 'required|string',
            'location' => 'required|string',
            'message' => 'required|string',
            'confirm' => 'accepted'
        ]);

        $plaque = Plaque::where('id', $request->id)
            ->update([
                'contact' => $request->input('contact'),
                'telephone' => $request->input('telephone'),
                'email' => $request->input('email'),
                'address1' => $request->input('address1'),
                'address2' => $request->input('address2'),
                'address3' => $request->input('address3'),
                'town' => $request->input('town'),
                'county' => $request->input('county'),
                'postcode' => $request->input('postcode'),
                'rank' => $request->input('rank'),
                'name' => $request->input('name'),
                'dob' => $request->input('dob'),
                'dod' => $request->input('dod'),
                'regiment' => $request->input('regiment'),
                'location' => $request->input('location'),
                'message' => $request->input('message'),
            ]);


        return response()->json($plaque, 200);
    }

    public function send(Request $request)
    {
        $plaque = Plaque::with('order')
            ->where('id', $request->input('id'))
            ->first();

        $defaultConfig = (new\Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];

        $stylesheet = file_get_contents(public_path('css/pdf.css'));

        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'en',
            'default_font_size' => 10,
            'fontDir' => array_merge($fontDirs, [
               public_path('fonts')
            ]),
            'fontdata' => $fontData + [
                'OpenSans' => [
                   'R' => 'open-sans.regular.ttf',
                   'B' => 'open-sans.bold.ttf'
                ],
                'MyriadProCondensed' => [
                    'R' => 'myriad-pro-condensed.ttf',  
                ]
            ],
            'default_font' => 'OpenSans'
        ]);

        $view = \View::make('pdf.engraver', [
            'data' => $plaque
        ]);

        $html = $view->render();

        $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

        // Output a PDF file directly to the browser
        $mpdf->Output(storage_path('app/engraver/' . $plaque->order->orderid . '.pdf'), \Mpdf\Output\Destination::FILE);

        event(new SendPlaqueToEngraver($plaque));
    }
}
