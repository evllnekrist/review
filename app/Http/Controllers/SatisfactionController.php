<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use App\Models\RatingModel;
use App\Models\RequestAssistanceModel;
use App\Models\SelectionListModel;
use App\Models\SiteModel;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Crypt;
use DB;

class SatisfactionController extends Controller
{

    public function __construct() {
        parent::__construct();
    }
    
    public function index(Request $request)
    {
        return 'Holaa!';
    }
    
    public function create_raih(Request $request,$id)
    {
        return 'this is your endpoint--> 
                <br><a href="'.env('APP_URL').'/satisfaction'.'?raih='.hash('sha256',$id).'" target="_blank">click me (SHA-256)</a> = '.hash('sha256',$id);
                // <br><a href="'.env('APP_URL').'/satisfaction'.'?raih='.Crypt::encryptString($id).'" target="_blank">click me (AES-256)</a> = '.Crypt::encryptString($id)
    }

    public function display_add_form(Request $request)
    {
        $website_key = env('WEBSITE_KEY');
        $request_assistance_id_hash         = (isset($_GET['raih'])?$_GET['raih']:'');
        $selected_data_rating               = RatingModel::where(DB::raw("encode(digest(request_assistance_id::text,'sha256'),'hex')"),$request_assistance_id_hash)->where('website_key',$website_key)->first();
        // dd($selected_data_rating);
        $selected_data_request_assistance   = RequestAssistanceModel::where(DB::raw("encode(digest(request_assistance_id::text,'sha256'),'hex')"),$request_assistance_id_hash)->where('website_key',$website_key)
                                            ->with('site')->with('assistant')->first();
        $list_score_complimentary           = SelectionListModel::where('selection_type','SCORE_COMPLIMENTARY')->where('website_key',$website_key)->get();
        if($selected_data_rating && $selected_data_request_assistance){
            return view('page.satisfaction.add',[
                'detail'=>$selected_data_request_assistance->makeHidden(['request_assistance_id']),
                'request_assistance_id_hash'=>$request_assistance_id_hash,
                'list_score_complimentary'=>$list_score_complimentary,
                'selected'=>$selected_data_rating->makeHidden(['rating_id','request_assistance_id']),
            ]);
        }else if($selected_data_request_assistance){
            return view('page.satisfaction.add',[
                'detail'=>$selected_data_request_assistance->makeHidden(['request_assistance_id']),
                'request_assistance_id_hash'=>$request_assistance_id_hash,
                'list_score_complimentary'=>$list_score_complimentary,
            ]);
        }else{
            return '<center><h1>We very sorry...</h1><br><br><br><br><h4>Request assistance data not found,</h4><h6>Cant continue to review page</h6></center>';
        }
    }

    public function store(Request $request)
    {
        if($request->ajax()) {
            $param = $request->all();
            $website_key = env('WEBSITE_KEY');
            $request_assistance_id_hash = $param['request_assistance_id_hash'];
            // $request_assistance_id = Crypt::decryptString($param['request_assistance_id_hash']);
            $selected_data_rating = RatingModel::where(DB::raw("encode(digest(request_assistance_id::text,'sha256'),'hex')"),$request_assistance_id_hash)->where('website_key',$website_key)->first();
            
            if($selected_data_rating){
                return array("status" => false,"message" => "Your rating already submitted");
            }else{
                $selected_data_request_assistance = RequestAssistanceModel::where(DB::raw("encode(digest(request_assistance_id::text,'sha256'),'hex')"),$request_assistance_id_hash)->where('website_key',$website_key)->first();
                if($selected_data_request_assistance){
                    DB::beginTransaction();  
                    $item = new RatingModel;
                    $item->request_assistance_id    = @$selected_data_request_assistance->request_assistance_id;
                    $item->website_key              = $website_key;
                    $item->score                    = @$param['score'];
                    $item->score_complimentary      = str_replace(",false","",str_replace("false,","",@$param['score_complimentary']));
                    $item->note                     = @$param['note'];
                    $item->site_code                = @$selected_data_request_assistance->site_code;
                    $item->created_by               = @$selected_data_request_assistance->member_id;
                    $item->save();

                    DB::commit();
                    return array(
                        "status" => true,"message" => "Rating saved successfully!"
                    );
                }else{
                    DB::rollback();
                    return array(
                        "status" => false,"message" => "Request assistance data not found, cant update..."
                    );
                }
            }
        }
    }
    
}
