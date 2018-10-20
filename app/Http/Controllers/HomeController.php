<?php

namespace App\Http\Controllers;

use App\Author;
use App\BookStatus;
use App\Category;
use App\Edition;
use App\PlaceStudy;
use Complex\Exception;
use Illuminate\Http\Request;
use App\Book;
use App\Beneficiary;
use Illuminate\Support\Facades\Storage;
use PHPExcel;
use PHPExcel_IOFactory;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books=Book::all();
        $beneficiars = Beneficiary::all();
        return view('dashboard.dashboard')
            ->with('books',$books)
            ->with('beneficiars',$beneficiars);
    }

    public function listView(){
        $books=Book::all();

        return view('layouts.listview')->with('books',$books);
    }

    public function importListIndex(){

        return view('layouts.importBooks');
    }

    public function importListSave(Request $request){

        $file = $request->file('file');
        $extensions=['xlsx','xls'];
        $extension='';
        if(in_array($file->guessClientExtension(),$extensions)) $extension=$file->guessClientExtension();
        if(in_array($file->getClientOriginalExtension(),$extensions)) $extension=$file->getClientOriginalExtension();

        $fileName=uniqid().'.'.$extension;
        $file->storeAs('uploads',$fileName,'uploads');
        $fileNameOriginal=$file->getClientOriginalName();

        $reader= PHPExcel_IOFactory::load('uploads/'.$fileName);
        $sheet= $reader->getActiveSheet();

        $i=2;

        while ($sheet->getCell('A'.$i)->getValue()!==null && $sheet->getCell('A'.$i)->getValue()!==''){
            $book = new Book();
            $book->name=$sheet->getCell('A'.$i)->getValue();

            $author = Author::where('name',$sheet->getCell('B'.$i)->getValue())->first();
            $author_id=0;
            if(!$author){
                $author=new Author();
                $authorName=$sheet->getCell('B'.$i)->getValue();
                (empty($authorName)) ? $author->name='Undefined' : $author->name=$authorName;
                $author_id=$author->save();
            }else{
                $author_id=$author->id;
            }

            $edition = Edition::where('name',$sheet->getCell('C'.$i)->getValue())->first();
            $edition_id=0;
            if(!$edition){
                $edition=new Edition();
                $authorName=$sheet->getCell('C'.$i)->getValue();
                (empty($authorName)) ? $edition->name='Undefined' : $edition->name=$authorName;
                $edition_id=$edition->save();
            }else{
                $edition_id=$edition->id;
            }

            $book->author_id=$author_id;
            $book->edition_id=$edition_id;
            $code = $sheet->getCell('E'.$i)->getValue();
            $codeCat = substr($code,0,3);

            $category = Category::where('code',$codeCat)->first();
            $cat_id=0;
            if(!$category){
                $category=new Category();
                $category->code=$codeCat;
                $category->name='Undefined';
                $cat_id=$category->save();
            }else{
                $cat_id=$category->id;
            }
                $book->category_id = $cat_id;

            $book->code = substr($code,4,1);

            $status = BookStatus::where('name',$sheet->getCell('F'.$i)->getValue())->first();
            $status_id=0;
            if(!$status){
                $status= new BookStatus();
                $status->name=$sheet->getCell('F'.$i)->getValue();
                $status_id=$status->save();
            }else{
                $status_id=$status->id;
            }

            $book->status_id=$status_id;
            $book->publication_year=date('Y-m-d',strtotime($sheet->getCell('D'.$i)->getValue().'-01-01'));

            $book->save();
            $i++;

        }
        unlink('uploads/'.$fileName);
        return redirect()->back()->with('success','Book was added successfully!');
    }

    public function listViewBeneficiariesIndex(){

        $beneficiaries = Beneficiary::all();

        return view('layouts.listBeneficiariesIndex')
            ->with('beneficiaries',$beneficiaries);
    }

    public function importListBeneficiariesSave(Request $request){


        $file = $request->file('file');
        $extensions=['xlsx','xls'];
        $extension='';
        if(in_array($file->guessClientExtension(),$extensions)) $extension=$file->guessClientExtension();
        if(in_array($file->getClientOriginalExtension(),$extensions)) $extension=$file->getClientOriginalExtension();

        $fileName=uniqid().'.'.$extension;
        $file->storeAs('uploads',$fileName,'uploads');
        $fileNameOriginal=$file->getClientOriginalName();

        $reader= PHPExcel_IOFactory::load('uploads/'.$fileName);
        $sheet= $reader->getActiveSheet();

        $i=2;

        while ($sheet->getCell('A'.$i)->getValue()!==null && $sheet->getCell('A'.$i)->getValue()!==''){
            $beneficiary = new Beneficiary();
            $beneficiary->first_name = $sheet->getCell('A'.$i)->getValue();
            $beneficiary->last_name= $sheet->getCell('B'.$i)->getValue();
            $place_study = PlaceStudy::where('name',$sheet->getCell('C'.$i)->getValue())->first();
            $placeid=0;
            if(!$place_study){
                $place_study = new PlaceStudy();
                $place_study->name=$sheet->getCell('C'.$i)->getValue();
                $placeid=$place_study->save();
            }else{
                $placeid=$place_study->id;
            }
            $beneficiary->study_place_id = $placeid;
            $beneficiary->study_year = $sheet->getCell('D'.$i)->getValue();
            $beneficiary->address = $sheet->getCell('E'.$i)->getValue();
            $beneficiary->idnp = $sheet->getCell('F'.$i)->getValue();
            $beneficiary->tel_number = $sheet->getCell('G'.$i)->getValue();
            $beneficiary->email = $sheet->getCell('H'.$i)->getValue();
            $beneficiary->birthday = date('Y-m-d',strtotime($sheet->getCell('I'.$i)->getValue()));
            $beneficiary->save();
            $i++;
        }
        unlink('uploads/'.$fileName);

        return redirect()->back()->with('success','Beneficiary was added successfully!');
    }
    public function importListBeneficiariesIndex(){

        return view('layouts.importBeneficiaries');
    }

    public function manualAddBook(Request $request){

        $name = $request->name;
        $author = $request->author;
        $edition = $request->edition;
        $year = $request->year.'-01-01';
        $language = $request->language;
        $category = $request->category;
        $status = $request->status;

        $author = Author::where('name',$author)->first();
        $author_id=0;
        if(!$author){
            $author= new Author();
            $author->name=$request->author;
            $author->save();
            $author_id=$author->id;
        }else{
            $author_id=$author->id;
        }


        $edition = Edition::where('name',$edition)->first();
        $edition_id=0;
        if(!$edition){
            $edition=new Edition();
            $edition->name=$request->edition;
            $edition->save();
            $edition_id=$edition->id;
        }else{
            $edition_id=$edition->id;
        }

        $year = date('Y-m-d',strtotime($year));

        $book = new Book();
        $book->name = $name;
        $book->author_id = $author_id;
        $book->edition_id = $edition_id;
        $book->publication_year = $year;
        $book->code = $language;
        $book->category_id = $category;
        $book->status_id = $status;

        $book->save();



        return redirect()->back()->with('success','Book was added successfully!');
    }

    public function manualAddBeneficiary(Request $request){

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $year = $request->study_year;
        $address = $request->address;
        $idnp = $request->idnp;
        $phone = $request->phone;
        $email = $request->email;
        $birthday = date('Y-m-d',strtotime($request->birthday));
        $place = $request->study_place;

        if(strlen($idnp)!=13){
            return redirect()->back()->withErrors('Invalid IDNP!');
        }
        if(!is_numeric($idnp)){
            return redirect()->back()->withErrors('Invalid IDNP!');
        }

        $beneficiary = new Beneficiary();
        $beneficiary->first_name = $first_name;
        $beneficiary->last_name = $last_name;
        $beneficiary->study_year = $year;
        $beneficiary->address = $address;
        $beneficiary->idnp = $idnp;
        $beneficiary->tel_number = $phone;
        $beneficiary->email = $email;
        $beneficiary->birthday=$birthday;
        $beneficiary->study_place_id=$place;
        $beneficiary->save();

        return redirect()->back()->with('success','Beneficiary was added successfully!');
    }
}
