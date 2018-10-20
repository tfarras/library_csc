<?php

namespace App\Http\Controllers;

use App\Author;
use App\BookStatus;
use App\Category;
use App\Edition;
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
            $code = $arr = explode(".", $code, 2);


            $category = Category::where('code',$code[0])->first();
            $cat_id=0;
            if(!$category){
                $category=new Category();
                $category->code=$code[0];
                $category->name='Undefined';
                $cat_id=$category->save();
            }else{
                $cat_id=$category->id;
            }
                $book->category_id = $cat_id;
            if(isset($code[1])){
                $code = substr($code[1], 0, strpos($code[1], ' '));
            }else{
                $code=$code[0];
            }

            $book->code = $code;

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
        return redirect()->back();
    }
}
