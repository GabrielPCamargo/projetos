<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MoneyCategory;
use App\Models\Activity;
use Illuminate\Support\Facades\Validator;


class FinanceController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->only(['index','store','create','destroy','update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($month)
    {
        //


        $activities = Activity::Where('user_id', '=', auth()->user()->id)->where('spend', '1')->whereMonth('date', $month)->get();
        $earnings = Activity::Where('user_id', '=', auth()->user()->id)->where('spend', '0')->whereMonth('date', $month)->get();

        //categorias
        $categories = auth()->user()->categories->where('spend', '1');

        $categoriesBalance = array();
        
        $salary = new \stdClass();
        $salary->name = 'Rendimentos';
        $salary->value = 0;
       

        foreach($earnings as $earn){
           
            $salary->value = $salary->value + $earn->price;
        }

        $salary->balance = $salary->value;

        $categoriesBalance[0] = $salary;

        foreach($categories as $category){

            $categoryBalance = new \stdClass();
            $categoryBalance->name = $category->name;
            $categoryBalance->value = ($salary->value * $category->percentage) / 100;
            $categoryBalance->value = number_format($categoryBalance->value, 2);
            $categoryBalance->balance = $categoryBalance->value;

            

            foreach($activities as $activity){
                if($activity->category->name == $category->name){
                    $categoryBalance->balance = $categoryBalance->balance - $activity->price;
                    $categoryBalance->balance = number_format($categoryBalance->balance, 2);
                }
            }

            $categoriesBalance[count($categoriesBalance)] = $categoryBalance;

        }

        



        return view('finance.index', compact('activities', 'earnings', 'categoriesBalance', 'month'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //Recuperar as categorias.
        
        $categories = MoneyCategory::all();
        
        
        return view('finance.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|unique:activities|max:100',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.unique' => 'Já existe uma categoria com esse nome, por favor escolha outro!',
            'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        ])->validate();
    
        auth()->user()->activities()->create($request->all());
    
    
        $request->session()->flash('message', 'Atividade criada com sucesso');
        return redirect('/finance/view/' . date('m'));
    
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $categories = auth()->user()->categories;
        $activity = Activity::find($id);

        return view('finance.edit', compact('categories', 'activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $rules = [
            'name' => 'required|max:100',
        ];
    
        $validator = Validator::make($request->all(), $rules, $messages = [
            'name.required' => 'O campo nome é obrigatório!',
            'name.unique' => 'Já existe uma categoria com esse nome, por favor escolha outro!',
            'name.max' => 'O campo nome tem a capacidade máxima de 100 caracteres.',
        ])->validate();

        $activity = Activity::find($id);
        
        $activity->name = $request->name;
        $activity->description = $request->description;
        $activity->category_id = $request->category_id;
        $activity->price = $request->price;
        $activity->date = $request->date;
        $activity->spend = $request->spend;

        $activity->save();

        return redirect('/finance/view/' . date('m'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $activity = Activity::find($id);
        $activity->delete();

        return redirect('/finance/view/' . date('m'));
    }
}
