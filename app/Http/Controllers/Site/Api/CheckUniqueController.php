<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckUniqueRequest;
use App\Models\CheckSystem;
use App\Models\CheckUnique;
use App\Models\PromoCode;
use App\Models\Report;
use App\Models\UniqueText;
use App\Services\Report\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Jaybizzle\DocToText\Doc;
use Illuminate\Support\Str;
use \TextMedia\FileParser\Parser;
use Illuminate\Support\Facades\Storage;
use \TextMedia\FileParser\ParserException;
use \TextMedia\FileParser\Parser\Pdf;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class CheckUniqueController extends Controller
{
    public function show($id)
    {
        $check_unique = CheckUnique::with(['reports' => function ($query){

        }])->findOrFail($id);

        foreach ($check_unique->reports as $key => $report) {
            if($report->checkSystem -> price > 0) {
                $paid =false;
                if($report->need_payment === 0) {
                    $paid = true;
                }
                if($report->uniqueOrder()->exists()) {
                    if($report->uniqueOrder->status === 'paid') {
                        $paid = true;
                    }
                }
                if(!$paid) {
                    unset($check_unique->reports[$key]);
                }
            }
        }

        return $check_unique;
    }

    public function validateCheckUniqueModal(Request $request)
    {
        $request->validate([
            'text' => 'required',
            'symbols_count' => 'numeric|min:100',
            'length' => 'numeric|min:1'
        ],[
            'text.required'=> 'Загрузите файл или введите текст для проверки на уникальность',
            'symbols_count.min' => 'Длина текста не может быть меньше 100 символов',
            'length.min' => 'Выберите систему проверки уникальности'
        ]);
        return $request->all();
    }

    public function check(Request $request)
    {
        $words_count = count(preg_split('/\s+/', $request->get('text')));
        $symbols_count = strip_tags($request->get('text'));
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $sentenceCount = substr_count($request->get('text'),'.')
            + substr_count($request->get('text'),'!')
            + substr_count($request->get('text'),'?');
        $pages = (int) ($symbols_count/1750);
        if ($pages === 0) {
            $pages = 1;
        }
        $textParams = [
            'symbolsCount' => (int) $symbols_count,
            'wordsCount' => $words_count,
            'plainText' => $request->get('text'),
            'sentenceCount' => $sentenceCount,
            'size' => 0,
            'pages' => $pages ,
        ];
        return $textParams;
    }

    public function checkFile(Request $request)
    {
        $request->validate([
            'file' => ['required','file','mimes:doc,docx,txt', 'max:49152'],
            'gRecaptchaV3Response' => [new GoogleReCaptchaV3ValidationRule('contact_us')]

            ],[
            'file.required'=> 'Загрузите файл или введите текст для проверки на уникальность',
            'file.mimes' => 'Файл должен быть следующих типов: doc, docx или txt'
        ]);

        //application/vnd.openxmlformats-officedocument.wordprocessingml.document
        //application/msword
        $file = $request->file('file');
        $types = Parser::getAvailableTypes();
        //dd($types);
        $text = Parser::parse($file);
       // dd($text);
        $size = $file->getSize();
        $source = $file;
       // dd($source->getClientOriginalName());

        //dd($request->file('file')->getClientMimeType());
        //dd($request->file('file')->getClientMimeType());


       // echo mb_convert_encoding( $text, 'UTF-8', 'UTF-16LE' );;
       // $extracted_plaintext = mb_convert_encoding( $extracted_plaintext, 'UTF-8', 'UTF-16LE' );
        $symbols_count = strip_tags($text);
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $words_count = preg_split('/\s+/',$text);
        $words_count = sizeof($words_count);
        $pages = (int) ($symbols_count/1750);
        if ($pages === 0) {
            $pages = 1;
        }

        $unique_text = UniqueText::create(['text' => $text]);
        if($request->hasFile('file')) {
            $filename = $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs(
                'public/unique_texts/' . $unique_text->id, $filename
            );
            $unique_text->filename = $filename;
            $unique_text->save();
        }

        $textParams = [
            'symbolsCount' => $symbols_count,
            'wordsCount' => $words_count,
            'sentenceCount' => 0,
            'plainText' => $text,
            'text_id' => $unique_text->id,
            'size' => $size,
            'pages' => $pages,
        ];
        return $textParams;
    }



    public function makeReport(CheckUniqueRequest  $request)
    {

        $data = [];
        if($request->has('sum')) {
            $data['sum'] = $request->get('sum');
        }
        if($request->has('promocode') && $request->get('promocode') && $request->has('sum') && $request->get('sum')) {
            $promo_code = PromoCode::where('name', $request->get('promocode'))->firstOrFail();
            $promo_code -> max_count = $promo_code -> max_count-1;
            $promo_code -> save();
            if($promo_code->discount_type === 'rubles') {
                $data['sum'] = $data['sum'] - $promo_code->discount;
                if($data['sum'] < 0) {
                    $data['sum'] = 0;
                }
            } else {
                $data['sum'] = $data['sum'] - ($data['sum'] * ($promo_code->discount/100));
            }
        }
        if($request->has('id')) {
            $check_unique = CheckUnique::findOrFail($request->get('id'));
        } else {
            $check_unique = CheckUnique::create($request->except('file'));
            $slug = Str::random(40);
            $check_unique->slug = $slug;
        }
        if($request->has('text_id') && $request->get('text_id')) {

            if(UniqueText::where('id', $request->get('text_id'))->exists()) {
                $unique_text = UniqueText::findOrFail($request->get('text_id'));
                Storage::copy('public/unique_texts/' . $unique_text->id . '/' . $unique_text->filename,
                    'public/check_uniques/' . $check_unique->id. '/' . $unique_text->filename);
                $check_unique->filename = $unique_text->filename;
                $check_unique->plainText = $unique_text->text;
                $check_unique->save();
            }
        }

        $systems = json_decode($request->get('systems'), true);
        $check_unique_types = [
            'manual' => false,
            'auto' => false,
        ];
        $reports = [];

        foreach ($systems as $system) {
            $system = CheckSystem::find($system['id']);

           $report = Report::firstOrCreate([
               'check_unique_id' => $check_unique -> id,
               'system_id' => $system->id,
               'api_id' => $system -> api_id,
           ]);
            if($system->price > 0 && $data['sum'] > 0) {
                $report->need_payment = true;
                $report->save();
            }
            $reports[] = $report->id;

           if($system['manual'] === 1) {
               if(!$check_unique_types['manual']) {
                   $check_unique_types['manual'] = true;
               }
           } else {
               if(!$check_unique_types['auto']) {
                   $check_unique_types['auto'] = true;
               }
           }
        }
        if($check_unique_types['auto'] && !$check_unique_types['manual']) {
            $check_unique->type = 1;
        } else if(!$check_unique_types['auto'] && $check_unique_types['manual']) {
            $check_unique->type = 2;
        } else if($check_unique_types['auto'] && $check_unique_types['manual']) {
            $check_unique -> type = 3;
        }

        $check_unique->save();

        if($request->get('services')) {
            $services  = json_decode($request->get('services'), true);
            $services_ids = [];
            foreach ($services as $service) {
                $services_ids[] = $service['id'];
            }
            $check_unique->services()->attach($services_ids);
        }

        $url = route('report', $check_unique->slug);
        $data['url'] = $url;
        $data['check_unique_id'] = $check_unique->id;
        $data['reports'] = $reports;
        return $data;
    }
}
