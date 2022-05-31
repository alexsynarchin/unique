<?php

namespace App\Http\Controllers\Site\Api;

use App\Http\Controllers\Controller;
use App\Models\CheckUnique;
use App\Models\PromoCode;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CheckUniqueController extends Controller
{
    public function show($id)
    {
        $check_unique = CheckUnique::with('reports')->findOrFail($id);
        return $check_unique;
    }

    public function check(Request $request)
    {
        $words_count = count(preg_split('/\s+/', $request->get('text')));
        $symbols_count = strip_tags($request->get('text'));
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $sentenceCount = substr_count($request->get('text'),'.') + substr_count($request->get('text'),'!')+ substr_count($request->get('text'),'?');
        $textParams = [
            'symbolsCount' => (int) $symbols_count,
            'wordsCount' => $words_count,
            'plainText' => $request->get('text'),
            'sentenceCount' => $sentenceCount,
            'size' => 0,
            'pages' => 0,
        ];
        return $textParams;
    }

    public function checkFile(Request $request)
    {
        //application/vnd.openxmlformats-officedocument.wordprocessingml.document
        //application/msword
        $file = $request->file('file');

        $size = $file->getSize();
        $source = $file;
        $text = '';
        if($request->file('file')->getClientMimeType() === 'application/msword') {
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($file,'MsDoc');
// read source

            $sections = $phpWord->getSections();
            foreach ($sections as $s) {
                $els = $s->getElements();
                foreach ($els as $e) {
                    if(!$e instanceof \PhpOffice\PhpWord\Element\Text){
                        continue;
                    }
                    $text .= $e->getText();

                }
            }
        }  elseif ($request->file('file')->getClientMimeType() === 'application/vnd.openxmlformats-officedocument.wordprocessingml.document') {
            $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');

            $phpWord = $objReader->load($source);
            $sections = $phpWord->getSections();

            foreach ($sections as $s) {
                $els = $s->getElements();
                foreach ($els as $e) {
                    if (!$e instanceof \PhpOffice\PhpWord\Element\Text) {
                        continue;
                    }
                    $text .= $e->getText();

                }
            }
        }



       // echo mb_convert_encoding( $text, 'UTF-8', 'UTF-16LE' );;
       // $extracted_plaintext = mb_convert_encoding( $extracted_plaintext, 'UTF-8', 'UTF-16LE' );
        $symbols_count = strip_tags($text);
        $symbols_count = preg_replace('/\s+/', '',  $symbols_count);
        $symbols_count = iconv_strlen($symbols_count);
        $words_count = str_word_count($text);
        $pages = (int) ($words_count/200);
        if ($pages === 0) {
            $pages = 1;
        }
        $textParams = [
            'symbolsCount' => $symbols_count,
            'wordsCount' => $words_count,
            'sentenceCount' => 0,
            'plainText' => $text,
            'size' => $size,
            'pages' => $pages,
        ];
        return $textParams;
    }

    public function getApiTextRu($uid, $userkey)
    {

        $TextRuApi= new \TextRuApi\TextRuApi($userkey);

        sleep(15);
        //Получаете результат проверки
        $jsonvisible = 'detail';
        $return = $TextRuApi->get($uid, $jsonvisible);
        return $return;
    }

    public function makeReport(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'plainText' => 'required',
            'symbolsCount' => 'numeric|min:100|max:150000',
            'promocode' => ['nullable', 'exists:promo_codes,name',
            function ($attribute, $value, $fail) use ($request) {
                $promo_code  = PromoCode::where('name', $request->get('promocode')) ->first();
                if($promo_code->max_count < 1) {
                    $fail('Данный промокод не может больше  использоваться');
                }
    },
            function ($attribute, $value, $fail) use ($request) {
                $promo_code  = PromoCode::where('name', $request->get('promocode')) ->first();
                $date1 = Carbon::parse(date('Y-m-d'));
                $date2 = Carbon::parse(date('Y-m-d', strtotime($promo_code->end_time)));
                if($date1> $date2) {
                    $fail('Данный промокод не может больше  использоваться');
                }
    },
            function ($attribute, $value, $fail) use ($request) {
                $promo_code  = PromoCode::where('name', $request->get('promocode')) ->first();
                $date1 = Carbon::parse(date('Y-m-d'));
                $date2 = Carbon::parse(date('Y-m-d', strtotime($promo_code->start_time)));
                if($date2 > $date1) {
                    $fail('Данный промокод не может использоваться');
                }
    },],
            [
                'symbolsCount.min' => 'Количество символов должно быть больше 100',
                'symbolsCount.max' => 'Количество символов не может быть больше 1500000',
                'email.required' => 'Введите ваш e-mail',
                'plainText.required' => 'Введите текст для проверки уникальности',
                'promocode.exists' => 'Промокод не найден'
            ]]);

        if($request->has('promocode') && $request->get('promocode')) {
            $promo_code = PromoCode::where('name', $request->get('promocode'))->firstOrFail();
            $promo_code -> max_count = $promo_code -> max_count-1;
            $promo_code -> save();
        }
        if($request->has('id')) {
            $check_unique = CheckUnique::findOrFail($request->get('id'));
        } else {
            $check_unique = CheckUnique::create($request->all());
        }
        foreach ($request->get('systems') as $system) {
           $report = Report::create([
               'check_unique_id' => $check_unique -> id,
               'system_id' => $system['id']
           ]);
        }
        $url = route('report', $check_unique->id);
        return $url;
    }
}
